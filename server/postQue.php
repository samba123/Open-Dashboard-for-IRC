<?php
	
	$string=$_GET['ques'];
//	$string = "Sagar: while trying to create primary in a 40GB table in mysql, got error SQL table full, can you suggest?";
	$tok = strtok($string, ":");

while ($tok !== false) {
      $tok = strtok("");
  		$q.=$tok;
}


$ch = curl_init();
$postvars = array();
$postvars['appid'] = '<appid>';
$postvars['context'] = $q;
$postvars['query']='mysql php linux apache';
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
//echo '11 '.$phpobj->{'ResultSet'}->{'Result'}[0];

$topic = strtolower($phpobj->{'ResultSet'}->{'Result'}[0]);
//$topic='mysql';
$per_topic_trans_table = array();
//	$users = array();
		
function initRand ()
{
    static $randCalled = FALSE;
    if (!$randCalled)
    {
        srand((double) microtime() * 1000000);
        $randCalled = TRUE;
    }
}

function randNum ()
{
    initRand();
    $rNum = rand()%1000;
    return $rNum;
}

	$Topics_Table = array();

	$op = file_get_contents("/tmp/topic.txt");
	$Topics_Table = unserialize($op);

		
	if(!array_key_exists($topic, $Topics_Table ))	
		$Topics_Table[ $topic ] = randNum();
		
	
	$top_id = $Topics_Table[ $topic ];
	$result = serialize($Topics_Table);//ob_get_clean();
	$fh = fopen("/tmp/topic.txt", 'w') or die("can't open file");
	fwrite($fh, $result);

//echo($top_id)."<br/><BR/>";
	class Transcript 
	{
	  	private $question ; 
	  	private $ans;  
	  	private $q_id;
		private $who_asked;

  		function __construct()
  		{
  			$this->ans = "";
  			$this->who_asked = NULL;
  		}
	
		function fill_data( $q )
		{
			
			$this->question = $q;
			$this->q_id = randNum();
		}
		
		function get_ques( ) { return $this->question; }
		function get_ans( ) { return $this->ans; }
		function get_qid( ) { return $this->q_id; }
		function get_users( ) { return $this->q_users; }
		function get_ques_creator( ) { return $this->who_asked; }
	}
			
	
/*	$quest_obj = new Transcript();
	$quest_obj->fill_data($string );	 

	$op = file_get_contents("/tmp/transcript.txt");

	$per_topic_trans_table = unserialize($op);
	//print_r($per_topic_trans_table);
	$temp_arr = array();
	if(array_key_exists($top_id , $per_topic_trans_table ))
	{
		$temp_arr = $per_topic_trans_table[$top_id];
	}
	
	array_push($temp_arr, $quest_obj );
	$per_topic_trans_table[$top_id] = $temp_arr;

	$res = serialize($per_topic_trans_table);//ob_get_clean();
	$fh = fopen("/tmp/transcript.txt", 'w') or die("can't open file");
	fwrite($fh, $res);

	echo $quest_obj->get_qid()."_".$topic ;*/
//	print "Hello " . $topic; 
	
		$quest_obj = new Transcript();

	$op = file_get_contents("/tmp/transcript.txt");

	$per_topic_trans_table = unserialize($op);

	$flag = 0;
	foreach ( $per_topic_trans_table as $key=>$val )
	{
		foreach($val as $k)
			if( !strcmp($k->get_ques() , $string) )
			{
				$quest_obj = $k;
				$flag = 1;
				break;			
			}	
			if($flag)
				break;
	}
	if(!$flag)
	{
		$quest_obj->fill_data($string );	 

		//print_r($per_topic_trans_table);
		$temp_arr = array();
		if(array_key_exists($top_id , $per_topic_trans_table ))
		{
			$temp_arr = $per_topic_trans_table[$top_id];
		}
	
		array_push($temp_arr, $quest_obj );
		$per_topic_trans_table[$top_id] = $temp_arr;

		$res = serialize($per_topic_trans_table);//ob_get_clean();
		$fh = fopen("/tmp/transcript.txt", 'w') or die("can't open file");
		fwrite($fh, $res);
	}

	echo $quest_obj->get_qid()."_".$topic ;

?>
