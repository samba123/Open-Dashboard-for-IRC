<?php

$string=$_GET['ques'];
//echo $string."this";


$tok = strtok($string, ":");

while ($tok !== false) {
  //  echo "Word=$tok<br />";
    $tok = strtok("");
    $q.=$tok;
}


$ch = curl_init();
$postvars = array();
$postvars['appid'] = '<appid>';
//$postvars['context'] =$q;
$postvars['context'] = 'Sagar: while trying to create primary in a 40GB table in mysql, got error SQL table full. can you suggest?';
$postvars['query']='mysql';
$postvars['output']='json';
curl_setopt($ch,CURLOPT_VERBOSE,true);

curl_setopt($ch,CURLOPT_PROXY,'<proxy>:<port>');

curl_setopt($ch,CURLOPT_PROXYUSERPWD,'<user>:<pass>');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postvars));

curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_URL, 'http://search.yahooapis.com/ContentAnalysisService/V1/termExtraction');

$res=curl_exec($ch);

//echo $res.'<br/><br/>';
echo curl_error($ch);


$phpobj = json_decode($res);
//print_r($phpobj);
echo '11 '.$phpobj->{'ResultSet'}->{'Result'}[0];
?>
