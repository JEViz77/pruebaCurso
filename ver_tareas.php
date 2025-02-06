<?php
session_start();
include("partials/cabecera.php");
include("conexiondb.php");

$Usuarios_id = $_SESSION['Usuarios_id']; // Asumiendo que user_id se almacena en la sesión al iniciar sesión

$sql = "SELECT * FROM tareas WHERE Usuarios_id = $Usuarios_id ORDER BY tareas_id DESC";
$result = $conexion->query($sql);
?>
<section id="tareas">
  <h3>Tareas</h3>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Descripción</th>
        <th>Fecha creación</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $fila['tareas_id'] . "</td>";
        echo "<td>" . $fila['titulo'] . "</td>";
        echo "<td>" . $fila['descripcion'] . "</td>";
        echo "<td>" . $fila['fecha_creacion'] . "</td>";
        echo "<td>" . $fila['estado'] . "</td>";
        echo "<td>
                <a href='editar_tarea.php?tareas_id=" . $fila['tareas_id'] . "'>Editar</a> |
                <a href='eliminar_tarea.php?tareas_id=" . $fila['tareas_id'] . "'>Eliminar</a>
              </td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</section>
<?php include("partials/footer.php"); ?>
