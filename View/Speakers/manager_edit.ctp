<div class="manager-view" id="workshop-edit">
	<h2><?php echo __('Referenten bearbeiten'); ?></h2>
	<p><?php echo __('Hier haben Sie die möglichkeit einen Referenten zu bearbeiten:'); ?></p>
	<div class="form">
		<?php
		
			echo $this->Form->create('Speaker',array('class' => 'vertical','type' => 'file'));
			echo $this->Form->input('name',array('type' => 'text', 'label' => __("Name:")));
			echo $this->Form->input('description',array('type' => 'textarea', 'label' => __("Beschreibung:")));			
			echo $this->Form->input('website',array('type' => 'text', 'label' => __("Website: (Sie können mehrere Websiten mit ',' trennen: meinname.de,ichimweltall.de,meinbuch.com,ganzlinks.org)")));
			echo $this->Form->input('twitter',array('type' => 'text', 'label' => __("Twitter:")));
			echo $this->Form->input('facebook',array('type' => 'text', 'label' => __("Facebook-Name")));
			
			if(isset($this->data['Speaker']['avatar']) && !empty($this->data['Speaker']['avatar'])) {
				
				echo '<div id="current-picture"> <p> '.__('Aktuelles Bild').': </p>'.$this->Html->image('/files/speakers/t_'.$this->data['Speaker']['avatar']).'</div>';
			}
			
			echo $this->Form->input('avatar',array('type' => 'file', 'label' => __("Neues Bild:"))); //'options' => $topics
			echo "<p>".__('Achtung! Das alte Bild überschrieben.')."</p>";
			echo $this->Form->input('position',array('type' => 'text', 'label' => __("Position in der Liste:")));
			echo $this->Form->button(__('Referent speichern'),array('class' => 'red'));
			echo $this->Form->end();
		?>
	</div>
</div>