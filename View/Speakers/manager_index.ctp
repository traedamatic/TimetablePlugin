<div class="manager-view">
	<h1><?php echo __('Referentenübersicht'); ?></h1>
	<p><?php echo __('Hier sind alle Workshops aufgezählt:'); ?></p>
	<?php echo $this->Html->link(__('Neu anlegen'),array('action' => 'add'),array('class' => 'button green btn-add', 'id' => 'btn-speaker-add'));?> 
	<table class="sortable">
		<thead>
			<?php echo $this->Html->tableHeaders(array(__('Position'), __('Name'), __('Beschreibung'),__('Website'), __('Aktionen'))); ?>
		</thead>
		<tbody>		
			<?php
				foreach($speakers as $speaker):
					echo $this->Html->tableCells(
												array(
													array(
															array($speaker['Speaker']['position'], array('class' => $speaker['Speaker']['_id'] )),
															$this->Html->link($speaker['Speaker']['name'],array('action' => 'view',$speaker['Speaker']['_id'])),
															$this->Text->truncate($speaker['Speaker']['description'],40),
															$speaker['Speaker']['website'],
															$this->Html->link(__('Bearbeiten'),array('action' => 'edit',$speaker['Speaker']['_id'])).' | '.
															$this->Html->link(__('Löschen'),array('action' => 'delete',$speaker['Speaker']['_id']))
															)
													)
												);
				endforeach;
			?>
		</tbody>
	</table>
</div>