<?php

/**
 * This is the model class for table "{{_api_postcode}}".
 *
 * The followings are the available columns in table '{{_api_postcode}}':
 * @property string $id
 * @property string $postal_code
 */
class ApiPostcode extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_api_postcode}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('postal_code', 'length', 'max'=>255),
                    // The following rule is used by search().
                    // @todo Please remove those attributes that should not be searched.
                    array('id, postal_code', 'safe', 'on'=>'search'),
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
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
            return array(
                    'id' => 'ID',
                    'postal_code' => 'Postal Code',
            );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
            // @todo Please modify the following code to remove attributes that should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id,true);
            $criteria->compare('postal_code',$this->postal_code,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ApiPostcode the static model class
     */
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }
    
    
    /**
     * @Author: ANH DUNG Oct 27, 2014
     * @Todo: get text by postal code
     * @Param: $postal_code
     */
    public static function getByPostalCode($postal_code) {
        $criteria = new CDbCriteria();
        $criteria->compare("t.postal_code", $postal_code, true);
        return self::model()->find($criteria);
    }
    
    /**
     * @Author: ANH DUNG Oct 27, 2014
     * @Todo: get text by postal code
     * @Param: $string_value may be 
     * postal code X(6): key = postal_code
        address type X(1): key = address_type
        building number X(7): key = building_number 
        street key X(7): key = street_key
        building key X(6): key = building_key
     * 
     */
    public static function getModelByStringValueOfKey($string_value) {
        $criteria = new CDbCriteria();
        $criteria->compare("t.postal_code", $string_value, true);
        return self::model()->find($criteria);
    }
        
    /**
     * @Author: ANH DUNG Oct 27, 2014
     * @Todo: get some value info. It's only map for table ApiPostcode
     * @Param: $postal_code
     * @Param: $key can be:
     *  postal code X(6): key = postal_code
        address type X(1): key = address_type
        building number X(7): key = building_number 
        street key X(7): key = street_key
        building key X(6): key = building_key
     */
    public static function getValueKeyByPostalCode($postal_code, $key) {
        $model = ApiPostcode::getByPostalCode($postal_code);
        return ApiPostcode::getValueKeyFromModel($model, $key);
    }
    
    /**
     * @Author: ANH DUNG Mar 05, 2015
     * @Todo: belong to getValueKeyByPostalCode
     * @Param: $model  ApiPostcode
     * @Param: $key can be:
     *  postal code X(6): key = postal_code
        address type X(1): key = address_type
        building number X(7): key = building_number 
        street key X(7): key = street_key
        building key X(6): key = building_key
     */
    public static function getValueKeyFromModel($model, $key) {
        $res = '';
        if($model){
            switch ($key) {
                case "postal_code":
                    $res = substr($model->postal_code, 0, 6);// lay tu vi tri 0 va lay 6 ky tu
                break;
                case "address_type":
                    $res = substr($model->postal_code, 6, 1);
                break;
                case "building_number":
                    $res = substr($model->postal_code, 7, 7);
                break;
                case "street_key":
                    $res = substr($model->postal_code, 14, 7);
                break;
                case "building_key":
                    $res = substr($model->postal_code, 21, 6);
                break;
                default: break;
            }
        }
        return $res;
    }
    
    
    /**
     * @Author: ANH DUNG Mar 05, 2015
     * @Todo: cron to run this
     */
    public static function HandleUpdateLonLatTableBuilding() {
        $mBuilding = ApiBuilding::model()->findAll();
        foreach($mBuilding as $model){
            $buildkey = ApiBuilding::getValueKeyFromModel($model, 'building_key');
            $building_name = ApiBuilding::getValueKeyFromModel($model, 'building_name');
            $mPostalcode = ApiPostcode::getModelByStringValueOfKey($buildkey);
            $postal_code = ApiPostcode::getValueKeyFromModel($mPostalcode, "postal_code");
            $aResLongLat = ApiPostcode::CurlToGetLongLat($building_name, $postal_code);
            ApiBuilding::UpdateLongLat($model, $aResLongLat);
        }
    }
    
    /**
     * @Author: ANH DUNG Mar 05, 2015
     * @Todo: curl to get long and lat
     * @Param: $postal_code
     * @Return: array[long]
     * @Note: $postal_code='428802' is line 50504 in file postcode.txt
     * CurlToGetLongLat
     * Respone CURL
     * Array
    (
    [0] => stdClass Object
        (
            [total] => 1
        )

    [1] => stdClass Object
        (
            [id] => 303416
            [v] => #1 Suites (U/C - TOP : 31 Dec 2018)
            [i] => 1 Lorong 20 Geylang. (S)398721
            [t] => 1
            [pid] => 100869
            [aid] => 51869
            [lid] => 303416
            [lon] => 103.881572
            [lat] => 1.31253
            [ad] => 0
            [c] => 1084
            [bld] => 1
            [hsp] => 1
        )
    )
     */
    public static function CurlToGetLongLat($building_name, $postal_code='428802'){
        // 1. sau khi co dc $buildkey tu table ApiBuilding => then like $buildkey ben bang table postal code de tim postal code
        // 2. sau khi tim dc $postal_code thi call ham actionImportBuilding
        // 3. Lay building name: => quay lai table building lay tu ky tu 7 den 45  ( la building name ) 
        // tuong duong voi $buildkey hoi nay find ra postal code
        // 4. sau khi CURL tra ve se isset de so khop phan tu [v] => 112 Katong voi cai building name trong table ApiBuilding
        
        //$link = 'http://www.streetdirectory.com/api/?mode=search&output=json&methods=all&country=sg&q='.trim($buildname);
        $url = "http://www.streetdirectory.com/api/?mode=search&&output=json&profile=sd_auto&country=sg&q=".trim($postal_code);
        $output = MyFormat::curl_get_contents($url);
//            $nearBy=file_get_contents($link);
        $aRes = array();
        $output = json_decode($output); 
        if(is_array($output)){
            foreach($output as $key=>$item){
                if($key==1){ // nếu có 1 item trả về thì chính là nó không cần check isset($item->v)
                    $aRes['long_street'] = $item->lon;
                    $aRes['lat_street'] = $item->lat;
                }
                if(isset($item->v)){
                    $building_name_res = trim(strtolower($item->v));
                    $building_name_local = trim(strtolower($building_name));
                    if( $building_name_res == $building_name_local){
                        $aRes['long_street'] = $item->lon;
                        $aRes['lat_street'] = $item->lat;
                        break;
                    }
                }
            }
        }
        return $aRes;
    }
        
    
    
    /********* Mar 04, 2015 ANH DUNG FOR IMPORT NEW DATA Postal Code *********/
    /********* STEP TO UPDATE THIS 6-Digit Postal Code  ********
     *  1. Run insert from action demo2/site/importApi
     *  2. Run this function from Cron console: ApiPostcode::HandleUpdateLonLatTableBuilding();
     *  vì ở trên host bị limit timeout cho 1 connection, ở local thì chạy trên browser được
     *  ở local sau khi chạy thì ra con số này: done in: 5333 Second <=> 88.883 Minutes
     * 
    ******** STEP TO UPDATE THIS 6-Digit Postal Code  *********/
    
    /** http://www.streetdirectory.com/sg/1-suites/1-lorong-20-geylang-398721/100869_51869.html
     * @Author: ANH DUNG Mar 04, 2015
     * @Todo: 6-Digit Postal Code Subscription
     * The latest update of the database is attached please.
        The data have been updated as at 10 Feb 2015.
     * @Link: verzview.com/verzpropertyinfo/demo2/site/importApi
     * @cron: s:39:" done in: 285  Second  <=> 4.75 Minutes";
     * s:39:" done in: 273  Second  <=> 4.55 Minutes";
     * s:48:" done in: 235  Second  <=> 3.91666666667 Minutes";
     */
    public function ConsoleImportApiUpdate() {
//        Yii::app()->setting->setDbItem('rss', 0); // for run cron NewsletterCommand
//        echo Yii::app()->setting->getItem('rss');die;
//        phpinfo();
//        echo "need close this line to run. Please read careful step above";die;
        $from = time();
        set_time_limit(72000);
//        $sql = "insert into {{_api_postcode}} ( postal_code ) values ( '019191K31 MAR0043MAR036999999' ),( '019191K31 MAR0043MAR036' ) ";
//        Yii::app()->db->createCommand($sql)->execute();die;
        $root = ROOT.'/api'; // ApiAddress, ApiBuilding, ApiPostcode, ApiStreets, ApiWalkup
        $aInfoImport = array(
//            array(
//                'ClassName'=>'ApiAddress',
//                'FieldName'=>'address',
//                'file_name'=>'ADDRESS.TXT',
//            ),
//            array(
//                'ClassName'=>'ApiBuilding',
//                'FieldName'=>'building',
//                'file_name'=>'BUILDING.TXT',
//            ),
//            array(
//                'ClassName'=>'ApiPostcode',
//                'FieldName'=>'postal_code',
//                'file_name'=>'POSTCODE.TXT',
//            ),
//            array(
//                'ClassName'=>'ApiStreets',
//                'FieldName'=>'streets',
//                'file_name'=>'STREETS.TXT',
//            ),
            array(
                'ClassName'=>'ApiWalkup',
                'FieldName'=>'walkup',
                'file_name'=>'WALKUP.TXT',
            ),
        ); // array name file to import
        foreach($aInfoImport as $item){
            $importFile = $root . "/". strtolower($item['file_name']) ;
            if (file_exists($importFile)){
                $aExists = array();
                $aNew = array();
                $aData = file($importFile, FILE_IGNORE_NEW_LINES);
                ApiPostcode::HandleImport($item['ClassName'], $item['FieldName'], $aData, $aExists, $aNew);
                ApiPostcode::InsertNewRecord($item['ClassName'], $item['FieldName'], $aNew);
            }
        }
//        ApiPostcode::HandleUpdateLonLatTableBuilding(); // only run from cron job
        $to = time();
        $second = $to-$from;
        echo ' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;
    }
    
    /**
     * @Author: ANH DUNG Mar 19, 2015
     * @Todo: Handle Import file, belong to actionImportApi
     * @Param: $ClassName name of model
     * @Param: $field_name field in db
     * @Param: $aData array data from file
     */
    public static function HandleImport($ClassName, $FieldName, $aData, &$aExists, &$aNew){
        foreach( $aData as $row ){
            $aNew[] = MyFormat::escapeValues($row);
        } // thêm mới toàn bộ
        echo "<hr>$ClassName Data: ".count($aData)." - Exists: ".count($aExists)." - New: ".count($aNew);
//        echo "<hr>$ClassName Data: ".count($aData)." - Exists: ".count($aExists)." - New: ".count($aNew)." - Detail: ".implode(",",$aNew);
    }
    
    /**
     * @Author: ANH DUNG Mar 04, 2015
     * @Todo: insert new record to db
     * @Param: $ClassName name of model
     * @Param: $field_name field in db
     * @Param: $aNew array data to insert new
     */
    public  static function InsertNewRecord($ClassName, $FieldName, $aNew) {
        $model_ = call_user_func(array($ClassName, 'model'));
        $tableName = $model_->tableName();
        Yii::app()->db->createCommand("truncate table $tableName")->query();
//        sleep(1);
        $aRowInsert=array();
        foreach ($aNew as $key=>$item) {
            $aRowInsert[]="( '$item' )";
        }
        
        $sql = "insert into $tableName (
                $FieldName
            ) values ".implode(',', $aRowInsert);
        if(count($aRowInsert)>0){
//            echo "<br> SQL: $sql <br>";
            Yii::app()->db->createCommand($sql)->execute();
        }
    }
    
    /********* Mar 04, 2015 ANH DUNG FOR IMPORT NEW DATA Postal Code *********/
    
}
