<?php

$mps_json = file_get_contents("./mps.json");
$mps_array[] = json_decode($mps_json, true);
$mps = $mps_array[0];
$member_id = '';
$person_id = '';
$name = '';
$party = ''; 
$constituency = '';

$out = array();
$i = 0;
foreach($mps as $mp) {
	$mymp = array();
	$mymp['member_id'] = $mp['member_id'];
	$mymp['name'] = $mp['name'];
	$mymp['person_id'] = $mp['person_id'];
	$mymp['party'] = $mp['party'];
	$mymp['constituency'] = $mp['constituency'];

	$person_id = $mymp['person_id'];
	//http://www.theyworkforyou.com/api/getMP?key=CPmndLARaZ76DJLwuiB7ZqQ7&id=$person_id
	$mp_twfy_string = iconv("ASCII", "UTF-8", file_get_contents("http://www.theyworkforyou.com/api/getMP?key=CPmndLARaZ76DJLwuiB7ZqQ7&id=$person_id"));
	$this_mp = json_decode($mp_twfy_string, $depth=40);
	

	$mymp['image'] = $this_mp[0]['image'];

	$mymp['theyworkforyou'] = "http://www.theyworkforyou.com/mp/".$mp['person_id'];
	

	// save pic
	$filenameIn  = $mymp['image'];
	$filenameOut = __DIR__ . '/images/' . basename($mymp['image']);

	//$contentOrFalseOnFailure   = file_get_contents($filenameIn);
	//$byteCountOrFalseOnFailure = file_put_contents($filenameOut, $contentOrFalseOnFailure);
	
	$member_id = $mymp['member_id'];
	$name = $mymp['name'];
	$person_id = $mymp['person_id'];
	$party = $mymp['party'];
	$constituency = $mymp['constituency'];
	$image = $mymp['image'];
	$twfy = $mymp['theyworkforyou'];

	echo '"'.$member_id.'","'.$name.'","'.$person_id.'","'.$party.'","'.$constituency.'","'.$image.'","'.$twfy."\"\n";

	// get extra info (pic, topics)
	// add into json
	// ask on irc for "votes"
	$out[] = $mymp;
	//$out[] = $twfy_getMP;
}
//print_r($out);
//echo json_encode($out);
//echo json_last_error();
// Now use this for your typeahead
?>