<div class="manager-view">
	<h2><?php echo __('Veranstaltung bearbeiten') ?></h2>
	<p><?php echo __('Hier haben Sie die möglichkeit eine Veranstaltung zu bearbeiten:'); ?></p>
	<div class="form">
		<?php
			echo $this->Form->create('Event',array('class' => 'vertical'));
			echo $this->Form->input('name',array('type' => 'text', 'label' => __("Veranstaltungsname:")));
			echo $this->Form->input('description',array('type' => 'quote', 'label' => __("Beschreibung:")));
			echo $this->Form->input('begin',array('type' => 'date', 'label' => __("Anfang:"),'dateFormat' => 'D-M-Y'));
			echo $this->Form->input('end',array('type' => 'date', 'label' => __("Ende:"),'dateFormat' => 'D-M-Y'));
			echo $this->Form->button(__('Veranstaltung speichern'),array('class' => 'red'));
			echo $this->Form->end();
		?>
	</div>
</div>