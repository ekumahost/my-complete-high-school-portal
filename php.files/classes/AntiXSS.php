<?php
/*  
	kAsTech FrameWork v2.42 for AntiXSS
	Designed by: kAsTechnology Network
	Developer: Kelvin Ugbana
	Lagos, Nigeria
	Date: 13th July 2019
	
	Changelog: 
		v2.42 Added the HTML Purifier			
*/

class AntiXSS {
	 
    public static $err = "XSS Detected!";

    public static function setEncoding($str, $newEncoding) {
        $encodingList = mb_list_encodings();
        $currentEncoding = mb_detect_encoding($str, $encodingList);
        $changeEncoding = mb_convert_encoding($str, $newEncoding, $currentEncoding);
        
        return $changeEncoding;
    }

    public static function blacklistFilter($str) {
        if (preg_match("/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t(.*)>(.*)/i", $str) > 0) {
            return $str;
        } else {
            return self::$err;
        }
    }

    public static function whitelistFilter($str, $whiteFilterPattern) {

        switch ($whiteFilterPattern) {
            case "string":
                $pattern = "([a-zA-Z]+)";
            break;
            case "number":
                $pattern = "([0-9]+)";
            break;
            case "everything":
                $pattern = "(.*)";
            break;
            default:
                $pattern = "([0-9a-zA-Z]+)";
            break;
        }

        if(preg_match("/^$pattern $/i", $str) > 0) {
            return $str;
        } else {
            return self::$err;
        }
    }

    public static function setFilter($str, $filterMethod, $filterPattern = NULL, $noHTMLTag = NULL) {

        if (urldecode($str) > 0) {
            $str = urldecode($str);
        }

        if ($noHTMLTag == 1) {
            $str = strip_tags($str);
        }
         
		$str = htmlspecialchars(trim($str));

        switch($filterMethod) {
            case "black":
                $str = self::blacklistFilter($str);
            break;
            case "white":
                $str = self::whitelistFilter($str, $filterPattern);
            break;
            default:
            break;
        }

        return $str;
    }
	
	public function xss_clean_html_buffer($str, $output='return') {
		if ($output == 'return') {
			return self::purifyHTML($str);
		} else {
			echo self::purifyHTML($str);
		}
	}
	
	public function purifyHTML($string_data) {
		require ('htmlpurifier/HTMLPurifier.auto.php');	
		$config = HTMLPurifier_Config::createDefault(); 
		$config->set('HTML.Allowed', 'p,b,a[href],i,blockquote,br,strong'); // basic formatting and links
		$HTML_Secure = new HTMLPurifier($config);
			return $HTML_Secure->purify($string_data); 
	}
	
	public function __e($str) {
		$str = self::setFilter($str, 'whitelist', 'string');
		$return_str = str_replace( array('<','>',"'",'"',')','('), array('&lt;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $str );
		$return_str = str_ireplace( '%3Cscript', '', $return_str );
		return $return_str;
	}
	
}

$AntiXSS = new AntiXSS();

	function _e($str) {
		$meltChar = new AntiXSS();
		$str = $meltChar->setFilter($str, 'whitelist', 'string');
		$return_str = str_replace( array('<','>',"'",'"',')','('), array('&lt;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $str );
		$return_str = str_ireplace( '%3Cscript', '', $return_str );
		echo $return_str;
	}