<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Guardar Persona</h2>
    <form method='POST'>
        <input type="text" name = 'nombre' placeholder='Ingrese su Nombre' required>
        <button type='sumbit' >Guardar</button>
    </form>

    <h3>Lista de Personas registradas</h3>
    <ul>
        <?php while($fila = $persona->fetch_assoc()): ?>

            <li><? htmlspecialchars($fila['nombre'],ENT_QUOTES, 'UTF-8') ?> ></li>

        <?php endwhile; ?>
    </ul>
</body>
</html>