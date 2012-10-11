<div class="view" id="speakers-index">
	<h1>Speakers</h1>
	<?php
	foreach($speakers as $speaker):	
	?>
	<div class="event">
		<div class="head clearfix">		
			<?php echo $this->Html->image('/files/speakers/t_'.$speaker['Speaker']['avatar']); ?>
			<div class="links">
				<h2><?php echo $speaker['Speaker']['name']?></h2>
				<p class="label">Websites</p>
				<?php
				foreach(explode(',',$speaker['Speaker']['website']) as $link):
					if(strpos($link,'http')):
						echo $this->Html->link($link,$link).'<br \>';
					else:
						echo $this->Html->link($link,'http://'.$link).'<br \>';
					endif;
				endforeach;
				?>
				<p class="label">Twitter</p>				
				<?php echo $this->Html->link($speaker['Speaker']['twitter'],'https://twitter.com/'.$speaker['Speaker']['twitter'],array('target' => '_blank')).'<br \>'; ?>
				<p class="label">Facebook</p>				
				<?php echo $this->Html->link($speaker['Speaker']['facebook'],'https://facebook.com/'.$speaker['Speaker']['facebook'],array('target' => '_blank')).'<br \>'; ?>
			</div>  			
		</div>
		<div class="des">
			<p class="label">Beschreibung</p>
			<?php echo $speaker['Speaker']['description']?>
		</div>
		<!--<p class="start">Start: <?php //echo implode('-',$speaker['Speaker']['begin']) ?></p>
		<p class="end">End: <?php // echo implode('-',$speaker['Speaker']['end']) ?></p>-->
	</div>
	<?php
	endforeach;
	?>
</div>

