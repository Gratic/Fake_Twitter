<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Timeline</title>
	<link rel="stylesheet" type="text/css" href="../lib/bootstrap-5.1.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../lib/bootstrap-icons-1.8.1/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="../style/style.css">
</head>

<body class="min-vh-100 bg-dark">
	<nav class="navbar navbar-dark bg-dark">
		<div class="container text-white">
			<a href="<?php url('timeline'); ?>" class="navbar-brand">Timeline</a>
			<div class="me-auto d-flex">
				<?php if(!Auth::check()): ?>
				<div class="nav-item">
					<a href="<?php url('connexion') ?>" class="nav-link text-white active" aria-current="page">Log
						in</a>
				</div>
				<div class="nav-item">
					<a href="<?php url('inscription') ?>" class="nav-link text-white">Sign up</a>
				</div>
				<?php else : ?>
				<div class="nav-item">
					<a href="<?php url('deconnexion') ?>" class="nav-link text-white">Log out</a>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</nav>
	<div class="container min-vh-100">
		<div class="row align-items-center min-vh-100 justify-content-center">
			<div class="col-6">
				<div class="card bg-dark text-white border">
					<div class="card-header">
						<h3 class="card-title">Sign up</h3>
					</div>
					<div class="card-body">
						<form method="post" action="<?php url('inscription-post'); ?>">
							<p>
								<input type="text" class="form-control text-white bg-dark" name="user_name" placeholder="Username">
							</p>
							<p>
								<input type="password" class="form-control text-white bg-dark" name="user_password" placeholder="Password">
							</p>
							<p>
								<input type="password" class="form-control text-white bg-dark" name="user_password_confirmation" placeholder="Confirm password">
							</p>
							<button type="submit" class="btn btn-dark border">
								Sign up
								<i class="bi bi-door-open ms-2"></i>
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>


	</div>
</body>

</html>