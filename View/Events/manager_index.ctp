<div class="manager-view">
	<h1><?php echo __('Veranstaltungsübersicht'); ?></h1>
	<p><?php echo __('Hier sind alle Veranstaltungen aufgezählt:'); ?></p>
	<?php echo $this->Html->link(__('Neu anlegen'),array('action' => 'add'),array('class' => 'button green btn-add', 'id' => 'btn-event-add'));?> 
	<table class="sortable">
		<thead>
			<?php echo $this->Html->tableHeaders(array('#',__('Name'), __('Beschreibung'),__('Anfang'),__('Ende'), __('Aktionen'))); ?>
		</thead>
		<tbody>		
			<?php
				$count = 0;
				foreach($events as $event):
					$count++;		
					echo $this->Html->tableCells(
												array(
													array(
															$count,
															array($event['Event']['name'],array('class' => $event['Event']['_id'])),
															$this->Text->truncate($event['Event']['description']),
															strftime('%d-%m-%G',strtotime(implode('-',$event['Event']['begin']))),
															strftime('%d-%m-%G',strtotime(implode('-',$event['Event']['end']))),
															$this->Html->link(__('Bearbeiten'),array('action' => 'edit',$event['Event']['_id'])).' | '.
															$this->Html->link(__('Löschen'),array('action' => 'delete',$event['Event']['_id']))
															)
													)
												);
				endforeach;
			?>
		</tbody>
	</table>
</div>