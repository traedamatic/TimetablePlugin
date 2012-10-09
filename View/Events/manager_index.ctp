<div class="manager-view">
	<h1>Veranstaltungsübersicht</h1>
	<p>Hier sind alle Veranstaltunge ausgezählt:</p>	
	<table class="tight">
		<thead>
			<?php echo $this->Html->tableHeaders(array(__('Id'), __('Name'), __('Beschreibung'),__('Anfang'),__('Ende'), __('Aktionen'))); ?>
		</thead>
		<tbody>		
			<?php
				foreach($events as $event):
					echo $this->Html->tableCells(
												array(
													array(
															$event['Event']['_id'],
															$event['Event']['name'],
															$event['Event']['description'],
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