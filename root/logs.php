<?php
require "config.php";

function getUserIpAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}


function getLocationFromIp($ip) {
    $url = "http://ipinfo.io/{$ip}/json";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    
    $data = json_decode($response, true);
    return isset($data['city']) ? "{$data['city']}, {$data['region']}, {$data['country']}" : 'Unknown';
}

function logUserLogin($userId, $pdo) {
    $ipAddress = getUserIpAddress();
    $location = getLocationFromIp($ipAddress);

    $stmt = $pdo->prepare("INSERT INTO user_activity (user_id, login_time, ip_address, location) VALUES (:user_id, NOW(), :ip_address, :location)");
    $stmt->execute([
        'user_id' => $userId,
        'ip_address' => $ipAddress,
        'location' => $location
    ]);
}

function logPageVisit($userId, $page, $pdo) {
    $ipAddress = getUserIpAddress();
    $location = getLocationFromIp($ipAddress);

    $stmt = $pdo->prepare("INSERT INTO user_activity (user_id, page_visited, visit_time, ip_address, location) VALUES (:user_id, :page, NOW(), :ip_address, :location)");
    $stmt->execute([
        'user_id' => $userId,
        'page' => $page,
        'ip_address' => $ipAddress,
        'location' => $location
    ]);
}


?>