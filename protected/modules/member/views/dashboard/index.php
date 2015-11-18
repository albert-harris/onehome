<?php
$this->breadcrumbs=array(
	'Dashboard'
);
?>
<!-- box -->
<div class="box-1 space-3">
    <div class="title"><h3>Quick links</h3></div>
    <div class="content space-5 tempt"> 
        <div class="row clearfix">
            <div class="lb-1">Active Listings :</div> <div class="group-1"><?php echo Listing::countListingWithStatusLisitng(STATUS_LISTING_ACTIVE, Yii::app()->user->id) ?> 
                <a href="<?php echo Yii::app()->createAbsoluteUrl('member/listing') ?>" title="view" class="f-right"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-arrow.png" alt="view" /></a>
            </div>
        </div>
        
<!--        <div class="row clearfix">
            <div class="lb-1">Pending Listings :</div> <div class="group-1"><?php echo Listing::countListingWithStatusLisitng(STATUS_LISTING_PENDING, Yii::app()->user->id) ?> 
                <a href="<?php echo Yii::app()->createAbsoluteUrl('member/listing',array('status'=>STATUS_LISTING_PENDING)) ?>" title="view" class="f-right"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-arrow.png" alt="view" /></a>
            </div>
        </div>
        <div class="row clearfix">
            <div class="lb-1">Rejected Listings :</div> <div class="group-1"><?php echo Listing::countListingWithStatusLisitng(STATUS_LISTING_REJECTED, Yii::app()->user->id) ?> 
                <a href="<?php echo Yii::app()->createAbsoluteUrl('member/listing',array('status'=>STATUS_LISTING_REJECTED)) ?>" title="view" class="f-right"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-arrow.png" alt="view" /></a>
            </div>
        </div>-->
        
        <div class="row clearfix">
            <div class="lb-1">Commission Receivable :</div> <div class="group-1"><?php echo MyFormat::formatNumberLeft(ProTransactionsSaveCommission::getCommissionReceivableUid(Yii::app()->user->id));?>
                <?php // echo "$ ". ProTransactionsSaveCommission::getCommissionReceivableAgent(Yii::app()->user->id); ?> 
                <a href="<?php echo Yii::app()->createAbsoluteUrl('member/member_profile/commissionLog') ?>" title="view" class="f-right"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-arrow.png" alt="view" /></a>
            </div>
        </div>
        <div class="row clearfix">
            <div class="lb-1">New enquiries :</div> <div class="group-1"> <?php echo ProEnquiryProperty::getTotalWithUser(Yii::app()->user->id); ?>
                <a href="<?php echo Yii::app()->createAbsoluteUrl('member/enquiries') ?>" title="view" class="f-right"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-arrow.png" alt="view" /></a>
            </div>
        </div>
    </div>
</div> 

<!-- box -->
<div class="box-1 space-3">
    <div class="title"><h3>Your Team</h3></div>
    <div class="content space-6 clearfix"> 
        
        <?php
//            $tiger = ProTransactionsSaveCommission::getArr1StAnd2NdTier(Yii::app()->user->id);
            $cUid = Yii::app()->user->id;
            $mAgentLogin = Users::model()->findByPk($cUid);
            $cmsFormater = new CmsFormatter();
            $aModelDownlineSale1St = ProAgentTierManager::GetArrModelDownlineSalesPersons($cUid, ProAgentTierManager::TYPE_1ST);
            $aModelDownlineSale2Nd = ProAgentTierManager::GetArrModelDownlineSalesPersons($cUid, ProAgentTierManager::TYPE_2ND);
        ?>
        
        <?php if(count($mAgentLogin->rAgentTierManager)): ?>
            <div class="box-4">
                <h4>
                    <?php // echo ($mAgentTier->type_tier);?>
                    <!--<sup>1st</sup> Tier Manager-->
                    Tier Manager
                </h4>
                 <ul class="list-2">
                     <?php foreach($mAgentLogin->rAgentTierManager as $key=>$mAgentTier): ?>
                    <?php $mAgent = Users::model()->findByPk($mAgentTier->tier_manager_id); ?>
                    <li><a href="javascript:;">
                        <sup><?php echo $mAgentTier->type_tier; echo isset(ProAgentTierManager::$ARR_NUMBER[($mAgentTier->type_tier)])?ProAgentTierManager::$ARR_NUMBER[($mAgentTier->type_tier)]:'th'; ?></sup>
                        <?php echo $cmsFormater->formatFullNameRegisteredUsers($mAgent);?>     
                        </a>
                    </li>
                    <?php endforeach;?>
                  </ul> 
            </div>            
        <?php endif;?>
        
        <?php /*
        <?php if(count($mAgentLogin->rAgentTierManager)): ?>
            <?php foreach($mAgentLogin->rAgentTierManager as $key=>$mAgentTier): ?>
            <?php $mAgent = Users::model()->findByPk($mAgentTier->tier_manager_id); 
            if($mAgentTier->type_tier==1){ // 1 st tier
                $percent = $mAgent->rCommissionSchema?$mAgent->rCommissionSchema->first_tier:0;
            }else{
                $percent = $mAgent->rCommissionSchema?$mAgent->rCommissionSchema->second_tier:0;
            }
            ?>
            <div class="box-4">
                <h4>
                    <?php echo ($mAgentTier->type_tier);?>
                    <sup><?php echo isset(ProAgentTierManager::$ARR_NUMBER[($mAgentTier->type_tier)])?ProAgentTierManager::$ARR_NUMBER[($mAgentTier->type_tier)]:'th' ?></sup>
                    Tier Sales Persons</h4>
                 <ul class="list-2">
                    <li><a href="javascript:;">
                        <?php echo $cmsFormater->formatFullNameRegisteredUsers($mAgent);?>     
                    </a></li>
                  </ul> 
            </div>
            <?php endforeach;?>
        <?php endif;?>
        
        <div class="box-4">
            <h4>1<sup>nd</sup> Tier Sales Persons</h4>
             <ul class="list-2">
                <?php if(isset($tiger['1ST_TIER']) && count($tiger['1ST_TIER'])>0 ):
                         foreach ($tiger['1ST_TIER'] as $k=>$item1)
                               echo '<li><a href="javascript:;">'.$item1.'</a></li>'; 
                endif; ?>     
              </ul> 
        </div>
         <div class="box-4">
            <h4>2<sup>nd</sup> Tier Sales Persons</h4>
            <ul class="list-2">
                <?php if(isset($tiger['2ND_TIER']) && count($tiger['2ND_TIER'])>0 ):
                         foreach ($tiger['2ND_TIER'] as $k=>$item1)
                               echo '<li><a href="javascript:;">'.$item1.'</a></li>'; 
                endif; ?> 
          </ul>                            
        </div>
        */ ?>
        <div class="box-4">
            <!--<h4>1st Tier Salespersons</h4>-->
            <h4>Tier Salespersons</h4>
             <ul class="list-2">
                <?php if( count($aModelDownlineSale1St) ):
                    foreach ($aModelDownlineSale1St as $k=>$mAgent)
                          echo "<li><a href='javascript:void(0)'>1<sup>st</sup> ".($cmsFormater->formatFullNameRegisteredUsers($mAgent))."</a></li>"; 
                endif; ?>                      
                <?php if( count($aModelDownlineSale2Nd) ):
                    foreach ($aModelDownlineSale2Nd as $k=>$mAgent)
                          echo "<li><a href='javascript:void(0)'>2<sup>nd</sup> ".($cmsFormater->formatFullNameRegisteredUsers($mAgent)).'</a></li>'; 
                endif; ?>     
              </ul> 
        </div>

    </div>
</div> 
<style>.tempt .row .group-1{width: 20%;}</style>