<div id="main">

	<noscript>This site must have javascript enabled to function.</noscript>

	<!-- IF LOGGED IN -->
	<h2>Your Account</h2>

	<form action="">
		<div>
			<label for="username">Change Email Address</label>
			<input id="username" name="username" type="text" /><br />
			<input id="change-email-submit" type="submit" value="Change Email" class="button" />
		</div>
	</form>

	<hr />

	<form action="">
		<div>
			<label for="new-password">Choose a New Password</label>
			<input id="new-password" name="new-password" type="password" /><br />
			<label for="repeat-new-password">Re-Type New password</label>
			<input id="repeat-new-password" name="repeat-new-password" type="password" /><br />
			<input id="change-password-submit" type="submit" value="Change Password" class="button" />
		</div>
	</form>

	<hr />

	<form action="">
		<div>
			<input id="delete-account-submit" type="submit" value="Delete Account?" class="button" />
		</div>
	</form>

	<!-- ELSE IF LOGGED OUT -->


	<!-- END IF -->
</div>