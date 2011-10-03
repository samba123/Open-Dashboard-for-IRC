<?php
	$quest = "Sagar: While creating primary key in a 40 GB mysql table I got error 'SQL table full..' Any suggestions?";
	$topic = strtolower("mysql");
	$user = strtolower("Sagar");
	$ANS = "Sachin:bye";
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
    $rNum = rand();
    return $rNum;
}

	$Topics_Table = array();
	$User_Table = array();

	if(!array_key_exists($user, $User_Table ))
		$User_Table[ $user ] = randNum();
	
	if(!array_key_exists($topic, $Topics_Table ))	
		$Topics_Table[ $topic ] = randNum();
		
	
	$top_id = $Topics_Table[ $topic ];

	class Transcript 
	{
	  	private $question ; 
	  	private $ans;  
	// private $q_users = array(); 
	  	private $q_id;
		private $who_asked;

  		function __construct()
  		{
  		}
	
		function fill_data( $q , $ans , $w )
		{
			
			$this->question = $q;
			$this->ans = $this->ans.",".$ans;
		/*	if(is_array($users))
			{
					for($i = 0 ; $i < count($users); $i++ ) 
					{
						$this->q_users[$i] = $users[$i];
					}
			} 
			else 
				echo "Not a array";
			*/
			$this->q_id = randNum();
			$this->who_asked = $w;
		}
		
		function get_ques( ) { return $this->question; }
		function get_ans( ) { return $this->ans; }
		function get_qid( ) { return $this->q_id; }
		function get_users( ) { return $this->q_users; }
		function get_ques_creator( ) { return $this->who_asked; }
	}
		class topics
		{
			private $NAME;
			private $id;
			
			function init_topic($nm)
			{
				$this->NAME = $nm;
				$this->id = randNum();
			}
			function get_name( ) { return $this->NAME; }
			function get_id( ) { return $this->id; }
		}
		
		class users
		{
			private $NAME;
			private $id;
			
			function init_user($nm)
			{
				$this->NAME = $nm;
				$this->id = randNum();
			} 
			function get_name( ) { return $this->NAME; }
			function get_id( ) { return $this->id; }
		}
		
		class topics_user
		{
			private $topic_id;
			private $t_users = array();
			
			function init_topics_user($t_id)
			{
				$this->topic_id = $t_id;
			/*if(is_array($usrs))
			{
					for($i = 0 ; $i < count($usrs); $i++ ) 
					{
						$this->t_users[$i] = $usrs[$i];
					}
			} 
			else echo "Not a array";*/	
			}
			function get_topic_id( ) { return $this->topic_id; }
			//function get_topic_users( ) { return $this->t_users; }
		}
		
		/*function get_topic_id($topic)
		{
			
		}*/
		
		
		
  /*function set_title( $title ) { $this->title = $title; }
  function get_title( ) { return $this->title; }

  function set_author( $author ) { $this->author = $author; }
  function get_author( ) { return $this->author; }

  function set_publisher( $publisher ) {
  $this->publisher = $publisher; }
  function get_publisher( ) { return $this->publisher; }*/

	
	// $user_arr[] users viewing this question
	// transcript table : question, ans,topic,q_users[],q_id,who_asked;
	// topics_table : topic name,id;
	// user_table : name,id;	
	// topics_user_table : topic_id,t_users[];
	
	function search_record($fname, $search_string )
	{
		//$filename = "data.txt";
		$fp = fopen($fname, "r") or die("Couldn't open $fname");
		$line=NULL;
		while(!feof($fp))
		{ 
			$line = fgets($fp);
			if (preg_match($search_string,$line)) // Print the line if it contains the word 'Ravi'
			{
				break;
			}
			$line = NULL;
			//print "$line<br>";
		}
			fclose($fp);
			return $line; 
	}	
		
	function add_record($fname,$data)
	{
		$fp = fopen($fname,"a");
		fputs($fp, $data);
		fclose($fp);
	}
	
	$quest_obj = new Transcript();
	$quest_obj->fill_data($quest , $ANS , $user );	 

	$temp_arr = array();
	if(array_key_exists($top_id , $per_topic_trans_table ))
	{
		$temp_arr = $per_topic_trans_table[$top_id];
	}
	
	array_push($temp_arr, $quest_obj );
	$per_topic_trans_table[$top_id] = $temp_arr;
//	print "Hello " . $topic; 
	
	
?>