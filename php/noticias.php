<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/deslizador.css" />
    <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,200,700' rel='stylesheet' type='text/css'>
    <title>Noticias</title>
</head>
    
    <body>
        <div id="slidorion" class="container">
            <input class="slider" type="hidden"/>
            <div class="contenedor">
            <div class="accordion">
      <?php 
            include 'libreria.php';
            session_start();
                if(isset($_SESSION['usuario'])){     
                    $rol = $_SESSION['rol'];
                    $conexion = conectar();
                    $consulta = "select fecha_fin, titulo, descripcion from noticias join usuarios on usuarios_login = login where rol_nombre = '".$rol."' ";
                    $query = $conexion->query($consulta);

                    if($query->rowCount()!=0)
                    {
                        while($noticia = $query->fetch())
                        {
                            if($noticia['fecha_fin'] <= time('Y-m-d'))
                            {
                                $titulo = $noticia['titulo'];
                                $noticia = $noticia['descripcion'];
                                print "<div class=header>".$titulo."</div>";
                                print "<div class=content>".$noticia."</div>";
                            }
                        }
                        $query->closeCursor();
                    }
                    else
                    {
                        print "<header><h1>No hay noticias</h1></header>";
                    }
                    header("Refresh: 300; URL=".$_SERVER['PHP_SELF']);
                }else
                {
                    header("Location: ../index.php");
                }
                ?>
                </div>
            </div>
        </div>
        <script src="../js/jquery.js"></script>
        <script src="../js/deslizador.js"></script>
        <script>
            $(function() { $('#slidorion').slidorion(); });
        </script>
    </body>

</html>