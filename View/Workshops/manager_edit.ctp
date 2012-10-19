<div class="manager-view" id="workshop-edit">	
	<h2>Workshop bearbeiten</h2>
	<?php //debug($this->data); ?>
	<p>Hier können Sie einen Workshop bearbeiten:</p>
	<div class="form">
		<?php
			echo $this->Form->create('Workshop',array('class' => 'vertical'));
			echo $this->Form->input('name',array('type' => 'text', 'label' => "Name:"));
			echo $this->Form->input('event_id',array('type' => 'select', 'options' => $events, 'label' => "Veranstaltung:", 'empty' => "Bitte wählen Sie eine Veranstaltung aus"));
		?>
		<div id="afterevent">
		<?php
			echo $this->Form->input('description',array('type' => 'textarea', 'label' => "Beschreibung:"));
			echo $this->Form->input('topic_id',array('type' => 'select', 'options' => $topics, 'label' => "Thema/Rubrik:")); //'options' => $topics			
			$count=0;
		?>
		
		<fieldset class="speakers-container clearfix">
			<legend>Referenten</legend>
		<?php
			foreach($speakers as $id => $speakerName) {
				echo $this->Form->input('Workshop.speakers.'.$id,array('type' => 'checkbox','label' => false,'after' => '<span>'.$speakerName.'</span>' ));
				$count++;
			}
		?>
		</fieldset>
		<?php
			echo $this->Form->input('location',array('type' => 'text', 'label' => "Wo?(Raum, Baum, Hörsaal, Haus mit Adresse, etc.)"));
			
			if(isset($this->data['Workshop']['event_id'])) {
				$days = $this->requestAction(Router::url(array('action' => 'eventdays', 'controller' => 'events',$this->data['Workshop']['event_id'])));
			}
			
			echo $this->Form->input('day',array('type' => 'select', 'options' => $days, 'label' => "Tag:", 'empty' => "Bitte wählen Sie einen Tag aus"));
			
			echo $this->Form->input('time',array('type' => 'time', 'label' => "Anfang:", 'dateFormat' => 'D-M-Y', 'timeFormat' => '24'));
			echo $this->Form->input('duration',array('type' => 'text', 'default' => '1.5', 'label' => "Länge in Stunden:"));
			echo $this->Form->input('active',array('type' => 'checkbox', 'label' => false,'after' => "Aktive: (sichtbar im Timetable)"));
			echo $this->Form->button(__('Workshop speichern'),array('class' => 'red'));
			echo $this->Form->end();
		?>
		</div>
	</div>
</div>

<?php

	$this->Js->buffer("
		$('select#WorkshopEventId').change(function(){
			
			var _eventId = $(this).find('option:selected').attr('value');
			
			$.get('".Router::url(array('controller' => 'events','action' => 'eventdays'))."/'+_eventId,function(data){
				if($('#WorkshopDay').length > 0) $('#WorkshopDay').parent('div').remove();				
				$('#WorkshopLocation').parent('div').after(data);
				$('#afterevent').fadeIn('fast');
			});
				
		});
		");
?>