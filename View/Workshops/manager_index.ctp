<div class="manager-view">
	<h1><?php echo __('Workshopübersicht'); ?></h1>
	<p><?php echo __('Hier sind alle Workshops aufgezählt:') ?></p>
	<?php echo $this->Html->link(__('Neu anlegen'),array('action' => 'add'),array('class' => 'button green btn-add', 'id' => 'btn-speaker-add'));?> 
	<table class="sortable">
		<thead>
			<?php echo $this->Html->tableHeaders(array('#',__('Name'), __('Beschreibung'),__('Ort'),__('Tag'),__('Zeit'),__('Länge'),__('Sichtbar'), __('Aktionen'))); ?>
		</thead>
		<tbody>		
			<?php
				$count = 0;
				foreach($workshops as $workshop):
					$count++;					
			
					echo $this->Html->tableCells(
												array(
													array(
															$count,
															array($workshop['Workshop']['name'],array('class' => $workshop['Workshop']['_id'])),
															$this->Text->truncate($workshop['Workshop']['description'],40),
															$workshop['Workshop']['location'],
															$workshop['Workshop']['day'],
															implode(':',$workshop['Workshop']['time']),															
															$workshop['Workshop']['duration'],
															$workshop['Workshop']['active'],
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

<?php debug($countActiveWorkshops); ?>