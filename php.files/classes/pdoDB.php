<?php
	/**/
		if (!defined('MC')) {
			define('MC', 1);
			function mc_connect() {
				try {
					$m = new Memcache();
					$m->addServer('unix:///home/sys/memcached.sock', 0);
					return $m;
				} catch (Exception $e) {
					return false;
				}
			}

			function mc_get($key) {
				if (!($mc = mc_connect()))
					return false;

				return $mc->get($key);
			}

			function mc_set($key, $value, $ttl = 60) {
				if (!($mc = mc_connect()))
					return false;

				return $mc->set($key, $value, 0, $ttl);
			}
		}
	
    $dbh = false;
    $database_host = 'localhost';
    $database_user = 'root';
    $database_pass = '';
    $database_db = 'school_portal';
    $database_type = 'mysql';
   
     $dsn = $database_type.":dbname=".$database_db.";host=".$database_host;
        try {
            $dbh = new PDO($dsn, $database_user, $database_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $kas) {
            exit($kas->getMessage());
        }
   
?>