<?php
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    $output = json_decode(file_get_contents("http://api.crowdnunciator.org.uk/annunciator"),20);
    
    $name=$output['name'];
    $member_id=$output['member_id'];
    $party=$output['party'];
    $constituency=$output['constituency'];
    $minutes=$output['minutes'];

    $say='';
    if (($member_id!='99990')&&($member_id!='99991')&&($member_id!='99992')) {
        $say="$name, $party M.P. for $constituency, has been speaking for $minutes minutes";
    } else {
        $say="Status is. $name.";
    }
?>
<Response>
    <Say><?php echo $say;?></Say>
</Response>