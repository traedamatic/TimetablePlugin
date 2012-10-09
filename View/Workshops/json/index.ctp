<?php
$workshopsNew = array();
	foreach($workshops as $workshop):	
		array_push($workshopsNew,$workshop['Workshop']);
	endforeach;
echo json_encode($workshopsNew);