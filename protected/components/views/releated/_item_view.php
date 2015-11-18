<?php
/* Author : Pham Duy Toan 
 * Email :ghostkissboy12@gmail.com and open the template in the editor.
 */
?>
<div class="item-releated">
    <div class="img">
        <?php
            $imgDefautl = Listing::getDefaultImgListing($data->id, 'image');
			echo InputHelper::holderImage($data->getDefaultImageUrl(120,96), 120, 96);
            $check = '';

           if($data->releated){
                if($data->releated->listing_releated == $data->id ){
                    $check='checked';
                }
           }
             
        ?>              
    </div>
    <div class="clear"></div>
    <input type="checkbox" class="checkphoto-releated" name="releated[<?php echo $data->id ?>]" value="<?php echo $data->id ?>" <?php echo $check;  ?> />
    Tick to display
</div>    