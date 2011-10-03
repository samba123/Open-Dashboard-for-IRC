<?php
	
	//$q_id = $_GET['qid'];
	//$t_id = '666' $_GET['tid'];
	//$ans = "p";		//$_GET['ans'];

	$q_id = $_GET['qid'];
	$t_id = $_GET['tid'];
	$ans = $_GET['ans'];
	
	$Topics_Table = array();

//	$op = file_get_contents("topic.txt");
	
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
		function set_ans( $data ) {  $this->ans = $this->ans."<br/>".$data; }
	}
			
	
	$quest_obj = new Transcript();
	
	$op = file_get_contents("/tmp/transcript.txt");

	$per_topic_trans_table = unserialize($op);
	
	//$temp_arr = array();
	
	$quest_obj = $per_topic_trans_table[$t_id] ;
	
	//print_r($quest_obj);
	foreach ( $quest_obj as $k)
	{
		if( $k->get_qid() == $q_id )
			$k->set_ans($ans);
	}


	$res = serialize($per_topic_trans_table);//ob_get_clean();
	$fh = fopen("/tmp/transcript.txt", 'w') or die("can't open file");
	fwrite($fh, $res);

	//echo $quest_obj->get_qid()." ".$topic ;
//	print "Hello " . $topic; 
	
	
?>
