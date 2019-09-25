<?php 
class MyPublican {

public function AlertSuccess($header,$string){
print '<div class="alert alert-success" style="width:80%s">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>'.$header.'</strong>'.$string.'</div>';

}
public function AlertError($header,$string){
print '<div class="alert alert-error" style="width:80%s">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>'.$header.'</strong>'.$string.'</div>';
}
public function AlertInfo($header,$string){
print '<div class="alert alert-info" style="width:80%s">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>'.$header.'</strong>'.$string.'</div>';
}

public function AlertWarning($header,$string){
print '<div class="alert alert-warning" style="width:80%s">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>'.$header.'</strong>'.$string.'</div>';
}

public function AlertImportant($header,$string){
print '<div class="alert alert-important" style="width:80%s">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>'.$header.'</strong>'.$string.'</div>';
}

public function StrongPassword($string,$throwback){
// ckech if the password is strong

if(strlen($string) < 6){
$throwback = "String Is too short, it must be 6-10 characters";
return false;
}
elseif(strlen($string) > 10){
$throwback = "String Is too long, it must be 6-10 characters";
}
// check if it has not special characters

}

public function CleanForSQL($value, $type) {
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
 		$value = trim(htmlentities(stripslashes($value)));
		//$value = mysql_real_escape_string($value);
      return $value;
    }
}


}// publican class ends

$myp = new MyPublican;

?>