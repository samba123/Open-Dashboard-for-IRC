<?php
	$string=$_GET['tid'];
	$q=$_GET['qid'];
	/*$qid='642';
	$string='mysql';
	*/
	$topic = strtolower($string);
	
	
		
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

	if ( $string != "" && $string != "null")
	{
		$res.='<root><questions id="'.$string.'">';
		foreach($temp_arr as $k)
		{
			$res.="<a href=\"javascript:addATab(";
			$res.= $k->get_qid()."_".$topic.")\">";
			$res.= $k->get_ques()."</a><br/>";
		}
	}
	else 	$res.='<root><questions id="">';
	$res.='</questions>';
	
	if ( isset($qid) )
	{
		$res.='<transcript id="'.$qid."_".$string.'">';
		foreach($temp_arr as $k)
		{
			if($k->get_qid()==$qid)
			{
				$res.= $k->get_ques()."<br/>".$k->get_ans();
				break;
			}
		}
	}
	else	$res.='<transcript id="">';
	$res.='</transcript>';
	
	$res.='<topic_list>';
	foreach($Topics_Table as $key=>$val)
	{
		$res.="<ti>".$key."</ti>";
	}

	$res.='</topic_list></root>';
	
	header('Content-Type: text/xml') ;
	echo '<?xml version="1.0" encoding="UTF-8"?>'.$res;
	
	
?>
