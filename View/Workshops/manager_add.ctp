<?php if (empty($speakers)): ?>
<div id="flash-message" class="success">
	<div class="message-inner">
		Achtung! Sie haben noch keinen Referenten angelegt. Um einen Workshop anlegen zu können müssen Sie min. ein Referenten angelegt haben. 	</div>
	<?php echo $this->Html->link('Referenten anlegen',array('controller' => 'speakers','action' => 'add' )); ?>
</div>
<?php else: ?>

<div id="workshop-add" class="manager-view <?php if(isset($onErrors)) { echo "errors"; } ?>">	
	<h2>Neuen Workshop/Vortrag anlegen</h2>
	<p>Hier haben Sie die möglichkeit einen neuen Workshop/Vortrag anzulegen:</p>
	<div class="form">
		<?php
			echo $this->Form->create('Workshop',array('class' => 'vertical'));
			echo $this->Form->input('name',array('type' => 'text', 'label' => "Name:"));
			echo $this->Form->input('event_id',array('type' => 'select', 'options' => $events, 'label' => "Veranstaltung:", 'empty' => "Bitte wählen Sie eine Veranstaltung aus"));
		?>
		<div id="afterevent" style="display: none;">
		<?php
			echo $this->Form->input('description',array('type' => 'textarea', 'label' => "Beschreibung:"));
			echo $this->Form->input('topic',array('type' => 'select', 'options' => $topics, 'label' => "Thema/Rubrik:")); //'options' => $topics
			//echo $this->Form->input('color',array('type' => 'text', 'label' => "Farbe:"));
			//echo $this->Form->input('referent_id',array('type' => 'select', 'options' => $speakers, 'label' => "Referenten:", 'empty' => "Bitte wählen Sie einen Referenten aus"));
		?>		
		<fieldset class="speakers-container clearfix">
			<legend>Referenten</legend>
		<?php
			$count = 0;
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
				echo $this->Form->input('day',array('type' => 'select', 'options' => $days, 'label' => "Tag:", 'empty' => "Bitte wählen Sie einen Tag aus"));
			}
			
			echo $this->Form->input('time',array('type' => 'time', 'label' => "Anfang:", 'dateFormat' => 'D-M-Y', 'timeFormat' => '24'));
			echo $this->Form->input('duration',array('type' => 'text', 'default' => '1.5', 'label' => "Länge in Stunden:"));
			echo $this->Form->input('active',array('type' => 'checkbox', 'label' => "Aktive: (sichtbar im Timetable)"));
			echo $this->Form->button('Workshop anlegen',array('class' => 'red'));
			echo $this->Form->end();
		?>
		</div>
	</div>
</div>

<?php endif; ?>


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
		
		if($('#workshop-add').hasClass('errors')) {
			//$('select#WorkshopEventId').trigger('change');
			$('#afterevent').fadeIn('fast');
		}
		
	");

?>