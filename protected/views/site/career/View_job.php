<?php
/** ANH DUNG JAN 19, 2015
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$cmsFormater = new CmsFormatter();
?>

<div class="ad_view_job">
    <aside class="sidebar">
        <div class="box-3">
            <!--<div class="title"><h3><?php echo 'Careers' ?></h3></div>-->
            <div class="content">
                <ul class="nav-list">
                    <li class="first current_page_item"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/career'); ?>">Job Opportunity</a></li>
                    <li class="last"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/resume'); ?>">Submit Resume</a></li>
                </ul>
            </div>
        </div>
    </aside>
    <div class="main-inner-2">
        <h1 class="title-page"><?php echo $model->title;?></h1>
        <!--<h4></h4>-->
        <p>&nbsp;</p>
        <div class="document">
            <div class="ico-bg">
                <p><strong>Country: </strong> <?php echo ProOpportunity::GetCountry($model);?></p>
                <p><strong>Department: </strong><?php echo $model->department;?></p>
                <p><strong>Posted: </strong><?php echo $cmsFormater->formatDate($model->posted);?></p>
                <?php if(trim($model->job_description) != ""):?>
                <p><strong>Job Description: </strong><?php echo $model->job_description;?></p>
                <?php endif;?>
                <?php if(trim($model->requirements) != ""):?>
                <p><strong>Requirements: </strong><?php echo $model->requirements;?></p>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<style>    
</style>