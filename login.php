<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
    <head>
        <?php
            include "assets/php/dbconfig.php";
            include "assets/php/head.php";
            // Check authentication
            if (isset($_SESSION['auth_id'])) {
                header("Location: index.php");
                exit();
            }
            // Check server
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $authname = $_POST['authname'];
                $authpass = $_POST['authpass'];
                strip_tags($authname, $authpass);
                // Authentication Logic
                if (!empty($authname) && !empty($authpass)) {
                    try {
                        $hasedpass = hash('sha256', $authpass);
                        $stmt = $db_connect->prepare("SELECT * FROM authorized WHERE name = :username AND password = :password");
                        $stmt->bindValue(':username', $authname, SQLITE3_TEXT);
                        $stmt->bindValue(':password', $hasedpass, SQLITE3_TEXT);
                        $result = $stmt->execute();
                        
                        if ($result && $row = $result->fetchArray(SQLITE3_ASSOC)) {
                            $_SESSION['auth_id'] = $row['id'];
                            header("Location: index.php");
                            exit();
                        } else {
                            $error = "Authentication failed. Please check your name and password.";
                        }
                    }
                    catch (Exception $unhandled) {
                        $error = "An error occurred during authentication. " . $unhandled->getMessage();
                    }
                } 
                else {
                    $error = "Please enter both name and password for authentication.";
                }
            }
        ?>
        <title>Authentication</title>
    </head>
    <body class="login-view">
        <?= recieve_server_messages() ?>
        <div class="login-box">
            <div class="heading">
                <h1 class="display-5 fw-bold">Storage</h1>
                <h1 class="display-5 fw-bold">Authentication</h1>
            </div>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="mb-3 input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-circle-user"></i>
                    </span>
                    <input type="text" class="form-control" id="authname" name="authname" placeholder="Name" autocomplete="off">
                </div>
                <div class="mb-3 input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" class="form-control" id="authpass" name="authpass" placeholder="Password" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-outline-success"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
            </form>
        </div>
        <?php include "assets/php/body.php"; ?>
    </body>
</html>