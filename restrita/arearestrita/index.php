<?php
    require_once("../classes/User.php");

    $user = new User();

    $user->checkLogin();

    if (isset($_POST["exit"])) {
        User::logout();
    }
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!DOCTYPE html>
<html>

<head>
    <title>Restrita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta charset="utf-8" />
</head>

<body>
    <div class="mt-5 ml-5">
        <form method="POST">
            Seja bem vindo! Essa é uma área restrita.&nbsp;<input type="submit" name="exit" value="Sair" class="btn btn-outline-secondary">
        </form>
    </div>
</body>

</html>