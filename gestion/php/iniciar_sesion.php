<?php 
    //Almacenar datos en variables
    $usuario = limpiar_cadena($_POST['login_usuario']);
    $contraseña = limpiar_cadena($_POST['login_contraseña']);

    //Verificar camppos obligatorios
    if ($usuario == "" || $contraseña == "") {
        echo "
            <div class= 'notification is-danger is-light'>
            <strong>¡Ocurrio un error inesperado!</strong><br>
            Todos los campos son obligatorios
            </div>
        ";
        exit();
    }

    //Verificar integridad de los datos
    if (verificar_datos("[a-zA-Z0-9]{4,20}",$usuario)) {
        echo"
            <div class='notification is-danger is-light'>
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El USUARIO no coincide con el formato solicitado.
            </div>
        ";
        exit();
    }

    if (verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$contraseña)) {
        echo"
            <div class='notification is-danger is-light'>
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La CONTRASEÑA no coincide con el formato solicitado.
            </div>
        ";
        exit();
    }

    $check_user=conexion();
    $check_user=$check_user -> query("SELECT * FROM usuario WHERE username = '$usuario' AND role = 'Administrador'");
    if ($check_user -> rowCount() == 1) {
        $check_user=$check_user -> fetch();
    
        if ($check_user['username'] == $usuario && password_verify($contraseña, $check_user['password'])) {
            $_SESSION['id'] = $check_user['id'];
            $_SESSION['nombre'] = $check_user['firstname'];
            $_SESSION['apellido'] = $check_user['lastname'];
            $_SESSION['usuario'] = $check_user['username'];
    
            if (headers_sent()) {
                echo "<script> window.location.href = 'index.php?vista=home';</script>";
            }else {
                header("Location: index.php?vista=home");
            }
        }else {
            echo"
                <div class='notification is-danger is-light'>
                    <strong>¡ocurrio un error inesperado!</strong><br>
                    Usuario o contraseña incorrectos
                </div>   
            ";
        }
    }else {
        echo"
            <div class='notification is-danger is-light'>
                <strong>¡ocurrio un error inesperado!</strong><br>
                Usuario o contraseña incorrectos
            </div>   
        ";
    }
    $check_user=null;   
?>