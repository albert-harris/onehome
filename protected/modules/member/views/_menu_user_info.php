<?php

/* Author : Pham Duy Toan 
 * Email :ghostkissboy12@gmail.com and open the template in the editor.
 */
?>
<div class="info-box clearfix">
    <?php 
        if(isset(Yii::app()->user->id)): 
            $model = Users::model()->findByPk(Yii::app()->user->id);
            $link = ImageProcessing::bindImageByModel($model, 100, 100, array('avatar'=>1));
    ?>
    <?php else: 
        $link = '';
    endif; ?>

    <div class="image"><img src="<?php echo $link; ?>" alt="image" /></div>
    <div class="col-1 w-350" >
        <?php
            $mUser = Users::model()->findByPk(Yii::app()->user->id);
        ?>
        <p>Welcome, <strong><?php echo $mUser->title.' '.$mUser->first_name.' '.$mUser->last_name ?></strong></p>
        <!--<p>Welcome, <strong><?php // echo Yii::app()->user->first_name.' '.Yii::app()->user->last_name ?></strong></p>-->
        <p><strong>Commission Scheme:</strong> <?php echo $mUser->rCommissionSchema?$mUser->rCommissionSchema->percent. "%":''; ?></p>
        
        <?php
            $link = '';
            if(isset(Yii::app()->user->role_id)){
                $role = Yii::app()->user->role_id;
                switch ($role)
                {
                    case ROLE_REGISTER_MEMBER:
                    $link = Yii::app()->createAbsoluteUrl('member/member_profile/myprofile');
                    break;
                    case ROLE_TENANT:
                    $link = Yii::app()->createAbsoluteUrl('member/tenant/myprofile');
                    break;
                    case ROLE_AGENT:
                    $link = Yii::app()->createAbsoluteUrl('member/agent/myprofile');
                    break;
                    case ROLE_LANDLORD:
                    $link = Yii::app()->createAbsoluteUrl('member/landlord/myprofile');
                    break;
                }
            }
        ?>
        
        <?php if($link != ''): ?>
            <p><a href="<?php echo $link; ?>">Edit Profile</a></p>
            <?php // if(ProTransactionsSaveCommission::IsBestRankingOfTheMonth()): ?>
            <p class="best_ranking"><?php echo ProTransactionsSaveCommission::GetBestRankingOfTheMonth(); ;?></p>
            <?php // endif;?>        
        <?php endif; ?>        
    </div>
    <div class="col-2">
        <p><strong>Designation:</strong> <?php echo $mUser->rCommissionSchema?$mUser->rCommissionSchema->name:''; ?></p>
		<p><a href="<?php echo ProAgent::getForumLoginUrl(Yii::app()->user->id) ?>" target="_blank"><img src="<?= Yii::app()->theme->baseUrl ?>/img/forum-button.png" alt="" /></a></p>
        <?php if(isset(Yii::app()->user->id)): ?>
            <div class="w-51 clearfix">
                <a href="<?php echo Yii::app()->createAbsoluteUrl('site/logout') ?>" class="btn-3">LOGOUT</a>
            </div>
        <?php endif; ?>        
    </div>
</div>     

<style>
    .info-box .btn-3 {
        margin: 0 19px;
        position: relative;
        right: 20px;
        top: 0;
    }    
</style>