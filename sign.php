<?php

require_once 'common.php';

// Conf
$conf = parse_ini_file('jwt.conf');

// Header
$header = ['typ' => 'JWT', 'alg' => 'HS256'];

// Payload
$payload = (object) [];
$payload->data = file_get_contents('php://input');

json_decode($payload->data, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400); // Bad Request

    echo json_encode([
        "error" => "Invalid JSON payload provided.",
        "details" => json_last_error_msg()
    ]);

    exit;
}

$payload->sub = md5(uniqid($payload->data));
$payload->aud = $_SERVER['REMOTE_ADDR'];
$payload->iss = $conf['issuer'];
$payload->exp = time() + ((int) $conf['token_exp']);

// JSON
$header = json_encode($header);
$payload_json = $payload;
$payload = json_encode($payload);

// Base 64
$header = base64url_encode($header);
$payload = base64url_encode($payload);

// Sign
$sign = hash_hmac('sha256', $header . '.' . $payload, $conf['secret'], true);
$sign = base64url_encode($sign);

// Token
$token = $header . '.' . $payload . '.' . $sign;

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");

echo json_encode([
  'token' => $token,
  'expires' => $payload_json->exp
]);

?>
