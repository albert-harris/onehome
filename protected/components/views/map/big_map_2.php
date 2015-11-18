<?php echo $data['x'] ?>,<?php echo $data['y'] ?>
<body id="listing-map" class="pg_sg">
    

<div class="map-wrapper">
	<div class="map-window">
<!--								
		<div class="map-caption">
							Buildings near <span class="bluetext">Iridium</span>
			
					</div>-->
	
		<div class="map-div" id="map-div"></div>                 
			<script type="text/javascript" src="http://www.streetdirectory.com/js/map_api/m.php?api=9d8ec051c66464b06807209ae334986c39a3c7ae"></script> 
			<script type="text/javascript" src="http://www.propertyguru.com.sg/js/mxn/mxn.js?(streetdirectory)"></script>
			<script type="text/javascript">
				$(function () {
					var m = new mxn.Mapstraction('map-div','streetdirectory');
					m.addControls({zoom:'small'});
					var myPoint = new mxn.LatLonPoint(1.315074,103.842537);
					m.setCenterAndZoom(myPoint, 16);

					m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(1.31556, 103.842655)) ,{
							label : "Olivio",
							infoBubble : "<table class='table-infobubble'><tr><td><a href='/project/olivio-246'><img src='http://cdn-sg1.pgimgs.com/images/thumb/b/d/f/0/bdf0f630923296_1_V75B.jpg'></a></td><td><a href='/project/olivio-246'>Olivio</a><BR/>30 Surrey Road<BR/>307761</td></tr></table>",
							marker : 8,
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/condo_32.png",
							iconSize : [32,70],
							draggable : false,
							hover : true
					});
					m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(103.969085,1.333542)) ,{
							label : "Olivio",
							infoBubble : "<table class='table-infobubble'><tr><td><a href='/project/olivio-246'><img src='http://cdn-sg1.pgimgs.com/images/thumb/b/d/f/0/bdf0f630923296_1_V75B.jpg'></a></td><td><a href='/project/olivio-246'>Olivio</a><BR/>30 Surrey Road<BR/>307761</td></tr></table>",
							marker : 8,
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/condo_32.png",
							iconSize : [32,70],
							draggable : false,
							hover : true
					});
											
					m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(103.969085,1.333542)) ,{
							label : "Olivio",
							infoBubble : "<table class='table-infobubble'><tr><td><a href='/project/olivio-246'><img src='http://cdn-sg1.pgimgs.com/images/thumb/b/d/f/0/bdf0f630923296_1_V75B.jpg'></a></td><td><a href='/project/olivio-246'>Olivio</a><BR/>30 Surrey Road<BR/>307761</td></tr></table>",
							marker : 8,
							iconShadow: "http://www.propertyguru.com.sg/images/pg/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "http://www.propertyguru.com.sg/images/pg/maptool/condo_32.png",
							iconSize : [32,70],
							draggable : false,
							hover : true
					});
											

					m.addMarkerWithData(new mxn.Marker(myPoint) ,{
						icon : "http://www.propertyguru.com.sg/images/pg/maptool/condo_32_h.png",
						iconSize : [32,70],
						draggable : false,
						label : "Iridium",
						infoBubble: "<table class='table-infobubble'><tr><td><img src='http://cdn-sg1.pgimgs.com/images/thumb/b/d/f/0/bdf0f630923296_1_V75B.jpg'></td><td><b>Iridium</b><BR/>11 Lincoln Road<BR />300000</td></tr></table>",
						hover : true
					});
				});
			</script>

			</div>
    
    </body>
    
    <style>
        
        .map-div {
    height: 500px;
    overflow: hidden;
    position: relative;
    width: 740px;
}
    </style>