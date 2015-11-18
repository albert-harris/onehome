<?php 
  $q= '';
  if(isset($_GET['q'])){
      // $arr =explode('--',trim($_GET['q']));
      // if(count($arr)==2){
      //     $q= trim($arr[1]);
      // }else{
        $q = trim($_GET['q']);
      // }
  }
?>

<link href="<?php echo Yii::app()->theme->baseUrl; ?>/js/streetdirectory/T_custom_css.css" rel="stylesheet" type="text/css" />	
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/js/streetdirectory/autocomplete.plugin.css" rel="stylesheet" type="text/css" />	
<?php Yii::app()->clientScript->registerCoreScript('jquery');?>
<script type="text/javascript">$(function(){});</script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/fancybox.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/streetdirectory/hilitearrow.js"></script>
<script type="text/javascript" language="javascript" src="http://www.streetdirectory.com/js/map_api/m.php"></script>
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/streetdirectory/T_geocode.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl ?>/js/streetdirectory/jquery.tinysort.js"></script>
<input id="searchPropertyOnsite" type="hidden" value="<?php echo Yii::app()->createAbsoluteUrl('ajax/Searchlistingonmap',array('term'=>$_GET['q'])); ?>">
<body onLoad="loadMap()">
    <div id="Layer1">
        <form action="#" onSubmit="search(this.region.value, this.address.value); return false;">
            <input type="hidden" value="SG" id="region" />
            <input type="hidden" value="" id="postal_code" />
            <input type="hidden" value="" id="postal_code_xy" />
            <input type="hidden" value="" id="property_type" />
            <input type="hidden" value="" id="buildingname" />
            <input type="hidden" value="" id="name" />
            <input type="hidden" value="<?php echo Yii::app()->createAbsoluteUrl('ajax/seachmapdropdownlist',array('q'=>'')) ?>" id="mapDropdownlist" />
            <input type="hidden" value="<?php echo Yii::app()->createAbsoluteUrl('ajax/loaddata',array('data'=>'')) ?>" id="loaddataMap" />
            <table cellpadding="2" cellspacing="2" border="0">
                <tr class="dialogtitle">
                    <td colspan="2" class="dialogtitle">Search Results</td>
                </tr>
              <tr>
                  <td colspan="2"><p class="alignleft left10 bottom10">Please choose the correct development from the results below, and then click on 'Select'. If the property is not listed here, then click on 'Cancel'. You can then try to search again or continue without matching a property.</p></td>
              </tr>
            </table>
        </form>
    </div>
<div style="clear:both;"></div>
<div style="visibility: hidden;"  id="map"></div>
<fieldset>
    <div style="margin:0 auto;height:420px;overflow-y:auto;overflow-x:hidden;" id="content-property">
        <div id="loading" style="text-align: center;margin-top:100px;">
             <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icon_loading.gif" />
        </div>
       <table style="width:100%" class="table-property">
           <tbody> </tbody>
       </table>         
    </div>   
</fieldset>

<table cellpadding="2" cellspacing="2" border="0" id="btn-control">
  <tr>
      <td><input type="hidden" name="address" id="address" size="43" value="<?php echo  $q; ?>" autocomplete="off" />
          <input type="button" style=" width:120px;" class="apply" value="Select" />
      </td>
      <td><input type="button" style=" width:120px;" value="Cancel" id="popup_none" name="popup_none" class="btn-cancel"></td>
  </tr>
</table>
 
</body>
<script>
    /*
    * DTOAN
    * Email: toanpham.it@gmail.com
    * CHANGE 3-2-2015
    */
     // var q = parent.$('#Listing_postal_code').val();
     // if(q!=''){
     //    $('#address').val(q);
     // }

     $('#address').trigger('change');
     $('.btn-cancel').on('click',function(){
        parent.$.fancybox.close();
     });
</script>    
<style>
    .dialogtitle {
    background-color: #5D80B8;
    color: #FFFFFF;
    font-size: 14px;
    font-weight: bold;
    height: 22px;
    padding: 5px 5px 5px 15px;
    text-align: left;
    vertical-align: middle;
}
.table-property {
    border: 2px solid #EEEEEE;
    border-collapse: collapse;
    width: 100%;
}
.even {
    background: none repeat scroll 0 0 #F0F0F0;
}
</style>