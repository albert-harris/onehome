<?php
class ExportExcel
{
     public static $replace = array("<br>","<BR>");
     public static $replaceNewLine = "\r\n";
     public static $remove = array( "&nbsp;", "<p>", "</p>", "<div>", "</div>","<b>","</b>");
    
    
    public static function ListingCompany(){
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("ANHDUNG")
                                        ->setLastModifiedBy("ANHDUNG")
                                        ->setTitle('Company Listing')
                                        ->setSubject("Office 2007 XLSX Document")
                                        ->setDescription("Company Listing")
                                        ->setKeywords("office 2007 openxml php")
                                        ->setCategory("Company Listing");
        $row=1;
        $i=1;
        $dataAll = $_SESSION['data-excel']->data;
        $company_listing_type = $_SESSION['data_excel_company_listing_type'];
        $HeadTitle = 'Immediate Listing';
        if($company_listing_type==Listing::COMPANY_FOLLOW_UP){
            $HeadTitle = 'Follow Up Listing';
        }
        $cmsFormatter = new CmsFormatter();	

        // 1.sheet 1 
        $objPHPExcel->setActiveSheetIndex(0);		
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);            
        $objPHPExcel->getActiveSheet()->setTitle('Company '.$HeadTitle); 
//            $objPHPExcel->getActiveSheet()->setCellValue("A$row", 'Client List');
//            $objPHPExcel->getActiveSheet()->getStyle("A$row")->getFont()
//                                ->setBold(true);    			
//            $objPHPExcel->getActiveSheet()->mergeCells("A$row:H$row");
//            $row++;
        $index=1;
        $beginBorder = $row;
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'SN');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Property Name Or Address');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Postal Code');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'District – location	');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Property Type');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Unit #');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'House/Blk No');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Building Name');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Listing Type');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Owner Name');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Contact No');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Email');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Dnc Expiry Date');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Floor Area');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", '# Of Bedrooms');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Storey');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Utility Room');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Price (S$)');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Built Up');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Tenure');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Availability');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Created By');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Last Modified Date');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Remark');
        
        $index--;

        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFormat::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFormat::columnName($index).$row)->getFont()
                            ->setBold(true);    	
        $row++;

        foreach($dataAll as $data):
            $index=1;
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $i);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $data->property_name_or_address);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $data->postal_code);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormatter->formatListingDistrict($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", Listing::getViewDetailPropertyType($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $data->unit_from." - $data->unit_to");
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $data->house_blk_no);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $data->building_name);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormatter->formatPropertyType($data->listing_type));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $data->company_owner_name);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $data->contact_name_no);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $data->company_email);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormatter->formatDate($data->dnc_expiry_date));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormatter->formatPrice($data->floor_area));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormatter->formatPrice($data->of_bedroom));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $data->company_storey);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $data->company_utility_room);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormatter->formatPrice($data->price));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $data->company_built_up);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $data->tenure);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $data->company_availability);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormatter->formatNameForAll($data->rUser));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormatter->formatDate($data->last_update_time));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $data->remark);
            
            $row++;
            $i++;
        endforeach;	// end body

        $objPHPExcel->getActiveSheet()->getStyle("B$beginBorder:".MyFormat::columnName($index).($row))
            ->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(20);

        $row--;		
        $index--;
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:A".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
        $objPHPExcel->getActiveSheet()->getStyle("H$beginBorder:H".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
        $objPHPExcel->getActiveSheet()->getStyle("J$beginBorder:J".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder".':'.MyFormat::columnName($index).($row))
                                            ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFormat::columnName($index).$row)
                        ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);		

        //save file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        for($level=ob_get_level();$level>0;--$level)
        {
                @ob_end_clean();
        }
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.'Company '.$HeadTitle.'.'.'xlsx'.'"');

        header('Cache-Control: max-age=0');				
        $objWriter->save('php://output');			
        Yii::app()->end();                
    }
    
    public static function ReportFinancial(){
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("ANHDUNG")
                                        ->setLastModifiedBy("ANHDUNG")
                                        ->setTitle('Report Financial')
                                        ->setSubject("Office 2007 XLSX Document")
                                        ->setDescription("Report Financial")
                                        ->setKeywords("office 2007 openxml php")
                                        ->setCategory("Report Financial");
        $row=1;
        $i=1;
//        $dataAll = $_SESSION['data-excel']->data;        
        $HeadTitle = 'Report Financial';
        $TOTAL_AMOUNT_INVOICE = isset($_SESSION['REPORT_DATA']['TOTAL_AMOUNT_INVOICE'])?$_SESSION['REPORT_DATA']['TOTAL_AMOUNT_INVOICE']:array();
        $TOTAL_AMOUNT_VOUCHER = isset($_SESSION['REPORT_DATA']['TOTAL_AMOUNT_VOUCHER'])?$_SESSION['REPORT_DATA']['TOTAL_AMOUNT_VOUCHER']:array();
        $COUNT_TRANS = isset($_SESSION['REPORT_DATA']['COUNT_TRANS'])?$_SESSION['REPORT_DATA']['COUNT_TRANS']:array();
        $LOOP_VAR = isset($_SESSION['REPORT_DATA']['LOOP_VAR'])?$_SESSION['REPORT_DATA']['LOOP_VAR']:array();
        $total_trans = 0;
        $total_revenue = 0;
        $cmsFormater = new CmsFormatter();
        $REPORT_TYPE = $_SESSION['REPORT_TYPE'];

        // 1.sheet 1 
        $objPHPExcel->setActiveSheetIndex(0);		
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);            
        $objPHPExcel->getActiveSheet()->setTitle($HeadTitle); 
            $objPHPExcel->getActiveSheet()->setCellValue("A$row", FiInvoice::$STA_REPORT_TYPE[$REPORT_TYPE]);
            $objPHPExcel->getActiveSheet()->getStyle("A$row")->getFont()
                                ->setBold(true);    			
            $objPHPExcel->getActiveSheet()->mergeCells("A$row:c$row");
            $row++;
        $index=1;
        $beginBorder = $row;      
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Date');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Number of Transactions');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Revenue');
        $index--;
        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFormat::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFormat::columnName($index).$row)->getFont()
                            ->setBold(true);    	
        $row++;
        
        if($REPORT_TYPE == FiInvoice::REPORT_DAILY):
            foreach($LOOP_VAR as $value):
                $amount_invoice = isset($TOTAL_AMOUNT_INVOICE[$value])?$TOTAL_AMOUNT_INVOICE[$value]:0;
                $amount_voucher = isset($TOTAL_AMOUNT_VOUCHER[$value])?$TOTAL_AMOUNT_VOUCHER[$value]:0;
                $revenue = $amount_invoice-$amount_voucher;                
                $total_trans+= ( isset($COUNT_TRANS[$value])?$COUNT_TRANS[$value]:0 );
                $total_revenue += $revenue;
                if($revenue!=0 || $amount_invoice!=0 || $amount_voucher!=0):
                    $index=1;
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", MyFormat::dateConverYmdToDmy($value, "d/m/Y"));
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $COUNT_TRANS[$value]);
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", MyFormat::formatPrice($revenue));            
                    $row++;
                    $i++;
                endif;
            endforeach;	// end foreach($LOOP_VAR
        elseif($REPORT_TYPE == FiInvoice::REPORT_MONTHLY) :
            foreach($LOOP_VAR as $year=>$arrMonth):
                foreach($arrMonth as $month=>$temp):
                    
                    $amount_invoice = isset($TOTAL_AMOUNT_INVOICE[$year][$month])?$TOTAL_AMOUNT_INVOICE[$year][$month]:0;
                    $amount_voucher = isset($TOTAL_AMOUNT_VOUCHER[$year][$month])?$TOTAL_AMOUNT_VOUCHER[$year][$month]:0;
                    $revenue = $amount_invoice-$amount_voucher;                    
                    $total_trans+= ( isset($COUNT_TRANS[$year][$month])?$COUNT_TRANS[$year][$month]:0 );
                    $total_revenue += $revenue;
                    if($revenue!=0 || $amount_invoice!=0 || $amount_voucher!=0):
                        $index=1;
                        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", "$month/$year");
                        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $COUNT_TRANS[$year][$month]);
                        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", MyFormat::formatPrice($revenue));            
                        $row++;
                        $i++;
                    endif;
                endforeach; // foreach($arrMonth as $month=>$temp):
            endforeach;	// end foreach($LOOP_VAR
        elseif($REPORT_TYPE == FiInvoice::REPORT_YEARLY) :
            foreach($LOOP_VAR as $year=>$tmp):                        
                $amount_invoice = isset($TOTAL_AMOUNT_INVOICE[$year])?$TOTAL_AMOUNT_INVOICE[$year]:0;
                $amount_voucher = isset($TOTAL_AMOUNT_VOUCHER[$year])?$TOTAL_AMOUNT_VOUCHER[$year]:0;
                $revenue = $amount_invoice-$amount_voucher;                
                $total_trans+= ( isset($COUNT_TRANS[$year])?$COUNT_TRANS[$year]:0 );
                $total_revenue += $revenue;
                if($revenue!=0 || $amount_invoice!=0 || $amount_voucher!=0):
                    $index=1;
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $year);
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $COUNT_TRANS[$year]);
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", MyFormat::formatPrice($revenue));            
                    $row++;
                    $i++;
                endif;
            endforeach;	// end foreach($LOOP_VAR        
        endif;                        

//        $objPHPExcel->getActiveSheet()->getStyle("B$beginBorder:".MyFormat::columnName($index).($row))
//            ->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        
        $row--;		
        $index--;
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:A".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
        $objPHPExcel->getActiveSheet()->getStyle("B$beginBorder:B".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		
        $objPHPExcel->getActiveSheet()->getStyle("C$beginBorder:C".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder".':'.MyFormat::columnName($index).($row))
                                            ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFormat::columnName($index).$row)
                        ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);		

        //save file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        for($level=ob_get_level();$level>0;--$level)
        {
                @ob_end_clean();
        }
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.'Report Financial.'.'xlsx'.'"');

        header('Cache-Control: max-age=0');				
        $objWriter->save('php://output');			
        Yii::app()->end();                
    }
    
    public static function ReportTrans(){
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("ANHDUNG")
                                        ->setLastModifiedBy("ANHDUNG")
                                        ->setTitle('Report Financial')
                                        ->setSubject("Office 2007 XLSX Document")
                                        ->setDescription("Report Transaction")
                                        ->setKeywords("office 2007 openxml php")
                                        ->setCategory("Report Transaction");
        $row=1;
        $i=1;
//        $dataAll = $_SESSION['data-excel']->data;        
        $HeadTitle = 'Report Transaction';
        $TOTAL_AMOUNT_INVOICE = isset($_SESSION['REPORT_TRANSACTION']['TOTAL_AMOUNT_INVOICE'])?$_SESSION['REPORT_TRANSACTION']['TOTAL_AMOUNT_INVOICE']:array();
        $TOTAL_AMOUNT_VOUCHER = isset($_SESSION['REPORT_TRANSACTION']['TOTAL_AMOUNT_VOUCHER'])?$_SESSION['REPORT_TRANSACTION']['TOTAL_AMOUNT_VOUCHER']:array();
        $COUNT_TRANS = isset($_SESSION['REPORT_TRANSACTION']['COUNT_TRANS'])?$_SESSION['REPORT_TRANSACTION']['COUNT_TRANS']:array();
        $LOOP_VAR = isset($_SESSION['REPORT_TRANSACTION']['LOOP_VAR'])?$_SESSION['REPORT_TRANSACTION']['LOOP_VAR']:array();
        $total_trans = 0;
        $total_revenue = 0;
        $cmsFormater = new CmsFormatter();
        $REPORT_TYPE = $_SESSION['REPORT_TYPE'];

        // 1.sheet 1 
        $objPHPExcel->setActiveSheetIndex(0);		
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);            
        $objPHPExcel->getActiveSheet()->setTitle($HeadTitle); 
            $objPHPExcel->getActiveSheet()->setCellValue("A$row", FiInvoice::$STA_REPORT_TYPE[$REPORT_TYPE]);
            $objPHPExcel->getActiveSheet()->getStyle("A$row")->getFont()
                                ->setBold(true);    			
            $objPHPExcel->getActiveSheet()->mergeCells("A$row:c$row");
            $row++;
        $index=1;
        $beginBorder = $row;      
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Date');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Number of Transactions');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Revenue');
        $index--;
        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFormat::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFormat::columnName($index).$row)->getFont()
                            ->setBold(true);    	
        $row++;
        
        if($REPORT_TYPE == FiInvoice::REPORT_DAILY):
            foreach($LOOP_VAR as $value):
                $amount_invoice = isset($TOTAL_AMOUNT_INVOICE[$value])?$TOTAL_AMOUNT_INVOICE[$value]:0;
                $amount_voucher = isset($TOTAL_AMOUNT_VOUCHER[$value])?$TOTAL_AMOUNT_VOUCHER[$value]:0;
                $revenue = $amount_invoice-$amount_voucher;                
                $total_trans+= ( isset($COUNT_TRANS[$value])?$COUNT_TRANS[$value]:0 );
                $total_revenue += $revenue;
                if($revenue!=0 || $amount_invoice!=0 || $amount_voucher!=0):
                    $index=1;
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", MyFormat::dateConverYmdToDmy($value, "d/m/Y"));
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $COUNT_TRANS[$value]);
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", MyFormat::formatPrice($revenue));            
                    $row++;
                    $i++;
                endif;
            endforeach;	// end foreach($LOOP_VAR
        elseif($REPORT_TYPE == FiInvoice::REPORT_MONTHLY) :
            foreach($LOOP_VAR as $year=>$arrMonth):
                foreach($arrMonth as $month=>$temp):
                    
                    $amount_invoice = isset($TOTAL_AMOUNT_INVOICE[$year][$month])?$TOTAL_AMOUNT_INVOICE[$year][$month]:0;
                    $amount_voucher = isset($TOTAL_AMOUNT_VOUCHER[$year][$month])?$TOTAL_AMOUNT_VOUCHER[$year][$month]:0;
                    $revenue = $amount_invoice-$amount_voucher;                    
                    $total_trans+= ( isset($COUNT_TRANS[$year][$month])?$COUNT_TRANS[$year][$month]:0 );
                    $total_revenue += $revenue;
                    if($revenue!=0 || $amount_invoice!=0 || $amount_voucher!=0):
                        $index=1;
                        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", "$month/$year");
                        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $COUNT_TRANS[$year][$month]);
                        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", MyFormat::formatPrice($revenue));            
                        $row++;
                        $i++;
                    endif;
                endforeach; // foreach($arrMonth as $month=>$temp):
            endforeach;	// end foreach($LOOP_VAR
        elseif($REPORT_TYPE == FiInvoice::REPORT_YEARLY) :
            foreach($LOOP_VAR as $year=>$tmp):                        
                $amount_invoice = isset($TOTAL_AMOUNT_INVOICE[$year])?$TOTAL_AMOUNT_INVOICE[$year]:0;
                $amount_voucher = isset($TOTAL_AMOUNT_VOUCHER[$year])?$TOTAL_AMOUNT_VOUCHER[$year]:0;
                $revenue = $amount_invoice-$amount_voucher;
                $total_trans+= ( isset($COUNT_TRANS[$year])?$COUNT_TRANS[$year]:0 );
                $total_revenue += $revenue;
                if($revenue!=0 || $amount_invoice!=0 || $amount_voucher!=0):
                    $index=1;
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $year);
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $COUNT_TRANS[$year]);
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", MyFormat::formatPrice($revenue));            
                    $row++;
                    $i++;
                endif;
            endforeach;	// end foreach($LOOP_VAR        
        endif;                        

//        $objPHPExcel->getActiveSheet()->getStyle("B$beginBorder:".MyFormat::columnName($index).($row))
//            ->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        
        $row--;		
        $index--;
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:A".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
        $objPHPExcel->getActiveSheet()->getStyle("B$beginBorder:B".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		
        $objPHPExcel->getActiveSheet()->getStyle("C$beginBorder:C".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder".':'.MyFormat::columnName($index).($row))
                                            ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFormat::columnName($index).$row)
                        ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);		

        //save file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        for($level=ob_get_level();$level>0;--$level)
        {
                @ob_end_clean();
        }
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.'Report Transaction.'.'xlsx'.'"');

        header('Cache-Control: max-age=0');				
        $objWriter->save('php://output');			
        Yii::app()->end();                
    }
    
    /**
     * @Author: ANH DUNG Sep 21, 2014
     * @Todo: Export summary report
     */
    public static function SummaryReport(){
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("ANHDUNG")
                                        ->setLastModifiedBy("ANHDUNG")
                                        ->setTitle('Report Financial')
                                        ->setSubject("Office 2007 XLSX Document")
                                        ->setDescription("Summary Report Transaction")
                                        ->setKeywords("office 2007 openxml php")
                                        ->setCategory("Report Transaction");
        $row=1;
        $i=1;        
        $HeadTitle = 'Summary Report Transaction';
        
        $cmsFormater = new CmsFormatter();
        // 1.sheet 1 
        $objPHPExcel->setActiveSheetIndex(0);		
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);            
        $objPHPExcel->getActiveSheet()->setTitle($HeadTitle); 
            $objPHPExcel->getActiveSheet()->setCellValue("A$row", "Summary Report Transaction");
            $objPHPExcel->getActiveSheet()->getStyle("A$row")->getFont()
                                ->setBold(true);    			
            $objPHPExcel->getActiveSheet()->mergeCells("A$row:c$row");
            $row++;
        $index=1;
        $beginBorder = $row;      
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'S/N');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Invoice No');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Submitted Date');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Listing Type');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Property Address');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Type');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Price');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Client Commission');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Receivable Commission Amount');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Received Commission Amount');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Received Date');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Commission Receivable from External Cobroke agent');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Commission payable to  External Cobroke agent');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'External Coboke agent company');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'External Coboke agent name');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Paid date');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Gross Commission to Company');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Salesperson Name');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Commission Payable to Salesperson');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", '1st Tier Manager  Name');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Overriding to 1st Tier Manager');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", '2nd Tier Manager  Name');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Overriding to 2nd Tier Manager');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", "Telemarketer's Name");
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Commission Payable to Telemarketer');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Net Commission Earned by Company');
        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(40);
        $index--;
        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFormat::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFormat::columnName($index).$row)->getFont()
                            ->setBold(true);    	
        $row++;
        foreach($_SESSION['DATA_SUMMARY_REPORT']->data as $data){
            $index=1;
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $i);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReportInvoiceNo($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatdate($data->created_date));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatTransListingType($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatTransactionPropertyName($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatPropertyType($data->type));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatTransactionPropertyPrice($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReportClientCom($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReportReceivableCommissionAmount($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReportReceivedCommissionAmount($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReportReceivedDate($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReportComExternalCobrokeAgent($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReportComPayableExternalCobrokeAgent($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReportExternalCobrokeAgentCompany($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReportExternalCobrokeAgentName($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReportDatePaidExernalCobroke($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReportGrossCommissiontoCompany($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReportSalespersonName($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReportCommissionPayabletoSalesperson($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReport1stTierName($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReport1stTierOverriding($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReport2ndTierName($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReport2ndTierOverriding($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReportTelemarketerName($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReportTelemarketerComm($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $cmsFormater->formatSumReportNetCommissionEarnedbyCompany($data));
//            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'TEST VALUE');
            
            $row++;
            $i++;
        }

        $objPHPExcel->getActiveSheet()->getStyle("B$beginBorder:".MyFormat::columnName($index).($row))
            ->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(30);        
        
        $row--;		
        $index--;
        $objPHPExcel->getActiveSheet()->getStyle("G$beginBorder:G".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("H$beginBorder:H".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("I$beginBorder:I".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("K$beginBorder:K".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("L$beginBorder:L".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("M$beginBorder:M".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("Q$beginBorder:Q".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("S$beginBorder:S".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("U$beginBorder:U".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("W$beginBorder:W".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("Z$beginBorder:Z".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder".':'.MyFormat::columnName($index).($row))
                                            ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFormat::columnName($index).$row)
                        ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);		

        //save file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        for($level=ob_get_level();$level>0;--$level)
        {
                @ob_end_clean();
        }
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.'Summary Report Transaction.'.'xlsx'.'"');

        header('Cache-Control: max-age=0');				
        $objWriter->save('php://output');			
        Yii::app()->end();                
    }
    
}
?>