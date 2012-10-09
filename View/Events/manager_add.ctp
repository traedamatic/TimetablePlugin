<div class="manager-view">
	<h2>Neue Veranstaltung anlegen</h2>
	<p>Hier haben Sie die möglichkeit eine neue Veranstaltung anzulegen:</p>
	<div class="form">
		<?php
			echo $this->Form->create('Event',array('class' => 'vertical'));
			echo $this->Form->input('name',array('type' => 'text', 'label' => "Veranstaltungsname:"));
			echo $this->Form->input('description',array('type' => 'quote', 'label' => "Beschreibung:"));
			echo $this->Form->input('begin',array('type' => 'date', 'label' => "Anfang:",'dateFormat' => 'D-M-Y'));
			echo $this->Form->input('end',array('type' => 'date', 'label' => "Ende:",'dateFormat' => 'D-M-Y'));
			echo $this->Form->button('Veranstaltung anlegen',array('class' => 'red'));
			echo $this->Form->end();
		?>
	</div>
</div>