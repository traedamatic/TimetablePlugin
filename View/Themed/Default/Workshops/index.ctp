<div class="view" id="workshops-index">
	<h1>Workshops</h1>
	<?php
	foreach($workshops as $workshop):
	?>
	<div class="workshop">
		<h2><?php echo $workshop['Workshop']['name']?></h2>
		<p style="background-color: <?php echo $workshop['Workshop']['color']?>">Color</p>
		<div class="des">
			<p class="label">Beschreibung</p>
			<?php echo $workshop['Workshop']['description']?>
		</div>
		<p class="label">Thema</p>
		<p><?php echo $workshop['Workshop']['topic']?></p>
		<p class="label">Ort</p>
		<p><?php echo $workshop['Workshop']['location']?></p>
		<p class="label">Zeit</p>
		<p><?php echo implode(':',$workshop['Workshop']['time'])?></p>
		<p class="label">Länge</p>
		<p><?php echo $workshop['Workshop']['duration']?></p>
		<?php
			$speaker = $this->requestAction(Router::url(array('action' => 'view', 'controller' => 'speakers',$workshop['Workshop']['referent_id'])));
			
		?>
		<p class="label">Referent</p>
		<p><?php echo $speaker['Speaker']['name']; ?></p> 	
	</div>
	<?php
	endforeach;
	?>
</div>