<link href="<?php echo Yii::app()->theme->baseUrl; ?>/js/streetdirectory/T_custom_css.css" rel="stylesheet" type="text/css" />	
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/js/streetdirectory/autocomplete.plugin.css" rel="stylesheet" type="text/css" />	
<!--<script type="text/javascript" language="javascript" src="<?php // echo Yii::app()->theme->baseUrl; ?>/js/streetdirectory/jquery.js"></script>-->
<?php Yii::app()->clientScript->registerCoreScript('jquery');?>
<script type="text/javascript">
$(function(){});
</script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/fancybox.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/streetdirectory/hilitearrow.js"></script>
<script type="text/javascript" language="javascript" src="http://www.streetdirectory.com/js/map_api/m.php"></script>
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/streetdirectory/T_geocode.js"></script>
<body onLoad="loadMap()">
    <div id="Layer1">
        <form action="#" onSubmit="search(this.region.value, this.address.value); return false;">
            <input type="hidden" value="SG" id="region" />
            <input type="hidden" value="" id="postal_code" />
            <input type="hidden" value="" id="postal_code_xy" />
            <table cellpadding="2" cellspacing="2" border="0">
              <tr>
                    <td>Address:</td>
                    <td><input type="text" name="address" id="address" size="43" value="" autocomplete="off" /> <input type="button" class="apply" value="Select Map" /></td>
              </tr>
            </table>
        </form>
    </div>
<div style="clear:both;"></div>
<div id="info">
    <table cellpadding="0" cellspacing="0" id="tableInfo">
      <tbody>
      <tr>
        <td id="columnInfo">
                    <table id="datatableInfo"><tbody></tbody></table>
        </td>
      </tr>
      </tbody>
    </table>
</div>	
 <div id="map"></div>
</body>