<?php
session_start();
include("partials/cabecera.php");
include("conexiondb.php");

$Usuarios_id = $_SESSION['Usuarios_id']; // Asumiendo que user_id se almacena en la sesión al iniciar sesión

if (isset($_GET['tareas_id'])) {
    $tareas_id = $_GET['tareas_id'];
    $sql = "SELECT * FROM tareas WHERE tareas_id = $tareas_id AND Usuarios_id = $Usuarios_id";
    $result = $conexion->query($sql);
    $fila = $result->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tareas_id = $_POST['tareas_id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];

    $sql = "UPDATE tareas SET titulo = '$titulo', descripcion = '$descripcion', estado = '$estado' WHERE tareas_id = $tareas_id AND Usuarios_id = $Usuarios_id";
    $conexion->query($sql);
    header("Location: ver_tareas.php");
}
?>

<section id="editar_tarea">
  <h3>Editar Tarea</h3>
  <form action="editar_tarea.php" method="POST">
    <input type="hidden" name="tareas_id" value="<?php echo $fila['tareas_id']; ?>">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" value="<?php echo $fila['titulo']; ?>" required>
    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion" value="<?php echo $fila['descripcion']; ?>" required>
    <label for="estado">Estado:</label>
    <input type="text" id="estado" name="estado" value="<?php echo $fila['estado']; ?>" required>
    <button type="submit">Guardar Cambios</button>
  </form>
</section>
<?php include("partials/footer.php"); ?>
