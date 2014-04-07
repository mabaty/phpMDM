<?php

//Insert Function
function insertData($table, $datas=array()){
    
    while (list($key, $value) = each($datas)) {
            $keyLists[] = $key;
            $valueLists[] = strlen($value) ? sprintf("'%s'", addslashes($value)) : "''";
        }
    $query = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, implode(",", $keyLists), implode(",", $valueLists));
    $data = mysql_query($query);
    return $data;
}

//Get Row
function getRow($sql){
    $result = mysql_query($sql);
    $row = mysql_fetch_row($result);
    return $row;
}

//Update Data
function updateData($table, $datas=array(), $whereData=array()){
   
    while (list($key, $value) = each($datas)) {
            if ($value === NULL) {
                $setData[] = sprintf("%s = NULL", $key);
                continue;
            }
            $setData[] = sprintf("%s = '%s'", $key, addslashes($value));
            
        }
       
    while (list($key, $value) = each($whereData)) {
            $whereKey = $key;
            $whereValue = addslashes($value);
        } 
    $where = "$whereKey='$whereValue'";
    $query = sprintf("UPDATE %s SET %s WHERE %s", $table, @implode(",", $setData), $where);
    $data = mysql_query($query);
    return $data;
}

/**Get user data by ID**/
function get_user_data($id) {

	$sql = "SELECT * FROM `users` ";//Common  SQL
	$sql .="WHERE `user_id`='" . $id . "'";

	$result = mysql_query($sql);

	while ($row = mysql_fetch_object($result)) {
		return $row;
	}

}

/**Get device data by ID**/
function get_device_data($id) {

	$sql = "SELECT * FROM `devices` ";//Common  SQL
	$sql .="WHERE `user_id`='" . $id . "'";

	$result = mysql_query($sql);

	while ($row = mysql_fetch_object($result)) {
		return $row;
	}

}

//Get user note
function get_user_note($id) {

	$sql = "SELECT * FROM `activity_log` ";//Common  SQL
	$sql .="WHERE `user_id`='" . $id . "'";

	$result = mysql_query($sql);

	while ($row = mysql_fetch_object($result)) {
		return $row->activity_notes;
	}

}

/***Get All User***/
function get_all_user() {
	$data = array();
	$sql = "SELECT * FROM `users` ORDER BY `user_id` DESC";//Common  SQL

	$result = mysql_query($sql);

	while ($row = mysql_fetch_object($result)) {
		$data[] = $row;
	}

	return $data;

}
?>