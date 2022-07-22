<?php
/* session_start();

//conexion bd

function cerrarSesion($paxina){
    $_SESSION = array();
    session_destroy();
    header('Location:'.$paxina);
} */
$servidor = 'db-pdo';
$usuario = 'root';
$contrasinal = 'root';
$bd = 'andreawood';
try {
    $pdo = new PDO("mysql:host=$servidor; dbname=$bd; charset=utf8mb4", $usuario, $contrasinal);
} catch (Exception $e) {
    $pdo = null;
    /* cerrarSesion('login.php'); */
}
?>


<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <title>Galerias</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1><a href='galerias.php'>andreawood</a></h1>
        <a class="boton" id="boton-blanco" href="logout.php">Cerrar sesión</a>
        <main>
            <?php
                if(isset($_POST['submit'])){
                    $countfiles = count($_FILES['file']['name']);
                    $extension_imagen = array("png","jpeg","jpg", "svg", "webp");
                    $extension_video = array("mp4", "avi", "webm");
                    for($i=0;$i<$countfiles;$i++){
                        $filename = $_FILES['file']['name'][$i];
                        $target_file = 'Assets/'.$filename;
                        $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
                        $file_extension = strtolower($file_extension);
                        if(in_array($file_extension, $extension_imagen)){
                            $tipo= 'imagen';
                        } else if(in_array($file_extension, $extension_video)){
                            $tipo= 'video';
                        } else{
                            $tipo=null;
                        }
                        if(!$tipo){
                            $sconsulta = "INSERT INTO archivos (ruta, tipo) VALUES ('$filename','$tipo')";
                            
                            /*Generar los mensajes de error*/

                            move_uploaded_file($_FILES['file']['tmp_name'][$i],$target_file);
                                $bd=$pdo->query($sql);
                            
                        }
                        
                    }
                }

                


                $pdo=null;
            ?>
            <form method='post' action='' enctype='multipart/form-data'>
                <input type="file" name="file[]" id="file" multiple>
                <input type='submit' name='submit' value='Upload'>
            </form>
        </main>
    </body>
</html>