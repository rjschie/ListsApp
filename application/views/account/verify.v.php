<div id="main">

	<h2>Choose a Password</h2>

	<form method="post" action="accountverify.php">
		<div>
			<label for="password">Choose a Password:</label>
			<input type="password" name="password" id="password" /><br />
			<label for="repeat-password">Re-Type Password:</label>
			<input type="password" name="repeat-password" id="repeat-password" /><br />
			<!--  <input type="hidden" name="verify" id="verify" value="<?php echo $_GET['v'] ?>" />-->
			<input type="submit" id="verify-submit" value="Verify Your Account" class="button" />
		</div>
	</form>
</div>