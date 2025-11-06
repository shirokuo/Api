<?php
error_reporting(0);
ob_clean();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

function validateApiKey($api_key) {
    $valid_keys = array(
        "DEMO123456" => strtotime('+7 days') * 1000,
        "DEMO30" => strtotime('+30 seconds') * 1000,
        "PREMIUM001" => strtotime('+30 days') * 1000,
        "PREMIUM002" => strtotime('+90 days') * 1000,
        "LIFETIME01" => strtotime('+10 years') * 1000
    );
    return isset($valid_keys[$api_key]) ? $valid_keys[$api_key] : false;
}

$api_key = isset($_POST['api_key']) ? trim($_POST['api_key']) : '';

if ($api_key == '') {
    ob_clean();
    echo json_encode(['status' => 'error', 'message' => 'API Key is required']);
    exit;
}

$expiry_timestamp = validateApiKey($api_key);

ob_clean();
if ($expiry_timestamp !== false) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Premium activated successfully',
        'expiry' => $expiry_timestamp
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid API Key'
    ]);
}
