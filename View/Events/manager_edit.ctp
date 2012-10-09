<div class="manager-view" id="speaker-edit">
	<h2>Referenten bearbeiten</h2>
	<p>Hier haben Sie die möglichkeit einen Referenten zu bearbeiten:</p>
	<div class="form">
		<?php
			echo $this->Form->create('Speaker',array('class' => 'vertical'));
			echo $this->Form->input('name',array('type' => 'text', 'label' => "Name:"));
			echo $this->Form->input('description',array('type' => 'textarea', 'label' => "Beschreibung:"));			
			echo $this->Form->input('website',array('type' => 'text', 'label' => "Website: (Sie können mehrere Websiten mit ',' trennen: meinname.de,ichimweltall.de,meinbuch.com,ganzlinks.org)"));
			echo $this->Form->input('twitter',array('type' => 'text', 'label' => "Twitter:",));
			echo $this->Form->input('facebook',array('type' => 'text', 'label' => "Facebook-Name"));
			echo $this->Form->input('avatar',array('type' => 'file', 'label' => "Bild:")); //'options' => $topics
			echo $this->Form->input('position',array('type' => 'text', 'label' => "Position in der Liste:"));
			echo $this->Form->button('Workshop anlegen',array('class' => 'red'));
			echo $this->Form->end();
		?>
	</div>
</div>