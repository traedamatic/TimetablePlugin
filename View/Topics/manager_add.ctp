<div class="manager-view">
	<h2><?php echo __('Neues Themaanlegen'); ?></h2>
	<p><?php echo __('Hier haben Sie die Möglichkeit ein neues Thema anzulegen. Themen können später den Workshops zugeordnet werden.'); ?></p>
	<div class="form">
		<?php
			echo $this->Form->create('Topic',array('class' => 'vertical'));
			echo $this->Form->input('name',array('type' => 'text', 'label' => __("Themaname:")));
			echo $this->Form->input('description',array('type' => 'textarea', 'label' => __("Beschreibung:")));
			echo $this->Form->input('color',array('type' => 'text', 'label' => __("Farbe:")));			
			echo $this->Form->button(__('Thema anlegen'),array('class' => 'red'));
			echo $this->Form->end();
		?>
	</div>
</div>