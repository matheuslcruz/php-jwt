<?php

require_once 'common.php';

// Conf
$conf = parse_ini_file('jwt.conf');
$token_parts = explode('.', $_GET['token']);
header("Access-Control-Allow-Origin: *");

if (count($token_parts) !== 3) {
  header("HTTP/1.1 400 Invalid token");
  header("Content-type: application/json");

  echo json_encode([
    'message' => 'Invalid token',
    'token' => $_GET['token']
  ]);
} else {
  $sign = hash_hmac('sha256', $token_parts[0] . '.' . $token_parts[1], $conf['secret'], true);
  $sign = base64url_encode($sign);

  if ($token_parts[2] !== $sign) {
    header("HTTP/1.1 401 Invalid token");
    header("Content-type: application/json");

    echo json_encode([
      'message' => 'Signature missmatch',
      'token' => $_GET['token']
    ]);
  } else {
    $payload = base64url_decode($token_parts[1]);
    $payload_decoded = json_decode($payload);
    $now = time();

    if ((int) $payload_decoded->exp > (int) $now) {
      header("Content-type: application/json");
      echo $payload;
    } else {
      header("HTTP/1.1 401 Expired token");
      header("Content-type: application/json");

      echo json_encode([
        'message' => "Token expired at ".date(DATE_RSS, $payload_decoded->exp),
        'token' => $_GET['token']
      ]);
    }
  }
}

?>
