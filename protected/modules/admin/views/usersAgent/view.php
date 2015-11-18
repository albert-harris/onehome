<?php
$this->breadcrumbs=array(
	'Saleperson Management'=>array('index'),
	$model->first_name,
);

$model->scenario = 'view_register';

$menus = array(
	array('label'=>'Saleperson Management', 'url'=>array('index')),
	array('label'=>'Create Saleperson', 'url'=>array('create')),
	array('label'=>'Update Saleperson', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Saleperson', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Saleperson: <?php echo $model->first_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                array(
                    'label'=>'Full Name',
                    'type'=>'FullNameRegisteredUsers',
                    'value'=>$model
                ),
                array(
                    'name'=>'commission_schema_id',
                    'value'=>$model->rCommissionSchema?$model->rCommissionSchema->name:'',
                ),
                'nric_passportno_roc',
                array(
                    'name'=>'phone',
                    'type'=>'FullPhone',
                    'value'=>$model
                ),
		'email_not_login',
		'agent_cea',
		'license',
		'agent_company_name',
                array(
                    'name' => 'agent_company_logo',
                    'type' => 'html',
                    'value' => ($model->agent_company_logo!='')?CHtml::image(ImageProcessing::bindImageByModel($model, 106, 75, array('agent_company_logo'=>1))):'',
                ),            
                array(
                    'name' => 'avatar',
                    'type' => 'html',
                    'value' => ($model->avatar!='')?CHtml::image(ImageProcessing::bindImageByModel($model, 100, 100, array('avatar'=>1))):'',
                ),            
                'address',
//                'contact_no',
                'postal_code',
                array(
                    'name'=>'country_id',                    
                    'value'=>$model->country?$model->country->area_name:"",
                ),
            
		'is_subscriber:YNStatus',
		'status:status',
		'gst:YNStatus',
		'created_date:datetime',
                array(
                    'name'=>'ProAgentDistrict',
                    'type'=>'ProAgentDistrict',
                    'value'=>$model,
                ),
		'phone_click',
		'email_click',
	),
)); ?>

<?php $model->aTierManager = $model->rAgentTierManager; $cmsFormater = new CmsFormatter();?>
<div class="grid-view">
    <label> Tier Manager</label>
    <table class="materials_table items ">
        <thead>
            <tr>
                <th class="w-20 item_c">#</th>
                <th class="w-320 item_c">Name</th>                        
                <th class="w-320 item_c">NRIC/FIN/PP No</th>
                <th class="w-100 item_c">Type</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($model->aTierManager)):?>
            <?php foreach($model->aTierManager as $key=>$mAgentTier):?>
            <tr class="materials_row">
                <td class="item_c order_no row_class_id<?php echo $mAgentTier->tier_manager_id;?>"><?php echo ($key+1);?></td>
                <td class="l_padding_10">
                    <?php echo $mAgentTier->rTier?($cmsFormater->formatFullNameRegisteredUsers($mAgentTier->rTier)):"" ?>
                    <input type="hidden" name="tier_id[]" value="<?php echo $mAgentTier->agent_id;?>">
                </td>
                <td class="l_padding_10">
                    <?php echo $mAgentTier->rTier?$mAgentTier->rTier->nric_passportno_roc:"" ?>
                </td>
                <td class="l_padding_10 ">
                    <?php echo ProAgentTierManager::$TYPE[$mAgentTier->type_tier];?>
                </td>
            </tr>                    
            <?php endforeach;?>
            <?php endif;?>
        </tbody>
    </table>
</div>       