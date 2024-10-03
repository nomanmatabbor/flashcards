<!DOCTYPE html>
<html>
<head>
    <title>Add New File</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php
$folderPath = '../flashcards'; // Replace with the path to your folder

if (isset($_POST['newFileName']) && isset($_POST['newFileContent'])) {
    $newFileName = $_POST['newFileName'];
    $newFileContent = $_POST['newFileContent'];

    if (!empty($newFileName) && !empty($newFileContent)) {
        $newFilePath = $folderPath . '/' . $newFileName . '.txt';
        if (file_put_contents($newFilePath, $newFileContent) !== false) {
            echo '<div class="alert alert-success" role="alert">New text file created successfully.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error creating the new text file.</div>';
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">Please enter both file name and content to create a new text file.</div>';
    }
}
?>

    <div class="container mt-5">
        <h1>Create a New .txt File</h1>
        <form method="POST">
            <div class="form-group">
                <label for="newFileName">File Name</label>
                <input type="text" class="form-control" id="newFileName" name="newFileName" placeholder="Enter file name">
            </div>
            <div class="form-group">
                <label for="newFileContent">File Content</label>
                <textarea class="form-control" id="newFileContent" name="newFileContent" rows="5" placeholder="Enter file content"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
        <a href="upload_image.php">Uplaod an image</a>
    </div>

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Allow typing tabs in the newFileContent textarea
        document.getElementById('newFileContent').addEventListener('keydown', function (e) {
            if (e.key === 'Tab') {
                e.preventDefault();
                var start = this.selectionStart;
                var end = this.selectionEnd;
                var text = this.value;
                this.value = text.substring(0, start) + '\t' + text.substring(end);
                this.selectionStart = this.selectionEnd = start + 1;
            }
        });
    </script>
</body>
</html>
