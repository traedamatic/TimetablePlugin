<div class="view" id="event-index">
	<h1>Events</h1>
	<?php
	foreach($events as $event):	
	?>
	<div class="event">
		<h2><?php echo $event['Event']['name']?></h2>
		<div class="des">
			<?php echo $event['Event']['description']?>
		</div>
		<p class="start">Start: <?php echo implode('-',$event['Event']['begin']) ?></p>
		<p class="end">End: <?php echo implode('-',$event['Event']['end']) ?></p>
	</div>
	<?php
	endforeach;
	?>
</div>

