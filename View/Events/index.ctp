<?php
$eventsNew = array();
	foreach($events as $event):	
		array_push($eventsNew,$event['Event']);
	endforeach;
echo json_encode($eventsNew);