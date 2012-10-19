<?php
$topicsNew = array();
	foreach($topics as $topic):	
		array_push($topicsNew,$topic['Topic']);
	endforeach;
echo json_encode($topicsNew);