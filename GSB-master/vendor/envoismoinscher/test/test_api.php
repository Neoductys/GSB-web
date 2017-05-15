<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
require_once('../utils/header.php');
require_once('../utils/autoload.php');
ob_start();
header('Content-Type: text/html; charset=utf-8');

/* Possible state of testings */
define('UNKNOWN',0); 	// Not tested
define('OK',1); 		 	// Classe 100% working
define('WARNING',2);		 	// Some not criticals errors
define('ERROR',3);			// At least one critical error

/* Classes to test
 * To add a new class to the test, add it in this array, and create the corresponding test function
 */
$_CLASSES = array(
	'Env_Carrier',
	'Env_ContentCategory',
	'Env_ListPoints',
	'Env_Country',
	'Env_ParcelPoint',
	'Env_OrderStatus',
	'Env_Service',
	'Env_User',
	'Env_Quotation'
	);
	
/* Test functions corresponding to their classes, each one must return an array of this configuration :
 * $result 							=> array(
 * 	['duration'] 					=> #int(sec)
 * 	['reception'] 				=> #state
 * 	['reception_info'][x] => #text
 * 	['parsing'] 					=> #state
 * 	['parsing_info'][x]			=> #text
 *	['additionals'][x]			=> array(
 * 		['name']							=> #text
 * 		['info'][x]						=> #text
 * 		['state']						=> #state
 *		)
 *	)
 **/

function parse_message($state,$info){
	$message = '';
	$message_info = '';
	if (count($info) == 0){
		$message_info .='No available informations';
	}
	else{
		$message_info .= '<ul class="info">';
		foreach($info as $info_ent)
		{
			$message_info .= '<li>'.$info_ent.'</li>';
		}
		$message_info .= '</ul>';
	}
	
	switch($state)	{
		case UNKNOWN :
			$message .= '<span class="unknown" onmouseout="hide_info(\''.htmlspecialchars($message_info).'\')" onmouseover="show_info(\''.htmlspecialchars($message_info).'\')">Not tested</span>';
			break;
		case OK :
			$message .= '<span class="ok" onmouseout="hide_info(\''.htmlspecialchars($message_info).'\')" onmouseover="show_info(\''.htmlspecialchars($message_info).'\')">Ok</span>';
			break;
		case WARNING :
			$message .= '<span class="warning" onmouseout="hide_info(\''.htmlspecialchars($message_info).'\')" onmouseover="show_info(\''.htmlspecialchars($message_info).'\')">Warning</span>';
			break;
		case ERROR :
			$message .= '<span class="error" onmouseout="hide_info(\''.htmlspecialchars($message_info).'\')" onmouseover="show_info(\''.htmlspecialchars($message_info).'\')">Error</span>';
			break;
	}
	return $message;
}
 
function default_value(){
	$result = array(
		'duration' => 0,
		'reception' => UNKNOWN,
		'reception_info' => array(),
		'additionals' => array(
		)
	);
	return $result;
}

function microtime_float(){
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
 
function test_Env_Carrier($userData){
	$result = default_value();
	$start = microtime_float();
	
	/* Initialisation */
	$env = new Env_Carrier(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));
	$env->setEnv('test'); 
	$env->getCarriers();
	
	/* Reception test */
	if($env->curlError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Error while sending the query';
	}
	else if ($env->respError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Invalid query : ' . $userData["api_key"];
		foreach($env->respErrorsList as $message) { 
			$result['reception_info'][count($result['reception_info'])] = $message['message'];
		}  
	}
	else
	{
		$result['reception'] = max($result['reception'],OK);
		$result['reception_info'][count($result['reception_info'])] = 'Reception time : ' . (microtime_float() - $start) . 's';
	}
	
	/* Additionals test */
	
	/* Test for the result structure */
	$result['additionals'][0]['name'] = 'Structure';
	$result['additionals'][0]['state'] = OK;
	if (count($env->carriers) == 0){
		$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
		$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$carriers array is empty';
	}
	else{
		foreach($env->carriers as $code => $carrier){
			if (!isset($carrier['label'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"label" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($carrier['code'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"code" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($carrier['logo'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"logo" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($carrier['logo_modules'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"logo_modules" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($carrier['description'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"description" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($carrier['address'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"address" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($carrier['url'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"url" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($carrier['tracking'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"tracking" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($carrier['tel'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"tel" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($carrier['cgv'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"cgv" not defined in $carriers["'.$code.'"] array';
			}
		}
	}
	
	$result['duration'] = microtime_float() - $start;
	return $result;
}
function test_Env_ContentCategory($userData){
	$result = default_value();
	$start = microtime_float();
	
	/* Initialisation */
	$env = new Env_ContentCategory(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));
	$env->setEnv('test'); 
	// Gather categories
	$env->getCategories();
	// Gather contents
	$env->getContents(); 
	
	/* Reception test */
	if($env->curlError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Error while sending the query';
	}
	else if ($env->respError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Invalid query : ' . $userData["api_key"];
		foreach($env->respErrorsList as $message) { 
			$result['reception_info'][count($result['reception_info'])] = $message['message'];
		}  
	}
	else
	{
		$result['reception'] = max($result['reception'],OK);
		$result['reception_info'][count($result['reception_info'])] = 'Reception time : ' . (microtime_float() - $start). 's';;
	}
	
	/* Additionals test */
	
	/* Test for the result structure */
	$result['additionals'][0]['name'] = 'Structure';
	$result['additionals'][0]['state'] = OK;
	if (count($env->categories) == 0){
		$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
		$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$categories array is empty';
	}
	else{
		foreach($env->categories as $code => $category){
			if (!isset($category['label'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"label" not defined in $categories["'.$code.'"] array';
			}
			if (!isset($category['code'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"code" not defined in $categories["'.$code.'"] array';
			}
		}
	}
	if (count($env->categories) == 0){
		$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
		$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$contents array is empty';
	}
	else{
		foreach($env->contents as $category => $content){
			foreach($content as $x => $line){
				if (!isset($env->contents[$category][$x]['label'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"label" not defined in $contents["'.$category.'"]['.$x.'] array';
				}
				if (!isset($env->contents[$category][$x]['code'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"code" not defined in $contents["'.$category.'"]['.$x.'] array';
				}
				if (!isset($env->contents[$category][$x]['category'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"category" not defined in $contents["'.$category.'"]['.$x.'] array';
				}
			}
		}
	}
	
	$result['duration'] = microtime_float() - $start;
	return $result;
}
function test_Env_ListPoints($userData){
	$result = default_value();
	$start = microtime_float();
	
	/* Initialisation */
	$env = new Env_ListPoints(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));
	$env->setEnv('test'); 
	$params = array('srv_code' => 'RelaisColis', 'pays' => 'FR', 'cp' => '75011', 'ville' => 'PARIS');
	$env->getListPoints("SOGP", $params);
	
	/* Reception test */
	if($env->curlError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Error while sending the query';
	}
	else if ($env->respError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Invalid query : ' . $userData["api_key"];
		foreach($env->respErrorsList as $message) { 
			$result['reception_info'][count($result['reception_info'])] = $message['message'];
		}  
	}
	else
	{
		$result['reception'] = max($result['reception'],OK);
		$result['reception_info'][count($result['reception_info'])] = 'Reception time : ' . (microtime_float() - $start). 's';;
	}
	
	/* Additionals test */
	
	/* Test for the result structure */
	$result['additionals'][0]['name'] = 'Structure';
	$result['additionals'][0]['state'] = OK;
	if (count($env->listPoints) == 0){
		$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
		$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$listPoints array is empty';
	}
	else{
		foreach($env->listPoints as $x => $content){
			if (!isset($env->listPoints[$x]['code'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"code" not defined in $listPoints['.$x.'] array';
			}
			if (!isset($env->listPoints[$x]['name'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"name" not defined in $listPoints['.$x.'] array';
			}
			if (!isset($env->listPoints[$x]['address'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"address" not defined in $listPoints['.$x.'] array';
			}
			if (!isset($env->listPoints[$x]['city'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"city" not defined in $listPoints['.$x.'] array';
			}
			if (!isset($env->listPoints[$x]['zipcode'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"zipcode" not defined in $listPoints['.$x.'] array';
			}
			if (!isset($env->listPoints[$x]['country'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"country" not defined in $listPoints['.$x.'] array';
			}
			if (!isset($env->listPoints[$x]['description'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"description" not defined in $listPoints['.$x.'] array';
			}
			if (!isset($env->listPoints[$x]['days'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"days" not defined in $listPoints['.$x.'] array';
			}
			else if (count($env->listPoints[$x]['days']) != 7){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"days" should contains 7 days info, but contains ' . count($env->contents[$x]['days']) . ' instead';
			}
			if (isset($env->listPoints[$x]['days'])){
				foreach($env->listPoints[$x]['days'] as $j => $day){
					if (!isset($env->listPoints[$x]['days'][$j]['weekday'])){
						$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
						$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"weekday" not defined in $listPoints['.$x.']["days"]['.$j.'] array';
					}
					if (!isset($env->listPoints[$x]['days'][$j]['open_am'])){
						$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
						$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"open_am" not defined in $listPoints['.$x.']["days"]['.$j.'] array';
					}
					if (!isset($env->listPoints[$x]['days'][$j]['close_am'])){
						$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
						$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"close_am" not defined in $listPoints['.$x.']["days"]['.$j.'] array';
					}
					if (!isset($env->listPoints[$x]['days'][$j]['open_pm'])){
						$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
						$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"open_pm" not defined in $listPoints['.$x.']["days"]['.$j.'] array';
					}
					if (!isset($env->listPoints[$x]['days'][$j]['close_pm'])){
						$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
						$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"close_pm" not defined in $listPoints['.$x.']["days"]['.$j.'] array';
					}
				}
			}
		}
	}
	
	$result['duration'] = microtime_float() - $start;
	return $result;
}
function test_Env_Country($userData){
	$result = default_value();
	$start = microtime_float();
	
	/* Initialisation */
	$env = new Env_Country(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));
	$env->setEnv('test'); 
	$env->getCountries();
	$env->getCountry("NL");
	
	/* Reception test */
	if($env->curlError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Error while sending the query';
	}
	else if ($env->respError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Invalid query : ' . $userData["api_key"];
		foreach($env->respErrorsList as $message) { 
			$result['reception_info'][count($result['reception_info'])] = $message['message'];
		}  
	}
	else
	{
		$result['reception'] = max($result['reception'],OK);
		$result['reception_info'][count($result['reception_info'])] = 'Reception time : ' . (microtime_float() - $start). 's';;
	}
	
	/* Additionals test */
	
	/* Test for the result structure */
	$result['additionals'][0]['name'] = 'Structure';
	$result['additionals'][0]['state'] = OK;
	if (count($env->countries) == 0){
		$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
		$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$countries array is empty';
	}
	else{
		foreach($env->countries as $x => $country){
			if (!isset($env->countries[$x]['label'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"label" not defined in $countries["'.$x.'"] array';
			}
			if (!isset($env->countries[$x]['code'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"code" not defined in $countries["'.$x.'"] array';
			}
		}
	}
	if (count($env->country) == 0){
		$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
		$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$country array is empty';
	}
	else{
		foreach($env->country as $x => $country){
			if (!isset($env->country[$x]['label'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"label" not defined in $country['.$x.'] array';
			}
			if (!isset($env->country[$x]['code'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"code" not defined in $country['.$x.'] array';
			}
		}
	}
	
	$result['duration'] = microtime_float() - $start;
	return $result;
}
function test_Env_ParcelPoint($userData){
	$result = default_value();
	$start = microtime_float();
	
	/* Initialisation */
	$env = new Env_ParcelPoint(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));
	$env->setEnv('test'); 
	$env->constructList = true;
	$env->getParcelPoint("dropoff_point", "SOGP-C3084");
	$env->getParcelPoint("dropoff_point", "SOGP-C3159"); 
	$env->getParcelPoint("dropoff_point", "SOGP-C3065"); 
	$env->getParcelPoint("dropoff_point", "SOGP-C3137");  
	$env->getParcelPoint("pickup_point", "SOGP-C3059"); 
	$env->getParcelPoint("pickup_point", "SOGP-C3210"); 
	$env->getParcelPoint("pickup_point", "SOGP-C3138"); 
	
	/* Reception test */
	if($env->curlError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Error while sending the query';
	}
	else if ($env->respError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Invalid query : ' . $userData["api_key"];
		foreach($env->respErrorsList as $message) { 
			$result['reception_info'][count($result['reception_info'])] = $message['message'];
		}  
	}
	else
	{
		$result['reception'] = max($result['reception'],OK);
		$result['reception_info'][count($result['reception_info'])] = 'Reception time : ' . (microtime_float() - $start). 's';;
	}
	
	/* Additionals test */
	
	/* Test for the result structure */
	$result['additionals'][0]['name'] = 'Structure';
	$result['additionals'][0]['state'] = OK;
	if (count($env->points) != 2){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$points should contains 2 elements, contains ' . count($env->points) . ' instead';
	}
	else
	{
		foreach($env->points as $type => $points)
		if (count($env->points[$type]) == 0){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$points["'.$type.'"] array is empty';
		}
		else{
			foreach($env->points[$type] as $x => $content){
				if (!isset($env->points[$type][$x]['code'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"code" not defined in $points["'.$type.'"]['.$x.'] array';
				}
				if (!isset($env->points[$type][$x]['name'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"name" not defined in $points["'.$type.'"]['.$x.'] array';
				}
				if (!isset($env->points[$type][$x]['address'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"address" not defined in $points["'.$type.'"]['.$x.'] array';
				}
				if (!isset($env->points[$type][$x]['city'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"city" not defined in $points["'.$type.'"]['.$x.'] array';
				}
				if (!isset($env->points[$type][$x]['zipcode'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"zipcode" not defined in $points["'.$type.'"]['.$x.'] array';
				}
				if (!isset($env->points[$type][$x]['country'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"country" not defined in $points["'.$type.'"]['.$x.'] array';
				}
				if (!isset($env->points[$type][$x]['description'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"description" not defined in $points["'.$type.'"]['.$x.'] array';
				}
				if (!isset($env->points[$type][$x]['schedule'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"days" not defined in $points["'.$type.'"]['.$x.'] array';
				}
				else if (count($env->points[$type][$x]['schedule']) != 7){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"days" should contains 7 days info, but contains ' . count($env->contents[$x]['days']) . ' instead';
				}
				if (isset($env->points[$type][$x]['schedule'])){
					foreach($env->points[$type][$x]['schedule'] as $j => $day){
						if (!isset($env->points[$type][$x]['schedule'][$j]['weekday'])){
							$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
							$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"weekday" not defined in $points["'.$type.'"]['.$x.']["days"]['.$j.'] array';
						}
						if (!isset($env->points[$type][$x]['schedule'][$j]['open_am'])){
							$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
							$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"open_am" not defined in $points["'.$type.'"]['.$x.']["days"]['.$j.'] array';
						}
						if (!isset($env->points[$type][$x]['schedule'][$j]['close_am'])){
							$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
							$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"close_am" not defined in $points["'.$type.'"]['.$x.']["days"]['.$j.'] array';
						}
						if (!isset($env->points[$type][$x]['schedule'][$j]['open_pm'])){
							$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
							$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"open_pm" not defined in $points["'.$type.'"]['.$x.']["days"]['.$j.'] array';
						}
						if (!isset($env->points[$type][$x]['schedule'][$j]['close_pm'])){
							$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
							$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"close_pm" not defined in $points["'.$type.'"]['.$x.']["days"]['.$j.'] array';
						}
					}
				}
			}
		}
	}
	
	$result['duration'] = microtime_float() - $start;
	return $result;
}
function test_Env_OrderStatus($userData){
	/* Create an order for the test */
	/* Initialisation */
	$orderPassed = "1306261940UPSE8302AU";
	
	$result = default_value();
	$start = microtime_float();
	
	/* Initialisation */
	$env = new Env_OrderStatus(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));
	$env->setEnv('test'); 
	$env->getOrderInformations($orderPassed);
	
	/* Reception test */
	if($env->curlError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Error while sending the query';
	}
	else if ($env->respError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Invalid query : ' . $userData["api_key"];
		foreach($env->respErrorsList as $message) { 
			$result['reception_info'][count($result['reception_info'])] = $message['message'];
		}  
	}
	else
	{
		$result['reception'] = max($result['reception'],OK);
		$result['reception_info'][count($result['reception_info'])] = 'Reception time : ' . (microtime_float() - $start). 's';;
	}
	
	/* Additionals test */
	
	/* Test for the result structure */
	$result['additionals'][0]['name'] = 'Structure';
	$result['additionals'][0]['state'] = OK;
	if (count($env->orderInfo) == 0){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$orderInfo array is empty';
	}
	else{
		if (!isset($env->orderInfo['emcRef'])){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"emcRef" not defined in $orderInfo array';
		}
		if (!isset($env->orderInfo['state'])){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"emcRef" not defined in $orderInfo array';
		}
		if (!isset($env->orderInfo['opeRef'])){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"emcRef" not defined in $orderInfo array';
		}
		if (!isset($env->orderInfo['labelAvailable'])){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"emcRef" not defined in $orderInfo array';
		}
		else if ($env->orderInfo['labelAvailable']){
			if (!isset($env->orderInfo['labelUrl'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"labelUrl" not defined in $orderInfo array';
			}
			if (!isset($env->orderInfo['labels'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"labels" not defined in $orderInfo array';
			}
			else{
				if (count($env->orderInfo['labels']) == 0){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$orderInfo["labels"] array is empty';
				}
			}
		}
	}
	
	$result['duration'] = microtime_float() - $start;
	return $result;
}
function test_Env_Service($userData){
	$result = default_value();
	$start = microtime_float();
	
	/* Initialisation */
	$env = new Env_Service(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));
	$env->setEnv('test'); 
	$env->getServices();
	
	/* Reception test */
	if($env->curlError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Error while sending the query';
	}
	else if ($env->respError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Invalid query : ' . $userData["api_key"];
		foreach($env->respErrorsList as $message) { 
			$result['reception_info'][count($result['reception_info'])] = $message['message'];
		}  
	}
	else
	{
		$result['reception'] = max($result['reception'],OK);
		$result['reception_info'][count($result['reception_info'])] = 'Reception time : ' . (microtime_float() - $start). 's';;
	}
	
	/* Additionals test */
		
	/* Test for the result structure */
	$result['additionals'][0]['name'] = 'Structure';
	$result['additionals'][0]['state'] = OK;
	if (count($env->carriers) == 0){
		$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
		$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$carriers array is empty';
	}
	else{
		foreach($env->carriers as $code => $carrier){
			if (!isset($env->carriers[$code]['label'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"label" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($env->carriers[$code]['code'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"code" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($env->carriers[$code]['logo'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"logo" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($env->carriers[$code]['logo_modules'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"logo_modules" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($env->carriers[$code]['description'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"description" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($env->carriers[$code]['address'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"address" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($env->carriers[$code]['url'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"url" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($env->carriers[$code]['tracking'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"tracking" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($env->carriers[$code]['tel'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"tel" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($env->carriers[$code]['cgv'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"cgv" not defined in $carriers["'.$code.'"] array';
			}
			if (!isset($env->carriers[$code]['services'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"services" not defined in $carriers["'.$code.'"] array';
			}
			else{
				if (count($env->carriers[$code]['services']) == 0){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$carriers["'.$code.'"]["services"] array is empty';
				}
				else{
					foreach($env->carriers[$code]['services'] as $s => $service){
						if (!isset($env->carriers[$code]['services'][$s]['code'])){
							$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
							$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"code" not defined in $carriers["'.$code.'"]["services"]["'.$s.'"] array';
						}
						if (!isset($env->carriers[$code]['services'][$s]['label'])){
							$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
							$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"label" not defined in $carriers["'.$code.'"]["services"]["'.$s.'"] array';
						}
						if (!isset($env->carriers[$code]['services'][$s]['mode'])){
							$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
							$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"mode" not defined in $carriers["'.$code.'"]["services"]["'.$s.'"] array';
						}
						if (!isset($env->carriers[$code]['services'][$s]['alert'])){
							$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
							$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"alert" not defined in $carriers["'.$code.'"]["services"]["'.$s.'"] array';
						}
						if (!isset($env->carriers[$code]['services'][$s]['collection'])){
							$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
							$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"collection" not defined in $carriers["'.$code.'"]["services"]["'.$s.'"] array';
						}
						if (!isset($env->carriers[$code]['services'][$s]['delivery'])){
							$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
							$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"delivery" not defined in $carriers["'.$code.'"]["services"]["'.$s.'"] array';
						}
						if (!isset($env->carriers[$code]['services'][$s]['is_pluggable'])){
							$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
							$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"is_pluggable" not defined in $carriers["'.$code.'"]["services"]["'.$s.'"] array';
						}
						if (!isset($env->carriers[$code]['services'][$s]['options'])){
							$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
							$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"options" not defined in $carriers["'.$code.'"]["services"]["'.$s.'"] array';
						}
						else{
							if (count($env->carriers[$code]['services'][$s]['options']) == 0){
								$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
								$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$carriers["'.$code.'"]["services"]["'.$s.'"]["options"] array is empty';
							}
							else{
								foreach($env->carriers[$code]['services'][$s]['options'] as $o => $option){
									if (!isset($env->carriers[$code]['services'][$s]['options'][$o]['label'])){
										$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
										$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"label" not defined in $carriers["'.$code.'"]["services"]["'.$s.'"]["options"]["'.$o.'"] array';
									}
								}
							}
						}
						if (!isset($env->carriers[$code]['services'][$s]['exclusions'])){
							$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
							$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"exclusions" not defined in $carriers["'.$code.'"]["services"]["'.$s.'"] array';
						}
						else{
							if (count($env->carriers[$code]['services'][$s]['exclusions']) == 0){
								$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
								$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$carriers["'.$code.'"]["services"]["'.$s.'"]["exclusions"] array is empty';
							}
							else{
								foreach($env->carriers[$code]['services'][$s]['exclusions'] as $e => $exclusion){
									if (!isset($env->carriers[$code]['services'][$s]['exclusions'][$e]['label'])){
										$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
										$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"label" not defined in $carriers["'.$code.'"]["services"]["'.$s.'"]["exclusions"]["'.$e.'"] array';
									}
								}
							}
						}
						if (!isset($env->carriers[$code]['services'][$s]['apiOptions'])){
							$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
							$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"apiOptions" not defined in $carriers["'.$code.'"]["services"]["'.$s.'"] array';
						}
						else{
							if (count($env->carriers[$code]['services'][$s]['apiOptions']) == 0){
								//$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
								//$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$carriers["'.$code.'"]["services"]["'.$s.'"]["apiOptions"] array is empty';
							}
							else{
								
								foreach($env->carriers[$code]['services'][$s]['apiOptions'] as $e => $apiOption){
									foreach($env->carriers[$code]['services'][$s]['apiOptions'][$e] as $e2 => $apiOption2){
										if (!isset($env->carriers[$code]['services'][$s]['apiOptions'][$e][$e2])){
											$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
											$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"'.$e2.'" not defined in $carriers["'.$code.'"]["services"]["'.$s.'"]["apiOptions"]["'.$e.'"] array';
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	
	$result['duration'] = microtime_float() - $start;
	return $result;
}
function test_Env_User($userData){
	$result = default_value();
	$start = microtime_float();
	
	/* Initialisation */
	$env = new Env_User(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));
	$env->setEnv('test'); 
	$env->getEmailConfiguration();
	
	/* Reception test */
	if($env->curlError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Error while sending the query';
	}
	else if ($env->respError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Invalid query : ' . $userData["api_key"];
		foreach($env->respErrorsList as $message) { 
			$result['reception_info'][count($result['reception_info'])] = $message['message'];
		}  
	}
	else
	{
		$result['reception'] = max($result['reception'],OK);
		$result['reception_info'][count($result['reception_info'])] = 'Reception time : ' . (microtime_float() - $start). 's';;
	}
	
	/* Additionals test */
	
	/* Test for the result structure */
	$result['additionals'][0]['name'] = 'Structure';
	$result['additionals'][0]['state'] = OK;
	if (!isset($env->userConfiguration['emails'])){
		$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
		$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"emails" not defined in $userConfiguration array';
	}
	else{
		if (count($env->userConfiguration['emails']) == 0){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$userConfiguration array is empty';
		}
	}
			
	$result['duration'] = microtime_float() - $start;
	return $result;
}
function test_Env_Quotation($userData){
	$result = default_value();
	$start = microtime_float();
	
	/* Initialisation */
	$order_env = new Env_Quotation(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));
	$order_from = array("pays" => "FR", "code_postal" => "75002", "type" => "particulier",
	"ville" => "Paris", "adresse" => "41, rue Saint Augustin | floor nr 3", "civilite" => "M",
	"prenom" => "Test_prenom", "nom" => "Test_nom", "email" => "dev@boxtale.com",
	"tel" => "0601010101", "infos" => "");
	$order_to = array("pays" => "AU", "code_postal" => "2000", "type" => "particulier",
	"ville" => "Sydney", "adresse" => "King Street", "civilite" => "M", 
	"prenom" => "Test_prenom_dst", "nom" => "Test_nom_dst", "email" => "dev@boxtale.com",
	"tel" => "0601010101", "infos" => "Some informations about my shipment");

	// Informations sur l'envoi
	$order_quotInfo = array("collecte" => date("Y-m-d"), "delai" => "aucun",  "code_contenu" => 10120,
	"operator" => "UPSE",
	"raison" => "sale",
	"colis.valeur" => 1200,
	// "assurance.selected" => false,
	"colis.description" => "Des journaux",
	"disponibilite.HDE" => "09:00", 
	"disponibilite.HLE" => "19:00");
	$order_env->setPerson("expediteur", $order_from);
	$order_env->setPerson("destinataire", $order_to);
	$order_env->setType("colis", array(
		1 => array("poids" => 21, "longueur" => 7, "largeur" => 8, "hauteur" => 11), 
		2 => array("poids" => 21, "longueur" => 7, "largeur" => 8, "hauteur" => 11))
	);
	// Pour cet envoi on est oblig� de joindre une facture proforma qui r�sume 2 objets exp�di�s
	$order_env->setProforma(array(1 => array("description_en" => "L'Equipe newspaper from 1998",
	"description_fr" => "le journal L'Equipe du 1998",  "nombre" => 1, "valeur" => 10, 
	"origine" => "FR", "poids" => 1.2),
	2 => array("description_en" => "300 editions of L'Equipe newspaper from 1999",
	"description_fr" => "300 num�ros de L'Equipe du 1999",  "nombre" => 300,  "valeur" => 8, 
	"origine" => "FR", "poids" => 0.1)));
	$order_env->setEnv('test'); 
	$orderPassed = $order_env->makeOrder($order_quotInfo,true);
	
	$offer_env = new Env_Quotation(array("user" => $userData["login"], "pass" => $userData["password"], "key" => $userData["api_key"]));
	$offer_env->setEnv('test'); 
	$offer_to = array(
		"pays" => "FR", 
		"code_postal" => "75002", 
		"ville" => "Paris", 
		"type" => "particulier", 
		"adresse" => "41, rue Saint Augustin"
		);
	$offer_from = array(
		"pays" => "FR", 
		"code_postal" => "13002",   
		"ville" => "Marseille", 
		"type" => "particulier", 
		"adresse" => "1, rue Chape"); 
	$offer_quotInfo = array(
		"collecte" => date("Y-m-d"), 
		"delai" => "aucun",  
		"code_contenu" => 10120
		);
	$offer_env->setPerson("expediteur", $offer_from);
	$offer_env->setPerson("destinataire", $offer_to);
	$offer_env->setType(
		"colis", 
		array(
			1 => array(
				"poids" => 2, 
				"longueur" => 18, 
				"largeur" => 18,
				"hauteur" => 18
			)
		)
	);
	$offer_env->getQuotation($offer_quotInfo);
	$offer_env->getOffers(false);
	
	/* Reception test */
	if (!$orderPassed){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Error while making the order (makeOrder returned false)';
	}
	if($order_env->curlError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Error while sending the query';
	}
	else if ($order_env->respError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Invalid query : ' . $userData["api_key"];
		foreach($order_env->respErrorsList as $message) { 
			$result['reception_info'][count($result['reception_info'])] = $message['message'];
		}  
	}
	else if($offer_env->curlError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Error while sending the query';
	}
	else if ($offer_env->respError){
		$result['reception'] = max($result['reception'],ERROR);
		$result['reception_info'][count($result['reception_info'])] = 'Invalid query : ' . $userData["api_key"];
		foreach($offer_env->respErrorsList as $message) { 
			$result['reception_info'][count($result['reception_info'])] = $message['message'];
		}  
	}
	else{
		$result['reception'] = max($result['reception'],OK);
		$result['reception_info'][count($result['reception_info'])] = 'Reception time : ' . (microtime_float() - $start). 's';
	}
	
	/* Additionals test */
	
	/* Test for the result structure */
	$result['additionals'][0]['name'] = 'Structure';
	$result['additionals'][0]['state'] = OK;
	if (count($offer_env->offers) == 0){
		$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
		$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$offers array is empty';
	}
	else{
		foreach($offer_env->offers as $x => $offer){
			if (!isset($offer_env->offers[$x]['mode'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"mode" not defined in $offers['.$x.'] array';
			}
			if (!isset($offer_env->offers[$x]['url'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"url" not defined in $offers['.$x.'] array';
			}
			if (!isset($offer_env->offers[$x]['characteristics'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"characteristics" not defined in $offers['.$x.'] array';
			}
			if (!isset($offer_env->offers[$x]['alert'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"alert" not defined in $offers['.$x.'] array';
			}
			if (!isset($offer_env->offers[$x]['operator'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"operator" not defined in $offers['.$x.'] array';
			}
			else{
				if (count($offer_env->offers[$x]['operator']) == 0){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$offers['.$x.']["operator"] array is empty';
				}
				else{
					if (!isset($offer_env->offers[$x]['operator']['code'])){
						$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
						$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"code" not defined in $offers['.$x.']["operator"] array';
					}
					if (!isset($offer_env->offers[$x]['operator']['label'])){
						$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
						$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"label" not defined in $offers['.$x.']["operator"] array';
					}
					if (!isset($offer_env->offers[$x]['operator']['logo'])){
						$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
						$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"logo" not defined in $offers['.$x.']["operator"] array';
					}
				}
			}
			if (!isset($offer_env->offers[$x]['service'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"operator" not defined in $offers['.$x.'] array';
			}
			else{
				if (count($offer_env->offers[$x]['service']) == 0){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$offers['.$x.']["service"] array is empty';
				}
				else{
					if (!isset($offer_env->offers[$x]['service']['code'])){
						$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
						$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"code" not defined in $offers['.$x.']["service"] array';
					}
					if (!isset($offer_env->offers[$x]['service']['label'])){
						$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
						$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"label" not defined in $offers['.$x.']["service"] array';
					}
				}
			}
			if (!isset($offer_env->offers[$x]['price'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"price" not defined in $offers['.$x.'] array';
			}
			else{
				if (count($offer_env->offers[$x]['price']) == 0){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$offers['.$x.']["price"] array is empty';
				}
				else{
					if (!isset($offer_env->offers[$x]['price']['currency'])){
						$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
						$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"currency" not defined in $offers['.$x.']["price"] array';
					}
					if (!isset($offer_env->offers[$x]['price']['tax-exclusive'])){
						$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
						$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"tax-exclusive" not defined in $offers['.$x.']["price"] array';
					}
					if (!isset($offer_env->offers[$x]['price']['tax-inclusive'])){
						$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
						$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"tax-inclusive" not defined in $offers['.$x.']["price"] array';
					}
				}
			}
			if (!isset($offer_env->offers[$x]['collection'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"collection" not defined in $offers['.$x.'] array';
			}
			else{
				if (count($offer_env->offers[$x]['collection']) == 0){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$offers['.$x.']["collection"] array is empty';
				}
				else{
					if (!isset($offer_env->offers[$x]['collection']['type'])){
						$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
						$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"type" not defined in $offers['.$x.']["collection"] array';
					}
					if (!isset($offer_env->offers[$x]['collection']['date'])){
						$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
						$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"date" not defined in $offers['.$x.']["collection"] array';
					}
					if (!isset($offer_env->offers[$x]['collection']['label'])){
						$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
						$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"label" not defined in $offers['.$x.']["collection"] array';
					}
				}
			}
			if (!isset($offer_env->offers[$x]['mandatory'])){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"mandatory" not defined in $offers['.$x.'] array';
			}
			else if (count($offer_env->offers[$x]['mandatory']) == 0){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$offers['.$x.']["mandatory"] array is empty';
			}
		}
	}
	
	if (count($order_env->order) == 0){
		$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
		$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$order array is empty';
	}
	else{
		if (!isset($order_env->order['ref'])){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"ref" not defined in $order array';
		}
		if (!isset($order_env->order['date'])){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"date" not defined in $order array';
		}
		if (!isset($order_env->order['mode'])){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"mode" not defined in $order array';
		}
		if (!isset($order_env->order['url'])){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"url" not defined in $order array';
		}
		if (!isset($order_env->order['proforma'])){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"proforma" not defined in $order array';
		}
		if (!isset($order_env->order['offer']['operator'])){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"offer"/"operator" not defined in $order array';
		}
		else{
			if (count($order_env->order['offer']['operator']) == 0){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$order['.$x.']["offer"]["operator"] array is empty';
			}
			else{
				if (!isset($order_env->order['offer']['operator']['code'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"code" not defined in $order["offer"]["operator"] array';
				}
				if (!isset($order_env->order['offer']['operator']['label'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"label" not defined in $order["offer"]["operator"] array';
				}
				if (!isset($order_env->order['offer']['operator']['logo'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"logo" not defined in $order["offer"]["operator"] array';
				}
			}
		}
		if (!isset($order_env->order['service'])){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"operator" not defined in $order array';
		}
		else{
			if (count($order_env->order['service']) == 0){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$order["service"] array is empty';
			}
			else{
				if (!isset($order_env->order['service']['code'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"code" not defined in $order["service"] array';
				}
				if (!isset($order_env->order['service']['label'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"label" not defined in $order["service"] array';
				}
			}
		}
		if (!isset($order_env->order['price'])){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"price" not defined in $order array';
		}
		else{
			if (count($order_env->order['price']) == 0){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$order["price"] array is empty';
			}
			else{
				if (!isset($order_env->order['price']['currency'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"currency" not defined in $order["price"] array';
				}
				if (!isset($order_env->order['price']['tax-exclusive'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"tax-exclusive" not defined in $order["price"] array';
				}
				if (!isset($order_env->order['price']['tax-inclusive'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"tax-inclusive" not defined in $order["price"] array';
				}
			}
		}
		if (!isset($order_env->order['collection'])){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"collection" not defined in $order array';
		}
		else{
			if (count($order_env->order['collection']) == 0){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$order["collection"] array is empty';
			}
			else{
				if (!isset($order_env->order['collection']['code'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"code" not defined in $order["collection"] array';
				}
				if (!isset($order_env->order['collection']['type_label'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"type_label" not defined in $order["collection"] array';
				}
				if (!isset($order_env->order['collection']['date'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"date" not defined in $order["collection"] array';
				}
				if (!isset($order_env->order['collection']['time'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"time" not defined in $order["collection"] array';
				}
				if (!isset($order_env->order['collection']['label'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"label" not defined in $order["collection"] array';
				}
			}
		}
		if (!isset($order_env->order['delivery'])){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"delivery" not defined in $order array';
		}
		else{
			if (count($order_env->order['delivery']) == 0){
				$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
				$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$order["delivery"] array is empty';
			}
			else{
				if (!isset($order_env->order['delivery']['code'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"code" not defined in $order["delivery"] array';
				}
				if (!isset($order_env->order['delivery']['type_label'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"type_label" not defined in $order["delivery"] array';
				}
				if (!isset($order_env->order['delivery']['date'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"date" not defined in $order["delivery"] array';
				}
				if (!isset($order_env->order['delivery']['time'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"time" not defined in $order["delivery"] array';
				}
				if (!isset($order_env->order['delivery']['label'])){
					$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
					$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"label" not defined in $order["delivery"] array';
				}
			}
		}
		if (!isset($order_env->order['alerts'])){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"alerts" not defined in $order array';
		}
		else if (count($order_env->order['alerts']) == 0){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$order["alerts"] array is empty';
		}
		if (!isset($order_env->order['chars'])){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"chars" not defined in $order array';
		}
		else if (count($order_env->order['chars']) == 0){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$order["chars"] array is empty';
		}
		if (!isset($order_env->order['labels'])){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],ERROR);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '"labels" not defined in $order array';
		}
		else if (count($order_env->order['labels']) == 0){
			$result['additionals'][0]['state'] = max($result['additionals'][0]['state'],WARNING);
			$result['additionals'][0]['info'][count($result['additionals'][0]['info'])] = '$order["labels"] array is empty';
		}
	}
	
	$result['duration'] = microtime_float() - $start;
	return $result;
}

?>
	<script type="text/javascript">
		
		var posx = 0;
		var posy = 0;
		
		function hide_info(message){
			if (document.getElementById('info').innerHTML == message){
				document.getElementById('info').style.display='none';
			}
		}
		function show_info(message){
			document.getElementById('info').style.display='inline';
			document.getElementById('info').innerHTML=message;
		}
		function mousePosition(e){
			if (!e) var e = window.event;
			if (e.pageX || e.pageY){
				posx = e.pageX;
				posy = e.pageY;
			}
			else if (e.clientX || e.clientY){
				posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
				posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
			}
			document.getElementById('info').style.top=''+(posy+5)+'px';
			document.getElementById('info').style.left=''+(posx+5)+'px';
		}
		
		document.body.onmousemove= function(event){
			mousePosition(event);
			hide_info();
		}
		
	</script>
	<style>
		body{
		text-align:left;
		width:100%;
		min-height:1000px;
		}
		
		#contenu{
		width:100%;
		min-height:500px;
		}
		
		#info{
			position:absolute;
			display:none;
			background-color: #ccc;
			padding:5px 20px 5px 5px;
			border:1px solid #999;
			border-radius:5px;
			box-shadow:3px 3px 3px;
		}
	
		td
		{
		vertical-align:top;
		padding:5px 20px;
		}
		
		.additional{
		list-style-type:none;
		margin:0;
		padding:0;
		}
	
		.class{
		font-style:italic;
		color:#505;
		}
		
		.duration{
		color:blue;
		}
	
		.unknown{
		color:grey;
		font-weight:bold;
		}
		.ok{
		color:green;
		font-weight:bold;
		}
		.warning{
		color:orange;
		font-weight:bold;
		}
		.error{
		color:red;
		font-weight:bold;
		}
	</style>
	<div id="info"></div>
	<!-- Code servant � tester le fonctionnement des classes du module -->
	<div id="contenu" onmouseOver="hide_info()">
		<table>
			<tr>
				<td>Classe</td>
				<td>Test duration</td>
				<td>Answer reception</td>
				<td>Additional tests</td>
			</tr>
<?php
			foreach($_CLASSES as $class){
				$result = array();
				try{
					eval('$result = test_'.$class.'($userData);');
				}
				catch (Exception $e){
					echo 'pas done';
					$result = default_value();
					$result['reception'] = ERROR;
					$result['reception_info'][0] = $e->getMessage();
					$result['duration'] = 0;
				}
?>
			<tr>
				<td><span class="class"><?php echo $class;?></span></td>
				<td><span class="duration"><?php echo $result['duration'] . 's';?></span></td>
				<td><?php echo parse_message($result['reception'],$result['reception_info']);?></td>
				<td>
					<ul class="additional">
<?php
						foreach($result['additionals'] as $test){
							echo '<li>'.$test['name']. ' : '.parse_message($test['state'],$test['info']).'</li>';
						}
?>
					</ul>
				</td>
			</tr>
<?php		
			}
?>
		</table>
	</div>
	</body>
</html>