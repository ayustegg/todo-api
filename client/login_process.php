<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el correo electrónico y la contraseña del formulario
    $json_data = file_get_contents("php://input");

    // Decodificar el JSON en un arreglo asociativo
    $data = json_decode($json_data, true);

    // Verificar si los datos se decodificaron correctamente
    if ($data !== null) {
        // Ahora puedes acceder a los datos de inicio de sesión
        $email = $data["email"];
        $password = $data["password"];

        // Continúa con la lógica de inicio de sesión
        // ...
    } else {
        // Manejar errores de decodificación JSON
        echo "Error al decodificar los datos JSON.";
    }
    $data_json = json_encode($data);
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_PORT => "3000",
  CURLOPT_URL => "http://localhost:3000/api/user/login",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $data_json,
  CURLOPT_HTTPHEADER => [
    "Accept: */*",
    "Content-Type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);


curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
}