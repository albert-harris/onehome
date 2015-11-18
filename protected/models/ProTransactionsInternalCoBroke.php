<?php

/**
 * This is the model class for table "{{_pro_transactions_internal_co_broke}}".
 *
 * The followings are the available columns in table '{{_pro_transactions_internal_co_broke}}':
 * @property string $id
 * @property string $transactions_id
 * @property string $user_id
 * @property string $gross_commission_amount
 */
class ProTransactionsInternalCoBroke extends CActiveRecord
{
    public $autocomplete_user_name;
    
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    public function tableName()
    {
            return '{{_pro_transactions_internal_co_broke}}';
    }

    public function rules()
    {
        return array(
        array('user_id', 'required', 'on'=>'AgentAddInternalCoBroke'),
        array('gross_commission_amount', 'compare', 'compareValue' => '0', 'operator' => '>', 'on' => 'AgentAddInternalCoBroke'),
        array('gross_commission_amount', 'compare', 'compareValue' => '100', 'operator' => '<', 'on' => 'AgentAddInternalCoBroke'),
        array('id, transactions_id, user_id, gross_commission_amount', 'safe'),
        );
    }

    public function relations()
    {
        return array(
            'relation_user' => array(self::BELONGS_TO, 'Users', 'user_id'),                    
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'transactions_id' => 'Transactions',
            'user_id' => 'Salespersons',
            'gross_commission_amount' => 'Percent Gross Commission',
        );
    }

    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('t.id',$this->id,true);
        $criteria->compare('t.transactions_id',$this->transactions_id,true);
        $criteria->compare('t.user_id',$this->user_id,true);
        $criteria->compare('t.gross_commission_amount',$this->gross_commission_amount,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
        ));
    }

    /*
    public function activate()
    {
        $this->status = 1;
        $this->update();
    }

    public function deactivate()
    {
        $this->status = 0;
        $this->update();
    }
	*/

    public function defaultScope()
    {
            return array(
                    //'condition'=>'',
            );
    }

    /**
     * @Author: ANH DUNG Mar 31, 2014
     * @Todo: search by transactions_id 
     * @Param: $transactions_id 
     * @Return: CActiveDataProvider
     */
    public static function searchByTransaction($transactions_id)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.transactions_id', $transactions_id);

        return new CActiveDataProvider('ProTransactionsInternalCoBroke', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
        ));
    }    
    
}