<?php
session_start();

// Función para cargar los libros desde un archivo JSON
function cargarLibros() {
    $archivo = 'libros.json';
    if (file_exists($archivo)) {
        $contenido = file_get_contents($archivo);
        return json_decode($contenido, true);
    }
    return [];
}

// Función para guardar los libros en un archivo JSON
function guardarLibros($libros) {
    $archivo = 'libros.json';
    $contenido = json_encode($libros, JSON_PRETTY_PRINT);
    file_put_contents($archivo, $contenido);
}

$libros = cargarLibros();
$libroIndex = isset($_GET['libro']) ? $_GET['libro'] : 0;
$libroActual = $libros[$libroIndex];

// Si el formulario de transacción fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['descripcion'])) {
    $transaccion = [
        'fecha' => $_POST['fecha'],
        'descripcion' => $_POST['descripcion'],
        'cuenta' => $_POST['cuenta'],
        'debe' => $_POST['debe'],
        'haber' => $_POST['haber']
    ];
    
    $libros[$libroIndex]['transacciones'][] = $transaccion;
    guardarLibros($libros);
    echo "Transacción agregada con éxito.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Transacciones</title>
</head>
<body>
    <h1>Transacciones para el Libro: <?php echo $libroActual['nombre']; ?></h1>

    <form action="transacciones.php?libro=<?php echo $libroIndex; ?>" method="POST">
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required><br>

        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" required><br>

        <label for="cuenta">Cuenta:</label>
        <input type="text" id="cuenta" name="cuenta" required><br>

        <label for="debe">Debe:</label>
        <input type="number" id="debe" name="debe" step="0.01" required><br>

        <label for="haber">Haber:</label>
        <input type="number" id="haber" name="haber" step="0.01" required><br>

        <button type="submit">Agregar Transacción</button>
    </form>

    <h2>Transacciones</h2>
    <ul>
        <?php foreach ($libroActual['transacciones'] as $transaccion): ?>
            <li>
                <?php echo $transaccion['fecha']; ?> - 
                <?php echo $transaccion['descripcion']; ?> - 
                Cuenta: <?php echo $transaccion['cuenta']; ?> - 
                Debe: <?php echo $transaccion['debe']; ?> - 
                Haber: <?php echo $transaccion['haber']; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="index.php">Volver a Libros</a>
</body>
</html>
