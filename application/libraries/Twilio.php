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
require_once APPPATH . "/third_party/Twilio.php"; 
 
class Twilio {
    public function __construct() { 
           
    }
   public function getClass($sid, $token){
	return new Services_Twilio($sid, $token);	
	}
}

?>
