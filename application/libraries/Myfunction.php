<?php

    class Myfunction
    {
        //protected $class;
	function __construct()
	{
		log_message('debug', "MY_excel_lib Class Initialized");
                
	}
	public  function wordlimit($string, $length, $ellipsis = "...")
      {
	  $words = explode(',', $string);
	  if (count($words) > $length)
	  {
		  return implode(',', array_slice($words, 0, $length)) ." ". $ellipsis;
	  }
	  else
	  {
		  return $string;
	  }
      }
	public function porcentaje($fallidos, $total){
		    $var = ($fallidos * 100);
		    if($var > 0){
			    return $var / $total;
		    }
			    return 100;
		    
    }
	function orderMultiDimensionalArray ($toOrderArray, $field, $inverse = false) {  
		$position = array();  
		$newRow = array();  
		foreach ($toOrderArray as $key => $row) {  
			$position[$key]  = $row[$field];  
			$newRow[$key] = $row;  
		}  
		if ($inverse) {  
		    arsort($position);  
		}  
		else {  
		    asort($position);  
		}  
		$returnArray = array();  
		foreach ($position as $key => $pos) {       
		    $returnArray[] = $newRow[$key];  
		}  
		return $returnArray;  
	    }
	 function validacionTel($tel){
		    $tel = (integer)$tel;
		    if($tel >= 40000000 && $tel <= 40009999){
			return false;
		    }else{
			return true;
		    }
	 
	 }
	
    }


?>
