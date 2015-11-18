<?php
class CronSendMailTenancyExpiringCommand extends CConsoleCommand
{
    public function run($arg)
    {
//        Yii::app()->setting->setDbItem('last_working', "xxxxxxxxxxxx");die;
        ProTransactions::CronSendMailTenancyExpiring();
    }
}