<?php
/* @var $agent_id int */
$mUser = Users::model()->findByPk($agent_id);
$src = $mUser->getAvatarUrl(66,65);
$username = $mUser->first_name . ' '.$mUser->last_name ;
$phone = '+65 ' . substr($mUser->phone, 0, 4) .' '. substr($mUser->phone, 4) ;
$srcCompany = $mUser->getCompanyLogoUrl(86,75);
$agent_cea = $mUser->agent_cea;
$company = $mUser->agent_company_name;
$CEALicenseNo = $mUser->license;
$colWidth = $position =="bottom" ? 'col-sm-6' : '';
$row = $position =="bottom" ? 'row' : '';
$c = Yii::app()->controller;
?>
<h2 class="title-2">Contact Agent</h2>
<div class="contact-agent contact-agent-<?php echo $position; ?> <?= $row ?>">
     <div class="<?= $colWidth ?> clearfix form-group agent-left agent-left-<?php echo $position; ?>">
       <div class="pull-left">
		   <img  class="agent_photo" src="<?= InputHelper::holderUrl($src, 66,65); ?>">
       </div>
       <div class="agent_detail pull-left">
           <div class="agent-title"><?php echo $username; ?> </div>
           <div class="telephone"> <?php $this->widget('ShortTextWidget', array(
				'text' => $phone,
				'urlOnCLick' => $c->createUrl('/agent/fieldClick', array('id'=>$mUser->id, 'field'=>'phone'))
			)) ?></div>
           <div>Agent Reg. No: <span class="cea"><?php echo $agent_cea; ?></span></div>
        </div>          
     </div>

     <div class="<?= $colWidth ?> clearfix form-group agent-right-<?php echo $position; ?>">
		<?php if ($position =="bottom" ): ?>
		<div class="pull-left" style="margin-right: 5px;">
			 <img class="agent_company_logo" src="<?= InputHelper::holderUrl($srcCompany, 86,75); ?>">
		</div>
		<?php endif;?>
		<div classs="company" id="company-<?php echo $position; ?>">
			  <b><?php echo $company; ?></b> <br />
			  CEA License No: <?php echo $CEALicenseNo;?><br/>
			  <?php echo Users::getCommissionSchemeText($agent_id); ?>
		</div>
     </div>
 </div>