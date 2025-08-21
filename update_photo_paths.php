<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Get tickets with photos
$tickets = \App\Models\Ticket::whereNotNull('photos')->get();

foreach ($tickets as $ticket) {
    $photos = $ticket->photos;
    $updatedPhotos = [];
    
    foreach ($photos as $photo) {
        // Remove "tickets/" prefix if it exists
        $filename = str_replace('tickets/', '', $photo);
        $updatedPhotos[] = $filename;
    }
    
    // Update the ticket with new photo paths
    $ticket->update(['photos' => $updatedPhotos]);
    
    echo "Updated ticket #{$ticket->id} - Photos: " . implode(', ', $updatedPhotos) . "\n";
}

echo "Photo paths updated successfully!\n";