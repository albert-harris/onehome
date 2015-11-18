<?php
//public
class SiteController extends ApiController
{
    public function actionIndex()
    {
        $this->setLanguage('zh_cn');
            echo '<pre>';
            print_r(Yii::app()->language);
            echo '</pre>';
            echo '<pre>';
            print_r(Yii::t('translation', 'Login to Ecoin'));
            echo '</pre>';
            exit;
    }

    
}
