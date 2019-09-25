<?php
define('common', true); // lets know if included in wrong houses sha
//include_once "configuration.php";


//-------------------------------
// Obtain specific URL Parameter from URL string
//-------------------------------
function get_param($param_name) {
  global $_POST;
  global $_GET;

  $param_value = "";
  if(isset($_POST[$param_name])) {
    $param_value = $_POST[$param_name];
  } else if(isset($_GET[$param_name])) {
    $param_value = $_GET[$param_name];
  }
  return $param_value;
}
// Convert value for use with SQL statament 
//-------------------------------
function tosql($value, $type)
{
  if(!strlen($value))
    return NULL;
  else
    if($type == "Number")
      return str_replace (",", ".", doubleval($value));
    else
    {
      if(get_magic_quotes_gpc() == 0)
      {
        $value = str_replace("'","''",$value);
        $value = str_replace("\\","\\\\",$value);
      }
      else
      {
        $value = str_replace("\\'","''",$value);
        $value = str_replace("\\\"","\"",$value);
      }
	  // play some other nonsense that may kind of stop injection
 		$value = htmlentities(stripslashes($value));
		//$value = mysql_real_escape_string($value);
      return "'" . $value . "'";
    }
}

function strip($value)
{
  if(get_magic_quotes_gpc() == 0)
    return $value;
  else
    return stripslashes($value);
}

class email

{
   // this function? when are we deleting it as html5 has taken over 
	function valida($str)
	{ //if (ereg("^[a-z0-9-]+(\.[a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$", $str)) DEPRICATED AND REPLACED APRIL 2014
        if (preg_match("^[a-z0-9-]+(\.[a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$", $str))
		{
           return 1;
        }
        else 
		{
           return 0;
		}
    }
}

function set_session($param_name, $param_value)
{

   $_SESSION[$param_name] = $param_value;
}

//for fixing the dates that the datepicker generates to something the db likes
function fix_date($date) {
	$tc = 0;
	$tok = strtok($date, "/");
	while ($tok) {
		$td[$tc] = $tok;
		$tc++;   			
  	$tok = strtok("/");
  }
  return ($td[2]."-".$td[0]."-".$td[1]);
}

function break_date($date) {
	$tc = 0;
	$tok = strtok($date, "-");
	while ($tok) {
		$td[$tc] = $tok;
		$tc++;   			
  	$tok = strtok("-");
  }
  return ($td[1]."/".$td[2]."/".$td[0]);
}

// ENCODE THE URL: for connecting specific id from db
function EncodeToken($id){
$letters = 'AaBbCc67b8eFl90DdENfG67Mm89gHIV8h90qR12yZ34vYx';// 46 strings
$numbers = '01g23g45isTtUu0j13JjKkLnOoPpQrS45v12i34f56WwXx78h9'; // 50 strings
@$a = str_shuffle(substr($numbers, mt_rand(0, (strlen($numbers) - 14)), 4));
@$b = str_shuffle(substr($letters, mt_rand(0, (strlen($letters) - 14)), 4));
@$c = str_shuffle(substr($letters, mt_rand(0, (strlen($letters) - 14)), 4));
@$d = str_shuffle(substr($numbers, mt_rand(0, (strlen($numbers) - 14)), 4));
@$e = str_shuffle(substr($numbers, mt_rand(0, (strlen($numbers) - 14)), 4));
@$f = str_shuffle(substr($letters, mt_rand(0, (strlen($letters) - 14)), 4));
 echo $a.$b.$c.$d.$id.$e.$f.$a.$b;
}
function EncoderToken($id){// returns the value
$letters = 'AaBbCc67b8eFl90DdENfG67Mm89gHIV8h90qR12yZ34vYx';// 46 strings
$numbers = '01g23g45isTtUu0j13JjKkLnOoPpQrS45v12i34f56WwXx78h9'; // 50 strings
@$a = str_shuffle(substr($numbers, mt_rand(0, (strlen($numbers) - 14)), 4));
@$b = str_shuffle(substr($letters, mt_rand(0, (strlen($letters) - 14)), 4));
@$c = str_shuffle(substr($letters, mt_rand(0, (strlen($letters) - 14)), 4));
@$d = str_shuffle(substr($numbers, mt_rand(0, (strlen($numbers) - 14)), 4));
@$e = str_shuffle(substr($numbers, mt_rand(0, (strlen($numbers) - 14)), 4));
@$f = str_shuffle(substr($letters, mt_rand(0, (strlen($letters) - 14)), 4));
 return $a.$b.$c.$d.$id.$e.$f.$a.$b;
}
function DecodeToken($idurl){
	$mutilateurl= 'Something is not right. Seems like you are manipulating the url like a hacker. Select a menu from the left';
	$myp = new MyPublican;
		$collect = substr($idurl, 16, strlen($idurl)-32);
			if(!is_numeric($collect)){
		$myp->AlertError('Out of Idea! not numeric ', $mutilateurl);
		}elseif(strlen($idurl)<33){
		$myp->AlertError('Out of Idea! ', $mutilateurl);
		}elseif(empty($collect)){
		$myp->AlertError('Out of Idea! ', $mutilateurl);
		}else{
		return $collect;
		}
}


?>
