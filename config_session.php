<?php

// Ensure no output before this script
if (headers_sent($file, $line)) {
    die("Headers already sent in $file on line $line");
}

// Set session settings before starting the session
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

// Set session cookie parameters
session_set_cookie_params([
    "lifetime" => 1800,
    "domain" => "localhost",
    "path" => "/",
    "secure" => false, // Set to true in production with HTTPS
    "httponly" => true
]);

// Start the session
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Regenerate session ID if needed
if (!isset($_SESSION['last_regenerated'])) {
    regenerate_session_id();
} else {
    $interval = 60 * 30; // 30 minutes
    if (time() - $_SESSION['last_regenerated'] >= $interval) {
        regenerate_session_id();
    }
}

function regenerate_session_id() {
    session_regenerate_id(true);
    $_SESSION['last_regenerated'] = time();
}
