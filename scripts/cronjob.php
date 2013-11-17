<?php
function mySQLquery($query) {
	$DB_HOST = "localhost";
	$DB_USER = "crowdnunciator";
	$DB_PASS = "cUNBLPAMsxSxSG2q";
	$DB_NAME = "crowdnunciator";
	mysql_connect($DB_HOST, $DB_USER, $DB_PASS) or die();
	mysql_select_db($DB_NAME) or die();
	$result = mysql_query("$query") or die();  
	return $result; 
}

// TODO Every 30 seconds (crontab)

// What time is now
date_default_timezone_set('Europe/London');
$now = date('Y-m-d H:i:s');

// 30 seconds ago
$thirty = date('Y-m-d H:i:s', strtotime('-60 seconds'));

//SELECT * from `crowd` WHERE timestamp BETWEEN NOW() - INTERVAL 30 SECOND AND NOW() ;
// get consensus
$query_crowd="SELECT member_id, count(member_id) as cnt from `crowd` WHERE timestamp BETWEEN '$thirty' AND '$now' group by member_id order by cnt desc LIMIT 1;";
$result = mySQLquery($query_crowd);
$member_crowd = '';
while($row = mysql_fetch_assoc( $result )) 
{
	$member_crowd = $row['member_id'];
}

// get current member & update in case
if ($member_crowd!='') {
	$query_now="SELECT member_id from now order by timestamp desc limit 1;";
	$result_now = mySQLquery($query_now);
	$member_now = '';
	while($row = mysql_fetch_assoc( $result_now )) 
	{
		$member_now = $row['member_id'];
	}
	if ($member_crowd != $member_now) {
		date_default_timezone_set('Europe/London');
      	$mysqldate = date('Y-m-d H:i:s');
      	$query_now = "INSERT INTO now (`member_id`,`timestamp`) VALUES ('$member_crowd','$mysqldate') ;";
      	echo $query_now;
      	$result = mySQLquery($query_now);   
	}
}


// delete old entries
$query_delete = "DELETE from `crowd` WHERE timestamp < '$now' ;";
echo $query_delete;
$result_delete = mySQLquery($query_delete);

?>