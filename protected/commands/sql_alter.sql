/**
    ANH DUNG ADD Oct 24, 2014    
*/
/* 1. */
********* Oct 24 2014 **********
ALTER TABLE  `pro_fi_payment_voucher` ADD  `payment_mode` TINYINT( 1 ) NOT NULL AFTER  `total_amount` ;
ALTER TABLE  `pro_fi_payment_voucher` ADD  `cheque_number` VARCHAR( 100 ) NOT NULL AFTER  `payment_mode` ;
ALTER TABLE  `pro_fi_payment_voucher` CHANGE  `payment_mode`  `payment_mode` TINYINT( 1 ) NOT NULL COMMENT  '1: Cash, 2: Cheque',
CHANGE  `cheque_number`  `cheque_number` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ;
********* Oct 24 2014 **********

********* Oct 27 2014 **********
ALTER TABLE  `pro_listing` ADD  `property_house_blk_no` VARCHAR( 100 ) NOT NULL ;
ALTER TABLE  `pro_listing` ADD  `property_street_name` VARCHAR( 100 ) NOT NULL ;
********* Oct 27 2014 **********

********* Oct 31 2014 **********
ALTER TABLE  `pro_fi_invoice` ADD  `payment_mode` TINYINT( 1 ) NOT NULL ,
ADD  `cheque_number` VARCHAR( 100 ) NOT NULL ;
ALTER TABLE  `pro_pro_report_defect` ADD  `location_text` VARCHAR( 200 ) NOT NULL AFTER  `location_id` ;
ALTER TABLE  `pro_pro_aircon_service` ADD  `remark` TEXT NOT NULL ;

1/ phan quyen cho admin vs telemarketer phan airconService trong Admin
********* Oct 31 2014 **********

********* Now 28 2014 **********
ALTER TABLE  `pro_pro_transactions` ADD  `add_property` TINYINT( 1 ) NOT NULL DEFAULT  '1' COMMENT  '1: existing, 2: Unlisted' AFTER  `id`
ALTER TABLE  `pro_pro_transactions_property_detail` ADD  `property_name_or_address` VARCHAR( 350 ) NULL ;
ALTER TABLE  `pro_pro_transactions_property_detail` ADD  `listing_id` BIGINT( 11 ) UNSIGNED NULL AFTER  `id` ;

********* Now 28 2014 **********

