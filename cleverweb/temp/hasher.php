<?php

function smart_hasher($data,$salt=FALSE,$encdata=FALSE) {
  //if encrypted data is passed, check it against input ($info)
	//if salt is passed use it instead
  if($encdata){
		if(!$salt){
			// keep strength standard (less confusion)
    	if(substr($encdata,0,60)===crypt($data,"$2a$08$".substr($encdata, 60)))
      	return TRUE;
   		else
    		return FALSE;
		}
		else{
    	if($encdata==crypt($data,$salt))
      	return TRUE;
   		else
    		return FALSE;
		}
  }
  else{
		if(!$salt){
			//make a salt and hash it with input, and add salt to end
			$chars = "./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  		while($i<22) {
    		$salt .= $chars[mt_rand(0,63)];//faster than substr()
				$i++;
  		}
  		//return 82 char string (60 char hash & 22 char salt)
			return crypt($data, "$2a$08$".$salt).$salt;
		}
		else{
			//return simple hash
			return crypt($data,$salt);
		}
	}
}

$data = "i like pie!";
$salt = "abcdefghijklmnopqrstuv";

$start = microtime(true);
while($i<50){
	$org = smart_hasher($data);
	$result = smart_hasher($data,NULL,$org);
	if($result===TRUE){
		$results['true']++;
	}
	elseif($result===FALSE){
		$results['false']++;
	}
	else{
		$results['other'] = $result;
	}
	$i++;
}
$end = microtime(true);

$results['last'] = $org;
$results['attempts'] = $i;
$results['time']['total'] = $end - $start;
$results['time']['average'] = $results['time']['total']/$results['attempts'];

print_r($results);

?>