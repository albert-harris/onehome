<?php if($data['fullScreen']=='map'): ?>
<?php $dataJson = json_decode($data['json_map'],true);?>
<?php if (isset($data['x']) && isset($data['y'])): ?>
    <script type="text/javascript" language="javascript" src="http://www.streetdirectory.com/js/map_api/m.php"></script> 
    <script type="text/javascript">
        function initialize() {
            var latlng = new GeoPoint(<?php echo $data['x'] ?>,<?php echo $data['y'] ?>);
            var myOptions = {
                zoom: 13,
                center: latlng,
                enableDefaultLogo: false,
                showCopyright: false,
            };

            var map = new SD.genmap.Map(
                    document.getElementById('map_canvas'),
                    myOptions
                    );

            var icon = new SD.genmap.MarkerImage({
                image:  "<?php echo Yii::app()->theme->baseUrl; ?>/img/condo_32_h.png",
                title: "",
                iconSize: new Size(32, 70),
                iconAnchor: new Point(15, 70),
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
            map.infoWindow.open(marker, "<?php echo isset($data['title']) ? $data['title'].'' : '' ?>");
        }

        SD.extend(CustomInfoWindow, SD.genmap.GInfoWindow);
        function CustomInfoWindow(options) {
            CustomInfoWindow.superclass.constructor.call(this, options);
        }
        CustomInfoWindow.prototype.init = function() {
            this.validating();

            // content div
            this.divContent = document.createElement("div");
            this.divContent.style.cssText = "font-size:12px; position:absolute; top:0; left:0; background-color:#FFFFFF; padding:5px; border:1px solid #CCCCCC";
            this.divContent.innerHTML = "";
            this.div.appendChild(this.divContent);

            // exit button
            this.exitButton = document.createElement("img");
            // pointer div
            this.divPointer = document.createElement("div");
            this.divPointer.style.cssText = " position:absolute; top:0; left:0; width:35px; height:32px; background:url('<?php echo Yii::app()->theme->baseUrl; ?>/img/arrow_bgbubble.png') no-repeat;";
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
            this.divContent.style.top = "-36px";
            this.divContent.innerHTML = this.content;

            this.exitButton.style.top = "30px";
            this.exitButton.style.left = (this.size.width) + "px";

            this.divPointer.style.top = (this.size.height -25) + "px";
            this.divPointer.style.left = "75px";
        };
    </script>
<?php endif; ?>

<?php else: ?>
    
<div class="row">
    <div class="col-md-9" >
       <div class="box-3">
        <p class="a-center"><?php echo $data['title']?></p>
            <iframe style="width:100%;min-height: 530px;border:none;" src="<?php echo Yii::app()->createAbsoluteUrl('site/loadmapdetail',array('listing_id'=>$data['model']->id,'size'=>'big_map','type'=>  isset($_GET['type']) ? $_GET['type'] : '')) ?>"></iframe> 
       </div>
    </div>   
        
        
     <div class="col-md-3">
        <div class="location-group text-center" style="margin-top: 20px">
            <a class='select-map' href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug' => $data['model']->slug,'m' => 'map','type'=>'location')) ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-location.png" alt="location" /></a>
            <a class='select-map' href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug' => $data['model']->slug,'m' => 'map','type'=>'car')) ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-car-2.png" alt="car" /></a>
            <a class='select-map' href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug' => $data['model']->slug,'m' => 'map','type'=>'building')) ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-hotel.png" alt="building" /></a>
            <a class='select-map' href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug' => $data['model']->slug,'m' => 'map','type'=>'sign')) ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-sign-post.png" alt="sign post" /></a>
        </div>  
    </div>
</div>
<?php endif; ?>   
 <?php if($data['fullScreen']=='map'): ?>   
    <body onload="initialize()">
       <div id="map_canvas" style="width:100%; height:500px;"></div>
   </body>   
<?php endif; ?>   
   
<style>
/*ANH DUNG Oct 27, 2014 - fix map*/
 .fsize_12 { font-size: 12px;}
 /*ANH DUNG Oct 27, 2014 - fix map*/
</style>