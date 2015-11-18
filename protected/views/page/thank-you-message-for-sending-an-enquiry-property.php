 <?php echo $model->content; ?>
 <?php
 if(isset(Yii::app()->session['propertyId'])): 
      $this->widget('ListingReleatedOnPageThankYouWidget',array( 'listing_id'=>Yii::app()->session['propertyId'],'limit'=>2));
 endif;
?>