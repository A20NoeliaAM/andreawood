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




/* function inicioSesion($pdo){
    session_regenerate_id(true);
    $consulta = "SELECT id, rol FROM usuarios WHERE nome=:nome";
    $pdoSentencia = $pdo->prepare($consulta);
    $pdoSentencia->bindParam(':nome', $_POST['nome']);
    $pdoSentencia->execute();
    if ($pdoSentencia) {
        list($idUsuario, $rolUsuario) = $pdoSentencia->fetch();
        $_SESSION['idUsuario'] = $idUsuario;
        $_SESSION['rolUsuario'] = $rolUsuario;
    } else {
        $pdo = null;
        cerrarSesion('login.php');
    }
}
if (isset($_POST['acceder'])) {
    $consulta = "SELECT contrasinal FROM usuarios WHERE nome=:nome";
    $pdoSentencia = $pdo->prepare($consulta);
    $pdoSentencia->bindParam(':nome', $_POST['nome']);
    $pdoSentencia->execute();
    if ($pdoSentencia) {
        list($contranisalHash) = $pdoSentencia->fetch();
        if (password_verify($_POST['contrasinal'], $contranisalHash)) {
            inicioSesion($pdo);
        } else {
            $pdo = null;
            cerrarSesion('login.php');
        }
    } else {
        $pdo = null;
        cerrarSesion('login.php');
    }
}
if (!isset($_SESSION['idUsuario'])) {
    $pdo = null;
    cerrarSesion('login.php');
} */
?>


<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <title>Galerias</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1>andreawood</h1>
        <a class="boton" id="boton-blanco" href="logout.php">Cerrar sesión</a>
        <main>
            <nav>
                <form method="POST">
                    <button class="boton boton-naranja" type="submit" name="filtro-todo">Todo</button>
                    <button class="boton boton-naranja" type="submit" name="filtro-edicion">Edición</button>
                    <button class="boton boton-naranja" type="submit" name="filtro-vfx">VFX</button>
                </form>
                <br><br>
                <a class="boton boton-violeta" href="nuevagaleria.php">Añadir Galería</a>
            </nav>
            <!-- Código para los filtros -->

            <?php
                if(isset($_POST["filtro-edicion"])){
                    $consulta="select año, categoria, enlace, equipo, ubicacion_web, galeria_id from galeria where categoria='edicion'";
                } else if(isset($_POST["filtro-vfx"])){
                    $consulta="select año, categoria, enlace, equipo, ubicacion_web, galeria_id from galeria where categoria='vfx'";
                } else {
                    $consulta="select año, categoria, enlace, equipo, ubicacion_web, galeria_id from galeria";
                }
            
                $stmt=$pdo->prepare($consulta);
                try {
                    $stmt->execute();
                    /*Si se queda así la info que se muestra, 
                    habrá que quitar elementos en la consulta*/
                    while(list($año, $categoria, $enlace, $equipo, $ubicacion, $galeria_id)= $stmt->fetch()){
                        $consulta_img="select ruta from archivo where galeria_id='$galeria_id' and tipo='imagen' order by orden limit 1";
                        $stmt_img=$pdo->prepare($consulta_img);
                        $stmt_img->execute();
                        if($stmt_img){
                            if(list($ruta)=$stmt_img->fetch()){
                                $ruta='Assets/'.$ruta;
                            } else{
                                $ruta='sinimagen.png';
                            }
                        }
                        
                        if(!$ubicacion){
                            $ubicacion='No publicada';
                        }

                        echo "<article>

                                    <img src='$ruta' alt='Imagen'>

                                <div>
                                    <p><b>$ubicacion</b></p>
                                    <p>Categoría: $categoria</p>
                                    <form action='modificar.php'>
                                        <button name='modificar' value='$galeria_id' class='boton boton-violeta'>Modificar</button>
                                        <button name='eliminar' value='$galeria_id' class='boton boton-eliminar'>Eliminar</button>
                                    </form>
                               </div>
                            </article>";
                    }
                } catch (PDOException $ex) {
                    die("Error al recuperar las galerías: " . $ex->getMessage());
                }
                


                $pdo=null;
            ?>
            
        </main>
    </body>
</html>