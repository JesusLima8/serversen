<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Ubicación</title>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Seleccionar Ubicación</h1>
    <p>Arrastra el marcador para obtener la latitud y longitud:</p>
    <div id="map"></div>
    <div>
        <label>Latitud: </label>
        <input type="text" id="latitude" readonly>
        <label>Longitud: </label>
        <input type="text" id="longitude" readonly>
    </div>
    <button id="saveLocation">Guardar y Volver</button>

    <script>
        function initMap() {
            const defaultLocation = { lat: -16.3989, lng: -71.5369 }; // UNSA - Arequipa
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: defaultLocation,
            });

            const marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true,
            });

            // Actualiza los campos de latitud y longitud al mover el marcador
            marker.addListener("dragend", (event) => {
                document.getElementById("latitude").value = event.latLng.lat();
                document.getElementById("longitude").value = event.latLng.lng();
            });

            // Permite que un clic en el mapa mueva el marcador
            map.addListener("click", (event) => {
                marker.setPosition(event.latLng);
                document.getElementById("latitude").value = event.latLng.lat();
                document.getElementById("longitude").value = event.latLng.lng();
            });
        }

        // Guardar coordenadas en localStorage y redirigir al formulario de creación
        document.getElementById("saveLocation").addEventListener("click", () => {
            const lat = document.getElementById("latitude").value;
            const lng = document.getElementById("longitude").value;

            if (lat && lng) {
                localStorage.setItem("selectedLatitude", lat);
                localStorage.setItem("selectedLongitude", lng);
                window.location.href = "/admin/sensors/create"; // Cambia la ruta según sea necesario
            } else {
                alert("Por favor selecciona una ubicación antes de guardar.");
            }
        });
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBol5qVgsckP561gyJ2ZmOwq4JOF4ZSKhA&callback=initMap" async defer></script>
</body>
</html>
