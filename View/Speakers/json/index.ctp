<?php
$speakersNew = array();
	foreach($speakers as $speaker):	
		array_push($speakersNew,$speaker['Speaker']);
	endforeach;
echo json_encode($speakersNew);