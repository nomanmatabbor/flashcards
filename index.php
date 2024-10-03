<?php
$meta_description = "This is a flash card platform to share and memorize easily.";
$page_title = isset($_GET['file']) ? 'Flashcards - ' . pathinfo(basename($_GET['file']), PATHINFO_FILENAME) : 'Flashcards';
$meta_keywords = "flashcards, flash cards, memorizing, memorize, free flash cards, flash card maker, free flash card maker"; // Define your keywords here
include('header.php');
?>


<?php
$folderPath = 'flashcards'; // Replace with the path to your folder

if (is_dir($folderPath)) {
    $files = scandir($folderPath);
    $txtFiles = array();

    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'txt') {
            $txtFiles[] = $file;
        }
    }

    // Display all flashcards
    echo '<div class="container mt-5">';
    echo '<h1>List of Flash Cards on Various Topics</h1>';

    echo '<div class="form-group">';
    echo '<label for="search">Search:</label>';
    echo '<input type="text" class="form-control" id="search" name="search">';
    echo '</div>';

    echo '<div class="card-deck" id="flashcards-container">'; // Bootstrap card-deck class

    foreach ($txtFiles as $txtFile) {
        $fileInfo = pathinfo($txtFile);
        $fileName = $fileInfo['filename'];

        echo '<a href="/flashcards.php?file=flashcards' . urlencode("/$txtFile") . '" class="card" data-filename="' . htmlspecialchars($fileName) . '">'; // Wrap entire card in anchor tag
        echo '<div class="card-body">';
        echo '<h3 class="card-title">' . $fileName . '</h3>';

        // Display the first question and answer
        $filePath = $folderPath . '/' . $txtFile;
        $fileContent = file($filePath, FILE_IGNORE_NEW_LINES);
        $firstQuestion = isset($fileContent[0]) ? $fileContent[0] : '';
        $firstAnswer = isset($fileContent[1]) ? $fileContent[1] : '';

        echo '<p class="card-text"><strong></strong> ' . htmlspecialchars($firstQuestion) . '</p>';
        echo '<p class="card-text"><strong></strong> ' . htmlspecialchars($firstAnswer) . ' Read More >></p>';

        echo '</div>'; // Close the card-body div
        echo '</a>'; // Close the anchor tag
    }

    echo '</div>'; // Close the card-deck div

    echo '</div>'; // Close the container div

    // Display pagination
    $filesPerPage = 10;
    $totalFiles = count($txtFiles);
    $totalPages = ceil($totalFiles / $filesPerPage);

    if ($totalPages > 1) {
        echo '<div class="container mt-3">';
        echo '<nav aria-label="Page navigation">';
        echo '<ul class="pagination justify-content-center" id="pagination">';

        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<li class="page-item">';
            echo '<a class="page-link" href="#">' . $i . '</a>';
            echo '</li>';
        }

        echo '</ul>';
        echo '</nav>';
        echo '</div>';
    }

    echo '<script>';
    echo 'document.addEventListener("DOMContentLoaded", function () {';
    echo 'const flashcardsContainer = document.getElementById("flashcards-container");';
    echo 'const pagination = document.getElementById("pagination");';
    echo 'const searchInput = document.getElementById("search");';

    echo 'const cards = Array.from(flashcardsContainer.querySelectorAll(".card"));';
    echo 'const cardsPerPage = ' . $filesPerPage . ';';

    echo 'function showPage(page) {';
    echo 'const start = (page - 1) * cardsPerPage;';
    echo 'const end = start + cardsPerPage;';
    echo 'cards.forEach((card, index) => {';
    echo 'card.style.display = index >= start && index < end ? "block" : "none";';
    echo '});';
    echo '}';

    echo 'pagination.addEventListener("click", function (event) {';
    echo 'if (event.target.tagName === "A") {';
    echo 'event.preventDefault();';
    echo 'const page = parseInt(event.target.textContent);';
    echo 'showPage(page);';
    echo '}';
    echo '});';

    echo 'searchInput.addEventListener("input", function () {';
    echo 'const searchQuery = searchInput.value.toLowerCase();';
    echo 'cards.forEach((card) => {';
    echo 'const fileName = card.getAttribute("data-filename").toLowerCase();';
    echo 'const display = fileName.includes(searchQuery) ? "block" : "none";';
    echo 'card.style.display = display;';
    echo '});';
    echo '});';

    echo 'showPage(1);'; // Show the first page initially
    echo '});';
    echo '</script>';
    echo '</body>';
    echo '</html>';
} else {
    echo 'The folder does not exist.';
}
?>
     
<?php include 'footer.php'; ?>