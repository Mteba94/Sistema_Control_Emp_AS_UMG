
<?php
session_start();
include './bd/conexion.php';

// Verifica si se ha enviado el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtiene los valores de nombre de usuario y contraseña del formulario
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Consulta para obtener los datos del usuario con el nombre de usuario proporcionado
    $query = "SELECT * FROM tbl_usuarios WHERE usuario=:usuario";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    $user = $stmt->fetch();

    // Verifica si el nombre de usuario y la contraseña coinciden con un usuario registrado
    if ($user && password_verify($password, $user['password'])) {
        // Si son correctos, inicia sesión y redirige a una página de inicio
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
        exit;
    } else {
        // Si son incorrectos, muestra un mensaje de error
        $error = "Nombre de usuario o contraseña incorrectos";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Iniciar sesión</title>
</head>
<body>
	
	<form action="login.php" method="POST">
		<label>Nombre de usuario:</label><br>
		<input type="text" name="usuario"><br>
		<label>Contraseña:</label><br>
		<input type="password" name="password"><br><br>
		<input type="submit" value="Iniciar sesión">
	</form>
    <?php if (isset($error)) { ?>
		<p><?php echo $error; ?></p>
	<?php } ?>
</body>
</html>