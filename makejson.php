<?php
// Directory containing MP4 files
$directory = '/var/www/html/public_files/dank_memes/';

// Function to get list of MP4 files in a directory
function getMP4Files($directory) {
    $mp4Files = [];
    $files = scandir($directory);
    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'mp4') {
            $mp4Files[] = $file;
        }
    }
    return $mp4Files;
}

// Function to convert MP4 files to JSON for VideoJS playlist plugin
function convertToPlaylistJSON($mp4Files) {
    $playlistJSON = [];
    foreach ($mp4Files as $index => $file) {
        $playlistJSON[] = [
            'sources' => [
                [
                    'src' => '/public_files/dank_memes/' . $file,
                    'type' => 'video/mp4'
                ]
            ],
            'title' => 'Video ' . ($index + 1)
        ];
    }
    return $playlistJSON;
}

// Main function
function main() {
    global $directory;
    $mp4Files = getMP4Files($directory);
    $playlistJSON = convertToPlaylistJSON($mp4Files);
    // Output JSON
    header('Content-Type: application/json');
    echo json_encode($playlistJSON, JSON_PRETTY_PRINT);
}

// Call the main function
main();
?>

