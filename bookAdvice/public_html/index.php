<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: books.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $username = filter_var($_POST['username'] ?? '', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    
    $usersFile = '../private/users.json';
    if (file_exists($usersFile)) {
        $users = json_decode(file_get_contents($usersFile), true);
        $validUser = false;

        foreach ($users as $user) {
            // Secure verification using PHP native password_verify
            if ($user['email'] === $username && password_verify($password, $user['password'])) {
                $validUser = true;
                
                // Prevent Session Fixation
                session_regenerate_id(true);
                
                $_SESSION['logged_in'] = true;
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['is_admin'] = $user['isAdmin'] ?? false;
                
                // Generate CSRF Token for books.php actions
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                
                header('Location: books.php');
                exit();
            }
        }
        
        $error = 'Invalid username or password.';
    } else {
        error_log("Critical: users.json missing."); // Log privately
        $error = 'System error. Please try again later.'; // Show generic error to user
    }
}
?>
<!doctype html>
<html>
<head>
    <title>Login Page</title>
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

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Sign In</h3>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="index.php">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input
                              type="text"
                              name="username"
                              class="form-control"
                              placeholder="email"
                              autocomplete="email"
                              required
                            />
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input
                              type="password"
                              name="password"
                              class="form-control"
                              placeholder="password"
                              autocomplete="current-password"
                              required
                            />
                        </div>
                        <div class="form-group">
                            <input
                              type="submit"
                              value="Login"
                              class="btn float-right login_btn"
                            />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>