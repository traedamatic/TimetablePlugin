<?php $count = 0 ?>
<div class="manager-view">	
	<h2><?php echo __('Neuen Referenten anlegen'); ?></h2>
	<p><?php echo __('Hier haben Sie die möglichkeit einen neuen Referenten anzulegen:'); ?></p>
	<div class="form">
		<?php
			echo $this->Form->create('Speaker',array('class' => 'vertical','type' => 'file'));
			echo $this->Form->input('name',array('type' => 'text', 'label' => __('Name_')));
			echo $this->Form->input('description',array('type' => 'textarea', 'label' => __("Beschreibung:")));			
			echo $this->Form->input('website',array('type' => 'text', 'label' => __("Website: (Sie können mehrere Websiten mit ',' trennen: meinname.de,ichimweltall.de,meinbuch.com,ganzlinks.org)")));
			echo $this->Form->input('twitter',array('type' => 'text', 'label' => __("Twitter:")));
			echo $this->Form->input('facebook',array('type' => 'text', 'label' => __("Facebook-Name")));
			echo $this->Form->input('avatar',array('type' => 'file', 'label' => __("Bild:"))); //'options' => $topics
			echo $this->Form->input('position',array('type' => 'text','default' => $count, 'label' => __("Position in der Liste:")));
			echo $this->Form->button(__('Referent anlegen'),array('class' => 'red'));
			echo $this->Form->end();
		?>
	</div>
</div>
