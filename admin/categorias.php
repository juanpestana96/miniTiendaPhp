<?php
include_once 'lib.php';
$categoria = new categoria("","");

if (isset($_POST["enviar"])) {
    $cat_temp = new categoria(0, "");
    $cat_temp->nombre = $_POST["nombre"];
    $db->adicionarCategoria($cat_temp);
}
if(isset($_GET["accion"]) && isset($_GET["id"])){
    switch($_GET["accion"]){
        case "editar":
            $edicion = TRUE;
            $categoria = $db->obtenerCategoria($_GET["id"]);
            break;
    }
}else{
    $categoria = new categoria("","");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Prueba SQLite</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div class="container">
            <div class="span5">
                <h2 id="producto">Adicionar Categoría</h2>
                <p></p>
                <form class="bs-example" role="form" action="categorias.php" method="POST">
                    <div class="form-group">
                        <label for="nombrecategoria">Nombre</label>
                        <input name="nombre" type="text" class="form-control" id="nombrecategoria" placeholder="Escriba el nombre completo" value="<?php echo $categoria->nombre;?>">
                    </div>
                    <input type="submit" class="btn btn-default" name="enviar" value="Guardar" />
                </form>
            </div>
            <div class="span7">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($db->obtenerTodoCategoria() as $value) {
                        echo "<tr>
                                <td>{$value->id}</td>
                                <td>{$value->nombre}</td>
                                <td><a href='categorias.php?accion=editar&id={$value->id}'>editar</a></td>
                               </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <a href="categoria.php?edit={id}"></a>
            </div>
        </div>
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
