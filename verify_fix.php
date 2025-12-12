<?php

use App\Models\Order;
use App\Models\ContactMessage;

require __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Testing Order Creation...\n";
try {
    $order = Order::create([
        'order_number' => 'TEST-' . uniqid(),
        'customer_name' => 'Test User',
        'email' => 'test@example.com',
        'address' => '123 Test St',
        'total' => 100.00,
        'status' => 'Pending',
        'date' => now(),
    ]);
    file_put_contents('verification_log.txt', "Order created successfully: ID " . $order->id . ", Address: " . $order->address . "\n", FILE_APPEND);
} catch (\Exception $e) {
    echo "Failed to create order: " . $e->getMessage() . "\n";
}

echo "Testing ContactMessage Creation...\n";
try {
    $message = ContactMessage::create([
        'name' => 'Test Contact',
        'email' => 'contact@example.com',
        'phone' => '1234567890',
        'subject' => 'Test Subject',
        'message' => 'This is a test message.',
        'date' => now(),
    ]);
    file_put_contents('verification_log.txt', "ContactMessage created successfully: ID " . $message->id . ", Date: " . $message->date . "\n", FILE_APPEND);
} catch (\Exception $e) {
    echo "Failed to create contact message: " . $e->getMessage() . "\n";
}

echo "\nVerifying Retrieval...\n";
$firstOrder = \App\Models\Order::latest()->first();
if ($firstOrder) {
    file_put_contents('verification_log.txt', "Latest Order Retrieved: " . $firstOrder->order_number . "\n", FILE_APPEND);
} else {
    file_put_contents('verification_log.txt', "Failed to retrieve order.\n", FILE_APPEND);
}

$firstMessage = \App\Models\ContactMessage::latest()->first();
if ($firstMessage) {
    file_put_contents('verification_log.txt', "Latest Message Retrieved: " . $firstMessage->subject . "\n", FILE_APPEND);
} else {
    file_put_contents('verification_log.txt', "Failed to retrieve message.\n", FILE_APPEND);
}
