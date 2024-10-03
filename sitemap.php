<?php

function generate_sitemap($folderPath, $baseUrl) {
    $xml = new SimpleXMLElement('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

    $files = scandir($folderPath);

    foreach ($files as $filename) {
        if (pathinfo($filename, PATHINFO_EXTENSION) === 'txt') {
            $fileUrl = $baseUrl . '/flashcards.php?file=flashcards%2F' . urlencode($filename);
            $url = $xml->addChild('url');
            $url->addChild('loc', $fileUrl);

            // Get the last modification time of the file
            $lastMod = filemtime($folderPath . '/' . $filename);
            $lastModDate = date('c', $lastMod);
            $url->addChild('lastmod', $lastModDate);
        }
    }

    return $xml->asXML();
}

// Example usage
$folderPath = 'flashcards'; // Replace with the actual path to your text files
$baseUrl = 'https://flash.cardcodegenerator.com'; // Replace with your website's base URL

$xmlContent = generate_sitemap($folderPath, $baseUrl);

// Save the XML content to a file
file_put_contents('sitemap.xml', $xmlContent);

?>
