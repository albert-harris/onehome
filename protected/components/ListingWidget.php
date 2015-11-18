<?php

Yii::import('zii.widgets.CListView');

/**
 * Display listings with sorter and pager
 *
 * @author Lam Huynh
 */
class ListingWidget extends CListView {

	public $template="{toolbar}\n{items}\n{toolbar}";
	public $sortBy;
	public $pageSize;
	public $showTypeFilter=false;
	public $listingType;
	
	/**
	 * @inheritdoc
	 */
	public function init() {
		// register shortlist js
		$uId = (int)Yii::app()->user->id;
		$rId = (int)Yii::app()->user->role_id;
		$roleMember = ROLE_REGISTER_MEMBER;
		$url = Yii::app()->createAbsoluteUrl('site/addShortlist');
		Yii::app()->clientScript->registerScript('shortlist-add-button', "setupShortList({ 
			userId: $uId,
			roleId: $rId,
			roleMember: $roleMember,
			addShortListUrl: '$url'
		});");	
		
		// default widget setting
		Yii::app()->clientScript->registerScript('listing-widget', 'setupListingWidget();');
		$this->htmlOptions['class']='listing-widget';
		$this->itemView = 'application.components.views.listing-widget.item';
		$this->sortableAttributes = array('date_listed');
		$this->pagerCssClass = 'pag-container';
		$this->afterAjaxUpdate = "function () { 
			$('select').uniform();
			window.addthis.layers.refresh();
			setupListingWidget();
		}";
		$this->pager = array(
			'header'=>'',
			'cssFile' => false,
			'nextPageLabel' => 'Next',
			'prevPageLabel' => 'Previous',
			'firstPageLabel' => '',
			'firstPageCssClass' => 'hide',
			'lastPageLabel' => '',
			'lastPageCssClass' => 'hide',
			'selectedPageCssClass'=>'active',
			'maxButtonCount' => 8,
			'htmlOptions'=>array('class' => 'pagination',)
		);
		
		// apply filter
		if(isset($_GET['listing_type'])){
            $this->listingType = $_GET['listing_type'];
        }
		$this->dataProvider->criteria->compare('listing_type', $this->listingType);
		
		//get current sort
		$this->dataProvider->sort->sortVar = 's_sort';
		$sortVar = $this->dataProvider->sort->sortVar;
		$this->sortBy = Listing::DEFAULT_SORT_BY;
		if(isset($_GET[$sortVar])){
            $this->sortBy = $_GET[$sortVar];
        }
		
		//get current paging
		$this->pageSize = Listing::DEFAULT_ITEM_PERPAGE;
		if(isset($_GET['pageSize'])){
            $this->pageSize = $_GET['pageSize'];
        }
		$this->dataProvider->pagination->pageSize = $this->pageSize;
		
		return parent::init();
	}
	
	public function renderToolbar() {
		if ($this->showTypeFilter) {
			$this->render('listing-widget/toolbar2');
		} else {
			$this->render('listing-widget/toolbar');
		}
	}
	
}
