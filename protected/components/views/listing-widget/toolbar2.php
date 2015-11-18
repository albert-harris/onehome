<?php
/* @var $this ListingWidget */
$sort = $this->dataProvider->getSort();
?>
<form method="get" class="listing-action-form form-horizontal">
	<div class="action-group">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3 col-sm-6 col-lg-2">
					<div class="form-group">
						<label class="control-label col-xs-5">Type</label>
						<div class="col-xs-7">
							<?php echo CHtml::dropDownList('listing_type', $this->listingType, 
								Listing::$aTextSaleRentNormal, array(
									'class'=>'typeSelect form-control',
									'empty'=>'-- All --'
								));
							?> 
						</div>
					</div>
				</div>
				
				<div class="col-md-3 col-sm-6 col-lg-2">
					<div class="form-group">
						<label class="control-label col-xs-5">Sort By</label>
						<div class="col-xs-7">
							<?php echo CHtml::dropDownList($sort->sortVar, $this->sortBy, 
								Listing::$SORT_BY, array('class'=>'sortBy form-control'));
							?> 
						</div>
					</div>
				</div>
				
				<div class="col-md-3 col-sm-6 col-lg-3">
					<div class="form-group">
						<label class="control-label col-xs-5">Items per page</label>
						<div class="col-xs-7">
							<?php echo CHtml::dropDownList('pageSize', $this->pageSize,
								Listing::$ITEM_PERPAGE, array('class'=>'pageSize')); ?>
						</div>
					</div>
				</div>
			
				<div class="col-md-3 col-sm-12 col-lg-5">
					<div class="form-group"><?php $this->renderPager() ?></div>
				</div>
			</div>
		</div>
	</div>
</form>
