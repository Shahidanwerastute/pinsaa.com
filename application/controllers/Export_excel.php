<?php
defined('BASEPATH') or exit('No direct script access allowed');

include 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export_excel extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        $fileName = 'user.xlsx';
        $employeeData = $this->User_model->get_all();


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'First Name');
        $sheet->setCellValue('C1', 'Last Name');
        $sheet->setCellValue('D1', 'Email');
        $sheet->setCellValue('E1', 'Mobile');
        $sheet->setCellValue('F1', 'Status');
        $sheet->setCellValue('G1', 'Created At');
        $sheet->setCellValue('H1', 'Updated At');
        $rows = 2;
        foreach ($employeeData as $val) {
            $sheet->setCellValue('A' . $rows, $val->id);
            $sheet->setCellValue('B' . $rows, $val->first_name);
            $sheet->setCellValue('C' . $rows, $val->last_name);
            $sheet->setCellValue('D' . $rows, $val->email);
            $sheet->setCellValue('E' . $rows, $val->mobile);
            $sheet->setCellValue('F' . $rows, $val->status);
            $sheet->setCellValue('G' . $rows, $val->created_at);
            $sheet->setCellValue('H' . $rows, $val->updated_at);
            $rows++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save("uploads/" . $fileName);

        $attachment = FCPATH . "uploads/" . $fileName;

        send_mail('Users Excel Export', 'Users Excel Export', 'darwish.moh@gmail.com', false, $attachment);

        send_mail('Users Excel Export', 'Users Excel Export', 'pinsaarabia@gmail.com', false, $attachment);

        send_mail('Users Excel Export', 'Users Excel Export', 'bilal_ejaz@astutesol.com', false, $attachment);

        unlink(realpath("uploads/user.xlsx"));

        //unlink($attachment);

        echo 'Email sent with attachment';

    }


}