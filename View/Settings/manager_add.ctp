<div id="settings-add" class="manager-view">	
	<h2><?php echo __('Einstellungen'); ?></h2>
	<?php
		echo $this->Form->create('Setting');
		echo $this->Form->inputs();
		echo $this->Form->button(__('Einstellungen speichern'),array('class' => 'red'));
	?>
</div>

