<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jsonclass {

	/*
	*	how to use
	*   ========================================================
	*   --------load the lirbrary -------- 
	*	$this->load->library('jsonclass'); 
    *   -------call do_json function ---------
    *   $this->jsonclass->do_json($OfficerData,'purchase_officer');
	*
	*  	how to read 
	*   =========================================================
	*	if(file_exists("assets/data/json/purchase_officer.json")):
	*	$string = file_get_contents("assets/data/json/purchase_officer.json");
	*	$json = json_decode($string, true);
	*	
	*	foreach ($json as $key => $value) {
	*	if (!is_array($value)) {
	*	echo $key . '=>' . $value . '<br />';
	*	} else {
	*	foreach ($value as $key => $val) {
	*	echo $key . '=>' . $val . '<br />';
	*	}
	*	}
	*	}
	*	endif;
	*/ 
	
  	public function do_json($data = NULL,$filename = NULL){
 		$json_string = json_encode($data);
		$file = "assets/data/json/$filename.json";
		@unlink($file);
		file_put_contents($file, $json_string);
 	}

}
 