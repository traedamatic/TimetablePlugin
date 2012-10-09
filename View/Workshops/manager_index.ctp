<div class="manager-view">
	<h1>Workshopübersicht</h1>
	<p>Hier sind alle Workshops aufgezählt:</p>	
	<table class="tight">
		<thead>
			<?php echo $this->Html->tableHeaders(array(__('Id'), __('Name'), __('Beschreibung'),__('Ort'),__('Tag'),__('Zeit'),__('Länge'), __('Aktionen'))); ?>
		</thead>
		<tbody>		
			<?php
				foreach($workshops as $workshop):
			
			
					echo $this->Html->tableCells(
												array(
													array(
															$workshop['Workshop']['_id'],
															$workshop['Workshop']['name'],
															$workshop['Workshop']['description'],
															$workshop['Workshop']['location'],
															$workshop['Workshop']['day'],
															implode(':',$workshop['Workshop']['time']),															
															$workshop['Workshop']['duration'],
															$this->Html->link(__('Bearbeiten'),array('action' => 'edit',$workshop['Workshop']['_id'])).' | '.
															$this->Html->link(__('Löschen'),array('action' => 'delete',$workshop['Workshop']['_id']))
															)
													)
												);
				endforeach;
			?>
		</tbody>
	</table>
</div>