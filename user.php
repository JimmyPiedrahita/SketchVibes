<?php
if (!empty($_POST["registro"])) {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = $conexion->query("insert into usuarios(nombre, email, password) values('$nombre','$email','$password')");
    if ($sql == 1) {
        echo "<script>alert('¡Usuario creado correctamente!'); window.location.href = 'login.php';</script>";
    } else {
        echo "<script>alert('¡Error al crear usuario!');</script>";
    }
}
if (!empty($_POST["ingreso"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = $conexion->query("select * from usuarios where email = '$email' and password = '$password'");
    if ($datos = $sql->fetch_object()) {
        session_start();
        $_SESSION["administrador"] = false;
        $_SESSION["id_usuario_actual"] = $datos->id_usuario;
        header("Location: home.php");
    } else {
        $sql = $conexion->query("select * from administradores where email = '$email' and password = '$password'");
        if ($datos = $sql->fetch_object()) {
            session_start();
            $_SESSION["administrador"] = true;
            header("Location: home.php");
        }else{
            echo "<script>alert('¡Usuario o contraseña incorrectos!');</script>";
        }
    }
}
if (isset($_POST['explore'])) {
    if (!isset($_SESSION['administrador'])) {
        header("Location: login.php");
    }
    header('Location: home.php');
}
if (isset($_POST['salir'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}
