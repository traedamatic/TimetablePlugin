<div class="manager-view">
	<h1>Referentenübersicht</h1>
	<p>Hier sind alle Workshops aufgezählt:</p>
	<?php echo $this->Html->link(__('Neu anlegen'),array('action' => 'add'),array('class' => 'button green', 'id' => 'btn-speaker-add'));?> 
	<table class="tight">
		<thead>
			<?php echo $this->Html->tableHeaders(array(__('Id'), __('Name'), __('Beschreibung'),__('Website'), __('Aktionen'))); ?>
		</thead>
		<tbody>		
			<?php
				foreach($speakers as $speaker):
					echo $this->Html->tableCells(
												array(
													array(
															$speaker['Speaker']['_id'],
															$this->Html->link($speaker['Speaker']['name'],array('action' => 'view',$speaker['Speaker']['_id'])),
															$this->Text->truncate($speaker['Speaker']['description']),
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