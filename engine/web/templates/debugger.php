<div id="pikolor_debug">
	<div class="debug_block"><?=$exec_time?> ms</div>
	<div class="debug_block click" onclick=" window.open('/engine/get_debug/<?=$debug_id?>/view_vars', 'debug_vars', 'width=800px, height=300px , scrollbars=1 ');"><?=count($template_vars)?> vars</div>
	<div class="debug_block click" onclick=" window.open('/engine/get_debug/<?=$debug_id?>/view_logs', 'debug_logs', 'width=800, height=300 , scrollbars=1 ');"><?=count($logs)?> logs</div>
	<?php 
	if (is_array($this->config['general']['langs'])) {
	?>
	<div class="debug_block"><?=LANG . " : " . $this->config['general']['langs'][LANG]?></div>
	<?php } ?>
</div>