<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//echo "Jason";
?>

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
    <h4>Job Opportunity</h4>
    <p>&nbsp;</p>
    <div class="table">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'list-engage-grid',
        'dataProvider'=>$model->search(),
        //'filter'=>$model,
             'enableSorting' => false,
             'summaryText' => "Showing items {start} to {end} of {count}",
             'htmlOptions'=>array(
                                'class'=>'tb-1',
                              ),
              'template'=>'{items} 
                            <div class="action-group clearfix">
                               <div class="pager f-right">{pager}</div> 
                               <div class="lb f-right">{summary}</div>               
                         </div>                
              ',
            'pager' => array(
                               'header' => '',
                               'cssFile' => false,
                               'prevPageLabel' => 'Previous',
                               'nextPageLabel' => 'Next',   
                               'lastPageLabel'  => '',
                               'firstPageLabel'  => '',
                               'htmlOptions'=>array(
                                                'class'=>'listing_manager'
                                           )
                           ),         
              'columns'=>array(
                    array(
                        'name' => 'JOB TITLE',
                        'type' => 'OpportuniryCareer',
                        'value' => '$data',
                    ),
                    array(
                        'name' => 'COUNTRY',
                        'value' => '$data->country->area_name',
                    ),
                    array(
                        'name' => 'DEPARTMENT',
                        'value' => '$data->department',
                    ),
                    array(
                        'name' => 'POSTED',
                        'type'=>'date',
                        'value' => '$data->posted',
                    ),
        ),
    )); ?>
    </div>
</div>

<style>
    .box-3{
        margin-top: 0px;
    }
    
    p {
        line-height: 18px;
        text-align: justify;
        margin: 0 0 15px;
    }

    h4{
        float: left;
        color: #002d56;
        position: relative;
        font-size: 20px;
        width: 100%;
        font-weight: normal;
        padding: 0px 0px 5px !important;
        margin: 18px 0px 0px 0px;
        margin: 0px 0px 0px 0px;
        /*border-bottom: 1px dotted #e8e8e8;*/ /* HTram closed*/
    }


    .items{
        width: 100%;
    }   
    
    .sidebar ul li a, .sidebar1 ul li a {
        padding: 12px 20px;
        -webkit-transition: all 0.3s ease-out;
        -moz-transition: all 0.3s ease-out;
        -o-transition: all 0.3s ease-out;
        -ms-transition: all 0.3s ease-out;
        transition: all 0.3s ease-out;
        overflow: hidden;
    }

    .sidebar{
        margin-right: 30px;
    }

    table.job-offer {
        width: 100%;
        height: 100%;
        color: #4d4d4d;
        margin-bottom: 40px !important;
    }
    
</style>