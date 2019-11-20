<?php
 
$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;

$dbh_Query = $dbh->prepare($Query); $dbh_Query->execute(); $fetchObj = $dbh_Query->fetch(PDO::FETCH_OBJ); $dbh_Query = null;

$dbh_Query = $dbh->prepare($Query); $dbh_Query->execute(); $rowCount = $dbh_Query->rowCount(); $dbh_Query = null;

$dbh_Query = $dbh->prepare($Query); $dbh_Query->execute(); $rowCount = $dbh_Query->rowCount(); $fetchObj = $dbh_Query->fetch(PDO::FETCH_OBJ); $dbh_Query = null;

$kas_framework->getallFieldinDropdownOption('table', 'field', 'store_value', $matchField);

$kas_framework->getValue('field', 'table', 'id', $value);


$kas_framework->countRestrict1('table', 'field', $value);

$ezr = $dbh->prepare($queryStr);
$ezr->execute();

//define ('', $);

include_once "../../php.files/classes/kas-framework.php";

//since we dont know the asolute URL and we dont care about it, lets connect our PDO file
(file_exists('../../php.files/classes/pdoDB.php'))? include ('../../php.files/classes/pdoDB.php'): include ('../../../php.files/classes/pdoDB.php');

header ("Location: http://hisp.kastechnet.com/help+faq");

?>