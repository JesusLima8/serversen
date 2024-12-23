<?php
if (isset($_GET['temperatura']) && isset($_GET['humedad']) && isset($_GET['nombre'])) {
    $temperatura = $_GET['temperatura'];
    $humedad = $_GET['humedad'];
    $sensorName = $_GET['nombre']; // Recibimos el nombre del ESP32

    // Conexión a la base de datos
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=prueba1", "root", ""); // Ajusta según tu configuración
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verificar si el sensor ya existe
        $sensorStmt = $pdo->prepare("SELECT id FROM sensors WHERE name = :name");
        $sensorStmt->execute(['name' => $sensorName]);
        $sensor = $sensorStmt->fetch(PDO::FETCH_ASSOC);

        if (!$sensor) {
            // Crear un nuevo sensor si no existe
            $createSensorStmt = $pdo->prepare("INSERT INTO sensors (name, is_visible, location, created_at, updated_at) VALUES (:name, :is_visible, :location, NOW(), NOW())");
            $createSensorStmt->execute([
                'name' => $sensorName,
                'is_visible' => false, // Valor predeterminado
                'location' => 'No especificada', // Valor predeterminado
            ]);

            // Obtener el ID del nuevo sensor
            $sensorId = $pdo->lastInsertId();
        } else {
            $sensorId = $sensor['id'];
        }

        // Insertar los datos en la tabla readings
        $sql = "INSERT INTO readings (sensor_id, temperature, humidity, created_at) VALUES (:sensor_id, :temperature, :humidity, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'sensor_id' => $sensorId,
            'temperature' => $temperatura,
            'humidity' => $humedad,
        ]);

        echo "Datos insertados correctamente";
    } catch (PDOException $e) {
        echo "Error al insertar datos: " . $e->getMessage();
    }
} else {
    echo "Faltan parámetros en la solicitud.";
}
?>
