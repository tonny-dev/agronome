<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Create a test registration request
$request = Request::create('/register', 'POST', [
    'first_name' => 'Test',
    'other_names' => 'User',
    'email' => 'test@example.com',
    'mobile' => '0712345678',
    'password' => 'password123',
    'password_confirmation' => 'password123',
    '_token' => 'test-token'
]);

try {
    $response = $kernel->handle($request);
    echo "Registration test completed\n";
    echo "Status: " . $response->getStatusCode() . "\n";
    echo "Content: " . substr($response->getContent(), 0, 200) . "...\n";
} catch (Exception $e) {
    echo "Error during registration: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}

$kernel->terminate($request, $response ?? null);
