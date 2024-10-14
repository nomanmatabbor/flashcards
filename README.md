# Flashcard Educational Website

This is an educational website designed to help students memorize complicated topics through the use of flashcards. It is a simple and effective tool where students can upload custom flashcards and practice their questions and answers interactively.

## Project Structure

Here is the structure of the Flashcard Educational Website project:

```
Flashcard Educational Website
│
├── admin/                     # Folder containing admin panel or related scripts
│   ├── add_new.php            # Script to add new flashcards or content
│   ├── dashboard.php           # Admin dashboard for managing flashcards
│   ├── delete.php              # Script to delete flashcards or records
│   ├── delete_images.php       # Script to delete uploaded images
│   ├── edit.php                # Script for editing existing flashcards
│   ├── error_log               # Log file for errors (could be logs from server or PHP errors)
│   ├── index.php               # Main admin page (could redirect to dashboard)
│   ├── password.txt            # Possibly contains a password for accessing the admin panel (ensure it's secure!)
│   └── upload_image.php        # Script to handle image uploads
│
├── flashcards/                 # Folder where flashcard data (files, images, etc.) might be stored
│
├── images/                     # Folder containing images used in the project
│
├── LICENSE                     # MIT License file for the project
│
├── README.md                   # Project description and documentation
│
├── favicon.ico                 # Favicon (icon shown in browser tabs)
├── favicon.png                 # Alternative favicon in PNG format
│
├── index.php                   # Main file for the web app, acts as entry point for users
├── info.php                    # File for displaying PHP info or other related info
│
├── manifest.json               # Web App manifest for PWA support
│
├── robots.txt                  # File to control search engine crawling
│
├── sample                      # Likely a sample or test HTML file
│
├── sitemap.php                 # Dynamic PHP-based sitemap for search engines
└── sitemap.xml                 # XML-based sitemap for search engines
```

## Features

1. **Installable as a Web App**: The website can be installed as a Progressive Web App (PWA) in major web browsers like Edge, Chrome, and others for easy access and offline use.
   
2. **Flashcard Upload**: Users can upload a `flashcard.txt` file where questions and answers are separated by a tab (`<tab>`). This allows for easy bulk uploads of flashcards.

3. **Interactive Question & Answer Display**: 
   - Questions will be displayed one by one, and the corresponding answers will be hidden by default.
   - By clicking the "See Answer" button, users can reveal the answer and practice effectively.

4. **Mark Questions as Done**: Once a user has completed a flashcard, they can click the "Done" button. This will update a progress bar, allowing the user to track their study progress.

5. **Image URL Support**: Users can also include image URLs in their question and answer pairs. This is particularly helpful for visual learners or when studying topics that require image references.

## Usage Instructions

1. Upload a `.txt` file with questions and answers separated by a tab (`<tab>`). For example:

2. Click "See Answer" to reveal the hidden answer for each question.

3. Once you have answered a question, click "Done" to mark it as completed and update your progress.

4. You can also include an image URL in your flashcard to enhance your learning experience:

## Installation

1. Open the website in your browser.
2. In Chrome or Edge, look for the install icon in the address bar and click it to install the site as a web app.
3. Once installed, you can access the website like a native app from your home screen or desktop.

## Contributing

Feel free to contribute to the development of this project by submitting issues or pull requests. Your contributions will help improve the functionality and user experience of the flashcard educational website.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.
