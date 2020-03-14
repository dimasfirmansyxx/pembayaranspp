<?php 

include 'config/functions.php';

$myfunc = new functions();
$myfunc->set_title("Login");

include 'templates/head.php';

if ( isset($_POST['login']) ) {
	$myfunc->login_check($_POST);
}

if ( isset($_SESSION["user_logged"]) ) {
	$myfunc->redirect($myfunc->baseurl);
}

?>

<div class="login-section mt-5">
	<div class="card">
		<div class="card-header bg-warning text-white text-center">
			<h3>Login</h3>
		</div>
		<div class="card-body">
			<?php if ( isset($_SESSION["flash_data"]) ): ?>
				<div class="alert bg-<?= $_SESSION["flash_data"]["status"] ?> text-white">
					<?= $_SESSION["flash_data"]["message"] ?>
				</div>
				<?php unset($_SESSION["flash_data"]) ?>
			<?php endif ?>
			<form action="" method="post">
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control" required autocomplete="off">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control" required>
				</div>
				<button class="btn btn-warning" type="submit" name="login">Login</button>
			</form>
		</div>
	</div>
</div>

<?php
	include 'templates/footer.php';
?>