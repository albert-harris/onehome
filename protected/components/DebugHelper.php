<?php
/**
 * bb
 */
class DebugHelper
{
        public static function getSql($criteria, $modelName, $tableAlias='t')
        {
          $tableName =  $modelName::model()->tableName();
          $schema = Yii::app()->db->schema;
          $cbuilder = new CDbCommandBuilder($schema);
          $sqlCommand = $cbuilder->createFindCommand($tableName, $criteria, $tableAlias);
          $sql = $sqlCommand->text;    

          foreach(array_reverse($criteria->params) as $key=>$value)
          {
              if(is_string($value))
                $sql = str_replace($key, "'" .addslashes($value) . "'", $sql);
              else
                $sql = str_replace($key, addslashes($value), $sql);  
          }
//          return $sql;
            echo '<pre>';
            print_r($sql);
            echo '<pre>';
            exit;
        }
  }
  ?>
