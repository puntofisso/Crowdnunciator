<?php
require('Toro.php');

/* Generic Functions */

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

/* API Endpoint Handlers */

class RootHandler {
    function get() {
      header('Access-Control-Allow-Origin: *');
      echo "Crowdnunciator<br/>";
    }
}

class PushAnnunciatorHandler {
    function get($member_id) {
      header('Access-Control-Allow-Origin: *');
      date_default_timezone_set('Europe/London');
      $mysqldate = date('Y-m-d H:i:s');
      $query = "INSERT INTO crowd (`member_id`,`timestamp`) VALUES ('$member_id','$mysqldate') ;";
      $result = mySQLquery($query);             
      echo "Ok";
    }
    

}

class GetAnnunciatorHandler {
    function get() {
      $query = "SELECT now.* , mps.image as `image`, mps.name as `name`, mps.constituency as `constituency`, mps.party as `party` from now, mps where now.member_id=mps.member_id order by timestamp desc limit 1;";

      $result = mySQLquery($query);
      $member_id = '';
      $dbdate='';
      $name='';
      $party='';
      $constituency='';
      $image='';
      while($row = mysql_fetch_assoc( $result )) {
        $member_id = $row['member_id'];
        $dbdate = $row['timestamp'];
        $name = $row['name'];
        $party = $row['party'];
        $constituency = $row['constituency'];
        $image = $row['image'];
      }
      
      date_default_timezone_set('Europe/London'); 

      $usersTimezone = new DateTimeZone('Europe/London');
      $l10nDate = new DateTime($dbdate);
      $l10nDate->setTimeZone($usersTimezone);
      $dbtimestamp = strtotime($l10nDate->format('Y-m-d H:i:s'));
      $now =  strtotime(date('Y-m-d H:i:s'));
      $duration = round(($now-$dbtimestamp)/60);
      $out = array();
      $out['member_id'] = $member_id;
      $out['party'] = $party;
      $out['constituency'] = $constituency;
      $out['name'] = $name;
      $out['image'] = $image;
      
      $out['minutes'] = $duration;

      header('Access-Control-Allow-Origin: *');
      echo json_encode($out);

    }


}


class GetHistoryHandler {
    function get() {
      $query = "SELECT now.* , mps.image as `image`, mps.name as `name`, mps.constituency as `constituency`, mps.party as `party` from now, mps where now.member_id=mps.member_id order by timestamp desc;";
      $result = mySQLquery($query);
      $member_id = '';
      $dbdate='';
      $name='';
      $party='';
      $constituency='';
      $image='';

      $all_out[] = array();
      while($row = mysql_fetch_assoc( $result )) {
        $member_id = $row['member_id'];
        $dbdate = $row['timestamp'];
        $name = $row['name'];
        $party = $row['party'];
        $constituency = $row['constituency'];
        $image = $row['image'];
      
      
        date_default_timezone_set('Europe/London'); 

        $usersTimezone = new DateTimeZone('Europe/London');
        $l10nDate = new DateTime($dbdate);
        $l10nDate->setTimeZone($usersTimezone);
        $dbtimestamp = strtotime($l10nDate->format('Y-m-d H:i:s'));
        $now =  strtotime(date('Y-m-d H:i:s'));
        $duration = round(($now-$dbtimestamp)/60);
        $out = array();
        $out['member_id'] = $member_id;
        $out['party'] = $party;
        $out['constituency'] = $constituency;
        $out['name'] = $name;
        $out['image'] = $image;
        $out['timestamp'] = $dbdate;
        $out['minutes'] = $duration;

        $all_out[] = $out;
      }
      header('Access-Control-Allow-Origin: *');
      echo json_encode($all_out);

    }


}

/* Toro main list of endpoints */

Toro::serve(array(
    "/" => "RootHandler",
    "/annunciator" => "GetAnnunciatorHandler",
    "/history" => "GetHistoryHandler",
    "/push/:number" => "PushAnnunciatorHandler"
));

?>
