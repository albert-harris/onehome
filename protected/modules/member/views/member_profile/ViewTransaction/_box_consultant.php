<!-- box -->
<?php 
$mAgentLogin = Users::model()->findByPk(Yii::app()->user->id);
?>
<div class="box-group clearfix">
    <div class="box-4">
        <h4>Consultant</h4>
        <div class="content">
            <div class="in-row clearfix">
                <label class="lb">Name</label>
                <div class="group"><?php echo $cmsFormater->formatFullNameRegisteredUsers($mAgentLogin);?></div>
            </div>
            <div class="in-row clearfix">
                <label class="lb">NRIC</label>
                <div class="group"><?php echo $mAgentLogin->nric_passportno_roc;?></div>
            </div>
            <div class="in-row clearfix">
                <label class="lb">Mobile</label>
                <div class="group"><?php echo $cmsFormater->formatFullPhone($mAgentLogin);?></div>
            </div>
        </div>
    </div>
    
    <?php if(count($mAgentLogin->rAgentTierManager)): ?>
        <?php foreach($mAgentLogin->rAgentTierManager as $key=>$mAgentTier): ?>
            <?php $mAgent = Users::model()->findByPk($mAgentTier->tier_manager_id); 
            if($mAgentTier->type_tier==1){ // 1 st tier
                $percent = $mAgentLogin->rCommissionSchema?$mAgentLogin->rCommissionSchema->first_tier:0;
            }else{
                $percent = $mAgentLogin->rCommissionSchema?$mAgentLogin->rCommissionSchema->second_tier:0;
            }
            ?>
    
            <div class="box-4">
                <h4><?php echo ($mAgentTier->type_tier);?>
                    <sup><?php echo isset(ProAgentTierManager::$ARR_NUMBER[($mAgentTier->type_tier)])?ProAgentTierManager::$ARR_NUMBER[($mAgentTier->type_tier)]:'th' ?></sup> Tier Manager
                </h4>
                <div class="content">
                    <div class="in-row clearfix">
                        <label class="lb">Name</label>
                        <div class="group"><?php echo $cmsFormater->formatFullNameRegisteredUsers($mAgent);?></div>
                    </div>
                    <div class="in-row clearfix">
                        <label class="lb">Mobile</label>
                        <div class="group"><?php echo $cmsFormater->formatFullPhone($mAgent);?></div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    <?php endif;?>
    
</div>