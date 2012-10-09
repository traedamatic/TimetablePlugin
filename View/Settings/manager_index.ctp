<div id="settings-add" class="manager-view">	
	<h2><?php echo __('Einstellungen'); ?></h2>
	<hr >
	<div class="form">
	<?php
		echo $this->Form->create('Setting',array('url' => array('action' => 'save'),'class' => 'vertical'));
		echo $this->Form->input('_id',array('type' => 'hidden','default' => $this->data['Setting']['_id']));
		echo $this->Form->input('theme',array('type' => 'select', 'options' => $themes,'empty' => 'default', 'label' => 'Theme'));
		
		echo "<fieldset><legend>Workshop Themen</legend>";		
		if(empty($this->data['Setting']['topic'])) {
			echo $this->Form->input('Setting.topic.0.name',array('type' => 'text', 'label' => 'Topicname'));
			echo $this->Form->input('Setting.topic.0.color',array('type' => 'text', 'label' => 'Topicfarbe'));
		} else {
			for($i=0;$i<=count($this->data['Setting']['topic']);$i++):
				echo $this->Form->input('Setting.topic.'.$i.'.name',array('type' => 'text', 'label' => 'Topicname'));
				echo $this->Form->input('Setting.topic.'.$i.'.color',array('type' => 'text', 'label' => 'Topicfarbe'));
			endfor;
		}
		echo "</fieldset>";
		echo '<br>';
		echo $this->Form->button(__('Einstellungen speichern'),array('class' => 'red'));
	?>
	</div>
</div>

