<div id="main">
	<h2>Reset Your Password</h2>
	<p>Enter the email address you signed up with and we'll send
		you a link to reset your password.</p>
	<br />
	<form action="db-interaction/users.php" method="post">
		<div>
			<input type="hidden" name="action" value="resetpassword" />
			<label for="username">Email</label>
			<input type="text" name="username" id="username" />
			<br />
			<input type="submit" name="reset" id="reset" value="Reset Password" class="button" />
		</div>
	</form>
</div>