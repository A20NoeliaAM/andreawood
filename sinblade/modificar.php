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
                if(isset($_POST['modificar'])){
                    $galeria_id=$_POST['modificar'];
                    $consulta = "select año, categoria, enlace, equipo, ubicacion_web from galeria where galeria_id='$galeria_id'";
                    $stmt=$pdo->prepare($consulta);
                    try {
                        $stmt->execute();
                        while(list($año, $categoria, $enlace, $equipo, $ubicacion, $galeria_id)= $stmt->fetch()){
                            if(!$ubicacion){
                                $ubicacion='No publicada';
                            }
                            echo "<h2>$ubicacion</h2>
                                <form action='POST'>";


                            /* Fañlta poner en la bd un campo alt */
                            $consulta_img="select ruta, orden, id from archivo where galeria_id='$galeria_id' and order by orden";
                            $stmt_img=$pdo->prepare($consulta_img);
                            $stmt_img->execute();
                            if($stmt_img){
                                echo "<div id='archivos'>";
                                while(list($ruta)=$stmt_img->fetch()){
                                    $ruta='Assets/'.$ruta;
                                    echo "<div>";
                                        if ($tipo == 'imagen'){
                                            echo "<img src='$ruta' alt='Imagen'>";
                                        } else if ($tipo == 'video'){
                                /* Agregar por aquí el código para que se visualizen los videos */
                                        }
                                        echo "<label>Orden: 
                                                    <input type='number' name='orden$id'>$orden</input>
                                                </label>
                                                <button name='guardar' value='$id' class='boton boton-violeta'>Guardar</button>
                                                <br>
                                                <button name='eliminar' value='$id' class='boton boton-eliminar'>Eliminar foto</button>
                                            
                                        </div>";
                                }
                                echo "</div>";
                            } else {
                                echo "<p>Archivos no encontrados</p>";
                            }
                            
                            echo 
                            






                            echo "

                                    <div>
                                        <p><b>$ubicacion</b></p>
                                        <p>Categoría: $categoria</p>
                                        <form action='modificar.php'>
                                            <button name='modificar' value='$galeria_id' class='boton boton-violeta'>Modificar</button>
                                            <button name='eliminar' value='$galeria_id' class='boton boton-eliminar'>Eliminar</button>
                                        </form>
                                </div>";




                                echo "</form>";
                        }
                    } catch (PDOException $ex) {
                        die("Error al recuperar las galerías: " . $ex->getMessage());
                    }







                } else if(isset($_POST['eliminar'])){

                }

        /* Habrá que añadir algo para cuando se vaya a esta página directamente */


                
                


                $pdo=null;
            ?>
            
        </main>
    </body>
</html>