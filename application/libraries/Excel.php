<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 *  ======================================= 
 *  Author     : Muhammad Surya Ikhsanudin 
 *  License    : Protected 
 *  Email      : mutofiyah@gmail.com 
 *   
 *  Dilarang merubah, mengganti dan mendistribusikan 
 *  ulang tanpa sepengetahuan Author 
 *  ======================================= 
 */  
require_once APPPATH . "/third_party/PHPExcel.php"; 
 
class Excel extends PHPExcel {
    private $excel;
    public function __construct() { 
        parent::__construct();    
    }

    public function load($path) {
        return PHPExcel_IOFactory::createReader('Excel2007');
    }

    public function save($path,$obj) {
        // Write out as the new file
        $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
        $objWriter->save($path);
    }

    public function stream($filename,$obj) {
        $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
        ob_end_clean();
        header('Content-type: application/vnd.ms-excel');
        header("Content-Disposition: attachment; filename=".$filename.".xlsx"); 
       // header("Cache-control: private");        
        $objWriter->save('php://output');    
    }

    public function  __call($name, $arguments) {  
        // make sure our child object has this method  
        if(method_exists($this->excel, $name)) {  
            // forward the call to our child object  
            return call_user_func_array(array($this->excel, $name), $arguments);  
        }  
        return null;  
    }  
}

?>