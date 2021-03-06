 <?php
include_once 'database.php';
//magia negra para la persisitencia de datos almacenados en los inputs
$clav = $cla = '';
$hijole='';
// array de errores
$errores = array('clave_user'=>'','clave_pwd'=>'');

session_start();
if(isset($_SESSION['rol']) && isset($_SESSION['name'])){
	switch ($_SESSION['rol']) {
		case 1:
			header("location: inicio.php"); 
			break;
		case 2:
			$hijole = 'no hay est';
			break;
		case 3:
			$hijole = 'no hay fed';
			break;
		
		default:

	}
}
if(isset($_POST['submit'])){

	//checar usuario
	if(empty($_POST['clave_user'])){
		$errores['clave_user'] ='Tu Clave de Usuario es Requerida';
	} else{
		$clav = $_POST["clave_user"];
		if (!preg_match('/^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/', $clav)) {
			$errores['clave_user'] ='Nombre de usuario solo debe tener letras y números.';
		}
	}
	//checar password
	if(empty($_POST['clave_pwd'])){
		$errores['clave_pwd'] ='Tu Clave de Usuario es Requerida';
	} else{
		$cla = $_POST["clave_pwd"];
		if (!preg_match('/^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/', $cla)) {
			$errores['clave_pwd'] ='La contraseña es incorrecta, inténtelo de  nuevo.';
		}
	}

		if(array_filter($errores)){
			//echo "hay errores";
		}else{
			$username = $_POST['clave_user'];
			$password = $_POST['clave_pwd'];
	
			$db = new Database();
			$query = $db->connect()->prepare('SELECT * FROM usuarios WHERE clave_user = :username AND clave_pwd = :password');
			$query->execute(['username' => $username, 'password' => $password]);
	
			$row = $query->fetch(PDO::FETCH_NUM);
			
			if($row == true){
				$rol = $row[4];
				$name = $row[2];
				$_SESSION['rol'] = $rol;
				$_SESSION['name'] = $name;
				switch($rol){
					case 1:
						header('location: inicio.php');
					break;
	
					case 2:
						$hijole = 'no hay est';
						break;
					case 3:
						$hijole = 'no hay fed';
						break;
					
	
					default:
				}
			}else{
				// no existe el usuario
				$hijole='Usuario no autorizado';
			}

			mysqli_free_result($resultado);
			mysqli_close($conexion);
		}

}


?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inidcadores</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/gob.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/zalogo.png);">
					<span class="login100-form-title-1">
						Iniciar Sesión
					</span>
				</div>
				<!--===============================================================================================-->	
				<form action ="index.php" method= "POST" class="login100-form validate-form">
				<!--===============================================================================================-->	
			
				<div class="wrap-input100 validate-input m-b-26" data-validate="Tu usuario es requerido">
						<span class="label-input100">Usuario</span>
						<input class="input100" type="text" name="clave_user" value="<?php echo htmlspecialchars($clav) ?>" placeholder="Ingresa tu usuario">
						<span class="focus-input100"></span>
					</div>
					<div class="red-text" style="color:red"> <?php echo $errores['clave_user']; ?></div>
<!--===============================================================================================-->
					<div class="wrap-input100 validate-input m-b-18" data-validate = "Se requiere tu contraseña">
						<span class="label-input100">Contraseña</span>
						<input class="input100" type="password" name="clave_pwd" value="<?php echo htmlspecialchars($cla) ?>" placeholder="Ingresa tu contraseña">
						
						<span class="focus-input100"></span>
					</div>
					<div class="red-text" style="color:red"> <?php echo $errores['clave_pwd']; ?></div>
					<div class="container-login100-form-btn justify-content-center">
						<Input class="login100-form-btn"  type="submit" name="submit" value="Ingresar">
							
					</div>
					<div class="red-text	"  style="color:red"> <?php echo $hijole; ?></div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>