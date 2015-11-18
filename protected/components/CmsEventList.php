<?php
/**
 *
 */
class CmsEventList extends CBehavior
{
    public function init()
    {
        //do nothing
    }

    public function onTest($event = null)
    {
        $this->raiseEvent('onTest', $event);
        Yii::log('onTest function', 'trace', 'CmsBehavior');
    }

    public function onEmail($event = null)
    {
        $this->raiseEvent('onEmail', $event);
        Yii::log('onEmail function', 'trace', 'CmsBehavior');
    }
}
