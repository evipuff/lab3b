<?php

// Define the upload directory
$upload_directory = getcwd() . '/uploads/';
$relative_path = '/uploads/';

// Ensure upload directory exists
if (!is_dir($upload_directory)) {
    mkdir($upload_directory, 0777, true);
}

// Function to handle file uploads
function handle_file_upload($file_key, $allowed_types, $upload_directory) {
    if (isset($_FILES[$file_key]) && $_FILES[$file_key]['error'] === UPLOAD_ERR_OK) {
        $file_name = basename($_FILES[$file_key]['name']);
        $file_path = $upload_directory . $file_name;
        $temporary_file = $_FILES[$file_key]['tmp_name'];
        $file_type = mime_content_type($temporary_file);

        // Debugging information
        echo "File Type: $file_type\n";
        echo "Allowed Types: " . implode(', ', $allowed_types) . "\n";

        if (in_array($file_type, $allowed_types)) {
            if (move_uploaded_file($temporary_file, $file_path)) {
                return $file_path;
            } else {
                return 'Failed to move uploaded file';
            }
        } else {
            return 'Invalid file type';
        }
    } else {
        return 'No file uploaded or upload error';
    }
}

// Handle each file type
$text_file_message = handle_file_upload('text_file', ['text/plain'], $upload_directory);
$pdf_file_message = handle_file_upload('pdf_file', ['application/pdf'], $upload_directory);
$audio_file_message = handle_file_upload('audio_file', ['audio/mpeg'], $upload_directory);
$video_file_message = handle_file_upload('video_file', ['video/mp4'], $upload_directory);

// Display file content for text files
if (is_string($text_file_message) && strpos($text_file_message, 'Failed') === false && strpos($text_file_message, 'Invalid') === false) {
    $text_file_content = file_get_contents($text_file_message);
    ?>
    <textarea cols="70" rows="30"><?php echo htmlspecialchars($text_file_content); ?></textarea>
    <?php
} else {
    echo $text_file_message;
}

//test comment

// Display debug information
echo '<pre>';
var_dump($_FILES);
echo '</pre>';
exit;
