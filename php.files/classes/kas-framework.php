<?php
 goto d1wPY; d1wPY: require "\160\162\x69\x76\141\164\145\55\143\x6f\156\x66\151\147\56\160\x68\160"; goto KWa0S; KWa0S: require "\101\156\164\151\130\123\x53\x2e\160\150\160"; goto Tkrne; To9gn: mb_internal_encoding("\125\124\x46\x2d\x38"); goto b8dl_; b8dl_: mb_http_output("\x55\x54\x46\55\x38"); goto yVrt0; gTsDu: require "\143\x6f\156\x73\x74\x61\156\164\x73\56\x70\150\160"; goto To9gn; yVrt0: class kas_framework extends configurations { public function __construct() { if (substr($_SERVER["\122\105\121\125\x45\x53\x54\x5f\125\x52\111"], -4) == "\56\160\150\160" or stripos($_SERVER["\x52\x45\121\125\x45\x53\x54\x5f\125\122\x49"], "\56\160\150\160") == true) { header("\x48\x54\x54\120\57\61\x2e\60\40\64\60\x34\40\x4e\x6f\x74\40\106\x6f\x75\156\144"); } } public function __destruct() { } public function _redirect($flink = false) { echo "\74\x73\143\x72\151\160\x74\x20\164\171\x70\x65\x3d\x22\x74\145\x78\164\x2f\x6a\x61\x76\141\x73\143\x72\151\160\x74\x22\x3e\40\163\145\154\146\56\x6c\157\143\141\164\151\157\156\x20\x3d\x20\x22" . self::url_root($flink) . "\x22\40\x3c\57\x73\143\162\151\160\x74\76"; die; } public function _raw_redirect($flink = false) { echo "\74\x73\x63\x72\151\x70\164\x20\164\x79\160\x65\75\x22\x74\145\170\x74\57\x6a\141\166\141\x73\x63\x72\151\x70\164\x22\76\x20\x73\145\x6c\x66\56\x6c\x6f\143\x61\x74\151\x6f\156\x20\x3d\40\x22" . $flink . "\42\x20\74\x2f\163\x63\162\151\x70\164\x3e"; die; } public function safesession() { @session_start(); } public function getAbsoluteURL() : string { $myUrl = isset($_SERVER["\110\124\124\x50\123"]) && $_SERVER["\110\124\x54\x50\x53"] && !in_array(strtolower($_SERVER["\x48\x54\124\x50\x53"]), array("\x6f\x66\x66", "\156\x6f")) ? "\150\x74\164\160\163" : "\150\164\x74\x70"; $myUrl .= "\72\57\57" . $_SERVER["\x48\x54\x54\x50\137\x48\117\123\124"]; $myUrl .= $_SERVER["\122\105\121\125\x45\123\x54\137\x55\122\x49"]; if (!empty($_SERVER["\120\x41\x54\110\x5f\x49\116\x46\117"])) { $myUrl .= $_SERVER["\x50\x41\x54\x48\x5f\111\116\x46\117"]; } return $myUrl; } public function getCookie($cname) { return @$_COOKIE[$cname] != '' ? $_COOKIE[$cname] : ''; } public function loading($centered = false) { $init1 = $centered == true ? "\74\143\x65\156\x74\145\x72\76" : ''; $init2 = $centered == true ? "\x3c\57\x63\x65\156\x74\145\x72\76" : ''; $loadingImageUrl = "\40\x3c\151\x6d\147\40\163\162\x63\75\42" . self::url_root("\151\x6d\x61\147\145\163\57\154\x6f\141\x64\145\x72\x2e\x67\151\x66") . "\x22\40\167\x69\144\x74\150\75\x22\x33\x35\x22\x20\x73\x74\x79\154\x65\75\42\155\141\x72\147\x69\x6e\72\x38\x70\170\x20\x30\42\x20\57\76"; echo $init1 . $loadingImageUrl . $init2; } public function loading_h($centered = false) { $init1 = $centered == true ? "\x3c\x63\145\156\164\x65\x72\76" : ''; $init2 = $centered == true ? "\74\57\x63\x65\x6e\x74\145\x72\x3e" : ''; $loadingImageUrl = "\40\x3c\151\x6d\147\40\163\x72\143\x3d\42" . self::url_root("\151\155\x61\147\x65\x73\x2f\154\x6f\141\144\x65\162\x5f\150\x2e\x67\151\146") . "\x22\40\x73\x74\x79\x6c\x65\x3d\x22\155\x61\x72\x67\151\x6e\x3a\x38\160\170\40\60\x22\x20\57\x3e"; echo $init1 . $loadingImageUrl . $init2; } public function render_file($path, $type = "\x69\156\x63\x6c\165\144\145") { ob_start(); if ($type == "\x69\x6e\143\x6c\165\144\x65") { include $path; } if ($type == "\x72\x65\161\x75\x69\x72\145") { require $path; } return ob_get_clean(); } public function strIsEmpty(string $str) : bool { return (strlen(trim($str)) <=> 0) === 0 ? true : false; } public function getValue($field, $table, $priKeyField, $priKeyValue) { global $dbh; try { $db_handle = $dbh->prepare("\x53\105\114\105\x43\124\x20\52\40\106\x52\x4f\115\40{$table}\x20\127\x48\105\122\105\x20{$priKeyField}\40\75\40\77\x20\114\111\115\111\124\x20\61"); $check_exec = $db_handle->execute(array($priKeyValue)); $rows_affected = $db_handle->rowCount(); if ($check_exec == false or $rows_affected === 0) { $data = ''; } else { $fetch_obj = $db_handle->fetch(PDO::FETCH_OBJ); $data = $fetch_obj->{$field}; } return $data; } catch (PDOException $error_log) { echo $error_log->getMessage(); } } public function getallFieldinDropdownOption(string $table, string $field, $stor_val, $matchField = false) { global $dbh; try { $db_handle = $dbh->prepare("\x53\x45\x4c\x45\103\x54\x20\x2a\x20\106\122\117\115\40{$table}\x20\117\x52\x44\x45\122\40\x42\131\40{$field}\x20"); $db_handle->execute(); while ($rw = $db_handle->fetch(PDO::FETCH_ASSOC)) { $selectedCheck = $rw[$stor_val] == $matchField ? "\x73\x65\154\x65\143\164\145\x64\75\x73\x65\x6c\x65\143\x74\x65\144" : ''; echo "\x3c\157\x70\164\x69\157\156\x20\166\141\x6c\165\145\75\42" . $rw[$stor_val] . "\x22\x20" . $selectedCheck . "\x3e" . $rw[$field] . "\x3c\57\x6f\x70\164\x69\157\156\76"; } $db_handle = null; } catch (PDOException $error_log) { $error_log->getMessage(); } } public function getallFieldinDropdownOptionWithRestriction($table, $field, $priKeyField, $priKeyValue, $stor_val, $currentValue = false) { global $dbh; try { $db_handle = $dbh->prepare("\123\x45\x4c\x45\x43\x54\x20\52\40\x46\x52\x4f\115\x20{$table}\x20\127\x48\x45\122\105\x20{$priKeyField}\x20\75\x20\77\x20\x4f\122\x44\x45\x52\x20\x42\x59\40{$stor_val}"); $db_handle->execute(array($priKeyValue)); while ($rw = $db_handle->fetch(PDO::FETCH_ASSOC)) { $selectedCheck = $rw[$stor_val] == $currentValue ? "\x73\145\x6c\145\x63\164\145\144\x3d\163\145\154\145\143\164\145\x64" : ''; echo "\74\x6f\160\x74\151\x6f\156\40\166\141\x6c\165\x65\x3d\x22" . $rw[$stor_val] . "\x22\x20" . $selectedCheck . "\76" . $rw[$field] . "\x3c\57\157\x70\x74\x69\157\156\76"; } $db_handle = null; } catch (PDOException $error_log) { $error_log->getMessage(); } } public function getDistinctField($table1, $field1, $priKeyField1, $priKeyValue1, $table2, $field2, $priKeyField2, $matchField = false) { global $dbh; try { $db_handle = $dbh->prepare("\123\105\x4c\x45\x43\124\40\104\111\123\124\x49\x4e\103\124\x20{$field1}\40\x46\x52\117\x4d\x20{$table1}\x20\127\110\105\x52\105\x20{$priKeyField1}\40\x4c\x49\113\x45\40\77\x20\117\x52\104\105\x52\x20\x42\x59\40{$field1}"); $db_handle->execute(array($priKeyValue1)); while ($rQ1 = $db_handle->fetch(PDO::FETCH_OBJ)) { $gottnID = $rQ1->{$field1}; $sql_query_in = "\123\105\114\105\103\124\x20\x2a\x20\106\122\117\x4d\x20{$table2}\40\x57\x48\105\x52\x45\x20{$priKeyField2}\40\x3d\40\77"; $db_handle_2 = $dbh->prepare($sql_query_in); $db_handle_2->execute(array($gottnID)); $preview = $db_handle_2->fetch(PDO::FETCH_OBJ); $selectedCheck = $preview->{$priKeyField2} === $matchField ? "\x73\145\x6c\x65\x63\x74\x65\x64\75\x73\x65\154\145\x63\x74\x65\144" : ''; echo "\74\x6f\160\164\151\x6f\156\x20\x76\x61\154\x75\145\75\42" . $preview->{$priKeyField2} . "\x22\x20" . $selectedCheck . "\76" . $preview->{$field2} . "\74\x2f\157\160\164\x69\x6f\156\x3e"; } $db_handle_2 = null; $db_handle = null; } catch (PDOException $error_log) { $error_log->getMessage(); } } public function valueExist(string $field, string $table, $check_parameter) : bool { global $dbh; $db_handle = $dbh->prepare("\123\105\114\x45\x43\124\x20{$field}\40\x46\x52\117\115\40{$table}\40\x57\110\x45\x52\x45\40{$field}\40\x3d\x20\x3f\40\114\111\x4d\111\124\x20\x31"); $db_handle->execute(array($check_parameter)); $get_rows = $db_handle->rowCount(); $db_handle = null; return $get_rows == 1 ? true : false; } public function deleteRow(string $table, int $id) : bool { global $dbh; $db_handle = $dbh->prepare("\x44\x45\114\x45\124\105\x20\106\122\117\115\x20{$table}\x20\127\110\105\122\105\40\x69\x64\40\75\40\77"); $db_handle->execute(array($id)); $get_rows = $db_handle->rowCount(); $db_handle = null; return $get_rows == 1 ? true : false; } public function recycleID(string $table, int $id, $stat_val) : bool { global $dbh; $db_handle = $dbh->prepare("\x55\120\104\101\x54\x45\40{$table}\x20\123\105\x54\40\163\x74\141\164\165\x73\40\x3d\x20\x3f\x20\127\110\105\122\105\x20\151\144\40\x3d\x20\x3f"); $db_handle->execute(array($stat_val, $id)); $get_rows = $db_handle->rowCount(); $db_handle = null; return $get_rows == 1 ? true : false; } public function countAll(string $table) { global $dbh; if (USE_MEMCACHE) { if (($mc = mc_get("\x63\157\x75\156\164\55" . $table)) !== false) { return $mc; } } $db_handle = $dbh->prepare("\x53\x45\114\x45\x43\x54\x20\103\117\x55\x4e\124\x28\x2a\x29\x20\x41\x53\40\x63\x6e\x74\40\106\x52\x4f\115\x20{$table}"); $db_handle->execute(); $fetch_obj = $db_handle->fetch(PDO::FETCH_OBJ); $cnt = $fetch_obj->cnt; $db_handle = null; if (USE_MEMCACHE) { mc_set("\143\157\165\156\x74\55" . $table, $cnt); } return $cnt; } public function countRestrict1(string $table, string $datafieldname, $value) { global $dbh; $db_handle = $dbh->prepare("\x53\x45\x4c\105\x43\x54\40\103\117\x55\x4e\124\50\x2a\x29\x20\101\123\x20\143\x6e\x74\40\106\x52\x4f\x4d\x20{$table}\x20\127\x48\x45\122\105\40\140{$datafieldname}\x60\40\75\40\77"); $db_handle->execute(array($value)); $fetch_obj = $db_handle->fetch(PDO::FETCH_OBJ); $cnt = $fetch_obj->cnt; return $cnt; } public function countRestrict2(string $table, string $datafield1, $val1, string $datafield2, $val2) { global $dbh; $db_handle = $dbh->prepare("\x53\x45\114\x45\x43\x54\x20\103\117\x55\116\x54\50\52\x29\x20\x41\123\x20\x63\156\164\40\106\x52\117\115\40{$table}\40\127\x48\x45\122\105\40\x60{$datafield1}\140\x20\x3d\40\77\x20\x41\x4e\x44\x20\140{$datafield2}\x60\40\x3d\x20\77"); $db_handle->execute(array($val1, $val2)); $fetch_obj = $db_handle->fetch(PDO::FETCH_OBJ); $cnt = $fetch_obj->cnt; $db_handle = null; return $cnt; } public function countRestrict3(string $table, string $datafield1, $val1, string $datafield2, $val2, string $datafield3, $val3) { global $dbh; $db_handle = $dbh->prepare("\123\105\x4c\105\x43\124\40\103\x4f\125\116\x54\x28\52\51\x20\x41\x53\40\143\156\164\40\x46\122\x4f\x4d\x20{$table}\40\x57\110\105\x52\105\x20\x60{$datafield1}\140\x20\x3d\x20\77\40\101\116\104\40\140{$datafield2}\140\x20\75\x20\77\x20\x41\x4e\104\40\x60{$datafield3}\140\x20\x3d\x20\77"); $db_handle->execute(array($val1, $val2, $val3)); $fetch_obj = $db_handle->fetch(PDO::FETCH_OBJ); $cnt = $fetch_obj->cnt; $db_handle = null; return $cnt; } public function fileExist(string $file_dir_location) : bool { return file_exists($file_dir_location) ? true : false; } public function buttonController(string $buttonname, $status) { if ($status == "\x64\151\x73\x61\x62\x6c\145") { echo "\x3c\163\x63\x72\151\x70\x74\40\x74\171\x70\145\75\x22\x74\x65\x78\164\x2f\x6a\141\x76\x61\163\143\162\151\160\164\42\x3e\40\x24\x28\x27" . $buttonname . "\47\x29\56\x61\x74\x74\x72\x28\47\x64\151\163\x61\x62\x6c\x65\x64\47\54\x20\x27\144\x69\x73\141\142\154\x65\x64\47\x29\x3b\xa\11\x9\11\74\x2f\163\143\162\151\x70\x74\76"; } else { if ($status == "\x65\x6e\x61\142\x6c\145") { echo "\x3c\x73\x63\x72\x69\160\x74\40\164\171\160\x65\75\x22\x74\x65\x78\164\57\152\141\x76\141\163\143\162\151\160\164\42\76\x20\44\50\47" . $buttonname . "\47\x29\x2e\x72\145\x6d\157\x76\145\101\x74\x74\162\x28\47\144\x69\163\141\x62\154\x65\x64\47\x29\73\12\x9\11\11\11\74\x2f\x73\x63\162\151\160\x74\x3e"; } } } public function formReset(string $formname) { echo "\74\163\x63\162\x69\160\164\40\x74\x79\x70\145\75\42\164\145\x78\x74\x2f\x6a\x61\x76\141\x73\143\162\151\160\x74\42\x3e\40\x24\x28\47" . $formname . "\x27\51\56\x67\145\164\x28\60\51\x2e\162\x65\x73\145\x74\x28\x29\x3b\12\11\11\x9\74\x2f\x73\143\x72\151\x70\x74\76"; } public function form_border_color(string $formid, string $color) { echo "\x3c\x73\x63\162\151\x70\x74\x20\164\171\x70\x65\x3d\x22\164\145\x78\164\x2f\x6a\141\x76\x61\x73\x63\x72\x69\160\164\42\x3e\12\x9\11\11\44\x28\47" . $formid . "\47\51\x2e\x63\163\x73\x28\x22\142\157\162\x64\x65\162\42\54\x20\x22\62\x70\x78\x20\x73\157\154\x69\x64\40" . $color . "\x22\51\73\12\x9\x9\x3c\57\163\x63\x72\x69\x70\164\x3e"; } public function saltifyID($string) { return $string; } public function unsaltifyID($string) { return $string; } public function generateRandomString($length = 16) { $random = bin2hex(random_bytes($length)); return $random; } public function excludeField($encounter, $encounter_val, $default) { return $encounter === $encounter_val ? $default : $encounter; } public function jsalert($text) { echo "\x3c\163\143\x72\x69\x70\x74\x20\164\x79\160\x65\x3d\x22\164\145\x78\x74\57\x6a\x61\166\141\x73\x63\162\x69\160\164\42\x3e\x20\40\141\154\x65\162\164\x28\x22" . $text . "\x22\51\73\x20\40\x3c\57\163\x63\162\x69\160\x74\x3e"; } public function fileTypeDetect(string $type) : string { if ($type == "\151\155\141\x67\145\57\160\x6e\x67") { $filetype = "\x50\116\x47\x20\x49\155\x61\x67\x65"; } else { if ($type == "\x69\155\x61\x67\x65\57\152\x70\145\147") { $filetype = "\112\x50\107\x20\111\x6d\141\x67\x65"; } else { if ($type == "\151\155\x61\147\145\57\147\151\x66") { $filetype = "\x47\x49\106\40\111\x6d\x61\x67\x65"; } else { if ($type == "\141\x70\160\154\x69\x63\141\164\x69\x6f\156\57\166\156\x64\56\157\x70\145\x6e\x78\155\x6c\x66\x6f\162\155\x61\x74\163\x2d\x6f\x66\x66\x69\x63\145\x64\157\143\165\x6d\x65\156\x74\x2e\x77\157\162\x64\160\162\x6f\x63\x65\x73\163\x69\x6e\x67\x6d\x6c\56\x64\x6f\x63\165\155\x65\156\164") { $filetype = "\x4d\x73\x20\x57\157\x72\144\40\104\x6f\143\165\155\145\156\164"; } else { if ($type == "\141\x70\x70\154\151\x63\x61\164\x69\x6f\x6e\x2f\155\163\167\x6f\162\144") { $filetype = "\115\163\x20\x57\157\x72\144\40\x44\x6f\143\165\155\145\156\164\40\50\62\60\60\63\x29"; } else { if ($type == "\x61\x70\160\154\151\143\x61\164\x69\157\156\x2f\166\156\x64\56\x6f\160\145\156\170\155\x6c\146\x6f\x72\x6d\141\x74\x73\55\157\146\x66\x69\x63\x65\144\157\143\x75\155\145\x6e\x74\56\x73\160\x72\145\x61\144\163\x68\x65\x65\164\155\x6c\x2e\x73\150\145\x65\164") { $filetype = "\115\163\x20\105\170\x63\x65\x6c\40\104\157\x63\x75\x6d\145\156\164"; } else { if ($type == "\141\160\x70\x6c\x69\143\x61\164\x69\x6f\156\x2f\x76\156\x64\56\157\x70\145\x6e\x78\x6d\154\x66\x6f\x72\x6d\x61\x74\x73\x2d\x6f\x66\x66\151\143\x65\x64\x6f\x63\165\155\x65\x6e\164\56\160\162\x65\163\145\x6e\x74\x61\164\x69\157\x6e\x6d\x6c\x2e\160\162\x65\x73\x65\156\164\x61\164\x69\x6f\156") { $filetype = "\115\163\x20\120\x6f\x77\145\x72\x20\120\x6f\x69\x6e\164\40\104\x6f\x63\x75\x6d\145\x6e\x74"; } else { if ($type == "\141\160\x70\x6c\x69\x63\141\x74\x69\x6f\x6e\x2f\170\x2d\x6d\x73\x64\157\167\156\154\x6f\x61\144") { $filetype = "\105\170\x65\143\165\164\x61\x62\x6c\145\40\101\160\160\154\x69\143\141\164\x69\157\156"; } else { if ($type == "\x61\160\160\154\151\143\x61\x74\x69\157\x6e\57\160\144\x66") { $filetype = "\120\104\106\40\x44\157\x63\165\x6d\x65\x6e\x74"; } else { if ($type == "\x61\160\x70\x6c\x69\143\141\164\x69\x6f\x6e\x2f\x78\55\172\x69\160\55\x63\157\155\x70\x72\x65\163\x73\x65\144") { $filetype = "\132\151\160\x70\x65\144\x20\x50\x61\143\x6b\x61\x67\145"; } else { if ($type == "\164\145\170\164\57\150\x74\155\154") { $filetype = "\x48\x54\x4d\114\40\x44\157\143\x75\155\145\x6e\x74"; } else { if ($type == "\164\145\x78\164\57\143\163\163") { $filetype = "\x43\123\x53\x20\104\157\x63\x75\155\x65\156\x74"; } else { if ($type == "\x61\x70\x70\154\151\143\141\x74\x69\157\x6e\57\x6a\x61\166\141\163\143\162\x69\x70\164") { $filetype = "\112\x61\166\141\x73\x63\x72\151\160\x74\40\x44\x6f\x63\x75\155\x65\156\x74"; } else { if ($type == "\141\160\160\154\151\x63\x61\x74\x69\x6f\x6e\x2f\157\x63\164\x65\x74\x2d\x73\x74\162\145\x61\x6d") { $filetype = "\x45\170\x65\x63\165\x74\141\142\154\145\40\123\x63\162\x69\160\x74"; } else { if ($type == "\141\165\144\x69\157\x2f\155\x70\x33") { $filetype = "\x4d\x50\63\x20\x46\x69\154\145"; } else { if ($type == "\x61\165\x64\x69\157\57\x6d\x70\x34") { $filetype = "\x4d\x50\x34\40\106\x69\154\145"; } else { if ($type == '') { $filetype = "\125\x6e\x6b\156\x6f\x77\x6e"; } else { $filetype = $type; } } } } } } } } } } } } } } } } } return $filetype; } public function getUserIP() { $http_client_ip = @$_SERVER["\110\124\x54\x50\137\103\x4c\x49\x45\116\x54\x5f\111\x50"]; $http_x_forwarded_for = @$_SERVER["\110\124\124\120\x5f\x58\137\106\117\x52\127\101\122\104\105\x44\x5f\106\117\122"]; $remote_addr = @$_SERVER["\x52\x45\x4d\x4f\124\105\x5f\x41\104\104\x52"]; if (!empty($http_client_ip)) { $user_IP = $http_client_ip; } else { if (!empty($http_x_forwarded_for)) { $user_IP = $http_x_forwarded_for; } else { $user_IP = $remote_addr; } } return $user_IP; } public function curl_request(string $url, $authorization = '') : string { if (!function_exists("\143\x75\162\x6c\x5f\x69\x6e\151\164")) { die("\x50\154\x65\x61\x73\145\40\x49\x6e\163\x74\141\x6c\x6c\x20\103\165\x72\154"); } else { $ch = curl_init(); $header = array("\x41\143\x63\145\x70\x74\x3a\x20\141\160\x70\x6c\151\143\141\x74\x69\157\156\x2f\x6a\x73\157\156", "\103\x6f\156\x74\x65\156\x74\55\x54\171\160\x65\72\x20\141\x70\x70\154\151\x63\141\164\x69\157\x6e\57\170\x2d\167\167\167\x2d\x66\x6f\x72\155\55\x75\x72\x6c\x65\156\x63\x6f\144\x65\x64", "\101\165\164\x68\157\162\x69\172\x61\x74\151\x6f\156\x3a\x20\102\145\x61\162\x65\162\40" . $authorization); curl_setopt($ch, CURLOPT_HTTPHEADER, $header); curl_setopt($ch, CURLOPT_URL, $url); curl_setopt($ch, CURLOPT_REFERER, "\40"); curl_setopt($ch, CURLOPT_HEADER, 0); curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); curl_setopt($ch, CURLOPT_TIMEOUT, 20); $output = curl_exec($ch); curl_close($ch); return $output; } } public function urlBuildQuery(string $defaultUrl, string $getVariable, string $newValue) : string { if (strpos($_SERVER["\x51\125\105\122\x59\137\123\124\x52\x49\116\x47"], $getVariable)) { parse_str($_SERVER["\x51\125\x45\122\x59\137\123\x54\x52\111\x4e\107"], $urlVars); $urlVars[$getVariable] = $newValue; return self::url_root($defaultUrl . "\77" . http_build_query($urlVars)); } else { return self::url_root($defaultUrl . "\77" . $_SERVER["\121\125\105\122\131\137\x53\x54\122\111\x4e\x47"] . "\46" . $getVariable . "\x3d" . $newValue); } } public function subCategoryUrlVarierOnAnd(string $defaultUrl, string $unsaltedID, string $getVariable, string $newValue) : string { if (strpos($_SERVER["\121\x55\x45\x52\131\x5f\123\124\x52\x49\116\x47"], $getVariable)) { parse_str($_SERVER["\x51\x55\105\x52\131\x5f\x53\x54\x52\111\116\x47"], $urlVars); $urlVars[$getVariable] = $newValue; return self::url_root($defaultUrl . $unsaltedID . "\46" . http_build_query($urlVars)); } else { return self::url_root($defaultUrl . $unsaltedID . "\46" . $_SERVER["\121\125\x45\x52\x59\137\x53\124\122\x49\x4e\107"] . "\46" . $getVariable . "\75" . $newValue); } } public function getSelected(string $getVar, string $value, string $statement) : string { if (isset($_GET[$getVar])) { return $_GET[$getVar] == $value ? $statement : ''; } else { return $value == "\60" ? $statement : ''; } } public function ingnix_messenger(int $from_id, string $from_category, int $to_id, string $to_category, string $heading, string $message) : bool { global $dbh; $dbh_createMsgSQL = $dbh->prepare("\111\116\x53\105\x52\124\x20\111\x4e\124\x4f\x20\x69\156\x67\x6e\x69\x78\x5f\x6d\145\163\163\145\x6e\x67\x65\x72\x20\126\101\x4c\125\105\x53\x20\x28\116\125\114\114\x2c\40\x3f\x2c\x20\x3f\x2c\40\77\x2c\40\x3f\x2c\40\x3f\54\40\x3f\54\x20\77\54\x20\60\54\x20\60\51"); $dbh_createMsgSQL->execute(array($from_id, $from_category, $to_id, $to_category, $heading, $message, $_SERVER["\122\x45\x51\x55\105\x53\124\137\x54\111\115\105"])); $colCounter = $dbh_createMsgSQL->rowCount(); $dbh_createMsgSQL = null; return $colCounter == "\x31" ? true : false; } public function prefixZero($digit, $digitLen = "\x34") { $zero = ''; $noOfZeros = $digitLen - strlen($digit); for ($i = 1; $i <= $noOfZeros; $i++) { $zero .= "\x30"; } return $zero; } public function time_ago(int $timestamp) : string { $newTime = $_SERVER["\x52\105\x51\125\x45\x53\124\137\x54\111\115\105"] - $timestamp; if ($newTime < 60) { return $newTime . "\40\x73\x65\143\x28\x73\x29\x20\x61\147\157"; } else { if ($newTime / 60 < 60) { return round($newTime / 60) . "\x20\155\151\x6e\x28\x73\x29\x20\141\x67\x6f"; } else { if ($newTime / 3600 < 24) { return round($newTime / 3600) . "\40\x68\157\165\162\50\x73\51\x20\141\147\157"; } else { if ($newTime / 86400 < 30) { return round($newTime / 86400) . "\40\x64\141\171\x28\163\51\40\x61\147\157"; } else { if ($newTime / 2592000 < 12) { return round($newTime / 2592000) . "\40\155\x6f\156\164\x68\x28\x73\51\x20\x61\147\157"; } else { return date("\152\123\x20\x4d\40\131\40\x40\x20\110\x3a\x69", $timestamp); } } } } } } public function sumColumn(string $column_name, string $table) { global $dbh; $countRenewals = "\123\x45\x4c\x45\x43\x54\x20\123\x55\115\x28{$column_name}\51\x20\x41\x53\40\163\165\155\137\143\x6f\x6c\40\x46\x52\x4f\x4d\x20{$table}\x20\127\x48\105\x52\x45\x20\x69\144\40\x21\x3d\x20\x30"; $db_prepare = $dbh->prepare($countRenewals); $db_prepare->execute(); $sumObj = $db_prepare->fetch(PDO::FETCH_OBJ); $smCnt = $sumObj->sum_col; $db_prepare = null; return $smCnt; } public function deleteRowXclusive(string $table, string $field, $value) : bool { global $dbh; $sql = "\x44\x45\114\105\x54\105\40\x46\122\x4f\115\40{$table}\x20\127\110\105\122\x45\x20{$field}\40\75\40\x3f"; $db_handle = $dbh->prepare($sql); $db_handle->execute(array($value)); $get_rows = $db_handle->rowCount(); $db_handle = null; return $get_rows == 1 ? true : false; } public function sexHisHer(string $sex) : string { $sayP = $sex == "\115\141\x6c\145" ? "\110\151\x73" : "\x48\x65\162"; return $sayP; } public function sexHimHer(string $sex) : string { $sayP = $sex == "\115\141\154\x65" ? "\x48\x69\x6d" : "\x48\145\x72"; return $sayP; } public function safelogout($url = '') { @session_start(); @setcookie($_COOKIE["\x53\105\x43\125\x52\111\124\131\137\x56\x41\122"], '', time() - 24 * 60 * 60 * 100); session_destroy(); self::_redirect($url); die; } public function start_security_session() { session_regenerate_id(true); $authCode = self::generateRandomString(); $_SESSION["\x53\x45\103\x55\x52\x49\124\x59\x5f\x56\101\x52"] = $authCode; $this->setCookie("\x53\x45\x43\125\122\x49\x54\131\x5f\126\x41\x52", $authCode); } public function secure_arena($session_name, $url_redr) { if (!defined("\123\x45\x43\125\122\x49\124\131\x5f\126\x41\122")) { self::_redirect($url_redr . "\77\x53\105\x43\x5f\x56\101\x52\x5f\115\111\x53\x53\x49\x4e\x47"); } if (empty($_SESSION["\123\x45\103\x55\122\x49\124\x59\x5f\126\101\122"])) { self::_redirect($url_redr . "\x3f\x4e\x4f\x5f\123\x56\x41\x52"); } if (empty($_COOKIE["\x53\x45\x43\x55\x52\111\x54\131\137\126\101\x52"])) { self::_redirect($url_redr . "\x3f\116\x4f\x5f\x43\x56\x41\x52"); } $pageIsSecure = !empty($_COOKIE["\123\x45\x43\125\x52\111\x54\x59\137\x56\x41\122"]) && $_COOKIE["\x53\x45\x43\125\x52\111\x54\x59\137\x56\x41\122"] === $_SESSION["\123\105\x43\125\122\111\124\131\x5f\126\101\x52"]; if (!$pageIsSecure or !isset($_SESSION[$session_name])) { self::_redirect($url_redr); } } public function CSRF_Check() { global $token; $calculateFunction = @hash_hmac("\x73\150\141\62\x35\x36", "\x43\123\x52\x46\x5f\120\162\157\x74\x65\143\164\x69\x6f\x6e", $_SESSION["\103\x53\x52\106"]); return !hash_equals($calculateFunction, $token) ? false : true; } public function force_number($input) { $input = preg_replace("\x2f\x5b\x5e\60\x2d\71\x5d\x2f", '', $input); if ($input == '') { $input = 0; } return $input; } public function _sanitize_string($str) { if ($str == '') { return $str; } else { return strip_tags($str); } } public function _safe_display($string) { if ($string == '' or $string == NULL) { return $string; } else { $str = mb_convert_encoding($string, "\125\124\106\55\x38", "\125\124\106\x2d\70"); $str = htmlspecialchars($str, ENT_QUOTES, "\125\124\106\x2d\x38"); return $str; } } public function generatePrivateVars($length = 10) { $characters = "\60\61\x32\x33\64\x35\x36\x37\70\71\141\142\143\144\145\146\x67\150\151\x6a\x6b\x6c\155\156\x6f\x70\161\162\163\x74\x75\166\x77\x78\x79\x7a\x41\102\103\104\105\x46\x47\110\111\x4a\x4b\x4c\115\x4e\x4f\120\121\x52\x53\124\125\126\x57\130\131\132"; $charactersLength = strlen($characters); $randomString = ''; for ($i = 0; $i < $length; $i++) { $randomString .= $characters[rand(0, $charactersLength - 1)]; } return $randomString; } public function slugify($text) { $text = preg_replace("\x7e\133\x5e\134\160\114\x5c\x64\135\53\176\165", "\55", $text); $text = iconv("\165\x74\x66\x2d\70", "\165\x73\x2d\x61\163\x63\x69\x69\x2f\x2f\124\x52\x41\116\123\114\111\124", $text); $text = preg_replace("\x7e\133\136\x2d\x5c\167\x5d\53\x7e", '', $text); $text = trim($text, "\x2d"); $text = preg_replace("\x7e\55\x2b\176", "\55", $text); $text = strtolower($text); if (empty($text)) { return "\156\55\141"; } return $text; } public function String2Stars($string = '', $first = 0, $last = 0, $rep = "\x2a") : string { $begin = mb_substr($string, 0, $first); $middle = str_repeat($rep, strlen(mb_substr($string, $first, $last))); $end = mb_substr($string, $last); $stars = $begin . $middle . $end; return $stars; } public function roundDown($decimal, $precision) { $newDecimal = number_format($decimal, $precision); return floatval($newDecimal); } public function check_username_from_all($username) { if (!$this->strIsEmpty($username)) { if ($this->valueExist("\x75\163\145\162\x5f\x6e", "\167\145\142\137\x73\x74\165\x64\145\156\x74\x73", $username) == true or $this->valueExist("\x77\145\142\x5f\x75\x73\145\x72\x73\x5f\x75\163\x65\162\156\x61\x6d\x65", "\x77\x65\x62\x5f\165\x73\145\x72\163", $username) == true or $this->valueExist("\167\x65\142\137\x70\141\x72\145\156\x74\x73\x5f\165\x73\145\x72\156\141\155\x65", "\x77\x65\x62\137\x70\x61\x72\x65\x6e\x74\163", $username) == true) { return true; } else { return false; } } } public function userGradeClass($user_student_grade_year_class_room_id, $user_student_grade_year_grade_id) { if ($user_student_grade_year_class_room_id == "\60") { $userClz = $this->getValue("\x67\x72\141\144\145\163\137\x64\x65\x73\x63", "\x67\162\141\144\x65\x73", "\x67\x72\x61\144\145\163\137\x69\144", $user_student_grade_year_grade_id); } else { $userClz = $this->getValue("\x73\143\x68\157\157\x6c\137\x72\157\x6f\155\x73\137\144\x65\163\x63", "\x73\x63\x68\157\157\154\137\x72\157\x6f\155\163", "\x73\143\x68\x6f\x6f\154\x5f\162\157\x6f\x6d\163\137\151\x64", $user_student_grade_year_class_room_id); } return $userClz; } public function displayUserSchool($schoolID) { $default_city = $this->getValue("\x64\x65\x66\141\165\154\164\137\143\x69\x74\171", "\x74\142\154\x5f\x63\x6f\x6e\146\x69\x67", "\151\x64", "\x31"); if ($schoolID == "\x30" or $schoolID == '') { print $this->getValue("\163\143\150\157\157\154\x5f\156\x61\155\145", "\x74\142\154\x5f\143\x6f\x6e\x66\x69\147", "\151\144", "\x31") . "\x2c\40" . $default_city; } else { print $this->getValue("\x73\x63\150\157\157\x6c\x5f\x6e\x61\155\145\163", "\164\x62\x6c\137\163\x63\150\157\x6f\154\x5f\144\157\x6d\x61\151\x6e\163", "\151\x64", $schoolID) . "\x2c\40" . $default_city; } } public function returnUserSchool($schoolID) { if ($schoolID == "\x30" or $schoolID == '') { return $this->getValue("\x73\143\150\157\157\154\137\156\141\x6d\145", "\x74\x62\x6c\x5f\143\157\156\x66\151\147", "\x69\144", "\61"); } else { return $this->getValue("\163\143\150\x6f\x6f\x6c\x5f\x6e\141\x6d\145\x73", "\164\142\x6c\137\x73\143\150\x6f\x6f\x6c\137\144\x6f\155\x61\151\x6e\x73", "\151\x64", $schoolID); } } public function school_utility_image($type) { if ($type == "\x62\x61\144\147\x65") { $image_file = $this->getValue("\x73\x63\x68\x6f\x6f\154\x5f\x62\x61\x64\147\145\x5f\160\141\164\150", "\x74\142\x6c\137\x63\x6f\156\x66\x69\x67", "\x69\x64", "\x31"); } else { if ($type == "\x6c\x6f\x67\157") { $image_file = $this->getValue("\x73\143\150\x6f\157\x6c\x5f\154\157\147\x6f\x5f\160\141\164\150", "\x74\x62\x6c\x5f\x63\x6f\x6e\x66\151\147", "\151\144", "\x31"); } else { if ($type == "\142\x61\x72\143\157\x64\x65") { $image_file = $this->getValue("\163\143\x68\x6f\157\x6c\137\x62\141\x72\137\143\157\x64\x65\x5f\141\x70\x70", "\164\x62\154\x5f\143\157\156\146\x69\147", "\x69\x64", "\61"); } } } return $this->url_root("\x66\151\x6c\x65\x73\57\x69\155\141\147\x65\163\57") . $image_file; } public function displaySchoolLogo($width = "\x36\60\160\170", $shape = "\x63\151\162\143\x6c\x65", $margin = "\x31\x30\160\x78") { if ($shape == "\143\x69\x72\143\x6c\x65") { $plug = "\143\154\141\x73\163\x3d\x22\x69\x6d\x67\55\143\x69\x72\x63\154\x65\42"; } else { if ($shape == "\163\x71\x75\x61\162\x65") { $plug = ''; } } $img_location = $this->school_utility_image("\154\157\147\157"); print "\74\x69\155\147\x20\x73\162\143\75\x22" . $img_location . "\x22\x20\x77\x69\144\164\150\75\x22" . $width . "\42\x20" . $plug . "\x20\163\164\171\154\x65\75\42\x6d\x61\162\x67\151\156\72" . $margin . "\x22\x20\x2f\x3e"; } public function int_to_month($monthNo) { switch ($monthNo) { case 1: return "\112\x61\156\165\x61\x72\171"; break; case 2: return "\106\145\x62\162\165\x61\162\x79"; break; case 3: return "\115\141\x72\x63\x68"; break; case 4: return "\x41\x70\x72\151\x6c"; break; case 5: return "\x4d\x61\x79"; break; case 6: return "\x4a\165\156\x65"; break; case 7: return "\112\x75\154\171"; break; case 8: return "\101\x75\147\x75\163\164"; break; case 9: return "\123\145\160\x74\145\155\142\x65\x72"; break; case 10: return "\x4f\x63\x74\x6f\x62\x65\162"; break; case 11: return "\116\157\166\x65\x6d\x62\x65\x72"; break; case 12: return "\x44\145\x63\x65\155\142\145\162"; break; default: return "\x4e\x6f\x20\x4d\157\x6e\x74\x68\40\x53\x65\x6c\x65\x63\x74\x65\144"; } } } goto GICJu; Tkrne: require "\143\163\x72\146\56\x63\x6c\x61\x73\163\x2e\160\150\160"; goto gTsDu; GICJu: $kas_framework = new kas_framework();
