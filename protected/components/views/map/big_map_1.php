<script type="text/javascript" language="javascript" src="http://www.streetdirectory.com/js/map_api/m.php"></script> 
<script type="text/javascript">
	function initialize() {
//		var latlng = new GeoPoint(103.743878,1.349677);
		var latlng = new GeoPoint(<?php echo $data['x'] ?>,<?php echo $data['y'] ?>);
		var myOptions = {
			zoom: 13,
			center: latlng,
                        enableDefaultLogo:false,
			showCopyright: false,
                        resize: {
                           w: 630,
                           h: 390
                       }                       
		};

		var map = new SD.genmap.Map(
			document.getElementById('map_canvas'), 
			myOptions
		);
		
                console.log(map.canvasInfo);
                
		var icon = new SD.genmap.MarkerImage({
			image : "<?php echo Yii::app()->theme->baseUrl; ?>/img/openrice_icon.png",
			title : "",
			iconSize : new Size(15, 15),
			iconAnchor : new Point(7, 15),
			infoWindowAnchor : new Point(0, 0)
		});
		
		var mm = new SD.genmap.MarkerStaticManager({
			map: map
		});			
		
		var marker = mm.add({
			position: latlng,
			map: map,
			icon: icon
		});
		
		var customInfo = new CustomInfoWindow({
			size: new Size(220, 50),
			minSize: new Size(100, 50)
		});
		map.setInfoWindow(customInfo);
		map.infoWindow = customInfo;
		map.infoWindow.open(marker, "<?php echo isset($data['title']) ? $data['title'] : '' ?>");
	}

	SD.extend(CustomInfoWindow, SD.genmap.GInfoWindow);
	function CustomInfoWindow(options) {
		CustomInfoWindow.superclass.constructor.call(this, options);
	}
	CustomInfoWindow.prototype.init = function() {
		this.validating();
		
		// content div
		this.divContent = document.createElement("div");
		this.divContent.style.cssText = "position:absolute; top:0; left:0; background-color:#FFFFFF; padding:5px; border:1px solid #CCCCCC";
		this.divContent.innerHTML = "";
		this.div.appendChild(this.divContent);
		
		// exit button
		this.exitButton = document.createElement("img");
//		this.exitButton.src = "http://www.streetdirectory.com/api/developer/docs/image/btnX.gif";
//		this.exitButton.style.cssText = "position:absolute; top:0; left:-10; width:7px; height:7px; cursor:pointer; z-index:20";
//		this.div.appendChild(this.exitButton);
//		
		// pointer div
		this.divPointer = document.createElement("div");
		this.divPointer.style.cssText = "position:absolute; top:0; left:0; width:35px; height:32px; background:url('<?php echo Yii::app()->theme->baseUrl; ?>/img/arrow_bgbubble.png') no-repeat;";
		this.div.appendChild(this.divPointer);
		
		var _info = this;
		EventManager.add(this.exitButton, 'click', function() {
			_info.close();
		});
		
		EventManager.add(this.div, "mousedown", function(e) {
			SD.util.cancelEvent(e, true, true);
		});
		EventManager.add(this.div, "DOMMouseScroll", function(e) {
			e.cancelBubble = true;
			e.cancel = true;
		});
		EventManager.add(this.div, "mousewheel", function(e) {
			e.cancelBubble = true;
			e.cancel = true;
		});
		
		this.reloadUI();
		this.setDisplay(false);
	};
	CustomInfoWindow.prototype.reloadUI = function() {
		this.divContent.style.width = (this.size.width) + "px";
		this.divContent.style.height = (this.size.height) + "px";
		this.divContent.style.top = "27px";
		this.divContent.innerHTML = this.content;
		
		this.exitButton.style.top = "30px";
		this.exitButton.style.left = (this.size.width) + "px";
		
		this.divPointer.style.top = (this.size.height + 26) + "px";
		this.divPointer.style.left = "75px";
	};
</script>

<div class="main-inner-3">
    <div class="box-3">
        <p class="a-center"><?php echo $data['title']; ?></p>
        <body onload="initialize()">
             <div id="map_canvas" style="width:100%; height:100%;"></div>
        </body>             
    </div>
    
   
    
</div>
<div class="sidebar-2">
    <div class="location-group" >
        <a class='select-map' href="javascript:;"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-location.png" alt="location" /></a>
        <a class='select-map' href="javascript:;"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-car-2.png" alt="car" /></a>
        <a class='select-map' href="javascript:;"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-hotel.png" alt="building" /></a>
        <a class='select-map' href="javascript:;"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-sign-post.png" alt="sign post" /></a>
    </div>     
        <?php
           $arrCat = $data['arrCat'];
           $dataCat =array();
           $data= json_decode($data['json_map'],true);
           foreach ($arrCat as $key=>$tab):
               $class='location';
               if($key==1093)  $class='building';
               if($key=='car')  $class='car';

       ?>   
       <div class="map-item <?php echo $class ?>" <?php if($class !='location') echo 'style="display:none;"'?>  >
           <div class="box-3">
               <h3 class="title-2"><?php echo $tab; ?></h3>
               <?php 
                       if(isset($data[$key])){
                            echo '<ul class="list-2">';
                            if(is_array($data[$key]) && count($data[$key])>0){
                                foreach ($data[$key] as $value)  echo "<li><a href='javascript:;'>$value</a></li>";
                            }
                            echo "</ul>";
                       }
                   ?>
           </div>    
       </div>
       <?php endforeach;?>
</div>
<script type="text/javascript">
$(function(){
    $('.select-map').on('click',function(){
          var tab=  $(this).find('img').attr('alt');
          $('.map-item').hide();
          $('.'+tab).show();
    });
})
</script>