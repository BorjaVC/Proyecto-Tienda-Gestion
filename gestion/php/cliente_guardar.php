<?php
    
    require_once "main.php";

    // Almacenar datos
    $nombre=limpiar_cadena($_POST['cliente_nombre']);
    $usuario=limpiar_cadena($_POST['cliente_usuario']);
    
    $apellido=limpiar_cadena($_POST['cliente_apellido']);
    $apellido_2=limpiar_cadena($_POST['cliente_apellido_2']);
    
    $rol="Cliente";
    $email=limpiar_cadena($_POST['cliente_email']);

    $clave_1=limpiar_cadena($_POST['cliente_clave_1']);
    $clave_2=limpiar_cadena($_POST['cliente_clave_2']);

    $telefono=limpiar_cadena($_POST['cliente_telefono']);
    $direccion=limpiar_cadena($_POST['cliente_direccion']);
    


    //Verificar campos obligatorios 
    if($nombre=="" || $usuario=="" || $apellido=="" || $apellido_2=="" /*|| $rol==""*/|| $email=="" || $clave_1=="" || $clave_2=="" || $telefono==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /// Verificar integridad de los datos
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    /*if(verificar_datos("[a-zA-Z0-9]{4,20}",$usuario)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El USUARIO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }*/

    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El APELLIDO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido_2)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El APELLIDO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z]{4,20}",$rol)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El ROL no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_1) || verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_2)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Las CLAVES no coinciden con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[0-9]{9,11}",$telefono)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El TELEFONO no coinciden con el formato solicitado
            </div>
        ';
        exit();
    }


    // Verificar email 
    if($email!=""){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $check_email=conexion();
            $check_email=$check_email->query("SELECT email FROM usuario WHERE email ='$email' AND role ='$rol' ");
            if($check_email->rowCount()>0){
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El correo electrónico ingresado ya se encuentra registrado, por favor elija otro
                    </div>
                ';
                exit();
            }
            $check_email=null;
        }else{
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    Ha ingresado un correo electrónico no valido
                </div>
            ';
            exit();
        } 
    }


    // Verificar usuario 
    $check_usuario=conexion();
    $check_usuario=$check_usuario->query("SELECT username FROM usuario WHERE username ='$usuario' AND role ='$rol'");
    if($check_usuario->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El USUARIO ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
        exit();
    }
    $check_usuario=null;


    // Verificar claves
    if($clave_1!=$clave_2){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Las CLAVES que ha ingresado no coinciden
            </div>
        ';
        exit();
    }else{
        $clave=password_hash($clave_1,PASSWORD_BCRYPT,["cost"=>10]);
    }


    //Guardar datos 
    $guardar_clientes=conexion();
    $guardar_cliente=$guardar_clientes->prepare("INSERT INTO usuario(username,email,password,role,firstname,lastname,lastname2,phone,address) VALUES(:usuario,:email,:clave,:rol,:nombre,:apellido,:apellido_2,:telefono,:direccion)");

    $marcadores=[
        
        ":usuario"=>$usuario,
        ":email"=>$email,
        ":clave"=>$clave,
        ":rol"=>$rol,
        ":nombre"=>$nombre,
        ":apellido"=>$apellido,
        ":apellido_2"=>$apellido_2,
        ":telefono"=>$telefono,
        ":direccion"=>$direccion
    ];

    $guardar_cliente->execute($marcadores);

    $guardar_cliente=$guardar_clientes->prepare("INSERT INTO cliente(username,email) VALUES(:usuario,:email)");

    $marcadores=[
        
        ":usuario"=>$usuario,
        ":email"=>$email,
    ];

    $guardar_cliente->execute($marcadores);

    if($guardar_cliente->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>CLIENTE REGISTRADO!</strong><br>
                El cliente se registro con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar el cliente, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_cliente=null;
