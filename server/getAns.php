<?php
	$tid=$_GET['tid'];
	$qid=$_GET['qid'];
	//$string='mysql';
	$topic = strtolower($tid);
	/*$qid='642';
	$topic='mysql';*/
	
	
		
	$Topics_Table = array();
	$op = file_get_contents("/tmp/topic.txt");
	$Topics_Table = unserialize($op);



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



	if(array_key_exists($topic, $Topics_Table ))	
		$top_id = $Topics_Table[ $topic ];


	$op = file_get_contents("/tmp/transcript.txt");

	$per_topic_trans_table = unserialize($op);
	

	$temp_arr = new Transcript();
	if(array_key_exists($top_id , $per_topic_trans_table ))
	{
		$temp_arr = $per_topic_trans_table[$top_id];
	}

	$res='';

	foreach($temp_arr as $k)
	{
		if($k->get_qid()==$qid)
		{
			$res.= $k->get_ques()."<br/>".$k->get_ans();
			break;
		}
	}
	echo $res;
	
	
?>
