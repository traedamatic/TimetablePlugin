<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		TimeTable Plugin <?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
			
		echo $this->Csscrush->tag('/css/Timetable/manager.css');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		echo $this->Html->script('Timetable.libs/modernizr-2.6.1.min');
	?>
</head>
<body>
	<div id="container">
		<header>
			<h1>Timetable Plugin Manager</h1>
		</header>
		<nav class="clearfix">
			<div class="menu-item">
				<?php echo $this->Html->link(_('Dashboard'),array('controller' => 'timetable', 'action' => 'dashboard'),array('escape' => false)); ?>				
			</div>
			<div class="menu-item">
				<?php echo $this->Html->link(_('Veranstaltung'),array('controller' => 'events', 'action' => 'index')); ?>
				<ul class="submenu">
					<li><?php echo $this->Html->link(_('Anlegen'),array('controller' => 'events', 'action' => 'add'),array('escape' => false)); ?></li>
				</ul>
			</div>
			<div class="menu-item">
				<?php echo $this->Html->link(_('Workshops'),array('controller' => 'workshops', 'action' => 'index')); ?>
				<ul class="submenu">
					<li><?php echo $this->Html->link(_('Anlegen'),array('controller' => 'workshops', 'action' => 'add'),array('escape' => false)); ?></li>
				</ul>
			</div>
			<div class="menu-item">
				<?php echo $this->Html->link(_('Referenten'),array('controller' => 'speakers', 'action' => 'index')); ?>
					<ul class="submenu">
					<li><?php echo $this->Html->link(_('Anlegen'),array('controller' => 'speakers', 'action' => 'add'),array('escape' => false)); ?></li>
				</ul>
			</div>
			<div class="menu-item">
				<?php echo $this->Html->link(_('Themen'),array('controller' => 'topics', 'action' => 'index')); ?>
					<ul class="submenu">
					<li><?php echo $this->Html->link(_('Anlegen'),array('controller' => 'topics', 'action' => 'add'),array('escape' => false)); ?></li>
				</ul>
			</div>
			<div class="menu-item">
				<?php echo $this->Html->link(_('Einstellungen'),array('controller' => 'settings', 'action' => 'index')); ?>					
			</div>
		</nav>
		<div id="meat" role="main">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<footer>
			
		</footer>
	</div>
	
	<?php echo $this->element('sql_dump'); ?>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.0.min.js"><\/script>')</script>
	
	<?php
		
		echo $this->Html->script('Timetable.manager');
		echo $this->Html->script('Timetable.libs/prettify');
		echo $this->Html->script('Timetable.libs/kickstart');		
			
		echo $this->fetch('script');
		
		echo $this->Js->writeBuffer();
	?>  
</body>
</html>
