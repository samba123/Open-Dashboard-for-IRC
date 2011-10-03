<?php
/*$a = array(1, 2, array("a", "b", "c"));
ob_start();
var_dump($a);
$result = ob_get_clean();
echo $result;
$myFile = "test.txt";*/
$fh = fopen("/tmp/transcript.txt", 'w') or die("can't open file");
$fh = fopen("/tmp/topic.txt", 'w') or die("can't open file");
//fwrite($fh, $result);
echo "success";
?>
