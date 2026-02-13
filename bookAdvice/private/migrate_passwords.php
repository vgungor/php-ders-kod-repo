<?php
$usersFile = 'users.json';
if (file_exists($usersFile)) {
    $users = json_decode(file_get_contents($usersFile), true);
    
    foreach ($users as &$user) {
        // Only hash if it's not already hashed (basic check)
        if (strlen($user['password']) < 20) { 
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
        }
    }
    
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
    echo "Passwords migrated successfully.";
}
?>