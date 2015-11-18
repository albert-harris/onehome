<?php

/**
 * This is the model class for table "{{_actions_users}}".
 *
 * The followings are the available columns in table '{{_actions_users}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $action_id
 * @property string $can_access
 */
class ActionsUsers extends ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ActionsUsers the static model class
     */
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_actions_users}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('user_id', 'numerical', 'integerOnly'=>true),
                    array('can_access', 'length', 'max'=>10),
                    // The following rule is used by search().
                    // Please remove those attributes that should not be searched.
                    array('id, user_id, can_access', 'safe', 'on'=>'search'),
            );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
            return array(
                    'id' => 'ID',
                    'user_id' => 'User',
                    'action_id' => 'Action',
                    'can_access' => 'Can Access',
            );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('user_id',$this->user_id);		
        $criteria->compare('can_access',$this->can_access,true);

        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
        ));
    }
    
    // May 08, 2014 bb code - ANH DUNG ADD
    public static function getActionArrayByUserIdAndControllerId($user_id, $controller_id, $can_access = 'allow')
    {
        $aActions = array();
        $criteria = new CDbCriteria;
        $criteria->compare('t.user_id', $user_id);
        $criteria->compare('t.controller_id', $controller_id);
        $criteria->compare('t.can_access', $can_access);
        $model = self::model()->find($criteria);
        if ($model)
        {                
            if(!empty($model->actions))
            {
                $aActions = explode(',', $model->actions); // bug:  ANH DUNG FIX NOW 14, 2014( remove space explode)
            }
        }
        // Jan 26, 2015 fix only for this project, một số project cũ thì chỗ này nó còn khoảng trắng sau khi explode ra
        $aActions = array_map('trim', $aActions);
        // Jan 26, 2015 fix only for this project
        return $aActions;
    }


    public static function getActionArrayAllowForCurrentUserByControllerName($controllerName)
    {
        try {
        $aResult = array();
        $user_id = Yii::app()->user->id;
        $mUser = Users::model()->findByPk($user_id);
        $mController = Controllers::getByName($controllerName);
        // ANH DUNG FIX  NOW 14, 2014
        if($mController)
        {
            $mActionsUsers = ActionsUsers::model()->findAll('user_id='.$user_id.' AND controller_id='.$mController->id);
            if($mActionsUsers == NULL)
            {
                $aActionsAllowGroup = ActionsRoles::getActionArrayByRoleIdAndControllerId($mUser->role_id, $mController->id);
                $aResult = $aActionsAllowGroup;
            }
            else{
                $aActionsAllowUser = ActionsUsers::getActionArrayByUserIdAndControllerId($user_id, $mController->id);
                $aResult = $aActionsAllowUser;
            }
                
        }
        // ANH DUNG FIX  NOW 14, 2014
//        if($mController)
//        {
//            $mActionsUsers = ActionsUsers::model()->find('user_id='.$user_id.' AND controller_id='.$mController->id);
//            $aActionsAllowGroup = ActionsRoles::getActionArrayByRoleIdAndControllerId($mUser->role_id, $mController->id);
//            $aActionsAllowUser = ActionsUsers::getActionArrayByUserIdAndControllerId($user_id, $mController->id);
//            if($mActionsUsers == NULL)
//            {
//                $aResult = $aActionsAllowGroup;
//            }
//            else
//                $aResult = $aActionsAllowUser;
//        }

        return $aResult;
        } catch (Exception $exc) {
            echo $exc->getMessage();die;
        }
    }

    public static function isAllowAccess($controllerName, $actionName)
    {
        $aActionAllowed = ActionsUsers::getActionArrayAllowForCurrentUserByControllerName($controllerName);
        if(in_array(ucfirst($actionName), $aActionAllowed))
        {
            return true;
        }
        return false;
    }        
    // END May 08, 2014 bb code - ANH DUNG ADD    
 
    
    
    /**
     * @Author: ANH DUNG Jan 26, 2015
     * @Todo: get name alias controller action
     */
    public static function GetAliasControllers() {
     /******** Jan 26, 2015 ANH DUNG **********
     * @note: ex: 'childActions'=>array('NameActionAjax1', 'NameActionAjax2', 'NameActionAjax3')
     * with some action you can use: MyFormat::isAllowAccess("rolesAuth", "group")
     */
    return array(
           
        'UsersLandlord'=>array('alias'=>'Landlord Management',
            'actions'=>array(
                'Index'=>array('alias'=> Yii::t('translation', 'List'),
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'UsersAgent'=>array('alias'=>'Saleperson Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'UsersTenant'=>array('alias'=>'Tenant Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'UsersRegistered'=>array('alias'=>'Registered Users Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'Proopportunity'=>array('alias'=>'Job Opportunity Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'Proresume'=>array('alias'=>'Resume Management',
            'actions'=>array(
                'ExportResume'=>array('alias'=>'Export Resume',
                                'childActions'=>array()
                                ),                
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'Listing'=>array('alias'=>'Listings Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array('Extradetail', "Managephotos",
                                    'Confrimations',
                                    'Ajax_upload_photo','Ajax_upload_doc','Ajaxdelete_photo',
                                    'Ajaxdelete_doc','Setdefault','Autocomplete_agent',
                                    )
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
                'AjaxDeactivate'=>array('alias'=>'Published / Unpublished',
                                'childActions'=>array('AjaxActivate')
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'BankRequest'=>array('alias'=>'Bank Evaluation Report',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'Transactions'=>array('alias'=>'Transactions Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array('ViewInvoice')
                                ),                
                'ApproveTransaction'=>array('alias'=>'Approve Transaction',
                                'childActions'=>array()
                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'AjaxGenReceipt'=>array('alias'=>'Generate Receipt',
                                'childActions'=>array()
                                ),
                'SummaryReport'=>array('alias'=>'Summary Report',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'Listingcompany'=>array('alias'=>'Company Listings Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                'UpdateTelemarketer'=>array('alias'=>'Edit Telemaketer',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'Tenancy'=>array('alias'=>'Tenancies Management',
            'actions'=>array(
                'Index'=>array('alias'=>'Tenancies Approved',
                                'childActions'=>array()
                                ),                
                'Tenancies_new'=>array('alias'=>'Tenancies New',
                                'childActions'=>array()
                                ),
                'Tenancies_draft'=>array('alias'=>'Tenancies Draft',
                                'childActions'=>array()
                                ),
                'CreateTenancy'=>array('alias'=>'Create Tenancy',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update Tenancy',
                                'childActions'=>array()
                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete ',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'Banners'=>array('alias'=>'Banner Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'Pages'=>array('alias'=>'Page Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'Testimonial'=>array('alias'=>'Master Files - Testimonial Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'FloorType'=>array('alias'=>'Master Files - Floor Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
//                'View'=>array('alias'=>'View',
//                                'childActions'=>array()
//                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'Furnished'=>array('alias'=>'Master Files - Furnished Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
//                'View'=>array('alias'=>'View',
//                                'childActions'=>array()
//                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'LeaseTerm'=>array('alias'=>'Master Files - Lease Term Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
//                'View'=>array('alias'=>'View',
//                                'childActions'=>array()
//                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'SpecialFeatures'=>array('alias'=>'Master Files - Special Features Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
//                'View'=>array('alias'=>'View',
//                                'childActions'=>array()
//                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'Bathroom'=>array('alias'=>'Master Files - Bathroom Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
//                'View'=>array('alias'=>'View',
//                                'childActions'=>array()
//                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'FixturesFittings'=>array('alias'=>'Master Files - Fixtures & Fitting Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
//                'View'=>array('alias'=>'View',
//                                'childActions'=>array()
//                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'FurnishingIncluded'=>array('alias'=>'Master Files - Furnishing Included Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
//                'View'=>array('alias'=>'View',
//                                'childActions'=>array()
//                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'OutdoorIndoorSpace'=>array('alias'=>'Master Files - Outdoor/Indoor Space Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
//                'View'=>array('alias'=>'View',
//                                'childActions'=>array()
//                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'ProMasterHdbTown'=>array('alias'=>'Master Files - HDB Town/Estate Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
//                'View'=>array('alias'=>'View',
//                                'childActions'=>array()
//                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'Prouploaddocument'=>array('alias'=>'Master Files - Document Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'Commission'=>array('alias'=>'Master Files - Commission scheme',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
//                'Create'=>array('alias'=>'Create',
//                                'childActions'=>array()
//                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
//                'View'=>array('alias'=>'View',
//                                'childActions'=>array()
//                                ),
//                'Delete'=>array('alias'=>'Delete',
//                                'childActions'=>array()
//                                ),
                )
        ), /* end controller */
        
        'Floor'=>array('alias'=>'Master Files - Floor Area Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
//                'View'=>array('alias'=>'View',
//                                'childActions'=>array()
//                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
                
        'Price'=>array('alias'=>'Master Files - Price For Sale',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
                
        'ProMasterPriceRent'=>array('alias'=>'Master Files - Price For Rent',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
                
                
        'ProPropertyType'=>array('alias'=>'Master Files - Property Types Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
//                'Create'=>array('alias'=>'Create',
//                                'childActions'=>array()
//                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
//                'Delete'=>array('alias'=>'Delete',
//                                'childActions'=>array()
//                                ),
                )
        ), /* end controller */
                
        
                
        'FiInvoice'=>array('alias'=>'Financial Management',
            'actions'=>array(
                'Index'=>array('alias'=>'Invoices Management',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create Invoice',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update Invoice',
                                'childActions'=>array()
                                ),
                'View'=>array('alias'=>'View Invoice',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete Invoice',
                                'childActions'=>array()
                                ),
                'GenerateReceipt'=>array('alias'=>'Generate Receipt',
                                'childActions'=>array('ViewReceipt')
                                ),
                'AccountsReceivables'=>array('alias'=>'Account Receivables Management',
                                'childActions'=>array()
                                ),
                'Paymentvouchers'=>array('alias'=>'Payment Vouchers Management',
                                'childActions'=>array('Printvoucher')
                                ),
                'Viewvoucher'=>array('alias'=>'View Voucher',
                                'childActions'=>array()
                                ),
                'Updatevoucher'=>array('alias'=>'Update Voucher',
                                'childActions'=>array()
                                ),
                'Deletevoucher'=>array('alias'=>'Delete Voucher',
                                'childActions'=>array()
                                ),
//                'Printvoucher'=>array('alias'=>'Print Voucher',
//                                'childActions'=>array()
//                                ),
                'Accountpayable'=>array('alias'=>'Account Payable Management',
                                'childActions'=>array()
                                ),
                'Report'=>array('alias'=>'Report Financial',
                                'childActions'=>array()
                                ),
                'Report_transaction'=>array('alias'=>'Report Transaction',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'Subscriber'=>array('alias'=>'Subscriber Management',
            'actions'=>array(
                'Index'=>array('alias'=>'Subscriber-Public Management',
                                'childActions'=>array()
                                ),                
                'Member'=>array('alias'=>'Subscriber-Member Management',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
//                'View'=>array('alias'=>'View',
//                                'childActions'=>array()
//                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'Newsletter'=>array('alias'=>'Newsletter Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
                'Create'=>array('alias'=>'Create',
                                'childActions'=>array()
                                ),
                'Update'=>array('alias'=>'Update',
                                'childActions'=>array()
                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'GlobalEnquiry'=>array('alias'=>'Global Enquiry Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
//                'Create'=>array('alias'=>'Create',
//                                'childActions'=>array()
//                                ),
//                'Update'=>array('alias'=>'Update',
//                                'childActions'=>array()
//                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'EnquiryProperty'=>array('alias'=>'Enquiry of Property Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
//                'Create'=>array('alias'=>'Create',
//                                'childActions'=>array()
//                                ),
//                'Update'=>array('alias'=>'Update',
//                                'childActions'=>array()
//                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        'ContactUs'=>array('alias'=>'Contact Us Management',
            'actions'=>array(
                'Index'=>array('alias'=>'List',
                                'childActions'=>array()
                                ),                
//                'Create'=>array('alias'=>'Create',
//                                'childActions'=>array()
//                                ),
//                'Update'=>array('alias'=>'Update',
//                                'childActions'=>array()
//                                ),
                'View'=>array('alias'=>'View',
                                'childActions'=>array()
                                ),
                'Delete'=>array('alias'=>'Delete',
                                'childActions'=>array()
                                ),
                )
        ), /* end controller */
        
        
        
        
        /******** Jan 26, 2015 ANH DUNG ***********/
        
        );
    }
}