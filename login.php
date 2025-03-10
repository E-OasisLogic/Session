<?php
session_start();

// Database connection (office.ads-gorilla.com)
/*
$host = 'localhost';
$dbname = 'adsgkfgy_google_ads_reports';
$username = 'adsgkfgy_root';
$password = 'w(~Bwq;UG%4.';
*/

// Database connection [localhost]
$host = 'localhost';
$dbname = 'google_ads_reports';
$username = 'root';
$password = '';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handling form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if (!empty($email) && !empty($pass)) {
        $stmt = $pdo->prepare('SELECT * FROM user_tbl WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData['password'] == $pass) {
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['firstname'] = $userData['firstname'];
            header('Location: Dashboard/index.php');
            exit();
        } else {
            echo $email;
            echo $pass;
            echo'stock here 1';
            //header('Location: login.html');
        }
    } else {
        echo'stock here 2';
        //header('Location: login.html');
    }
}
?>