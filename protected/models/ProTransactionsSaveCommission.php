<?php

/**
 * This is the model class for table "{{_pro_transactions_save_commission}}".
 *
 * The followings are the available columns in table '{{_pro_transactions_save_commission}}':
 * @property string $id
 * @property string $transactions_id
 * @property string $user_id
 * @property integer $type
 * @property string $transactions_no
 * @property string $submitted_date
 * @property integer $property_type_id
 * @property integer $commission_schema_id
 * @property string $price
 * @property string $client_commission
 * @property string $receivable_gross_commission
 * @property string $received_commission
 * @property string $received_on
 * @property string $net_commission_after_deduction
 * @property integer $type_of_tier
 * @property string $overriding_amount
 * @property string $percent_of_tier
 */
class ProTransactionsSaveCommission extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    public $submitted_date_downline;
    // ANH DUNG SEP 12, 2014
    public $month_paid;
    public $year_paid;
    public $count_record;
    // ANH DUNG SEP 12, 2014
    
    // ANH DUNG SEP 20, 2014
    const BELONG_SALEPERSON_PRIMARY = 1;
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_pro_transactions_save_commission}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('submitted_date_downline, id, transactions_id, user_id, type, transactions_no, submitted_date, property_type_id, commission_schema_id, price, client_commission, receivable_gross_commission, received_commission, received_on, net_commission_after_deduction, type_of_tier, overriding_amount, percent_of_tier', 'safe'),
            array('type_belong,status', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'rTransaction' => array(self::BELONGS_TO, 'ProTransactions', 'transactions_id'),
            'rUser' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'rSalePerson' => array(self::BELONGS_TO, 'Users', 'agent_id'),
            'rPropertyType' => array(self::BELONGS_TO, 'ProPropertyType', 'property_type_id'),
            'rListing' => array(self::BELONGS_TO, 'Listing', 'listing_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
            return array(
                'id' => 'ID',
                'transactions_id' => 'Transactions',
                'agent_id' => 'Sales Person Name',
                'user_id' => 'User',
                'type' => 'Type',
                'transactions_no' => 'Transactions ID',
                'submitted_date' => 'Submitted Date',
                'submitted_date_downline' => 'Submitted Date',
                'property_type_id' => 'Property Type',
                'commission_schema_id' => 'Commission Schema',
                'price' => 'Price',
                'client_commission' => 'Client Commission',
                'receivable_gross_commission' => 'Receivable Gross Commission',
                'received_commission' => 'Received Commission',
                'received_on' => 'Received On',
                'net_commission_after_deduction' => 'Net Commission After Deduction',
                'type_of_tier' => 'Type Of Tier',
                'overriding_amount' => 'Overriding Amount',
                'percent_of_tier' => 'Percent Of Tier',
            );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
            $criteria=new CDbCriteria;
            $criteria->compare('t.id',$this->id,true);
            $criteria->compare('t.transactions_id',$this->transactions_id,true);
            $criteria->compare('t.user_id',$this->user_id,true);
            $criteria->compare('t.type',$this->type);
            $criteria->compare('t.transactions_no',$this->transactions_no,true);
            $criteria->compare('t.submitted_date',$this->submitted_date,true);
            $criteria->compare('t.property_type_id',$this->property_type_id);
            $criteria->compare('t.commission_schema_id',$this->commission_schema_id);
            $criteria->compare('t.price',$this->price,true);
            $criteria->compare('t.client_commission',$this->client_commission,true);
            $criteria->compare('t.receivable_gross_commission',$this->receivable_gross_commission,true);
            $criteria->compare('t.received_commission',$this->received_commission,true);
            $criteria->compare('t.received_on',$this->received_on,true);
            $criteria->compare('t.net_commission_after_deduction',$this->net_commission_after_deduction,true);
            $criteria->compare('t.type_of_tier',$this->type_of_tier);
            $criteria->compare('t.overriding_amount',$this->overriding_amount,true);
            $criteria->compare('t.percent_of_tier',$this->percent_of_tier,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                    ),
            ));
    }
    
    public function searchFeList()
    {
            $criteria=new CDbCriteria;
            $aWith = array('rTransaction', 'rUser', 'rSalePerson', 'rPropertyType','rListing');
//            $criteria->with = $aWith;
//            $criteria->together = true;// Single Query - together is false => Multiple Query
            
            $criteria->compare('t.agent_id', Yii::app()->user->id);
            $criteria->compare('t.type', ProTransactions::TYPE_CONSULTANT);
            $criteria->compare('t.is_internal_co_broke', ProTransactions::IS_NOT_INTERNAL_CO_BROKE);
            $criteria->compare('t.transactions_no',$this->transactions_no,true);
            $criteria->compare('t.property_type_id',$this->property_type_id);
            
            $submitted_date = MyFormat::dateConverDmyToYmdForSeach($this->submitted_date);
            if(!empty($submitted_date)){
                $criteria->compare('t.submitted_date', $submitted_date, true);
            }
            if(isset($this->status) && $this->status != 1){
                $criteria->compare('t.status', $this->status);
            }
            $criteria->order = 't.id DESC';
            
            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
//                        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                        'pageSize'=> 10,
                    ),
            ));
    }
    
    
    /**
     * @Author: ANH DUNG Sep 19, 2014
     * @Todo: get client commission Sales person C who Created this transaction
     * @Param: $mTransaction
     */
    public static function ReportGetAllClientComm($mTransaction) {        
        $aRes = array();
        $criteria=new CDbCriteria;
//        $criteria->compare('t.status', STATUS_GEN_RECEIPT);
        $criteria->compare('t.type', ProTransactions::TYPE_CONSULTANT);
        $criteria->compare('t.is_internal_co_broke', ProTransactions::IS_NOT_INTERNAL_CO_BROKE);
        $criteria->addBetweenCondition("t.created_date",$mTransaction->date_from, $mTransaction->date_to);
        $models = self::model()->findAll($criteria);
        foreach($models as $item){
            $aRes['GrossCommissiontoCompany'][$item->transactions_id] = $item->receivable_gross_commission;
//            $aRes['AmountAtGross'][$item->transactions_id] = $item->AmountAtGross; // fix Oct 23, 2014 
            $aRes['AmountAtGross'][$item->transactions_id] = $item->received_commission;
            $aRes['GrossCommissionAmount'][$item->transactions_id] = $item->gross_commission_amount;
        }
        $_SESSION['DATA_COMM_REPORT'] = $aRes;        
    }
    
    /**
     * @Author: ANH DUNG Sep 20, 2014
     * @Todo: get row model of 1st and 2 nd
     * @Param: $mTransaction
     */
    public static function ReportGetAll1st2nd($mTransaction) {
        $aRes = array();
        $criteria=new CDbCriteria;
//        $criteria->compare('t.status', STATUS_GEN_RECEIPT);
        $criteria->addCondition('t.type<>'.ProTransactions::TYPE_CONSULTANT );
        $criteria->compare('t.is_internal_co_broke', ProTransactions::IS_NOT_INTERNAL_CO_BROKE);
        $criteria->addBetweenCondition("t.created_date",$mTransaction->date_from, $mTransaction->date_to);
        $criteria->with = array('rUser');
        $criteria->together = true;
        $models = self::model()->findAll($criteria);
        foreach($models as $item){
            if($item->type == ProTransactions::TYPE_1ST_TIER){
                $aRes['TIER_1ST'][$item->transactions_id] = $item;
            }
            elseif($item->type == ProTransactions::TYPE_2ND_TIER){
                $aRes['TIER_2ND'][$item->transactions_id] = $item;
            }            
        }
        $_SESSION['DATA_TIER'] = $aRes;
    }
    
    /**
     * @Author: ANH DUNG Sep 20, 2014
     * @Todo: calc report summary report between date
     * @Param: $mTransaction
     */
    public static function ReportGetAllCommCompany($mTransaction){
        $aRes = array();
        $criteria = new CDbCriteria();
//        $criteria->compare('t.status', STATUS_GEN_RECEIPT);
        $criteria->addBetweenCondition("t.created_date",$mTransaction->date_from, $mTransaction->date_to);
        $criteria->select = "sum(profit_to_property_info) as profit_to_property_info,sum(profit_to_property_info_by_company) as profit_to_property_info_by_company,"
                . "t.transactions_id";
        $criteria->group = "t.transactions_id";
        $models = ProTransactionsSaveCommission::model()->findAll($criteria);
        foreach($models as $item){
            $aRes[$item->transactions_id] = $item->profit_to_property_info+$item->profit_to_property_info_by_company;
        }
        $_SESSION['TOTAL_COMPANY_COM'] = $aRes;
    }    
    
    
    public function searchFeListDownline()
    {
            $criteria=new CDbCriteria;
            $aWith = array('rTransaction', 'rUser', 'rSalePerson', 'rPropertyType','rListing');
//            $criteria->with = $aWith;
//            $criteria->together = true;// Single Query - together is false => Multiple Query            
            $criteria->compare('t.user_id', Yii::app()->user->id);
            $criteria->compare('t.transactions_no',$this->transactions_no,true);
            $criteria->compare('t.property_type_id',$this->property_type_id);
//            $criteria->compare('t.is_internal_co_broke', ProTransactions::INTERNAL_CO_BROKE);
            $criteria->addCondition(
                    // 1. ROW LÀ INTERNAL CO BROKE
                    ' ( t.is_internal_co_broke = '.ProTransactions::INTERNAL_CO_BROKE.' ) OR '.
                    // 2. LÀ ROW CHÍNH CỦA SALE PERSON NHƯNG KO PHẢI TYPE LÀ SALEPERSON
                    ' ( t.is_internal_co_broke = '.ProTransactions::IS_NOT_INTERNAL_CO_BROKE.' AND '
                    . ' t.type <> '.ProTransactions::TYPE_CONSULTANT.')  '
                    );
            
            $submitted_date = MyFormat::dateConverDmyToYmdForSeach($this->submitted_date_downline);
            if(!empty($submitted_date)){
                $criteria->compare('t.submitted_date', $submitted_date, true);
            }   
            
            if(isset($this->status) && $this->status != 1){
                $criteria->compare('t.status',$this->status);
            }
            $criteria->order = 't.id DESC';
            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
//                        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                        'pageSize'=> 10,
                    ),
            ));
    }

    public function defaultScope()
    {
        return array(
                //'condition'=>'',
        );
    }
    
    public static function deleteBYTransactionId($transactions_id){
        self::model()->deleteAll("transactions_id=$transactions_id");
    }
    
    /**
     * @Author: ANH DUNG Jul 04, 2014
     * @Todo: tính  Gross Commission amount
     * Sales person C got the commission amount - 1000
        External co-broke – 100 (saleperson multi External co-broke  input )
        Gross Commission amount is 900.
     */
    public static function calcGrossCommissionAmount($mTransactions, &$GrossCommissionAmountRoot){
        $gross_commission_amount = 0;
        $com_external_cobroke = self::calcComExternalCoBroke($mTransactions);

        if($mTransactions->rBillTo->bill_to_id!=ProTransactions::BILL_TO_EXTERNAL_CO_BROKE){
            $GrossCommissionAmountRoot = $mTransactions->rBillTo->commission_amount;
            $gross_commission_amount = $mTransactions->rBillTo->commission_amount-$com_external_cobroke;
        }else{
            // theo như hỏi Tùng 4:55 PM ngày Jul 09, 2014 thì nếu chọn Bill To là External Co-Broke thì cái 
            // $gross_commission_amount nó = $com_external_cobroke 
            // nghĩa là người ta trả com cho thằng sale đó, còn trường hợp còn lại là thằng sala đó trả
            // commission cho nhân viên tier của nó
            $gross_commission_amount = $com_external_cobroke;
            $GrossCommissionAmountRoot = $gross_commission_amount;
        }

        return $gross_commission_amount;
    }
    
    public static function calcComExternalCoBroke($mTransactions){
        $commission_amount = 0;
        if($mTransactions->rBillTo->bill_to_id!=ProTransactions::BILL_TO_EXTERNAL_CO_BROKE){
            foreach($mTransactions->rExternalCoBrokeCommission as $model){
                $commission_amount += $model->commission_amount;
            }
        }else{
            foreach($mTransactions->rExternalCoBroke as $model){
                $commission_amount += $model->commission_amount;
            }
        }
        return $commission_amount;
    }
    
    // is External Co-Broke commission
    public static function calcClientCommission($mTransactions){
        // là tổng commission của ExternalCoBroke 
        $commission_amount = 0;
        if(count($mTransactions->rExternalCoBrokeCommission)){
            
            foreach($mTransactions->rExternalCoBrokeCommission as $model){
                $commission_amount += $model->commission_amount;
            }
        }
        return $commission_amount;
    }
    
    // is External Co-Broke commission
    public static function calcCommissionInternalCobroke($mTransactions){
        // là InternalCoBroke 
        // là số 160 trong => 3.Internal Co-Broke: 20% x (1000 – 100 – 100) = 160
        $criteria = new CDbCriteria();
        $criteria->compare('t.transactions_id', $mTransactions->id);
        $criteria->compare('t.is_internal_co_broke', ProTransactions::INTERNAL_CO_BROKE);
        $criteria->compare('t.type', ProTransactions::TYPE_CONSULTANT);
        $models = self::model()->findAll($criteria);
        $res = 0;
        foreach($models as $item){
            $res += $item->AmountAtGross;
        }
        return $res;
    }
    
    
    /**
     * @Author: ANH DUNG Apr 28, 2014
     * @Todo: save commission of one transaction
     * @Param: $mTransactions model Transactions
     * Sales person C got the commission amount - 1000
        External co-broke – 100 (saleperson multi External co-broke  input )
        Gross Commission amount is 900.
     */
    public static function saveOneTransaction($mTransactions){
        /* 1. foreach internal co-broke nếu có và save cho từng internal co-broke 
         * 2. lấy tổng % đã chia cho internal co-broke để phục vụ tính cho cái số 3
         * 3. save Salesperson C là thằng chính của transaction này
         */        
        self::deleteBYTransactionId($mTransactions->id);
        $TotalPercentInternalCoBroke = 0;
        $ProfitFromCompanyListing  = 0;
        $PercentProfitFromCompanyListing  = 0;
        // Sales person C got the commission amount - 1000 là con số tính ở đây
        $GrossCommissionAmountRoot = 0;
        $GrossCommissionAmount = self::calcGrossCommissionAmount($mTransactions, $GrossCommissionAmountRoot);
        $client_commission = self::calcClientCommission($mTransactions);
        $listing_type_id = $mTransactions->rPropertyDetail->listing_type_id;
        
        // For company listing
        if($listing_type_id == ProTransactionsPropertyDetail::VAR_COMPANY){
            $ProfitFromCompanyListing = (Yii::app()->params['percent_profit_from_company_listing']*$GrossCommissionAmount)/100;
            $PercentProfitFromCompanyListing  = Yii::app()->params['percent_profit_from_company_listing'];
        }
        
        $needMore = array('GrossCommissionAmountRoot'=>$GrossCommissionAmountRoot);
        // 1. chỗ này foreach internal co-broke nếu có và tính $TotalPercentInternalCoBroke
        foreach($mTransactions->rInternalCoBroke as $item){
            $TotalPercentInternalCoBroke += $item->gross_commission_amount;
//            self::SaveOneSaleperson($salesperson_id, $mTransactions, $GrossCommissionAmount, $percentAtGross, $is_internal_co_broke, $listing_type_id)
            self::SaveOneSaleperson(
                    $item->user_id, $mTransactions, $GrossCommissionAmount, 
                    $item->gross_commission_amount, ProTransactions::INTERNAL_CO_BROKE, $listing_type_id,
                    $ProfitFromCompanyListing,
                    $PercentProfitFromCompanyListing, $needMore
                    );
        }
        
        // 3. save Salesperson C là thằng chính của transaction này
        $needMore['type_belong'] = ProTransactionsSaveCommission::BELONG_SALEPERSON_PRIMARY; 
        // $needMore['type_belong'] dung de xac dinh nhom cua sale person chinh gom Salesperson C + 2 thang tier cua no
        $PercentAtGrossOfSaleperson = 100-$TotalPercentInternalCoBroke-$PercentProfitFromCompanyListing;
        if($PercentAtGrossOfSaleperson<0)
            $PercentAtGrossOfSaleperson = 0;
        self::SaveOneSaleperson(
                $mTransactions->user_id, $mTransactions, $GrossCommissionAmount, 
                $PercentAtGrossOfSaleperson, ProTransactions::IS_NOT_INTERNAL_CO_BROKE, $listing_type_id,
                $ProfitFromCompanyListing,
                $PercentProfitFromCompanyListing, $needMore
                );
        // 4. cập nhật NetCommissionAfterDeduction và $client_commission, 
        // cập nhật 1 số field chung cho tất cả các row của transaction đó
        self::UpdateNetCommissionAfterDeduction($mTransactions, $client_commission);
        // 5. save External co-broke vào, có thể nó sẽ dùng để làm report - vãi cả làm việc - ko rõ ràng document
        self::saveComExternalCoBroke($mTransactions, $listing_type_id);
    }
    
    /**
     * @Author: ANH DUNG Jul 04, 2014
     * @Todo: SaveOneSaleperson: 1 là saleperson, 2,3 là 2 thằng tier của saleperson đó
     * @Param: $salesperson_id id của thằng sale person, bên dưới nó có thể còn 2 thằng tier 
     * @Param: $mTransactions model transaction
     * @Param: $GrossCommissionAmount xem chú thích ở hàm trên ( đoạn Gross Commission amount is 900. )
     * @Param: $percentAtGross có thể là % mỗi internal cobroke  hoặc là % của saleperson sau khi trừ tổng % của internal cobroke
     * @Param: $is_internal_co_broke 0: là com của sale person, 1: là của internal co-broken
     * @Param: $listing_type_id 1: individual listing, 2:Company
     * @Param: $client_commission
     */        
    public static function SaveOneSaleperson($salesperson_id,
            $mTransactions, $GrossCommissionAmount, 
            $percentAtGross, $is_internal_co_broke, $listing_type_id,
            $ProfitFromCompanyListing, $PercentProfitFromCompanyListing, $needMore
            ){
        // không dùng hàm này, hình như bị sai, không đúng logic
//        $receivable_gross_commission = ProTransactionsSaveCommission::get_receivable_gross_commission($mTransactions);
        // P1: here is Under this value (20%x900) = 180 = $AmountAtGross: 
        $AmountAtGross = ($percentAtGross*$GrossCommissionAmount)/100; // là con số này 3. Internal Co-Broke: 20% x (1000 – 100 – 100) = 160
        // chỗ này để tính
        $AmountSaleperson = 0;// Profit to Property Info logic =  13.5 ( tuc la 180-162-3.6-0.9)
        $AmountTier = 0;// để tính profit
        $ModelRowSalepersonUpdateProfit = null;// mỗi saleperson sẽ lưu profit của property để tính profit
                
        // 1. save for my transaction( is salesperson ) hoặc là internal co-broke
        $model = new ProTransactionsSaveCommission();
        $model->transactions_id = $mTransactions->id;
        $model->listing_id = $mTransactions->listing_id;
        $model->agent_id = $mTransactions->user_id;// là user (saleperson ) tạo transaction 
        $model->user_id = $salesperson_id; // là 1 sale person dc hường commisson dạng internal co broke
        $model->type = ProTransactions::TYPE_CONSULTANT;
        $model->transactions_no = $mTransactions->transactions_no;
        $model->submitted_date = $mTransactions->created_date;
        $model->property_type_id = $mTransactions->rPropertyDetail->property_type_id;
        $model->is_internal_co_broke = $is_internal_co_broke;
        $model->listing_type = $listing_type_id;
        $model->AmountAtGross = $AmountAtGross;
        if(isset($needMore['type_belong'])){
            $model->type_belong = $needMore['type_belong'];
        }
        
        $mSaleperson = null;
        $ListingPrice = $mTransactions->rListing?$mTransactions->rListing->price:0;
        
        /**   Feb 02, 2015 
         * 68. Salesperson Portal: Pls. review the calculation for Salesperson’s Commission Log. 
            Price should be the rental amount – B Dung
         * Receivable Gross Commission should be rental + 7% GST
         */
        self::ForRentCalcSomething($mTransactions, $ListingPrice, $needMore['GrossCommissionAmountRoot'] );
        
        $mScheme = Users::getModelSchemeByUid($salesperson_id, $mSaleperson);
        if(is_null($mScheme))
            return;
        $model->commission_schema_id = $mScheme->id;
        $model->price = $ListingPrice;
        $model->receivable_gross_commission = $needMore['GrossCommissionAmountRoot'];
        $model->percent_of_tier = $mScheme->percent;// CÁI NÀY LÀ PERCENT CỦA SALEPERSON DÙNG LUÔN BIẾN CỦA TIER
        // P2: here is Salesperson A (90%x180) = 162
        $AmountSaleperson = ($mScheme->percent*$AmountAtGross)/100;
        // $AmountSaleperson is Net Commission After Deduction của saleperson chính, 
        // không phải sale của internal co broke
        $model->received_commission = $AmountSaleperson;
        $model->overriding_amount = $AmountSaleperson;
        $model->gross_commission_amount = $GrossCommissionAmount;
        $model->save();         
        $ModelRowSalepersonUpdateProfit = $model;
        
        //  2. save 1st tier and 2nd tier if have
        if($mSaleperson){
            if(count($mSaleperson->rAgentTierManager)){
                foreach($mSaleperson->rAgentTierManager as $key=>$mAgentTier){
                    $model = new ProTransactionsSaveCommission();
                    $model->transactions_id = $mTransactions->id;
                    $model->listing_id = $mTransactions->listing_id;
                    $model->agent_id = $mTransactions->user_id;
                    $model->user_id = $mAgentTier->tier_manager_id;
                    $model->commission_schema_id = $mScheme->id;
                    if($mAgentTier->type_tier == ProTransactions::TYPE_1ST_TIER){
                        $model->type_of_tier = ProTransactions::TYPE_1ST_TIER;
                        $model->type = ProTransactions::TYPE_1ST_TIER;
                        $model->percent_of_tier = $mScheme->first_tier;
                        
                    }else{
                        $model->type = ProTransactions::TYPE_2ND_TIER;
                        $model->type_of_tier = ProTransactions::TYPE_2ND_TIER;
                        $model->percent_of_tier = $mScheme->second_tier;
                    }
                    $model->transactions_no = $mTransactions->transactions_no;
                    $model->submitted_date = $mTransactions->created_date;
                    $model->property_type_id = $mTransactions->rPropertyDetail->property_type_id;
                    $model->is_internal_co_broke = $is_internal_co_broke;
                    $model->listing_type = $listing_type_id;                    
                    $model->price = $ListingPrice;
                    $OneTierAmount = ($model->percent_of_tier*$AmountAtGross)/100;
                    $AmountTier += $OneTierAmount;
                    $model->received_commission = $OneTierAmount; 
                    $model->receivable_gross_commission = $needMore['GrossCommissionAmountRoot'];
                    // P3: here is 1st Tier Manager sales person B (2%x180) = 3.6 = $model->overriding_amount
                                // 2nd Tier Manager sales person A (0.5%x180) = 0.9
                    $model->overriding_amount = $OneTierAmount;
                    $model->gross_commission_amount = $GrossCommissionAmount;
                    if(isset($needMore['type_belong'])){
                        $model->type_belong = $needMore['type_belong'];
                    }
                    $model->save();
                }
            } // end 
        }// end if($mSaleperson){   
        
        // is sale person  chính
        $attUpdate = array('profit_to_property_info');
        $ModelRowSalepersonUpdateProfit->profit_to_property_info = $AmountAtGross-$AmountSaleperson-$AmountTier;
        if($is_internal_co_broke==ProTransactions::IS_NOT_INTERNAL_CO_BROKE && 
                $listing_type_id == ProTransactionsPropertyDetail::VAR_COMPANY){
            $attUpdate[] = 'profit_to_property_info_by_company';
            $ModelRowSalepersonUpdateProfit->profit_to_property_info_by_company = $ProfitFromCompanyListing;
        }
        $ModelRowSalepersonUpdateProfit->update($attUpdate);
    }
    
    /**
     * @Author: ANH DUNG Feb 02, 2015
     * @Todo: For rent get rental amount and Receivable Gross Commission 
     * @Param: $rental_amount,  is $ListingPrice
     * &$receivable_gross_commission
     */
    public static function ForRentCalcSomething($mTransactions, &$rental_amount, &$receivable_gross_commission ) {
        /**   Feb 02, 2015 
         * 68. Salesperson Portal: Pls. review the calculation for Salesperson’s Commission Log. 
            Price should be the rental amount – B Dung
         * Receivable Gross Commission should be rental + 7% GST
         */
        if($mTransactions->type==ProTransactions::FOR_RENT){
            $rental_amount = $mTransactions->tenancy_amount;
            $gst = Yii::app()->params['gst'];
            $gst_amount = ($rental_amount * $gst)/100;
            $receivable_gross_commission = $rental_amount+$gst_amount;
        }
        // Feb 02, 2015 Receivable Gross Commission should be rental + 7% GST
    }
    
    /**
     * @Author: ANH DUNG Feb 02 2015
     * @Todo: update old data  for change Feb 02, 2015 Receivable Gross Commission should be rental + 7% GST
     * ProTransactionsSaveCommission::Feb02UpdateOldData();
     */ 
    public static function Feb02UpdateOldData() {        
        $AllTrans = ProTransactions::model()->findAll();
        foreach ( $AllTrans as $mTransactions){
            if($mTransactions->type==ProTransactions::FOR_RENT){
                $price = 0;
                $receivable_gross_commission = 0;
                self::ForRentCalcSomething($mTransactions, $price, $receivable_gross_commission );
                ProTransactionsSaveCommission::model()->updateAll(
                    array('price'=>$price,
                        'receivable_gross_commission'=>$receivable_gross_commission
                        ),
                        "`transactions_id`=$mTransactions->id");
            }
        }
        echo count($AllTrans);die;
    }
    
    /**
     * @Author: ANH DUNG Jul 17, 2014
     * @Todo: save vài row cho external co-broke
     * @Param: $mTransactions model 
     */
    public static function saveComExternalCoBroke($mTransactions, $listing_type_id){
        foreach($mTransactions->rExternalCoBrokeCommission as $model){
            $received_commission = $model->commission_amount;
            self::saveComExternalCoBrokeOne($mTransactions, $listing_type_id, $received_commission, $model->user_id);
        }
    }
    
    public static function saveComExternalCoBrokeOne($mTransactions, $listing_type_id, $received_commission, $uidCobroke){
        $model = new ProTransactionsSaveCommission();
        $model->transactions_id = $mTransactions->id;
        $model->listing_id = $mTransactions->listing_id;
        $model->agent_id = $mTransactions->user_id;// là user (saleperson ) tạo transaction 
        $model->user_id = $uidCobroke; // là 1 external co broke dc hường commisson 
        $model->type = ProTransactions::TYPE_EXTERNAL_COBROKE;
        $model->transactions_no = $mTransactions->transactions_no;
        $model->submitted_date = $mTransactions->created_date;
        $model->property_type_id = $mTransactions->rPropertyDetail->property_type_id;
        $model->is_internal_co_broke = 0;
        $model->listing_type = $listing_type_id;
        $model->received_commission = $received_commission;
        $model->save();
    }
        
    /**
     * @Author: ANH DUNG Apr 29, 2014
     * @Todo: get commission_amount
     * @Param: $mTransactions 
     * @Return: number commission_amount
     */
    public static function get_receivable_gross_commission($mTransactions){
        $res = 0;
        if($mTransactions->rBillTo){ // HAS_ONE 1: Vendor & Purchaser, 2: External Co-broke
           return $res = $mTransactions->rBillTo->commission_amount;
        }else{ // 2: External Co-broke
            
        }
        return $res;
    }
    
    /**
     * @Author: ANH DUNG Apr 29, 2014
     * @Todo: for DToan get array id,name of 1st tier and  2nd tier at transaction of agent
     * @Param: $user_id
     * @Return: array [1ST_TIER][user_id][name_user]
     * ProTransactionsSaveCommission::getArr1StAnd2NdTier($user_id);
     */
    public static function getArr1StAnd2NdTier($user_id){        
        $res = array();
        $cmsFormater = new CmsFormatter();
        $criteria=new CDbCriteria;
        $criteria->compare('t.agent_id', $user_id);
        $models = self::model()->findAll($criteria);
        if(count($models)){
            foreach($models as $item){
                if($item->type==ProTransactions::TYPE_1ST_TIER){
                    $res['1ST_TIER'][$item->user_id] = $cmsFormater->formatFullNameRegisteredUsers($item->rUser);
                }elseif($item->type==ProTransactions::TYPE_2ND_TIER){
                    $res['2ND_TIER'][$item->user_id] = $cmsFormater->formatFullNameRegisteredUsers($item->rUser);
                }
            }
        }
        return $res;
    }
    
    /**
     * @Author: ANH DUNG May 06, 2014
     * @Todo: get getCommissionReceivableAgent
     * @Param: $agent_id 
     * @Return: number commission
     * ProTransactionsSaveCommission::getCommissionReceivableAgent($agent_id);
     */
    public static function getCommissionReceivableAgent($agent_id){
        $criteria=new CDbCriteria;
        $criteria->compare('t.agent_id', $agent_id);
        $criteria->compare('t.type', ProTransactions::TYPE_CONSULTANT);
        $criteria->select = "sum(receivable_gross_commission) as receivable_gross_commission";
        $model = self::model()->find($criteria);
        return $model->receivable_gross_commission;
    }    
    
    /**
     * @Author: ANH DUNG Jul 15, 2014
     * @Todo: hien tong so Commission Amount cua tat ca cac Transaction nguoi salesperson da thuc hien
     * @Param: $user_id 
     * @Return: number commission
     * ProTransactionsSaveCommission::getCommissionReceivableAgent($user_id);
     */
    public static function getCommissionReceivableUid($user_id){
        $criteria=new CDbCriteria;
        $criteria->compare('t.user_id', $user_id);
        $criteria->compare('t.admin_approved', ProTransactions::TRANS_APPROVED);
        $criteria->select = "sum(t.received_commission) as received_commission";
        $model = self::model()->find($criteria);
        return $model->received_commission;
    }    
   
    /**
     * @Author: ANH DUNG Jul 07, 2014
     * @Todo: tính Net Commission After Deduction - net_commission_after_deduction và cập nhật cho tất cả các
     * row transaction liên quan của 1 transaction
     * @Param: $mTransactions model 
     */
    public static function getNetCommissionAfterDeduction($mTransactions){
        $criteria=new CDbCriteria;
        $criteria->compare('t.transactions_id', $mTransactions->id);
        // là saleperson chính
        $criteria->compare('t.type', ProTransactions::TYPE_CONSULTANT);
        // không phải là internal co broke
        $criteria->compare('t.is_internal_co_broke', ProTransactions::IS_NOT_INTERNAL_CO_BROKE );
        $model = self::model()->find($criteria);
        if($model){
            // chỗ này có thẻ lấy received_commission hay overriding_amount, chưa rõ???
            return $model->overriding_amount;
        }
        return 0;        
    }
    
    // tiện cập nhật 2 cột net_commission_after_deduction và $client_commission
    public static function UpdateNetCommissionAfterDeduction($mTransactions, $client_commission){
        $net_commission_after_deduction = self::getNetCommissionAfterDeduction($mTransactions);
        ProTransactionsSaveCommission::model()->updateAll(
                array('net_commission_after_deduction'=>$net_commission_after_deduction,
                    'client_commission'=>$client_commission
                    ),
                    "`transactions_id`=$mTransactions->id");        
    }

    /**
     * @Author: ANH DUNG Jul 07, 2014
     * @Todo: cập nhật status và date received cho bảng commission khi gen invoice
     * @Param: $mTransactions
     */
    public static function UpdateStatusOfCommission($mTransactions, $received_on, $status){
        ProTransactionsSaveCommission::model()->updateAll(array('status'=>$status, 'received_on'=>$received_on),
                    "`transactions_id`=$mTransactions->id");
    }
    
    /**
     * @Author: ANH DUNG Jul 04, 2014
     * @Todo: tính hoa hồng cho 1,2 tier, dùng khi lưu mới 1 transaction
     * @Param: $tier_id id tier
     * @Param: $percent tier nhận dc trong scheme của saleperson đó
     * @Return: number commission
     */
    public static function ComTier($tier_id, $percent){
        // not yet use
        return ($tier_id*$percent)/100;
    }
    
    /**
     * @Author: ANH DUNG Jul 04, 2014
     * @Todo: tính lợi nhuận chia cho cty Property, dùng khi lưu mới 1 transaction
     * @Param: $model model 
     * @Return: full name with salution of user
     */
    public static function ComProfitProperty(){
        // not yet use        
    }
    
    
    /**
     * @Author: ANH DUNG Jul 15, 2014
     * @Todo: Neu 1 salesperson co tong so Received Commission lon nhat 
     * trong thang truoc do, khi salesperson nay login vao dashboard 
     * se thay o duoi link edit profile 1 dong text: "Best ranking of the month"
     */
    public static function IsBestRankingOfTheMonth(){
        $UidBest = self::GetBestRankingOfTheMonth();
        if($UidBest && $UidBest==Yii::app()->user->id)
        {
            return true;
        }
        return false;
    }
    
    // belong to IsBestRankingOfTheMonth. Lấy uid của best ranking
    public static function GetBestRankingOfTheMonth(){
        $month = date('m')*1;
        $year = date('Y');
        if($month==1){
            $month = 12;            
            $year--;
        }else{
            $month--;
        }
        $month = $month*1;
        if($month<10){
            $month = "0$month";
        }
        
        $year_month = "$year$month";
        $ShortMonth = date('M', strtotime($year_month . '01'));
        
        $criteria = new CDbCriteria();        
        $criteria->compare('month(t.received_on)', $month);
        $criteria->compare('year(t.received_on)', $year);
        $criteria->compare('t.status', STATUS_GEN_RECEIPT);
        $criteria->select = "t.user_id, SUM(t.received_commission) as received_commission";
        $criteria->group = "t.user_id";
        $criteria->order = "SUM(t.received_commission) DESC";
        $criteria->limit = 100;
        $models = self::model()->findAll($criteria);
        $uid = Yii::app()->user->id;
        foreach($models as $key=>$item){
            if($item->user_id == $uid){
                $top = MyFormat::addOrdinalNumberSuffix($key+1);
                return "You are top $top achiever for $ShortMonth $year";
            }
        }
        return '';
    }
    
    /**
     * @Author: ANH DUNG Jul 17, 2014
     * @Todo: get list user have comm by trans id
     * @Param: $transactions_id
     * @Return: array id=>name
     */
    public static function getListUserForVoucher($transactions_id){
        $models = array(); $aModelUser = array(); $aRes = array();
        $cmsFormater = new CmsFormatter();
        self::getListUidId($transactions_id, $models, $aModelUser);
        foreach($models as $item){
            $type = 'Salesperson';
            if($item->type == ProTransactions::TYPE_EXTERNAL_COBROKE){
                $type = 'External Co-Broke';
            }elseif($item->is_internal_co_broke == ProTransactions::INTERNAL_CO_BROKE){
                $type = 'Internal Co-Broke';
            }
            $user_id = $item->user_id;
            $Fullname = isset($aModelUser[$user_id]) ? $cmsFormater->formatFullNameRegisteredUsers($aModelUser[$user_id]):'';
            $aRes [$user_id] = "$Fullname - $type";
        }
        return $aRes;
    }
    
    public static function getListUidId($transactions_id, &$models, &$aModelUser){
        $criteria = new CDbCriteria();
        $criteria->compare('t.transactions_id', $transactions_id);
        $criteria->order = 't.type DESC';
        $models = self::model()->findAll($criteria);        
        $aUid =  CHtml::listData($models,'user_id','user_id');
        $aModelUser = Users::getModelByListUid($aUid);        
    }
    
    /**
     * @Author: ANH DUNG Jul 17, 2014
     * @Todo: get type user for template voucher
     * - Đối với Salesperson: dùng template Voucher
       - Đối với Internal và External Co-Broke: dùng template Voucher (co-broke)
     * @Param: $transactions_id, $user_id
     * @Return: type tempalte
     */
    public static function getTypeTemplateVoucher($transactions_id, $user_id){
        $res = ProTransactionsInvoice::TEMPLATE_4_VOUCHER_SALEPERSON;
        $model = self::getByTransUid($transactions_id, $user_id);
        if($model->type == ProTransactions::TYPE_EXTERNAL_COBROKE || 
                $model->is_internal_co_broke == ProTransactions::INTERNAL_CO_BROKE){
            $res = ProTransactionsInvoice::TEMPLATE_5_VOUCHER_COBROKE;
        }
        return $res;
    }
    
    public static function getByTransUid($transactions_id, $user_id){
        $criteria = new CDbCriteria();
        $criteria->compare('t.transactions_id', $transactions_id);
        $criteria->compare('t.user_id', $user_id);
        return self::model()->find($criteria);
    }
    /**
     * @Author: ANH DUNG Jul 07, 2014
     * @Todo: cập nhật status admin new or approved
     * @Param: $mTransactions, $statusAdmin
     */
    public static function UpdateAdminStatus($mTransactions, $statusAdmin){
        ProTransactionsSaveCommission::model()->updateAll(array('admin_approved'=>$statusAdmin),
                    "`transactions_id`=$mTransactions->id");
    }
    
    /**
     * @Author: ANH DUNG Sep 19, 2014
     * @Todo: SumReportGetInfoExternalCoBroke 
     * @Param: $mTransactions
     */
    public static function SumReportGetInfoExternalCoBroke($arrModelTrans){
//    public static function SumReportGetInfoExternalCoBroke($mTransactions){
        $aRes = array();
        foreach($arrModelTrans as $mTransactions){
            $agent_company = array();
            $agent_name = array();  
            if($mTransactions->rBillTo->bill_to_id!=ProTransactions::BILL_TO_EXTERNAL_CO_BROKE){
                foreach($mTransactions->rExternalCoBrokeCommission as $model){
                    $agent_company[] = $model->company_name;
                    $agent_name[] = $model->salesperson_name;
                }
            }else{
                foreach($mTransactions->rExternalCoBroke as $model){
                    $agent_company[] = $model->company_name;
                    $agent_name[] = $model->salesperson_name;
                }
            } // end if($mTransactions->rBillTo->bill_
            
            $agent_company = implode(",", $agent_company);
            $agent_name = implode(",", $agent_name);
            $aRes[$mTransactions->id]['agent_company'] = $agent_company;
            $aRes[$mTransactions->id]['agent_name'] = $agent_name;
        }
        
        $_SESSION['AGENT_COMPANY_NAME'] = $aRes;
        return ;
        
//        $aRes = array();
//        //$agent_company = '';
//        $agent_company = '';
////        $agent_name = '';
//        $agent_name = '';
////        if(!isset($_SESSION['AGENT_COMPANY_NAME'][$mTransactions->id])){
//            if($mTransactions->rBillTo->bill_to_id!=ProTransactions::BILL_TO_EXTERNAL_CO_BROKE){
//                foreach($mTransactions->rExternalCoBrokeCommission as $model){
//                    //$agent_company .= $model->company_name.", ";
//                    $agent_company .= $model->company_name.", ";
//                     //$agent_name .= $model->salesperson_name.", ";
//                    $agent_name .= $model->salesperson_name.", ";
//                }
//            }else{
//                foreach($mTransactions->rExternalCoBroke as $model){
//                    $agent_company .= $model->company_name.", ";
//                    $agent_name .= $model->salesperson_name.", ";                    
//                }
//            }
////        }
//        $agent_company = trim($agent_company);
//        $agent_name = trim($agent_name);
//        $agent_company = trim($agent_company,",");
//        $agent_name = trim($agent_name,",");
//        $aRes[$mTransactions->id]['agent_company'] = $agent_company;
//        $aRes[$mTransactions->id]['agent_name'] = $agent_name;
//        if(!isset($_SESSION['AGENT_COMPANY_NAME'])){
//            $_SESSION['AGENT_COMPANY_NAME'] = $aRes;
//        }else{
//            $aTmp = $_SESSION['AGENT_COMPANY_NAME'];
//            if(!isset($aTmp[$mTransactions->id])){
//                $aTmp[$mTransactions->id]['agent_company'] = $agent_company;
//                $aTmp[$mTransactions->id]['agent_name'] = $agent_name;
//                $_SESSION['AGENT_COMPANY_NAME'] = $aTmp;
//            }
//        }
    }
    
    /**
     * @Author: ANH DUNG Sep 19, 2014
     * @Todo: SumReportGetInfoExternalCoBroke 
     * @Param: $mTransactions
     * bug Undefined variable: agent_company  when use at grid
     */
    public static function BackupForBugSumReportGetInfoExternalCoBroke($mTransactions){
        $aRes = array();
        $agent_company = '';
        $agent_name = '';        
        if(!isset($_SESSION['AGENT_COMPANY_NAME'][$mTransactions->id])){
            if($mTransactions->rBillTo->bill_to_id!=ProTransactions::BILL_TO_EXTERNAL_CO_BROKE){
                foreach($mTransactions->rExternalCoBrokeCommission as $model){
                    $agent_company += $model->company_name.", ";
                    $agent_name += $model->company_name.", ";
                }
            }else{
                foreach($mTransactions->rExternalCoBroke as $model){
                    $agent_company += $model->company_name.", ";
                    $agent_name += $model->company_name.", ";
                }
            }
        }
        $agent_company = trim($agent_company);
        $agent_name = trim($agent_name);
        $agent_company = trim($agent_company,",");
        $agent_name = trim($agent_name,",");
        $aRes[$mTransactions->id]['agent_company'] = $agent_company;
        $aRes[$mTransactions->id]['agent_name'] = $agent_name;
        if(!isset($_SESSION['AGENT_COMPANY_NAME'])){
            $_SESSION['AGENT_COMPANY_NAME'] = $aRes;
        }else{
            $aTmp = $_SESSION['AGENT_COMPANY_NAME'];
            if(!isset($aTmp[$mTransactions->id])){
                $aTmp[$mTransactions->id]['agent_company'] = $agent_company;
                $aTmp[$mTransactions->id]['agent_name'] = $agent_name;
                $_SESSION['AGENT_COMPANY_NAME'] = $aTmp;
            }
        }
    }
    
    /**
     * @Author: ANH DUNG Sep 19, 2014
     * @Todo: SumReportGetGrossCommissiontoCompany 
     * @Param: $mTransactions
     */
    public static function SumReportGetGrossCommissiontoCompany($mTransactions){
        $criteria = new CDbCriteria();
        $criteria->compare('t.transactions_id', $mTransactions->id);
        $criteria->compare('t.user_id', $user_id);
        return self::model()->find($criteria);
        
    }
    
}