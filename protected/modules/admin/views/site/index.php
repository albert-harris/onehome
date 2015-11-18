<div class="span11">
    <div class="well hero-unit">
        <h1>Welcome, <?php echo Yii::app()->user->name; ?></h1>
        <p>Dashboard</p>     


    </div>

    <?php if (Yii::app()->user->role_id == ROLE_ADMIN || Yii::app()->user->role_id == ROLE_MANAGER): ?>

        <div class="row-fluid">

            <div class="span5">
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="lighter">
                            <i class="icon-star orange"></i>
                            Property Infologic
                        </h4>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        <i class="icon-caret-right blue"></i>
                                        Name
                                    </th>

                                    <th class="hidden-phone">
                                        <i class="icon-caret-right blue"></i>
                                        Quantity
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $arr = array(
                                    0 => 'Normal Users',
                                    1 => 'Tenant Users',
                                    2 => 'Saleperson Users',
                                    3 => 'Landlord Users',
                                    4 => 'All Listing',
                                );

                                for ($i = 0; $i < 5; $i++) {
                                    ?>
                                    <tr>
                                        <td><?php echo $arr[$i] ?></td>

                                        <td class="hidden-phone">
                                            <?php if ($i == 0) : ?>
                                                <a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('admin/usersRegistered/index'); ?>"
                                                       <span class="label arrowed">
                                                               <?php echo count(Users::model()->findAll('role_id='.ROLE_REGISTER_MEMBER)); ?>
                                                        </span>
                                                </a>
                                            <?php elseif ($i == 1) : ?>
                                                <a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('admin/usersTenant/index'); ?>"
                                                   <span class="label arrowed">
                                                           <?php echo count(Users::model()->findAll('role_id='.ROLE_TENANT)); ?>
                                                    </span>
                                                </a>
                                            <?php elseif ($i == 2) : ?>
                                                <a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('admin/usersAgent/index'); ?>"
                                                       <span class="label arrowed">
                                                               <?php echo count(Users::model()->findAll('role_id='.ROLE_AGENT)); ?>
                                                        </span>
                                                </a>
                                            <?php elseif ($i == 3) : ?>
                                                <a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('admin/usersLandlord/index'); ?>"
                                                       <span class="label arrowed">
                                                               <?php echo count(Users::model()->findAll('role_id='.ROLE_LANDLORD)); ?>
                                                        </span>
                                                </a>
                                            <?php elseif ($i == 4) : ?>
                                            <a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('admin/listing'); ?>"
                                                       <span class="label arrowed">
                                                               <?php echo count(Listing::seachAllListingDaskboard()); ?>
                                                        </span>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div><!--/widget-main-->
                    </div><!--/widget-body-->
                </div><!--/widget-box-->
            </div>

        </div>
    <?php endif; ?>
</div>

<style>
    /*.hero-unit{margin-top:100px;}*/
    p {
        margin: 10px 0 10px !important;
    }

    .row-fluid .span5 {
        width: 100% !important;
    }    
</style>


