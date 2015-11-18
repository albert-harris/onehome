<?php

/**
 * <Jason>
 * <Date: 20131002>
 * <To delete all enquiry older than 1 year>
 */

class DeleteAllEnquiryOlderThanOneYearCommand extends CConsoleCommand
{
    protected $data = array();

    public function run($arg)
    {
        $this->doJob($arg);
    }

    protected function doJob($arg)
    {
        $criteria = new CDbCriteria;
        $criteria->addCondition('DATE_SUB(NOW(),INTERVAL '.DATE_DELETE_ORDER.' DAY) >= t.created_date ');       
        $models = PrecOrder::model()->findAll($criteria);
        
        if(count($models)>0)
        {
            foreach($models as $item)
                PrecOrder::model()->deleteByPk($item->id);
        }
        else
        {
            return;
        }
    }
}