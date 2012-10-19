<div class="manager-view">
	<h2><?php echo __('Thema bearbeiten'); ?></h2>
	<p><?php echo __('Bearbeiten Sie hier das Thema:'); ?></p>
	<div class="form">
		<?php
			echo $this->Form->create('Topic',array('class' => 'vertical'));
			echo $this->Form->input('name',array('type' => 'text', 'label' => __("Themaname:")));
			echo $this->Form->input('description',array('type' => 'textarea', 'label' => __("Beschreibung:")));
			echo $this->Form->input('color',array('type' => 'text', 'label' => __("Farbe:")));			
			echo $this->Form->button(__('Thema speichern'),array('class' => 'red'));
			echo $this->Form->end();
		?>
	</div>
</div>