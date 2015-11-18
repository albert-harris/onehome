<?php
$cmsFormater = new CmsFormatter();
$data = array("name"=>$model->listing?$model->listing->property_name_or_address:"", "transaction_id"=>$model->id);
$name_property = $cmsFormater->formatpropertyname($data);

if( !isset($_GET['next'])){
    $this->breadcrumbs=array(
            'Tenancies Approved'=>array('index'),
            $name_property,
    );

    $menus = array(
            array('label'=>'Tenancies Approved', 'url'=>array('index')),
    );
}else{
    $this->breadcrumbs=array(
            'Tenancies New'=>array('tenancies_new'),
            $name_property,
    );
    
    $menus = array(
	array('label'=>'Tenancies New', 'url'=>array('tenancies_new')),
    );
}

$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
$mTransactions = $model;
$mTransactions->mBillTo = $mTransactions->rBillTo?$mTransactions->rBillTo:( new ProTransactionsBillTo());
$mTransactions->mPropertyDetail = $mTransactions->rPropertyDetail?$mTransactions->rPropertyDetail:( new ProTransactionsPropertyDetail() );
$mTransactions->aModelPropertyDocument = count($mTransactions->rPropertyDocument)?$mTransactions->rPropertyDocument:( ProTransactionsPropertyDocument::getDefaultArrayForCreate($mTransactions->type) );
?>

<?php include 'ViewTransaction/ViewTransaction.php';?>
