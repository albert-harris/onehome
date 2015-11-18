var map, geocode, mm;
window.places;

function loadMap() {
   
    var opts = {
        zoom: 11,
        center: new GeoPoint(103.83050972046, 1.304787132947),
        enableDefaultLogo: false,
        showCopyright: false,
        resize: {
            w: 0.5,
            h: 0.5
        }
    };
    map = new SD.genmap.Map(document.getElementById('map'), opts);
    geocode = new SDGeocode(map);
    geocode.removeMouseClick();
    //auto
    suggest();
}

function saveLongLat(x, y) {
    $("#longlat").html(x + "," + y);
}

function naturalSorter(as, bs) {
    var a, b, a1, b1, i = 0,
        n, L,
        rx = /(\.\d+)|(\d+(\.\d+)?)|([^\d.]+)|(\.\D+)|(\.$)/g;
    if (as === bs) return 0;
    a = as.toLowerCase().match(rx);
    b = bs.toLowerCase().match(rx);
    L = a.length;
    while (i < L) {
        if (!b[i]) return 1;
        a1 = a[i],
        b1 = b[i++];
        if (a1 !== b1) {
            n = a1 - b1;
            if (!isNaN(n)) return n;
            return a1 > b1 ? 1 : -1;
        }
    }
    return b[i] ? -1 : 0;
}

/*
 * callback function after query address by key
 */
function set_data(json) {
	if (mm != undefined) mm.clear();

	// remove places not contain search keyword
	var s = $('#address').val().toLowerCase();
	json = $.grep(json, function(e) {
		return (typeof e.t !== 'undefined' && e.t.toLowerCase().indexOf(s)>-1) ||
			(typeof e.st_na !== 'undefined' && e.st_na.toLowerCase().indexOf(s) > -1) ||
			(typeof e.a !== 'undefined' && e.a.toLowerCase().indexOf(s)>-1);
	});
	window.places = json;	// save places for later use
	
	var posCodes = {};
	if (json != null && json.length > 0) {
		for (var i = 0; i < json.length; i++) {
			var dataTmp = json[i];
			posCodes[dataTmp.pc] = dataTmp.pc;
		}
	}

	// query address information by post codes
	$.ajax({
		url: $('#loaddataMap').val() + JSON.stringify(posCodes),
		type: 'GET',
		dataType: "json",
		async: true,
		success: function(dataJsonMap) {
			//seach data
			$.ajax({
				url: $('#searchPropertyOnsite').val(),
				type: 'GET',
				async: true,
			}).done(function(data) {
				dataOnsite = data;

				//data null
				if (json == null || json.length == 0) {
					$('#loading').remove();
					if (dataOnsite == '') {
						$('.table-property').before('<p style="line-height:300px;text-align:center;font-weight:bold;font-size:16px;">No results</p>');
					} else {
						$('.table-property tbody').html(dataOnsite);
						$('.table-property tbody tr').tsort('td:eq(1)[data-timestamp]', {
							order: 'asc',
							attr: 'data-timestamp'
						});
					}
					$('.table-property ,#btn-control').remove();
					return;
				}

				//data not null       
				for (var i = 0; i < json.length; i++) {
					var rec = json[i];
					if (rec.x && rec.y) {
						var textType = '';
						var propertyType = '';
						var buildingName = '';
						var blk_no = '';
						var street_name = '';

						if (dataJsonMap.hasOwnProperty(rec.pc)) {
							var itemName = dataJsonMap[rec.pc];
							textType = itemName['title'];
							propertyType = itemName['type'];
							buildingName = itemName['building'];
							blk_no = itemName['blk_no'];
							street_name = itemName['street_name'];
						}

						var BlkNoStreetName = "<input class='blk_no' type='hidden' value='" + blk_no + "' ><input type='hidden' class='street_name'  value='" + street_name + "'>";

						var td1 = '<td class="alt">' + BlkNoStreetName + '<input type="radio" value="1" name="check-radio"  class="select-postal-code"></td>';
						var title = unescape(rec.a).split(",");
						var td2 = '<td class="alt title " data-timestamp="' + title[0] + '">' + title[0] + '</td>';
						var td3 = '<td building="' + buildingName + '" class="alt propertyType" type="' + propertyType + '">' + textType + '</td>';
						var td4 = '<td class="alt postal-code ' + rec.pc + '" xy=' + rec.x + '-' + rec.y + '>' + rec.pc + '</td>';
						$('.table-property tbody').append('<tr class="sort_title" >' + td1 + td2 + td3 + td4 + '</tr>');
					}
				}
				//add data search listing on site
				if (dataOnsite != '') {
					$('.table-property tbody').append(dataOnsite);
					$('.table-property tbody tr').tsort('td:eq(1)[data-timestamp]', {
						order: 'asc',
						attr: 'data-timestamp'
					});
				}
				$('#loading').remove();
				$('.sort_title').each(function() {
					var checkTitle = $(this).find('.title').html();
					if (checkTitle == 'undefined') {
						$(this).remove();
					}
				});

				$('.table-property tbody tr:even').addClass('even');
				removeText();
			});
		}
	});
}

function removeText(){
    $('table tr td.propertyType').each(function(){
         var text = $(this).html();
         if(text=='') $(this).parent('tr').remove();
    });

     $('table tr td.postal-code').each(function(){
         var code = $(this).text();
         if(code=='') $(this).parent('tr').remove();        
     });
  
}

function assignClickEvent(row, marker, rec) {
    row.click(function() {
        var tbody = $("#datatableInfo").children(":nth-child(1)");
        $(tbody).children().removeClass("selected");
        $("#address").val(rec.a);
        $(this).addClass("selected");
        $("#address").focus();
        map.setCenter(marker.position, map.zoom);
        map.infoWindow.open(marker, rec.a);
        $('#postal_code').val(rec.pc);
        $('#postal_code_xy').val(rec.x + "-" + rec.y);
    });
}

function search(region, keyword) {
    $("#info").hide();
    gc = SDGeocode.SG;
    if (region == 'ID') gc = SDGeocode.ID;
    else if (region == 'MY') gc = SDGeocode.MY;
    else if (region == 'PH') gc = SDGeocode.PH;
    var searchOption = {
        "d": 1,
        "q": keyword,
        "limit": 20,
        "ctype": 1
    };
    geocode.requestData(gc, searchOption);
}

function enter_handle(obj) {
    if (obj.id) {
        var rec = unescape(obj.id).split("_");
        var title = unescape(obj.title).split("_");
        var icon = new SD.genmap.MarkerImage({
            image: "../image/openrice_icon.png",
            title: title[0],
            iconSize: new Size(15, 15),
            iconAnchor: new Point(7, 15),
            infoWindowAnchor: new Point(5, 0)
        });
        mm = new SD.genmap.MarkerStaticManager({
            map: map
        });
        var geo = new GeoPoint(parseFloat(rec[1]), parseFloat(rec[2]));
        var marker = mm.add({
            position: geo,
            map: map,
            icon: icon
        });
        $('#postal_code').val(rec.pc);
        $('#postal_code_xy').val(rec[1] + "-" + rec[2]);
        map.setCenter(marker.position, map.zoom);
        map.infoWindow.open(marker, title[1] + "<br>" + rec[1] + " - " + rec[2]);
    }
}

function suggest() {
    setTimeout(function() {
        var keyword = $("#address").val();
        if (keyword.length > 0) {
            search($("#region").val(), keyword);
        } else {
            $("#datatableInfo").empty();
        }
    }, 1000);
}
$(document).ready(function() {
    var link = $('#mapDropdownlist').val();
    var itemSelectPostalCode = ''; 
    var itemBuilding = '';
    var item_street_address_select='';

    // Dec 01, 2014 ANH DUNG
    var ad_postal_code = "";
    var ad_blk_no = "";
    var ad_street_name = "";
    var ad_property_name_or_address = "";
    var ad_building_name = "";
    var titlePropery ='';
    // Dec 01, 2014 ANH DUNG

    $('.select-postal-code').live('click', function() {
        var parent = $(this).parent('td').parent('tr');
        var linDropdown = link + parent.find('.title').html();

        $('#name').val(parent.find('.title').html());
        $('#postal_code').val(parent.find('.postal-code').html());
        $('#postal_code_xy').val(parent.find('.postal-code').attr('xy'));
        $('#property_type').val(parent.find('.propertyType').attr('type'));

        if(parent.find('.propertyType').attr('building') !=''){
           itemSelectPostalCode = parent.find('.postal-code').html();
           ad_building_name     = parent.find('.propertyType').attr('building');
           itemBuilding         = parent.find('.propertyType').attr('building');
        }else{
		   $.each(window.places, function () {
			   if (this.pc==parent.find('.postal-code').text().trim()) {
				   itemBuilding = this.t;
			   }
		   });
           $('#buildingname').val(parent.find('.title').html()); 
        }

       //dung de lay dia chi cua address dang chon
       item_street_address_select   = parent.find('.title').html();
       ad_property_name_or_address  = parent.find('.title').html();
       ad_postal_code  = parent.find('.postal-code').html();
       ad_blk_no       = parent.find('.blk_no').val();
       ad_street_name  = parent.find('.street_name').val();
       $('#mapDropdownlist').val(linDropdown);

    });
    
    function buildDisplayAddress(itemBuilding,item_street_address_select,itemSelectPostalCode){
        var displayTitle ='';
        if(itemBuilding !='' && itemBuilding !='undefined')        displayTitle += $.trim(itemBuilding) + ', ';
        if(item_street_address_select !='' &&  item_street_address_select !='undefined')   displayTitle += $.trim(item_street_address_select);
        //if(itemSelectPostalCode !='' && itemSelectPostalCode !='undefined' ) displayTitle += $.trim(itemSelectPostalCode);
        parent.$('#Listing_display_address').val(displayTitle);
    }

    function buildTitleProperty(itemBuilding,ad_street_name){
        var title ='';
        if(ad_street_name !='' && ad_street_name !='undefined') title = $.trim(ad_street_name);
        if(itemBuilding !='' && itemBuilding !='undefined')           title = $.trim(itemBuilding);
        
        parent.$('#Listing_property_name_or_address').val(title);
    }

    function buildDropdownPostalCode(itemCurrent,itemSelectPostalCode,ad_building_name){
        var itemDropdownlist ='';
        $('table td.postal-code').each(function(){
            var postcode = $(this).html();
            itemDropdownlist +='<option value='+postcode+'>'+postcode+'</option>';
        }) 

        var item = parent.$('#postal-ajax');
        parent.$('#Listing_building_name').val(ad_building_name);
        parent.$('#Listing_property_building_name').val(ad_building_name);  
        parent.$('#Listing_postal_code option[value=""]').remove();
        parent.$('#Listing_postal_code_xy').val($('#postal_code_xy').val());
        parent.$("#Listing_postal_code").html(itemDropdownlist);
        parent.$("#Listing_postal_code_tmp").val(itemDropdownlist);
        parent.$("#Listing_postal_code").val($('#postal_code').val());
        parent.$("#Listing_postal_code").trigger('click',function(){
             parent.$("#Listing_postal_code").val($('#postal_code').val());
        })
    }

    function buildPropertyType(){
        parent.$("#Listing_property_type_2").val($('#property_type').val());
        parent.$("#Listing_property_type_2").trigger('click',function(){
            parent.$("#Listing_property_type_2").val($('#property_type').val());
        });       
    }

    function addMoreItemByAdung(ad_postal_code,ad_blk_no,ad_street_name,ad_property_name_or_address, ad_building_name){
        // Dec 01, 2014 ANH DUNG
        parent.$('.ad_postal_code').val(ad_postal_code);
        parent.$('.ad_blk_no').val(ad_blk_no);
        parent.$('.ad_street_name').val(ad_street_name);
        parent.$('.ad_property_name_or_address').val(ad_property_name_or_address);
        parent.$('.ad_building_name').val(ad_building_name);
    }

    //select address
    $('.apply').live('click', function() {
        //build  list postal code
        buildDropdownPostalCode(this,itemSelectPostalCode);
        //build display address
        buildDisplayAddress(itemBuilding,item_street_address_select,itemSelectPostalCode);
        //build title property
        buildTitleProperty(itemBuilding,item_street_address_select);
        //build PropertyType
        buildPropertyType();
        // Dec 01, 2014 ANH DUNG
        addMoreItemByAdung(ad_postal_code,ad_blk_no,ad_street_name,ad_property_name_or_address, ad_building_name);

        parent.$('.reset-address').show(); 
        parent.$.fancybox.close();
    });
});