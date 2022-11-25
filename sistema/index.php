<?php
session_start();
if (!empty($_SESSION['active'])) {
    header('location: src/');
} else {
    if (!empty($_POST)) {
        $alert = '';
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Ingrese usuario y contraseña
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        } else {
            require_once "conexion.php";
            $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
            $clave = md5(mysqli_real_escape_string($conexion, $_POST['clave']));
            $query = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario = '$user' AND clave = '$clave'");
            mysqli_close($conexion);
            $resultado = mysqli_num_rows($query);
            if ($resultado > 0) {
                $dato = mysqli_fetch_array($query);
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $dato['idusuario'];
                $_SESSION['nombre'] = $dato['nombre'];
                $_SESSION['user'] = $dato['usuario'];
                header('Location: src/');
            } else {
                $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Contraseña incorrecta
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                session_destroy();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Iniciar Sesión</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/css/material-dashboard.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" />
</head>

<body background= "assets/img/ter.jpg">
<br><br>
    <div class="col-md-4 mx-auto" >
        <?php echo (isset($alert)) ? $alert : '' ; ?>
							<div class="card" style="background-color:YellowGreen">
                            <br><br>
								<div class = "text-center">
									<h4 class="card-title" style="background-color:Gold">Sistema de Ventas de Celulares</h4>
									<img class="img-thumbnail" src="assets/img/ventas.png" width="160" />
								</div>
                                
								<div class="card-body" >
									<?php echo isset($alert) ? $alert : ''; ?>
									<form action="" method="post" class="p-3">
										<div class="form-group">
											<input type="text" class="form-control input-sm text-center" id="exampleInputEmail1" placeholder="Usuario" name="usuario" style="background-color:Cornsilk" >
										</div>
                                        
										<div class="form-group" >
											<input type="password" class="form-control input-sm text-center" id="exampleInputPassword1" placeholder="Clave" name="clave" style="background-color:Cornsilk" >
										</div>

										<div class="mt-3">
											<button class="btn btn-block btn-dark btn-lg font-weight-medium auth-form-btn" type="submit" style="background-color:Chocolate">Login</button>
										</div>

									</form>
								</div>
							</div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/js/material-dashboard.js"></script>
    <!-- endinject -->
</body>

</html>