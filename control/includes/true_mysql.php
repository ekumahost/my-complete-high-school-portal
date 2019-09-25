<?php
//*
// true_mysql.php
// Common.  Instantiates actual mysql functionality, bypassing ez_sql.
//*
/*
include_once "configuration.php";



define ('DB_USER', $db_user);
define ('DB_PASSWORD', $db_password);
define ('DB_HOST', $db_server);
define ('DB_NAME', $db_name);

//Make the connection and then select the DB
$dbc= @mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die ('Could not 
connect to data source, error: ' . mysql_error() );
@mysql_select_db (DB_NAME) OR die ('No connection to DB: ' . mysql_error() 
);

// we should  now have a connection to the DB.
//end
*/
?>
