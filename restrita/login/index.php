<?php
	require_once("../classes/User.php");

	$user = new User();

	$error = false;

	if(isset($_POST["email"]) && isset($_POST["password"])){
		$email = $_POST["email"];
		$password = $_POST["password"];

		try {
			$user->login($email, $password);
			header("Location: ../arearestrita");
		} catch (\Throwable $th) {
			$error = true;
		}
	}

?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
		integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<meta charset="utf-8" />
</head>

<body>
	<div class="container">
		<div class="d-flex justify-content-center h-100">
			<div class="card">
				<div class="card-header text-center">
					<h3>Login</h3>
				</div>
				<div class="card-body">
					<form method="POST">
						<?php echo ($error ? '<div class="alert alert-danger" role="alert">Erro ao realizar login, por favor tente novamente!</div>' : '') ?>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="far fa-envelope"></i></span>
							</div>
							<input type="email" required="required" name="email" class="form-control" placeholder="Email">
						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" required="required" name="password" class="form-control" placeholder="Senha">
						</div>
						<div class="form-group d-flex justify-content-center mt-5">
							<input type="submit" value="Entrar" class="btn float-right login_btn">
						</div>
						<div class="form-group d-flex justify-content-center mt-5">
							<span class="links">Não possui conta? <a href="../cadastro" class="clickable"><u>Fazer Cadastro</u></a></span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

</html>