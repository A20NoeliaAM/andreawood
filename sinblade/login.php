<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1 id="h1-grande">andreawood</h1>
        <main>
            <div class="contenido">
                <form action="galerias.php" method="POST">
                    <label>
                        <span>Usuario: </span>
                        <input type="text" name="usuario">
                    </label>
                    <br><br>
                    <label>
                        <span>Contraseña: </span>
                        <input type="password" name="contraseña">
                    </label>
                    <br><br>
                    <button class="boton boton-naranja" id="boton-acceder" type="submit" name="acceder">Acceder</button>
                </form>
            </div>
        </main>
    </body>
</html>