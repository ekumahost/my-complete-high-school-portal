<?php
define('ez_sql', true);// see if this page not included in proper places
include_once "configuration.php";

	// ==================================================================
	//  Author: Okokoh Benjamin (ifihear@gmail.com)
	//	Web: 	http://www.ifihear.com
	//	Name: 	ezSQL
	// 	Desc: 	Class to make it very easy to deal with mySQL database things.

	// User Settings --
	define("EZSQL_DB_USER", $database_user);		// <-- mysql db user
	define("database_pass", $database_pass);		// <-- mysql db password
	define("EZSQL_DB_NAME", $database_db);	// <-- mysql dbname
	define("EZSQL_DB_HOST", $database_host);		// <-- mysql server host

	// ==================================================================
	//	this page Constants
	define("EZSQL_VERSION","1.01");
	define("OBJECT","OBJECT",true);
	define("ARRAY_A","ARRAY_A",true);
	define("ARRAY_N","ARRAY_N",true);

	// ==================================================================
	//	The Main Class
	
	class db {
	
		// ==================================================================
		//	DB Constructor - connects to the server and selects a database
		
		function db($dbuser, $dbpassword, $dbname, $dbhost) {
			global $mysqli;	
			$this->dbh = $mysqli;	
		}
	
		// ==================================================================
		//	Print SQL/DB error.
	
		function print_error($str = "") {
			
			if ( !$str ) $str = mysqli_error($this->dbh);
			//print "ER:10y-".mysqli_error($this->dbh);
		}
	
	
		// ==================================================================
		//	Basic Query	-
		
		function query($query, $output = OBJECT) {
			//improve the query string to make use of the Mysqli Function instead of the MYSQL (Deprecated)
			// Log how the function was called
			$this->func_call = "\$db->query(\"$query\", $output)";		
			
			// Kill this
			$this->last_result = null;
			$this->col_info = null;
	
			// Keep track of the last query for debug..
			$this->last_query = $query;
			
			// Perform the query via std mysqli_query function..
			$this->result = mysqli_query($this->dbh, $query);
	
			if ( mysqli_error($this->dbh) ) 
			{
				
				// If there is an error then take note of it..
				$this->print_error();
	
			}
			else
			{
	
				// In other words if this was a select statement..
				if ( $this->result )
				{
	
					// =======================================================
					// Take note of column info
					
					$i=0;
					while ($i < @mysqli_num_fields($this->result))
					{
						$this->col_info[$i] = @mysqli_fetch_field($this->result);
						$i++;
					}
	
					// =======================================================				
					// Store Query Results
					
					$i=0;
					while ( $row = @mysqli_fetch_object($this->result) )
					{ 
	
						// Store relults as an objects within main array
						$this->last_result[$i] = $row;
						
						$i++;
					}
					
					@mysqli_free_result($this->result);
	
					// If there were results then return true for $db->query
					if ( $i )
					{
						return true;
		
					}
					else
					{
						return false;
					}
	
				}
	
			}
		}
	
		// ==================================================================
		//	Get one variable from the DB 
		
		function get_var($query=null,$x=0,$y=0)
		{
			
			// Log how the function was called
			$this->func_call = "\$db->get_var(\"$query\",$x,$y)";
			
			// If there is a query then perform it if not then use cached results..
			if ( $query )
			{
				$this->query($query);
			}
			
			// Extract var out of cached results based x,y vals
			if ( $this->last_result[$y] )
			{
				$values = array_values(get_object_vars($this->last_result[$y]));
			}
			
			// If there is a value return it else return null
			return @$values[$x]?$values[$x]:null;
		}
	
		// ==================================================================
		//	Get one row from the DB - see docs for more detail
		
		function get_row($query=null,$y=0,$output=OBJECT)
		{
			
			// Log how the function was called
			$this->func_call = "\$db->get_row(\"$query\",$y,$output)";
			
			// If there is a query then perform it if not then use cached results..
			if ( $query )
			{
				$this->query($query);
			}
	
			// If the output is an object then return object using the row offset..
			if ( $output == OBJECT )
			{
				return $this->last_result[$y]?$this->last_result[$y]:null;
			}
			// If the output is an associative array then return row as such..
			elseif ( $output == ARRAY_A )
			{
				return $this->last_result[$y]?get_object_vars($this->last_result[$y]):null;	
			}
			// If the output is an numerical array then return row as such..
			elseif ( $output == ARRAY_N )
			{
				return $this->last_result[$y]?array_values(get_object_vars($this->last_result[$y])):null;
			}
			// If invalid output type was specified..
			else
			{
				$this->print_error(" \$db->get_row(string query,int offset,output type) -- Output type must be one of: OBJECT, ARRAY_A, ARRAY_N ");	
			}
	
		}
	
		// ==================================================================
		//	Function to get 1 column from the cached result set based in X index
	
		function get_col($query=null,$x=0)
		{
			
			// If there is a query then perform it if not then use cached results..
			if ( $query )
			{
				$this->query($query);
			}
			
			// Extract the column values
			for ( $i=0; $i < count($this->last_result); $i++ )
			{
				$new_array[$i] = $this->get_var(null,$x,$i);
			}
			
			return $new_array;
		}
	
		// ==================================================================
		// Return the the query as a result set 
		
		function get_results($query=null, $output = OBJECT)
		{
			
			// Log how the function was called
			$this->func_call = "\$db->get_results(\"$query\", $output)";
			
			// If there is a query then perform it if not then use cached results..
			if ( $query )
			{
				$this->query($query);
			}		
	
			// Send back array of objects. Each row is an object		
			if ( $output == OBJECT )
			{
				return $this->last_result; 
			}
			elseif ( $output == ARRAY_A || $output == ARRAY_N )
			{
				if ( $this->last_result )
				{
					$i=0;
					foreach( $this->last_result as $row )
					{
						
						$new_array[$i] = get_object_vars($row);
						
						if ( $output == ARRAY_N )
						{
							$new_array[$i] = array_values($new_array[$i]);
						}
	
						$i++;
					}
				
					return $new_array;
				}
				else
				{
					return null;	
				}
			}
		}
	
	
		// ==================================================================
		// Function to get column meta data info pertaining to the last query
		
		function get_col_info($info_type="name",$col_offset=-1)
		{
	
			if ( $this->col_info )
			{
				if ( $col_offset == -1 )
				{
					$i=0;
					foreach($this->col_info as $col )
					{
						$new_array[$i] = $col->{$info_type};
						$i++;
					}
					return $new_array;
				}
				else
				{
					return $this->col_info[$col_offset]->{$info_type};
				}
			
			}
			
		}
	
	
	}

// use the new format
$db = new db($database_user, $database_pass, $database_db, $database_host);

?>
