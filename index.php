

<?php
session_start();
if (!isset($_SESSION['usuario_online']) && !$_SESSION['usuario_online'] == true){
    //usuario nao logado
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="style.css">

    <title>Document</title>
</head>
<body>

<div class="social">

    <a href="verifica_usuario.php?acao=sair" class="sair" <img src="logout.png">sair</a>




    <h3>Bem vindo!</h3>
</div>

</body>
</html>

