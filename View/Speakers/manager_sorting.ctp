<div classs="view clearfix">
	<h2><?php echo __('Referentenlisteneinstellung'); ?></h2>
	<p><?php echo __('Hier können Sie die Reihenfolge der Referentenliste festlegen:'); ?></p>
	<div style="display: none;" id="flash-message" class="success">
	<div class="message-inner">Reihenfolge gespeichert </div>
	</div>
	<div id="speaker-list" class="dd clearfix">
		<ol>
		<?php foreach($speakers as $speaker): ?>
			<li class="dd-item" data-id="<?php echo $speaker['Speaker']['_id']; ?>">
				<div class="dd-handle"><?php echo $speaker['Speaker']['name']; ?></div>
			</li>
		<?php endforeach; ?>
		</ol>
	</div>
	<button id="btn-save-sorting" style="clear: both;display: none;" >Reihenfolge speichern</button>
</div>

<?php $this->Js->buffer('
			
		var _btnSaveSorting = $("#btn-save-sorting");					
		$("#speaker-list").nestable();
			
					
		$("#speaker-list").on("change", function() {
			_btnSaveSorting.css("display" ,"block");
	  });			
					
		_btnSaveSorting.on("click",function(){
				
				 var _data = $("#speaker-list").nestable("serialize");
				 _data =  {"positions" : _data};
				console.log(JSON.stringify(_data));
				
				$.post("'.Router::url(array('action' => 'sorting','ext' => 'json')).'",_data,function(data){
					console.log(data.response);
					if(data.response.result == "ok") {
						$("#flash-message").show()
						var _fadeOutTimeout = setTimeout(function(){  $("#flash-message").hide(); clearTimeout(_fadeOutTimeout);
						},4000)
					}
				});
				
		});
							');
		?><!---->