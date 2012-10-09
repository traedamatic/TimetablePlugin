<div class="manager-view" id="speaker-view">
	<h2>Referent - <?php echo $speaker['Speaker']['name']; ?></h2>
	
	<hr />
	<h3>Bild:</h3>
	<?php
		if($speaker['Speaker']['avatar'] != false) {
			echo $this->Html->image('/files/speakers/t_'.$speaker['Speaker']['avatar']);
		} else {
			echo "<p>Kein Bild hochgeladen</p>";
		}
	?>
	<h3>Beschreibung:</h3>
	<p><?php echo $speaker['Speaker']['description']; ?></p>
	<h3>Websites:</h3>
	<?php
		foreach(explode(',',$speaker['Speaker']['website']) as $link):
			if(strpos($link,'http')):
				echo $this->Html->link($link,$link).'<br \>';
			else:
				echo $this->Html->link($link,'http://'.$link).'<br \>';
			endif;
		endforeach;
	?>
	<h3>Twitter:</h3>
	<p><?php echo $speaker['Speaker']['twitter']; ?></p>
	<h3>Facebook:</h3>
	<p><?php echo $speaker['Speaker']['facebook']; ?></p>
	<hr>
	<?php echo $this->Html->link(__('Bearbeiten'),array('action' => 'edit', $speaker['Speaker']['_id']),array('class' => 'button green' ));?> 
	
</div>