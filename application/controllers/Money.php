<?php
/**
 * 
 */

class Money extends Pageparent_Controller
{
	
	public function __construct() {
       parent::__construct();
    }

    function index()
    {
    	$this->load->helper('url');
    	$data['pageName'] = 'money';
    	$data['pageMoneyStudent'] = site_url("Money/moneyStudent");   
    	$this->load->view("quanlytrungtam/layout",$data);
    }

    function moneyStudent()
    {
    	$this->load->helper('url');
    	$data['pageName'] = 'moneystudent';
    	$data['ajaxDetailPayment'] = site_url("Money/ajaxDetailPayment");
    	$data['ajaxPayment'] = site_url("Money/ajaxPayment");
    	$data['pageMoneyStudent'] = site_url("Money/moneyStudent");
        $data['dbClass'] = $this->quanlytrungtam_model->GetDBTable('class');
        //$data['exportExcel'] = site_url("Money/action");
        $data['exportExcel'] = site_url("Money/TemplateReportReceipt");
    	$this->load->model("quanlytrungtam_model");
    	$data['dbExtend'] = $this->quanlytrungtam_model->getDBJoin_STUDENT_CLASS_EXTENTD();
    	$this->load->view("quanlytrungtam/layout",$data);
    }

    function ajaxDetailPayment()
    {
    	$student_identitycard = (int)$_POST['studentIdentitycard'];
        $class_id = (int)$_POST['schedule_class'];
        $level_id = (int)$_POST['level_id'];
    	$this->load->model("quanlytrungtam_model");
    	$dbExtend = $this->quanlytrungtam_model->getDB_STUDENT_CLASS_EXTENTD_BY_INDENTITYCARD($student_identitycard,$class_id,$level_id);
    	$ketquaAjax = array(
    		'ketqua' => $dbExtend
    	);
    	echo json_encode($ketquaAjax);
    } 

    function ajaxPayment()
    {
    	$class_student_id = (int)$_POST['class_student_id'];
    	$precent_debt = $_POST['precentDebt'];
    	$precent_payment = $_POST['precentPayment'];
    	$updateMoney = $precent_debt + $precent_payment;
    	$table = 'extend_class_student';
    	$idTable = 'extend_id';
    	$dataUpdate = array(
    		'precent_debt' => (int)$updateMoney
    	);
    	$this->load->model("quanlytrungtam_model");
    	$affected_rows=$this->quanlytrungtam_model->updateDB($dataUpdate,$class_student_id,$table,$idTable);
    	$ketquaAjax =array(
			'ketqua' => 1
		);
		echo json_encode($ketquaAjax);
    }


    // TEST EXCEL
    function action()
    {

        $this->load->library("Excel");
        $objPHPExcel = new PHPExcel();
        // $tmpfname = "example.xls";
        // $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
        // $objPHPExcel = $excelReader->load($tmpfname);
        // // ------Hide F and G column
        // $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setVisible(false);
        // $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setVisible(false);
        // ------Set Font Color, Font Style and Font Alignment
        $stil=array(
            'borders' => array(
              'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('rgb' => '000000')
              )
            ),
            'alignment' => array(
              'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('J10:P13')->applyFromArray($stil);

        // Merge Cells
        $objPHPExcel->getActiveSheet()->mergeCells('J10:P13');
        $objPHPExcel->getActiveSheet()->setCellValue('J10', "MERGED CELL");
        $objPHPExcel->getActiveSheet()->getStyle('J10:P13')->applyFromArray($stil);
        // //-------Set document properties
        // $objPHPExcel->getProperties()->setCreator("Furkan Kahveci")
        //                      ->setLastModifiedBy("Furkan Kahveci")
        //                      ->setTitle("Office 2007 XLS Test Document")
        //                      ->setSubject("Office 2007 XLS Test Document")
        //                      ->setDescription("Description for Test Document")
        //                      ->setKeywords("phpexcel office codeigniter php")
        //                      ->setCategory("Test result file");

        // Create a first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "TÊN HỌC VIÊN");
        $objPHPExcel->getActiveSheet()->setCellValue('B1', "CMND");
        $objPHPExcel->getActiveSheet()->setCellValue('C1', "LỚP");
        $objPHPExcel->getActiveSheet()->setCellValue('D1', "TIỀN HỌC PHÍ");
        $objPHPExcel->getActiveSheet()->setCellValue('E1', "TIỀN NỢ");

        

        // Set auto size
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

        // Add data
        $dbExtend = $this->quanlytrungtam_model->getDBJoin_STUDENT_CLASS_EXTENTD();
        $excel_row = 2;
        foreach ($dbExtend as $key => $value) {
            $money = $value['course_price']*$value['precent_debt']/100;
            $money_debt = $value['course_price']-$money;
            $student_name = $value['student_name'];
            $student_identitycard = $value['student_identitycard'];
            $class_name = $value['class_name'];
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 0 , $excel_row, $student_name);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 1 , $excel_row, $student_identitycard);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 2 , $excel_row, $class_name);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 3 , $excel_row, $money);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 4 , $excel_row, $money_debt);
            $excel_row++;
        }
        // ------Save Excel xls File
        $filename="export-listmoneystudent.xls";
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$filename);
        $objWriter->save('php://output');
        $ketquaAjax = array(
            'ketqua' => 1
        );
        echo json_encode($ketquaAjax);
    }

    function TemplateReportReceipt()
    {
        $this->load->library("Excel");
        $objPHPExcel = new PHPExcel();
        // Set Fontsize
        $style=array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                ),
            );
        $style2=array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                ),
            );
        $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($style2);
        $objPHPExcel->getActiveSheet()->getStyle('A2:B2')->applyFromArray($style2);
        $objPHPExcel->getActiveSheet()->getStyle('A11:A12')->applyFromArray($style2);
        $objPHPExcel->getActiveSheet()->getStyle('A13:A14')->applyFromArray($style2);
        $objPHPExcel->getActiveSheet()->getStyle('E1:I1')->applyFromArray($style);
        $objPHPExcel->getActiveSheet()->getStyle('E2:I2')->applyFromArray($style);
        $objPHPExcel->getActiveSheet()->getStyle('E3:I3')->applyFromArray($style);
        $objPHPExcel->getActiveSheet()->getStyle('C6:F7')->applyFromArray($style);
        $objPHPExcel->getActiveSheet()->getStyle('C8:F8')->applyFromArray($style);

        //Set Size
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);

        // Set template CENTER 
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "ĐƠN VỊ");
        $objPHPExcel->getActiveSheet()->setCellValue('B1', "TRUNG TÂM TIN HỌC");
        $objPHPExcel->getActiveSheet()->setCellValue('A2', "ĐỊA CHỈ");
        $objPHPExcel->getActiveSheet()->setCellValue('B2', "49 Tăng nhơn phú, Quận 9");
        // Set template Nghị Định
        $objPHPExcel->getActiveSheet()->mergeCells('E1:I1');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', "Mẫu số 06 - TT");
        $objPHPExcel->getActiveSheet()->mergeCells('E2:I2');
        $objPHPExcel->getActiveSheet()->setCellValue('E2', "(Ban hành theo Thông tư số 133/2016/TT-BTC");
        $objPHPExcel->getActiveSheet()->mergeCells('E3:I3');
        $objPHPExcel->getActiveSheet()->setCellValue('E3', "Ngày 26/8/2016 của Bộ Tài chính)");


        // Set template Tiêu Đề
        $objPHPExcel->getActiveSheet()->mergeCells('C6:F7');
        $objPHPExcel->getActiveSheet()->setCellValue('C6', "BIÊN LAI THU TIỀN");

        // Set template Ngày Tháng Năm
        $objPHPExcel->getActiveSheet()->mergeCells('C8:F8');
        $objPHPExcel->getActiveSheet()->setCellValue('C8', "Ngày... Tháng... Năm...");

        // Set template CENTER 
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A11', "Họ Và Tên");
        $objPHPExcel->getActiveSheet()->setCellValue('A12', "Địa Chỉ");
        $objPHPExcel->getActiveSheet()->setCellValue('A13', "Số Tiền Đóng");
        $objPHPExcel->getActiveSheet()->setCellValue('A14', "Bằng Chữ");
            
        // ------Save Excel xls File
        $filename="Report-Receipt.xls";
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$filename);
        $objWriter->save('php://output');
    }
}

