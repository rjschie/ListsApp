
<?php
	// If severity is high, use this.
	// Else use standard error display popup?
?>
<div id="dimmer"></div>
<div id="errors">

<?php foreach ( $this->errors as $err ): ?>

	<p><?php echo $err; ?></p>

<?php endforeach; ?>

</div>