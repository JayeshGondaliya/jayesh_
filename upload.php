<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photos'])) {
    $uploadedPhotos = $_FILES['photos'];
    $uploadErrors = [];
    foreach ($uploadedPhotos['tmp_name'] as $key => $tmpName) {
        $filename = 'images/' . uniqid() . '_' . basename($uploadedPhotos['name'][$key]);
        if (move_uploaded_file($tmpName, $filename)) {
            // File uploaded successfully
        } else {
            $uploadErrors[] = 'Error uploading ' . $uploadedPhotos['name'][$key];
        }
    }
    if (empty($uploadErrors)) {
        echo 'All photos uploaded successfully!';
    } else {
        echo implode("\n", $uploadErrors);
    }
} else {
    echo 'Invalid request.';
}
?>
