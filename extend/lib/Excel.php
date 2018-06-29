<?php
    /**
     *  Author : Luo
     *  Encoding : UTF-8
     *  Separator : Unix and OS X (\n)
     *  File Name : Excel.php
     *  Create Date : 2017/7/8 11:05
     *  Version : 0.1
     *  Email Address : Luo@126.com
     */

    namespace lib;
    use think\Log;

    class Excel {
        protected $root;
        protected $rootFile;
        protected $Excel;

        public function __construct() {
            $this->root     = EXTEND_PATH . '/lib/PHPExcel/Classes/';
            $this->rootFile = $this->root . 'PHPExcel.php';
            if (is_file($this->rootFile)) {
                require_once $this->rootFile;
            }
            try {
                $this->Excel = new \PHPExcel();
            } catch (\Exception $e) {
                $e->getMessage();
            }
        }

        /**
         * @param        $fileName
         * @param array  $fileHead
         * @param array  $data
         * @param array  $letter
         * @param string $textNode
         * @throws \PHPExcel_Exception
         * @throws \PHPExcel_Writer_Exception
         */
        public function downExcel($fileName, $fileHead = [], $data = [], $letter = [], $textNode = '') {
            $this->Excel->getActiveSheet()->getStyle($textNode)->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
            $this->Excel->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            $this->Excel->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            $this->Excel->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
            $this->Excel->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER_000);
            $this->Excel->getActiveSheet()->getStyle('I')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            $this->Excel->getActiveSheet()->getStyle('H')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            $this->Excel->getActiveSheet()->getStyle('A')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
            $this->Excel->getActiveSheet()->getStyle($textNode)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
            $this->Excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('F')->setWidth(85);
            $this->Excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
            //填充表头信息
            for ($i = 0; $i < count($fileHead); $i++) {
                $this->Excel->getActiveSheet()->setCellValue("$letter[$i]1", "$fileHead[$i]");
            }
            //表格数组
            //填充表格信息
            for ($i = 2; $i <= count($data) + 1; $i++) {
                $j = 0;
                foreach ($data[$i - 2] as $key => $value) {
                    $this->Excel->getActiveSheet()->setCellValue("$letter[$j]$i", "$value");
                    $j++;
                }
            }

            //创建Excel输入对象
            ob_end_clean();//清除缓冲区,避免乱码
            $write = new \PHPExcel_Writer_Excel5($this->Excel);
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
            header("Content-Type:application/force-download");
            header("Content-Type:application/vnd.ms-execl");
            header("Content-Type:application/octet-stream");
            header("Content-Type:application/download");;
            header('Content-Disposition:attachment;filename=' . $fileName);
            header("Content-Transfer-Encoding:binary");
            $write->save('php://output');
        }

       /* public function memberExcel($fileName, $fileHead = [], $data = [], $letter = [], $textNode = '') {
            $this->Excel->getActiveSheet()->getStyle($textNode)->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
            $this->Excel->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
            $this->Excel->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
            $this->Excel->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            $this->Excel->getActiveSheet()->getStyle('A')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
            $this->Excel->getActiveSheet()->getStyle($textNode)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
            $this->Excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
            //填充表头信息
            for ($i = 0; $i < count($fileHead); $i++) {
                $this->Excel->getActiveSheet()->setCellValue("$letter[$i]1", "$fileHead[$i]");
            }
            //表格数组
            //写入下层人员
            for ($i = 2; $i <= count($data) + 1; $i++) {
                $j = 0;
                $level = 0;
                foreach ($data[$i - 2] as $key => $value) {
                    if($j === 5){
                        $level = $value - 1;
                        Log::write($level,'notice');
                    }
                    if($j === 9){
                        $j = $j + $level;
                    }
                    $this->Excel->getActiveSheet()->setCellValue("$letter[$j]$i", "$value");
                    $j++;
                }
            }
            //创建Excel输入对象
            ob_end_clean();//清除缓冲区,避免乱码
            $write = new \PHPExcel_Writer_Excel5($this->Excel);
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
            header("Content-Type:application/force-download");
            header("Content-Type:application/vnd.ms-execl");
            header("Content-Type:application/octet-stream");
            header("Content-Type:application/download");;
            header('Content-Disposition:attachment;filename=' . $fileName);
            header("Content-Transfer-Encoding:binary");
            $write->save('php://output');
        }*/
        /**
         * 导出会员列表
         * @param        $fileName
         * @param array  $fileHead
         * @param array  $data
         * @param array  $letter
         * @param string $textNode
         * @throws \PHPExcel_Exception
         * @throws \PHPExcel_Writer_Exception
         */
        public function memberExcel($fileName, $fileHead = [], $data = [], $letter = [], $textNode = '') {
            //$this->Excel->getActiveSheet()->getStyle($textNode)->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
            $this->Excel->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            $this->Excel->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            $this->Excel->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            $this->Excel->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            //$this->Excel->getActiveSheet()->getStyle($textNode)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
            $this->Excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
            $this->Excel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
            //填充表头信息
            for ($i = 0; $i < count($fileHead); $i++) {
                $this->Excel->getActiveSheet()->setCellValue("$letter[$i]1", "$fileHead[$i]");
            }
            //表格数组
            //写入下层人员
            for ($i = 2; $i <= count($data) + 1; $i++) {
                $j = 0;
                $level = 0;
                foreach ($data[$i - 2] as $key => $value) {
                    if($j === 8){
                        if($value !== 0){
                            $level = $value;
                        }
                    }
                    if($j === 9){
                        $j = intval($j + $level);
                        //Log::write($j,'notice');
                    }
                    $this->Excel->getActiveSheet()->setCellValue("$letter[$j]$i", "$value");
                    $j++;
                }
            }
            //创建Excel输入对象
            ob_end_clean();//清除缓冲区,避免乱码
            $write = new \PHPExcel_Writer_Excel5($this->Excel);
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
            header("Content-Type:application/force-download");
            header("Content-Type:application/vnd.ms-execl");
            header("Content-Type:application/octet-stream");
            header("Content-Type:application/download");;
            header('Content-Disposition:attachment;filename=' . $fileName);
            header("Content-Transfer-Encoding:binary");
            $write->save('php://output');
        }

        public function setCellChild($child, $row) {
            if (!is_array($child) && count($child) < 1) {
                return $row;
            }
        }
    }