<?php
session_start();

// 1. Authentication Check
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit();
}

$successMessage = '';
$errorMessage = '';
$isAdmin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : false;

// 2. CSRF Validation Helper
function validateCSRF() {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Security violation: Invalid CSRF token.");
    }
}

// Handle book deletion (admin only)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_book']) && $isAdmin) {
    validateCSRF(); // Security Check
    $bookId = intval($_POST['book_id'] ?? 0);
    
    $booksFile = 'books.json';
    if (file_exists($booksFile)) {
        $booksJson = file_get_contents($booksFile);
        $books = json_decode($booksJson, true);
        
        if (is_array($books)) {
            $books = array_filter($books, function($book) use ($bookId) {
                return $book['id'] !== $bookId;
            });
            
            $books = array_values($books);
            
            // 3. Secure File Write: Use LOCK_EX to prevent corruption
            if (file_put_contents($booksFile, json_encode($books, JSON_PRETTY_PRINT), LOCK_EX)) {
                $successMessage = 'Kitap kaydı başarı ile silindi :)';
            } else {
                $errorMessage = 'Kitap silme başarısız!!!.';
            }
        }
    }
}

// Handle book suggestion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['suggest_book'])) {
    validateCSRF(); // Security Check
    
    // 4. Input Sanitization
    $bookTitle = trim(filter_var($_POST['book_title'] ?? '', FILTER_SANITIZE_STRING));
    $bookAuthor = trim(filter_var($_POST['book_author'] ?? '', FILTER_SANITIZE_STRING));
    
    if (empty($bookTitle) || empty($bookAuthor)) {
        $errorMessage = 'Kitap adı ve yazar bilgisi zorunludur!';
    } else {
        $booksFile = 'books.json';
        $books = [];
        
        if (file_exists($booksFile)) {
            $booksJson = file_get_contents($booksFile);
            $books = json_decode($booksJson, true);
        }
        
        // CHANGED: Get optional comment and cover link
        $bookComment = trim(filter_var($_POST['book_comment'] ?? '', FILTER_SANITIZE_STRING));
        $coverLink = trim(filter_var($_POST['cover_link'] ?? '', FILTER_SANITIZE_URL));
        
        // Check for duplicate book with same title AND author
        $isDuplicate = false;
        foreach ($books as $book) {
            $existingTitle = strtolower(trim($book['title']));
            $existingAuthor = strtolower(trim($book['author'] ?? ''));
            $newTitle = strtolower(trim($bookTitle));
            $newAuthor = strtolower(trim($bookAuthor));
            
            if ($existingTitle === $newTitle && $existingAuthor === $newAuthor) {
                $isDuplicate = true;
                break;
            }
        }

        date_default_timezone_set('Europe/Istanbul');
        
        if ($isDuplicate) {
            $errorMessage = 'Yazarın bu kitabı önerilen kitaplarda zaten mevcut. Lütfen farklı bir kitap önerin.';
        } else {
            $maxId = 0;
            foreach ($books as $book) {
                if (isset($book['id']) && $book['id'] > $maxId) {
                    $maxId = $book['id'];
                }
            }
        
        $newBook = [
            'id' => $maxId + 1,
            'title' => $bookTitle,
            'author' => $bookAuthor,
            'advicer' => $_SESSION['user_email'],
            'comment' => $bookComment, 
            'cover_link' => $coverLink,
            'year' => null,
            'genres' => null,
            'added_date' => date('Y-m-d H:i:s'),
        ];
        
        $books[] = $newBook;
        
        // Secure File Write
        if (file_put_contents($booksFile, json_encode($books, JSON_PRETTY_PRINT), LOCK_EX)) {
            $successMessage = 'Kitap öneriniz başarıyla kaydedildi. Teşekkürler!';
        } else {
            $errorMessage = 'Kitap önerisi kaydedilemedi. Lütfen tekrar deneyin.';
        }
    }
} }

// CHANGED: Get view preference with auto-detection support
// Check URL parameter first (manual selection), otherwise check if it's first load
$viewMode = isset($_GET['view']) ? $_GET['view'] : null;

// If no view parameter, this might be auto-selection from JavaScript or first load
// Default to 'cards' - JavaScript will redirect if needed based on screen size
if ($viewMode === null) {
    $viewMode = 'cards'; // Default for first load and mobile
}

// Read books from JSON file for display and duplicate check
$booksFile = 'books.json';
$books = [];
if (file_exists($booksFile)) {
    $booksJson = file_get_contents($booksFile);
    $books = json_decode($booksJson, true);
    if (!is_array($books)) {
        $books = [];
    }
}

// Sort books by ID in descending order (highest to lowest)
if (!empty($books)) {
    usort($books, function($a, $b) {
        $idA = isset($a['id']) ? $a['id'] : 0;
        $idB = isset($b['id']) ? $b['id'] : 0;
        return $idB - $idA; // Descending order
    });
}

// Determine if search functionality should be shown
$showSearch = count($books) > 10;

// Prepare books data for JavaScript
$booksJson = json_encode($books);
?>
<!doctype html>
<html>
    <head>
        <title>Book List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Bootsrap 4 CDN-->
        <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous"
        />

        <!--Fontawesome CDN-->
        <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous"
        />

        <style>
            body {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                background-image: url(image-ephesus.png);
                background-size: cover;
                background-attachment: fixed;
                background-position: center;
                min-height: 100vh;
                font-family: "Numans", sans-serif;
                padding: 15px;
            }
            
            .header-section {
                background-color: rgba(255, 255, 255, 0.95);
                border-radius: 10px;
                padding: 15px;
                margin-bottom: 20px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .header-section h2 {
                font-size: 1.8rem; /* CHANGED: Responsive font size */
                margin-bottom: 0.5rem;
            }

            .search-section {
                background-color: rgba(255, 255, 255, 0.95);
                border-radius: 10px;
                padding: 20px;
                margin-bottom: 20px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            
            .search-section .form-control {
                border-radius: 25px;
                padding: 10px 20px;
                border: 2px solid #dee2e6;
            }
            
            .search-section .form-control:focus {
                border-color: #667eea;
                box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
            }
            
            .search-icon {
                color: #667eea;
                font-size: 1.2rem;
            }
            
            .clear-search-btn {
                background-color: #6c757d;
                color: white;
                border: none;
                padding: 8px 20px;
                border-radius: 20px;
                font-size: 0.9rem;
                cursor: pointer;
                transition: background-color 0.2s;
            }
            
            .clear-search-btn:hover {
                background-color: #5a6268;
            }
            
            .search-results-info {
                color: #667eea;
                font-weight: 500;
                margin-top: 10px;
            }
            
            .suggest-section {
                background-color: rgba(255, 255, 255, 0.95);
                border-radius: 10px;
                padding: 20px;
                margin-bottom: 20px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            
            .books-container {
                background-color: rgba(255, 255, 255, 0.95);
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            
            .book-card {
                background-color: #fff;
                border: 1px solid #dee2e6;
                border-radius: 8px;
                padding: 15px;
                margin-bottom: 15px;
                transition: transform 0.2s, box-shadow 0.2s;
            }
            
            .book-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            }
            
            .book-title {
                color: #667eea;
                font-size: 1.25rem;
                font-weight: bold;
                margin-bottom: 10px;
                word-wrap: break-word;
            }
            
            .book-author {
                color: #6c757d;
                font-size: 1rem;
                margin-bottom: 5px;
            }
            
            .book-details {
                color: #495057;
                font-size: 0.9rem;
            }
            
            .logout-btn {
                background-color: #ffc312;
                color: black;
                border: none;
                padding: 8px 20px;
                border-radius: 5px;
                font-weight: bold;
                font-size: 0.9rem;
            }
            
            .logout-btn:hover {
                background-color: white;
                color: black;
            }
            
            .badge-genre {
                background-color: #764ba2;
                color: white;
                padding: 4px 10px;
                border-radius: 15px;
                font-size: 0.85rem;
                display: inline-block;
                margin: 2px;
            }
            
            .badge-advicer {
                background-color: #ffc312;
                color: black;
                padding: 4px 10px;
                border-radius: 15px;
                font-size: 0.85rem;
                display: inline-block;
                margin: 2px;
                word-break: break-word;
            }
            
            .suggest-btn {
                background-color: #667eea;
                color: white;
                border: none;
                padding: 10px 30px;
                border-radius: 5px;
                font-weight: bold;
            }
            
            .suggest-btn:hover {
                background-color: #764ba2;
                color: white;
            }
            
            .form-control:focus {
                border-color: #667eea;
                box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            }
            
            .view-toggle {
                margin-bottom: 0; 
                display: flex;
                flex-wrap: wrap; 
                gap: 8px; 
            }
            
            .view-btn {
                background-color: #f8f9fa;
                color: #495057;
                border: 1px solid #dee2e6;
                padding: 8px 16px;
                border-radius: 5px;
                margin-right: 10px;
                font-weight: 500;
                font-size: 0.9rem;
            }
            
            .view-btn:hover {
                background-color: #e9ecef;
                color: #495057;
            }
            
            .view-btn.active {
                background-color: #667eea;
                color: white;
                border-color: #667eea;
            }
            
            .view-btn.active:hover {
                background-color: #764ba2;
                border-color: #764ba2;
            }

            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
            }
            
            .table-books {
                background-color: white;
                font-size: 0.9rem;
            }
            
            .table-books th {
                background-color: #667eea;
                color: white;
                border: none;
                font-weight: 600;
                position: sticky; /* Sticky header */
                top: 0;
                z-index: 10;
            }
            
            .table-books td {
                vertical-align: middle;
                word-wrap: break-word;
            }
            
            .book-cover {
                width: 40px;
                height: 56px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border-radius: 4px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 20px;
            }
            
            .delete-btn {
                background-color: #dc3545;
                color: white;
                border: none;
                padding: 6px 12px;
                border-radius: 5px;
                font-size: 0.85rem;
            }
            
            .delete-btn:hover {
                background-color: #c82333;
                color: white;
            }
            
            .admin-badge {
                background-color: #28a745;
                color: white;
                padding: 3px 8px;
                border-radius: 10px;
                font-size: 0.75rem;
                margin-left: 10px;
            }

            /* Style for hidden books during search */
            .book-card.hidden,
            .table-books tr.hidden {
                display: none;
            }

            /* Mobile-specific readability fixes */
            @media (max-width: 768px) {
                body {
                    padding: 10px;
                }
                
                .header-section,
                .suggest-section,
                .books-container {
                    padding: 15px;
                    margin-bottom: 15px;
                }
                
                .header-section h2 {
                    font-size: 1.4rem;
                }
                
                .header-section .d-flex {
                    flex-direction: column;
                    align-items: stretch !important;
                }
                
                .header-section .d-flex > div:first-child {
                    margin-bottom: 15px;
                }
                
                .logout-btn {
                    width: 100%;
                    text-align: center;
                }
                
                .book-title {
                    font-size: 1.1rem;
                }
                
                .book-author {
                    font-size: 0.95rem;
                }
                
                .book-details {
                    font-size: 0.85rem;
                }

                /* Make buttons easier to tap */
                .btn {
                    padding: 12px;
                    font-size: 1rem;
                }
                
                .suggest-btn {
                    width: 100%;
                }
                
                .view-toggle {
                    width: 100%;
                    justify-content: space-between;
                    margin-bottom: 15px;
                }
                
                .view-btn {
                    flex: 1;
                    text-align: center;
                }

                /* Table adjustments for mobile */
                .table-books {
                    font-size: 0.8rem;
                }
                
                .table-books th,
                .table-books td {
                    padding: 8px 5px;
                    white-space: nowrap;
                }
                
                .book-cover {
                    width: 30px;
                    height: 42px;
                    font-size: 16px;
                }
                
                /* Hide less important columns on mobile */
                .table-books th:nth-child(5),
                .table-books td:nth-child(5) {
                    display: none;
                }
                
                /* Ensure form inputs are touch-friendly */
                .form-control {
                    font-size: 16px; /* Prevent zoom on iOS */
                }
                
                .books-container h3 {
                    font-size: 1.3rem;
                }
                
                .books-container .d-flex {
                    flex-direction: column;
                    align-items: stretch !important;
                }
                
                .books-container .d-flex h3 {
                    margin-bottom: 15px !important;
                }
                /* Search section mobile adjustments */
                .search-section .input-group {
                    flex-wrap: wrap;
                }
                
                .clear-search-btn {
                    margin-top: 10px;
                    width: 100%;
                }
            }
            
            /* Tablet-specific styles */
            @media (min-width: 769px) and (max-width: 1024px) {
                .header-section,
                .suggest-section,
                .books-container {
                    padding: 20px;
                }
                
                .table-books {
                    font-size: 0.85rem;
                }
                
                .book-card {
                    padding: 18px;
                }
            }
            
            /* CHANGED: Very small screens */
            @media (max-width: 576px) {
                .header-section p {
                    font-size: 0.9rem;
                }
                
                .admin-badge {
                    display: block;
                    margin-left: 0;
                    margin-top: 5px;
                    width: fit-content;
                }
                
                .book-card {
                    padding: 12px;
                }
            }
            
            /* CHANGED: Improved card grid for different screen sizes */
            @media (max-width: 576px) {
                .col-md-6 {
                    padding-left: 7.5px;
                    padding-right: 7.5px;
                }
            }
        
            
            /* CHANGED: New card layout styles with cover image */
            .book-card-content {
                display: flex;
                gap: 15px;
                align-items: flex-start;
            }
            
            .book-card-cover {
                flex-shrink: 0;
                width: 80px;
                height: 120px;
            }
            
            .book-card-cover img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 4px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            
            .book-cover-placeholder {
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border-radius: 4px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 2rem;
            }
            
            .book-card-info {
                flex: 1;
                min-width: 0;
            }
            
            .book-title-author {
                margin-bottom: 8px;
            }
            
            .book-name {
                color: #667eea;
                font-size: 1.1rem;
                display: block;
                margin-bottom: 4px;
            }
            
            .book-author-inline {
                color: #6c757d;
                font-size: 0.95rem;
                font-style: italic;
            }
            
            .book-adviser {
                margin: 8px 0;
                font-size: 0.9rem;
                color: #555;
            }
            
            .book-comment {
                margin: 10px 0;
                padding: 10px;
                background-color: #f8f9fa;
                border-left: 3px solid #667eea;
                border-radius: 4px;
                font-size: 0.9rem;
                color: #555;
                line-height: 1.5;
                /* white-space: pre-wrap;  */
                word-wrap: break-word; /* CHANGED: Wrap long words */
            }
            
            .book-comment i {
                color: #667eea;
                margin-right: 5px;
            }
            
            .book-meta {
                margin-top: 10px;
                font-size: 0.85rem;
                color: #666;
            }
            
            .book-year {
                margin-right: 10px;
            }
            
            .delete-button-container {
                position: absolute;
                top: 10px;
                right: 10px;
                z-index: 1;
            }
            
            /* CHANGED: Table book cover image styles */
            .book-cover-clickable {
                cursor: pointer;
                transition: transform 0.2s;
            }
            
            .book-cover-clickable:hover {
                transform: scale(1.05);
            }
            
            .table-book-cover-img {
                width: 40px;
                height: 56px;
                object-fit: cover;
                border-radius: 4px;
            }
            
            /* CHANGED: Comment column styles */
            .comment-column {
                max-width: 300px;
            }
            
            .comment-text {
                font-size: 0.85rem;
                color: #555;
                line-height: 1.4;
                /* white-space: pre-wrap;  */
                word-wrap: break-word; /* CHANGED: Wrap long words */
            }
            
            .comment-text i {
                color: #667eea;
                margin-right: 5px;
            }
            
            /* CHANGED: Hide comment column on small screens */
            @media (max-width: 991px) {
                .comment-column {
                    display: none;
                }
                
                .book-cover-clickable {
                    position: relative;
                }
                
                .book-cover-clickable::after {
                    content: '👁';
                    position: absolute;
                    bottom: -5px;
                    right: -5px;
                    font-size: 12px;
                    background: white;
                    border-radius: 50%;
                    width: 20px;
                    height: 20px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
                }
            }
            
            /* CHANGED: Modal styles */
            .modal-comment {
                font-style: italic;
                color: #555;
                padding: 10px;
                background-color: #f8f9fa;
                border-left: 3px solid #667eea;
                border-radius: 4px;
                white-space: pre-wrap; /* CHANGED: Preserve line breaks in comments */
                word-wrap: break-word; /* CHANGED: Wrap long words */
            }
            
            .modal-author, .modal-adviser {
                margin-bottom: 10px;
            }
            
            /* CHANGED: Mobile card adjustments - keep cover on left */
            @media (max-width: 768px) {
                .book-card-content {
                    flex-direction: row; /* CHANGED: Keep horizontal layout on mobile */
                    gap: 10px; /* CHANGED: Smaller gap on mobile */
                }
                
                .book-card-cover {
                    width: 80px; /* CHANGED: Fixed width on mobile */
                    height: 120px; /* CHANGED: Maintain aspect ratio */
                    flex-shrink: 0; /* CHANGED: Prevent cover from shrinking */
                }
                
                .book-card-info {
                    flex: 1;
                    min-width: 0; /* CHANGED: Allow text to wrap properly */
                }
                
                .book-name {
                    font-size: 1rem;
                }
                
                .book-author-inline {
                    font-size: 0.9rem;
                    display: block; /* CHANGED: Stack author below title */
                    margin-top: 2px;
                }
                
                .book-adviser {
                    font-size: 0.85rem;
                    margin: 6px 0;
                }
                
                .book-comment {
                    font-size: 0.85rem;
                }
                
                .table-book-cover-img {
                    width: 30px;
                    height: 42px;
                }
            }
            
            /* CHANGED: Extra small screens - optimize card layout further */
            @media (max-width: 480px) {
                .book-card-content {
                    gap: 8px;
                }
                
                .book-card-cover {
                    width: 60px; /* CHANGED: Smaller cover on very small screens */
                    height: 90px;
                }
                
                .book-name {
                    font-size: 0.95rem;
                }
                
                .book-author-inline {
                    font-size: 0.85rem;
                }
                
                .book-adviser {
                    font-size: 0.8rem;
                    margin: 4px 0;
                }
                
                .badge-advicer {
                    font-size: 0.75rem;
                    padding: 3px 8px;
                }
                
                .book-comment {
                    font-size: 0.8rem;
                }
                
                .book-meta {
                    font-size: 0.75rem;
                }
            }
            /* CHANGED: Style for hidden books during search */
            .col-12.hidden {
                display: none;
            }
            
            .table-books tr.hidden {
                display: none;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="header-section">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2><i class="fas fa-book"></i>EGE KÜTÜPHANE</h2>
                        <p class="mb-0">
                            Merhaba, <?php echo htmlspecialchars($_SESSION['user_email']); ?>
                            <?php if ($isAdmin): ?>
                                <span class="admin-badge"><i class="fas fa-crown"></i> Admin</span>
                            <?php endif; ?>
                        </p>
                    </div>
                    <a href="logout.php" class="btn logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Çıkış Yap
                    </a>
                </div>
            </div>


            
            <!-- Book Suggestion Form -->
            <div class="suggest-section">
                <h4 class="mb-3"><i class="fas fa-lightbulb"></i> BİR KİTAP ÖNERİN -   Lütfen öneri öncesinde kitap adını listeden kontrol edin.</h4>
                
                <?php if ($successMessage): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($successMessage); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                
                <?php if ($errorMessage): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($errorMessage); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="books.php" id="suggestForm">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="book_title"><i class="fas fa-book"></i> Kitap Adı *</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="book_title" 
                                    name="book_title" 
                                    placeholder="Lütfen Kitap Adı giriniz (Boş olamaz)."
                                    value="<?php echo isset($_POST['book_title']) && $errorMessage ? htmlspecialchars($_POST['book_title']) : ''; ?>"
                                    required
                                />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="book_author"><i class="fas fa-user-edit"></i> Yazar(lar) *</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="book_author" 
                                    name="book_author" 
                                    placeholder="Lütfen en az bir yazar adı giriniz (Boş olamaz)."
                                    value="<?php echo isset($_POST['book_author']) && $errorMessage ? htmlspecialchars($_POST['book_author']) : ''; ?>"
                                />
                            </div>
                        </div>
                        <!-- CHANGED: Added cover link input -->
                        <!-- <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="cover_link"><i class="fas fa-image"></i> Cover Image URL</label>
                                <input 
                                    type="url" 
                                    class="form-control" 
                                    id="cover_link" 
                                    name="cover_link" 
                                    placeholder="https://example.com/book-cover.jpg (optional)"
                                    value="<?php echo isset($_POST['cover_link']) && $errorMessage ? htmlspecialchars($_POST['cover_link']) : ''; ?>"
                                />
                                <small class="form-text text-muted">Optional: Link to book cover image</small>
                            </div>
                        </div> -->
                        <!-- CHANGED: Added comment textarea -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="book_comment"><i class="fas fa-comment"></i> Öneren Yorumu</label>
                                <textarea 
                                    class="form-control" 
                                    id="book_comment" 
                                    name="book_comment" 
                                    rows="3" 
                                    placeholder="Lütfen önerinizi veya yorumunuzu ekleyin (isteğe bağlı)"><?php echo isset($_POST['book_comment']) && $errorMessage ? htmlspecialchars($_POST['book_comment']) : ''; ?></textarea>
                                <small class="form-text text-muted">Önerinizi veya yorumunuzu ekleyin</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <button type="submit" name="suggest_book" class="btn suggest-btn btn-block">
                                    <i class="fas fa-plus-circle"></i> Öneri Listesine Kaydet
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

                        <!-- Search Section (only shown if more than 10 books) -->
            <?php if ($showSearch): ?>
            <div class="search-section">
                <h4 class="mb-3"><i class="fas fa-search search-icon"></i> Kitap Ara</h4>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-right-0" style="border-radius: 25px 0 0 25px;">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                    </div>
                    <input 
                        type="text" 
                        class="form-control border-left-0" 
                        id="searchInput" 
                        placeholder="Kitap adı/yazar adı ile arama yapın..."
                        style="border-radius: 0 25px 25px 0;"
                    />
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="search-results-info" id="searchResults"></div>
                    <button class="clear-search-btn" id="clearSearch" style="display: none;">
                        <i class="fas fa-times"></i> Aramayı Temizle
                    </button>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Books List -->
            <?php if (!empty($books)): ?>
            <div class="books-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0">Önerilen Kitaplar (<span id="bookCount"><?php echo count($books); ?></span>)</h3>
                    <div class="view-toggle">
                        <a href="?view=cards" class="btn view-btn <?php echo $viewMode === 'cards' ? 'active' : ''; ?>" title="Switch to card view">
                            <i class="fas fa-th-large"></i> <span class="d-none d-sm-inline">Kart olarak listele</span> <!-- CHANGED: Hide text on very small screens -->
                        </a>
                        <a href="?view=table" class="btn view-btn <?php echo $viewMode === 'table' ? 'active' : ''; ?>" title="Switch to table view">
                            <i class="fas fa-table"></i> <span class="d-none d-sm-inline">Tablo olarak göster</span> <!-- CHANGED: Hide text on very small screens -->
                        </a>
                    </div>
                </div>
                
                <?php if ($viewMode === 'table'): ?>
                    <!-- Table View -->
                    <div class="table-responsive">
                        <table class="table table-books table-hover">
                            <thead>
                                <tr>
                                    <th>Kapak</th>
                                    <th>Kitap Adı</th>
                                    <th>Yazar(lar)</th>
                                    <th>Tavsiye Eden</th>
                                    <!-- <th>Year</th>
                                    <th>Genre</th> -->
                                    <th class="comment-column">Yorum</th> <!-- CHANGED: Added comment column, hidden on small screens -->
                                    <?php if ($isAdmin): ?>
                                        <th></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody id="booksTableBody">
                                <?php foreach ($books as $book): ?>
                                    <tr data-title="<?php echo htmlspecialchars(strtolower($book['title'])); ?>" 
                                        data-author="<?php echo htmlspecialchars(strtolower($book['author'] ?? '')); ?>"
                                        data-comment="<?php echo htmlspecialchars($book['comment'] ?? ''); ?>"
                                        data-book-title="<?php echo htmlspecialchars($book['title']); ?>">
                                        <!-- CHANGED: Clickable book cover with image support -->
                                        <td>
                                            <?php if (!empty($book['cover_link'])): ?>
                                                <div class="book-cover-clickable" 
                                                     data-book-title="<?php echo htmlspecialchars($book['title']); ?>"
                                                     data-book-author="<?php echo htmlspecialchars($book['author'] ?? ''); ?>"
                                                     data-book-comment="<?php echo htmlspecialchars($book['comment'] ?? 'Yorum bulunmuyor...'); ?>"
                                                     data-book-adviser="<?php echo htmlspecialchars($book['advicer'] ?? ''); ?>"
                                                     title="Detay için göz sembolünü tıklayınız (mobile)">
                                                    <img src="<?php echo htmlspecialchars($book['cover_link']); ?>" 
                                                         alt="<?php echo htmlspecialchars($book['title']); ?>" 
                                                         class="table-book-cover-img"
                                                         onerror="this.parentElement.innerHTML='<div class=\'book-cover\'><i class=\'fas fa-book\'></i></div>';">
                                                </div>
                                            <?php else: ?>
                                                <div class="book-cover-clickable" 
                                                     data-book-title="<?php echo htmlspecialchars($book['title']); ?>"
                                                     data-book-author="<?php echo htmlspecialchars($book['author'] ?? ''); ?>"
                                                     data-book-comment="<?php echo htmlspecialchars($book['comment'] ?? 'Yorum bulunmuyor...'); ?>"
                                                     data-book-adviser="<?php echo htmlspecialchars($book['advicer'] ?? ''); ?>"
                                                     title="Detay için göz sembolünü tıklayınız (mobile)">
                                                    <div class="book-cover">
                                                        <i class="fas fa-book"></i>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($book['title']); ?></strong>
                                        </td>
                                        <td>
                                            <?php 
                                                if (!empty($book['author'])) {
                                                    echo htmlspecialchars($book['author']);
                                                } else {
                                                    echo '<em class="text-muted">Yazar bilinmiyor</em>';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if (isset($book['advicer'])): ?>
                                                <span class="badge-advicer"><?php echo htmlspecialchars($book['advicer']); ?></span>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- <td>
                                            <?php 
                                                if (isset($book['year'])) {
                                                    echo htmlspecialchars($book['year']);
                                                } else {
                                                    echo '<span class="text-muted">-</span>';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if (isset($book['genre'])): ?>
                                                <span class="badge-genre"><?php echo htmlspecialchars($book['genre']); ?></span>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td> -->
                                        <!-- CHANGED: Added comment column (hidden on small screens) -->
                                        <td class="comment-column">
                                            <?php if (!empty($book['comment'])): ?>
                                                <div class="comment-text">
                                                    <i class="fas fa-comment-dots"></i> 
                                                    <?php echo htmlspecialchars($book['comment']); ?>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-muted"><em>Yorum bulunmuyor...</em></span>
                                            <?php endif; ?>
                                        </td>
                                        <?php if ($isAdmin): ?>
                                            <td>
                                                <form method="POST" action="books.php?view=table" style="display: inline;" onsubmit="return confirm('Kitabı silmek istediğinize emin misiniz?');">
                                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                    <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                                                    <button type="submit" name="delete_book" class="btn delete-btn">
                                                        <i class="fas fa-trash"></i> <span class="d-none d-md-inline">Kitap Kaydını Sil</span>
                                                    </button>
                                                </form>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <!-- Card View -->
                    <div class="row">
                        <?php foreach ($books as $book): ?>
                            <div class="col-12 col-sm-6 col-lg-6" data-title="<?php echo htmlspecialchars(strtolower($book['title'])); ?>" data-author="<?php echo htmlspecialchars(strtolower($book['author'] ?? '')); ?>">
                                <div class="book-card">
                                    <?php if ($isAdmin): ?>
                                        <div class="delete-button-container">
                                            <form method="POST" action="books.php?view=cards" style="display: inline;" onsubmit="return confirm('Kitabı silmek istediğinize emin misiniz?');">
                                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                                                <button type="submit" name="delete_book" class="btn btn-sm delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- CHANGED: New card layout with cover image -->
                                    <div class="book-card-content">
                                        <!-- Book Cover Image -->
                                        <?php if (!empty($book['cover_link'])): ?>
                                            <div class="book-card-cover">
                                                <img src="<?php echo htmlspecialchars($book['cover_link']); ?>" 
                                                     alt="<?php echo htmlspecialchars($book['title']); ?> cover" 
                                                     onerror="this.parentElement.innerHTML='<div class=\'book-cover-placeholder\'><i class=\'fas fa-book\'></i></div>';">
                                            </div>
                                        <?php else: ?>
                                            <div class="book-card-cover">
                                                <div class="book-cover-placeholder">
                                                    <i class="fas fa-book"></i>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <!-- Book Info -->
                                        <div class="book-card-info">
                                            <!-- CHANGED: Title and Author on same line -->
                                            <div class="book-title-author">
                                                <strong class="book-name"><?php echo htmlspecialchars($book['title']); ?></strong>
                                                <span class="book-author-inline">
                                                    <?php 
                                                        if (!empty($book['author'])) {
                                                            echo ' ' . htmlspecialchars($book['author']);
                                                        } else {
                                                            echo '<em> </em>';
                                                        }
                                                    ?>
                                                </span>
                                            </div>
                                            
                                            <!-- CHANGED: Adviser below title/author -->
                                            <?php if (isset($book['advicer'])): ?>
                                                <div class="book-adviser">
                                                    <i class="fas fa-user-check"></i> Öneren: 
                                                    <span class="badge-advicer"><?php echo htmlspecialchars($book['advicer']); ?></span>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <!-- CHANGED: Comment below adviser -->
                                            <?php if (!empty($book['comment'])): ?>
                                                <div class="book-comment">
                                                    <i class="fas fa-comment-dots"></i> 
                                                    <em><?php echo htmlspecialchars($book['comment']); ?></em>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <!-- Additional details -->
                                            <?php if (isset($book['year']) || isset($book['genre'])): ?>
                                                <div class="book-meta">
                                                    <?php if (isset($book['year'])): ?>
                                                        <span class="book-year">
                                                            <i class="fas fa-calendar-alt"></i> <?php echo htmlspecialchars($book['year']); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (isset($book['genre'])): ?>
                                                        <span class="badge-genre"><?php echo htmlspecialchars($book['genre']); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php else: ?>
                <div class="books-container text-center">
                    <i class="fas fa-book" style="font-size: 4rem; color: #ccc; margin-bottom: 20px;"></i> <!-- CHANGED: Reduced icon size -->
                    <h4>Henüz kütüphanede önerilmiş kitap bulunmuyor..</h4>
                    <p>İlk kitap önerisini sen yap!</p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- CHANGED: Modal for displaying book comments on mobile -->
        <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="commentModalLabel">
                            <i class="fas fa-book"></i> <span id="modalBookTitle" style="color: #667eea;
            font-size: 2rem;"></span>
                        </h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="modal-author"><strong>Yazar:</strong> <span id="modalBookAuthor"></span></p>
                        <p class="modal-adviser"><strong>Öneren:</strong> <span id="modalBookAdviser"></span></p>
                        <hr>
                        <h6><i class="fas fa-comment-dots"></i> Yorum:</h6>
                        <p class="modal-comment" id="modalBookComment"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Listeye Dön</button>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        
        <script>
            // CHANGED: Auto-select view based on screen size
            (function() {
                const currentView = '<?php echo $viewMode; ?>';
                const urlParams = new URLSearchParams(window.location.search);
                const hasViewParam = urlParams.has('view');
                const manualSelection = localStorage.getItem('manualViewSelection');
                
                // Function to get appropriate view based on screen width
                function getAutoView() {
                    const width = window.innerWidth;
                    // Mobile: < 768px → Cards
                    // Tablet/PC: >= 768px → Table
                    return width < 768 ? 'cards' : 'table';
                }
                
                // Function to redirect to appropriate view
                function redirectToView(view) {
                    const url = new URL(window.location);
                    url.searchParams.set('view', view);
                    window.location.href = url.toString();
                }
                
                // Only auto-redirect if:
                // 1. User hasn't manually selected a view (no manualSelection in localStorage)
                // 2. No view parameter in URL (first load or coming from another page)
                if (!manualSelection && !hasViewParam) {
                    const autoView = getAutoView();
                    if (currentView !== autoView) {
                        redirectToView(autoView);
                    }
                }
                
                // Store manual selection when user clicks view buttons
                document.addEventListener('DOMContentLoaded', function() {
                    const viewButtons = document.querySelectorAll('.view-btn');
                    viewButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            // Store that user made a manual selection
                            localStorage.setItem('manualViewSelection', 'true');
                        });
                    });
                    
                    // Add "Clear auto-selection" option (optional feature)
                    // User can clear their preference to re-enable auto-selection
                    window.clearViewPreference = function() {
                        localStorage.removeItem('manualViewSelection');
                        location.reload();
                    };
                });
            })();
            
            // CHANGED: Event delegation for book cover clicks (handles special characters in comments)
            document.addEventListener('DOMContentLoaded', function() {
                // Use event delegation to handle clicks on book covers
                document.addEventListener('click', function(e) {
                    const coverElement = e.target.closest('.book-cover-clickable');
                    if (coverElement) {
                        const title = coverElement.getAttribute('data-book-title') || 'Bilinmeyen';
                        const author = coverElement.getAttribute('data-book-author') || 'Bilinmeyen';
                        const comment = coverElement.getAttribute('data-book-comment') || 'Yorum bulunmuyor...';
                        const adviser = coverElement.getAttribute('data-book-adviser') || 'Bilinmeyen';
                        
                        // Populate modal with book information
                        document.getElementById('modalBookTitle').textContent = title;
                        document.getElementById('modalBookAuthor').textContent = author;
                        document.getElementById('modalBookComment').textContent = comment;
                        document.getElementById('modalBookAdviser').textContent = adviser;
                        
                        // Show the modal
                        $('#commentModal').modal('show');
                    }
                });
            });
            
            const booksData = <?php echo $booksJson; ?>;
            const totalBooks = booksData.length;

            const bookTitleInput = document.getElementById('book_title');
            const bookAuthorInput = document.getElementById('book_author');
            const suggestForm = document.getElementById('suggestForm');

            /**
             * Normalizes strings for comparison (removes extra spaces, lowercase)
             */
            const normalize = (str) => str.toLowerCase().trim().replace(/\s+/g, ' ');

            /**
             * Checks if a book with same title AND author already exists
             */
            const isDuplicate = (title, author) => {
                const normalizedTitle = normalize(title);
                const normalizedAuthor = normalize(author);
                return booksData.some(book => {
                    const bookTitle = normalize(book.title);
                    const bookAuthor = normalize(book.author || '');
                    return bookTitle === normalizedTitle && bookAuthor === normalizedAuthor;
                });
            };

            // 1. Real-time feedback on blur - check both fields
            const checkDuplicate = () => {
                const title = bookTitleInput.value.trim();
                const author = bookAuthorInput.value.trim();
                
                if (title !== '' && author !== '' && isDuplicate(title, author)) {
                    bookTitleInput.classList.add('is-invalid');
                    bookAuthorInput.classList.add('is-invalid');
                    alert('Not: Yazarın bu kitabı önerilenler listesinde bulunuyor.');
                } else {
                    bookTitleInput.classList.remove('is-invalid');
                    bookAuthorInput.classList.remove('is-invalid');
                }
            };

            bookTitleInput.addEventListener('blur', checkDuplicate);
            bookAuthorInput.addEventListener('blur', checkDuplicate);

            // 2. Final Guard: Prevent form submission if duplicate
            suggestForm.addEventListener('submit', function(e) {
                const title = bookTitleInput.value.trim();
                const author = bookAuthorInput.value.trim();
                
                // Check if both fields are filled
                if (title === '' || author === '') {
                    e.preventDefault();
                    alert('Kitap adı ve yazar bilgisi girişi zorunludur!');
                    return;
                }
                
                // Check for duplicate
                if (isDuplicate(title, author)) {
                    e.preventDefault();
                    alert('Gönderim engellendi: Bu yazarın bu kitabı önerilenler listesinde zaten bulunuyor.');
                }
            });

            
            
            // Clear form after successful submission
            <?php if ($successMessage): ?>
                document.getElementById('suggestForm').reset();
                
                // Auto-dismiss success message after 20 seconds
                setTimeout(function() {
                    const successAlert = document.querySelector('.alert-success');
                    if (successAlert) {
                        successAlert.style.transition = 'opacity 0.5s';
                        successAlert.style.opacity = '0';
                        setTimeout(function() {
                            successAlert.remove();
                        }, 500);
                    }
                }, 10000); // 10 seconds
            <?php endif; ?>

            // Search functionality (only if more than 10 books)
            <?php if ($showSearch): ?>
            const searchInput = document.getElementById('searchInput');
            const clearSearchBtn = document.getElementById('clearSearch');
            const searchResults = document.getElementById('searchResults');
            const bookCountSpan = document.getElementById('bookCount');
            
            /**
             * Performs search on books by title or author
             */
            function performSearch() {
                const searchTerm = normalize(searchInput.value);
                let visibleCount = 0;
                
                if (searchTerm === '') {
                    // Show all books
                    const cardWrappers = document.querySelectorAll('.col-12.col-sm-6');
                    const tableRows = document.querySelectorAll('#booksTableBody tr');
                    
                    cardWrappers.forEach(wrapper => {
                        wrapper.classList.remove('hidden');
                    });
                    
                    tableRows.forEach(row => {
                        row.classList.remove('hidden');
                    });
                    
                    visibleCount = totalBooks;
                    searchResults.textContent = '';
                    clearSearchBtn.style.display = 'none';
                } else {
                    // Filter books
                    const cardWrappers = document.querySelectorAll('.col-12.col-sm-6');
                    const tableRows = document.querySelectorAll('#booksTableBody tr');
                    
                    cardWrappers.forEach(wrapper => {
                        const title = normalize(wrapper.getAttribute('data-title') || '');
                        const author = normalize(wrapper.getAttribute('data-author') || '');
                        
                        if (title.includes(searchTerm) || author.includes(searchTerm)) {
                            wrapper.classList.remove('hidden');
                            visibleCount++;
                        } else {
                            wrapper.classList.add('hidden');
                        }
                    });
                    
                    tableRows.forEach(row => {
                        const title = normalize(row.getAttribute('data-title') || '');
                        const author = normalize(row.getAttribute('data-author') || '');
                        
                        if (title.includes(searchTerm) || author.includes(searchTerm)) {
                            row.classList.remove('hidden');
                            visibleCount++;
                        } else {
                            row.classList.add('hidden');
                        }
                    });
                    
                    searchResults.textContent = ` ${visibleCount} kitap bulundu${visibleCount !== 1 ? 's' : ''}`;
                    clearSearchBtn.style.display = 'inline-block';
                }
                
                // Update book count
                bookCountSpan.textContent = visibleCount;
            }
            
            // Search on input
            searchInput.addEventListener('input', performSearch);
            
            // Clear search
            clearSearchBtn.addEventListener('click', function() {
                searchInput.value = '';
                performSearch();
                searchInput.focus();
            });
            <?php endif; ?>
        </script>
    </body>
</html>