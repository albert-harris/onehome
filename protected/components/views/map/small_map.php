<?php if($data['fullScreen']=='map'): ?>
<?php if (isset($data['x']) && isset($data['y'])): ?>
    
    <script type="text/javascript" language="javascript" src="http://www.streetdirectory.com/js/map_api/m.php"></script> 
    <script type="text/javascript">
        function initialize() {
            var latlng = new GeoPoint(<?php echo (float)$data['x'] ?>,<?php echo (float)$data['y'] ?>);
            var myOptions = {
                zoom: 13,
                center: latlng,
                enableDefaultLogo: false,
                showCopyright: false,
                resize: {
                    w: 243,
                    h: 243
                }
            };

            var map = new SD.genmap.Map(
                    document.getElementById('map_canvas'),
                    myOptions
                    );

            var icon = new SD.genmap.MarkerImage({
                image:  "<?php echo Yii::app()->theme->baseUrl; ?>/img/condo_32_h.png",
                title: "",
                iconSize: new Size(15, 50),
                iconAnchor: new Point(5, 30),
                infoWindowAnchor: new Point(0, 0)
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
<?php endif; ?>
        <body onload="initialize()">
            <div id="map_canvas" style="width:100%; height:100%;"></div>
        </body>    
<?php else: ?>
    

<div class="box-3">
    <h3 class="title-2">Location</h3>
    <p class="text-center"><?php echo $data['title']; ?></p>
    <div class="map">
        <iframe style="width:270px;height: 270px;border:none;overflow: none;margin-left:-10px;" src="<?php echo Yii::app()->createAbsoluteUrl('site/loadmapdetail',array('listing_id'=>$data['model']->id,'size'=>'small_map')) ?>"></iframe>
    </div>
    <div class="location-group text-center">
        <a class='select-map' href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug' => $data['model']->slug, 'm' => 'map', 'type' => 'location')) ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-location.png" alt="location" /></a>
        <a class='select-map' href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug' => $data['model']->slug, 'm' => 'map', 'type' => 'car')) ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-car-2.png" alt="car" /></a>
        <a class='select-map' href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug' => $data['model']->slug, 'm' => 'map', 'type' => 'building')) ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-hotel.png" alt="building" /></a>
        <a class='select-map' href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug' => $data['model']->slug, 'm' => 'map', 'type' => 'sign')) ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-sign-post.png" alt="sign post" /></a>
    </div>
</div>

<?php
$arrCat = $data['arrCat'];
$dataCat = array();
$dataCar = json_decode($data['json_map'], true);
?>   
<div class="map-item" >
    <div class="box-3">
        <h3 class="title-2">Nearest MRT Stations</h3>
        <ul class="list-2 list-unstyled" style="max-height: 205px;overflow-y: scroll;overflow: auto;">
		<?php
			if(isset($dataCar[51]) && is_array($dataCar[51]) && count($dataCar[51])>0){
					 foreach ($dataCar[51] as $value)  echo "<li><a href='javascript:;'>".$value['v']."</a></li>";
			}
		?>                  
        </ul>
    </div>    
</div>   
<div class="map-item" >
    <div class="box-3">
        <h3 class="title-2">Nearest Schools</h3>
        <ul class="list-2 list-unstyled" style="max-height: 205px;overflow-y: scroll;overflow: auto;">
            <?php
                     if(isset($dataCar[23]) && is_array($dataCar[23]) && count($dataCar[23])>0){
                                foreach ($dataCar[23] as $value)  echo "<li><a href='javascript:;'>".$value['v']."</a></li>";
                       }
            ?>                  
        </ul>
    </div>    
</div>   
<?php endif; ?>   