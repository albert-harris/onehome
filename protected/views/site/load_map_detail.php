<?php



/* 

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */

?>



<?php 

	$titleAressMap = ($model->display_title !='') ? $model->display_title : Listing::GetAddressReal($model);// ANH DUNG FIX Listing::GetAddressReal($model) Mar 10, 2015
    $titleAressMap = Listing::GetAddressReal($model);
	$this->widget('MapWidget', array(

                'json_map' => $model->json_map,

                'postal_code' => $model->postal_code_xy,

                'title' => $titleAressMap. ", Singapore $model->postal_code ", 

                'sizeMap' => $size,

                'fullScreen'=>'map',

                'model'=>$model)); 

?>