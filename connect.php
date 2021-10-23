<?php 

class mysql{
	private static $connection 	= NULL;
	private static $result 		= NULL;		
	private static $sql 		= NULL;
	private static $error 		= NULL;
	private static $prefix 		= '';
	
	public static function connect(){
		self::$connection = mysqli_connect('localhost', 'root', '', 'trial') or self::debug(mysqli_connect_error());
		return self::$connection;	
	}	

	public static function disconnect(){
		mysqli_close(self::connect());
	}	
		
	public static function select($table, $fields, $where='', $orderby='', $limit=''){
		$row 		= NULL;
		$where 		= (trim($where) != '') ? "WHERE {$where}" : $where;
        $orderby 	= (trim($orderby) != '') ? "ORDER BY {$orderby}" : $orderby;
		$limit 		= (trim($limit) != '') ? "LIMIT {$limit}" : $limit;
		$result 	= mysqli_query(self::connect(), "SELECT {$fields} FROM ".self::$prefix.$table." {$where} {$orderby} {$limit}") or self::debug(mysqli_error(self::$connection));
	
		while($fetchrow = mysqli_fetch_assoc($result)) $row[] = $fetchrow;
		mysqli_free_result($result);
		
		return $row;
	}	
		
    public static function update($table, $fields, $where=''){
		if($where != '') $where = " WHERE $where";
		$query = mysqli_query(self::connect(), "UPDATE ".self::$prefix.$table." SET $fields" . $where) or self::debug(mysqli_error(self::$connection));
		
		if($query){
			return true;
		}
		return false;
	}

	public static function buildFields($post, $sep=" "){    
        $count  = '';
        $fields = ''; 
        foreach($post as $key => $value){

            //$value = mysqli_escape_string($value);

            if($count == 0){
                $fields .= "$key='$value'";
            }else{
                $fields .= $sep . "$key='$value'";
            }

            $count++;
        }
        return $fields;
	}
}
?>