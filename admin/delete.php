<?php
// Get the file to delete from the query parameter
if (isset($_GET['file'])) {
    $fileToDelete = urldecode($_GET['file']);

    // Check if the file exists and is a .txt file
    if (file_exists($fileToDelete) && pathinfo($fileToDelete, PATHINFO_EXTENSION) === 'txt') {
        // Attempt to delete the file
        if (unlink($fileToDelete)) {
            echo '<h1>File Deleted</h1>';
            echo '<p>The text file has been successfully deleted.</p>';
        } else {
            echo '<h1>Delete Error</h1>';
            echo '<p>There was an error while trying to delete the file.</p>';
        }
    } else {
        echo '<h1>Invalid File</h1>';
        echo '<p>The specified file does not exist or is not a valid text file.</p>';
    }
} else {
    echo '<h1>No File Specified</h1>';
    echo '<p>No file has been specified for deletion.</p>';
}
?>
