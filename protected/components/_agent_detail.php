<?php
/*------------------------------------------------------------
 * 
 * Author : Dtoan
 * Fmail :toan.pd@verzdesign.com.sg
 * 
 * ------------------------------------------------------------
 */
?>
<?php
    $src='';
    $username = '';
    $phone = '';
    $srcCompany='';
    $agent_cea = '';
    $company = '';
    $CEALicenseNo = '';
    if(is_numeric($agent_id)){
          $mUser = Users::model()->findByPk($agent_id);
          if($mUser){
              $src = ImageProcessing::bindImageByModel($mUser, 100, 100, array('avatar'=>1));
              $username = $mUser->title . ' ' .$mUser->first_name . ' '.$mUser->last_name ;
              $phone = $mUser->phone;
              $srcCompany = ImageProcessing::bindImageByModel($mUser, 106, 75, array('agent_company_logo'=>1));
              $agent_cea = $mUser->agent_cea;
              $company = $mUser->agent_company_name;
              $CEALicenseNo = $mUser->license;
        }
    } 
?>
<h2 class="title-2">Contact Agent</h2>
 <div class="contact-agent contact-agent-<?php echo $position; ?> clearfix">
     <div class="agent-left agent-left-<?php echo $position; ?>">
       <div style="float:left;max-width: 70px;">
            <img  class="agent_photo" src="<?php echo $src; ?>">
       </div>
       <div class="agent_detail ">
           <div class="agent-title"><?php echo $username; ?> </div>
           <div class="telephone"><span class="icon-tel"><?php echo $phone; ?></span></div>
           <div class="cea">Salesperson Reg. No: <a href="javascript:void(0);" class="blueboldlink"><?php echo $agent_cea; ?></a></div>
<!--           <div class="">Company License No: <a href="javascript:void(0);" class="blueboldlink"><?php echo Yii::app()->params['company_license']; ?></a></div>
           <div class="">Agent License No: <a href="javascript:void(0);" class="blueboldlink"><?php echo Users::getFieldNameByPk($agent_id, 'license'); ?></a></div>-->
        </div>          
     </div>

     <div class="clearfix agent-right-<?php echo $position; ?>">
         <div style="width:106px;height: 75px;text-align: center;float:left;margin-right: 5px;">
              <img  class="agent_company_logo" src="<?php echo $srcCompany; ?>">
         </div>
          <div classs="company" id="company-<?php echo $position; ?>">
              <div class=" float_l w-190">
                <b><?php echo $company; ?></b> <br />
                CEA License No: <?php echo $CEALicenseNo;?><br/>
                <?php echo Users::getCommissionSchemeText($agent_id); ?>
              </div>
          </div>
     </div>
 </div>