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

// Si el formulario para crear un libro fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombreLibro'])) {
    $nombreLibro = $_POST['nombreLibro'];
    
    if (!empty($nombreLibro)) {
        $libro = [
            'nombre' => $nombreLibro,
            'transacciones' => []
        ];
        $libros[] = $libro;
        guardarLibros($libros);
        echo "Libro '$nombreLibro' creado con éxito.";
    } else {
        echo "Por favor, ingrese un nombre para el libro.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Libros Contables</title>
</head>
<body>
    <h1>Gestión de Libros Contables</h1>
    
    <form action="index.php" method="POST">
        <label for="nombreLibro">Nombre del Libro Contable:</label>
        <input type="text" id="nombreLibro" name="nombreLibro" required>
        <button type="submit">Crear Libro</button>
    </form>

    <h2>Historial de Libros</h2>
    <ul>
        <?php foreach ($libros as $index => $libro): ?>
            <li>
                <?php echo $libro['nombre']; ?> 
                <a href="transacciones.php?libro=<?php echo $index; ?>">Ver/Agregar Transacciones</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
