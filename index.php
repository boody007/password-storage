<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
    <head>
        <?php
            include "assets/php/dbconfig.php";
            include "assets/php/head.php";
            // Check authentication
            if (!isset($_SESSION['auth_id'])) {
                header("Location: login.php");
                exit();
            }
        ?>
        <title>Password Storage</title>
    </head>
    <body>
        <?= recieve_server_messages() ?>
        <?php include "assets/php/navbar.php" ?>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                </tr>
                <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>John</td>
                <td>Doe</td>
                <td>@social</td>
                </tr>
            </tbody>
        </table>
        <?php include "assets/php/body.php" ?>
    </body>
</html>