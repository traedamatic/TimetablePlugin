<div class="manager-view clearfix">
	<h2>Dashboard</h2>
	<p>Hier finden Sie aktuelle Statistiken und Informationen zu Ihren
	Veranstaltungen, Workshops und Vorträgen.</p>
	<hr>
	
	<?php		
		if($countSpeakers == 0 ):
	?>
	<div class="notice warning">
		Sie müssen einen Referenten hinzufügen bevor Sie einen Workshop anlegen können.
	</div>
	<?php
		endif;
	?>
	
	<div class="col_6">
		<h2>Statistiken</h2>
		<p><b>Veranstaltungen:</b> <?php echo $countEvents; ?> </p>
		<p><b>Workshops:</b> <?php echo $countWorkshops; ?> </p>
		<p><b>Referenten:</b> <?php echo $countSpeakers; ?> </p>
	</div>	
	<div class="col_6">
		<h2>Aktionen</h2>
		<p><?php echo $this->Html->link(_('Veranstaltung'),array('controller' => 'events', 'action' => 'index')); ?></p>
		<p><?php echo $this->Html->link(_('Workshops'),array('controller' => 'workshops', 'action' => 'index')); ?></p>
		<p><?php echo $this->Html->link(_('Referenten'),array('controller' => 'speakers', 'action' => 'index')); ?></p>
	</div>
	<div class="col_12">
		<h2>Help/Contribute</h2>
		<p>This project is a open-source. It was founded by Haithem Bel Haj and
		Nicolas Traeder. Further information please visit the GitHub project page </p>
	</div>
</div>