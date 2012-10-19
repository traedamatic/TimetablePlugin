<div class="manager-view">
	<h1><?php echo __('Themenübersicht'); ?></h1>
	<p><?php echo __('Hier sind alle Themen aufgezählt:'); ?></p>
	<?php echo $this->Html->link(__('Neu anlegen'),array('action' => 'add'),array('class' => 'button green btn-add', 'id' => 'btn-event-add'));?> 
	<table class="sortable">
		<thead>
			<?php echo $this->Html->tableHeaders(array('#', __('Name'), __('Beschreibung'),__('Farbe'), __('Aktionen'))); ?>
		</thead>
		<tbody>		
			<?php
				$count = 0;
				foreach($topics as $topic):
					$count++;		
					echo $this->Html->tableCells(
												array(
													array(
															$count,
															array($topic['Topic']['name'],array('class' => $topic['Topic']['_id'])),
															$this->Text->truncate($topic['Topic']['description']),
															$topic['Topic']['color'],															
															$this->Html->link(__('Bearbeiten'),array('action' => 'edit',$topic['Topic']['_id'])).' | '.
															$this->Html->link(__('Löschen'),array('action' => 'delete',$topic['Topic']['_id']))
															)
													)
												);
				endforeach;
			?>
		</tbody>
	</table>
</div>