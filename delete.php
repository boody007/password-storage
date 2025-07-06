<?php
    include "assets/php/dbconfig.php";
    if (isset($_GET['datacol'])) {
        $data_stmt = $db_connect->prepare("DELETE FROM data WHERE col4 = :col4");
        $data_stmt->bindValue(":col4", $_GET['datacol'], SQLITE3_INTEGER);
        $data_stmt->execute();
        // Deleting any related comments or notes
        $comment_stmt = $db_connect->prepare("DELETE FROM comments WHERE cell = :cell");
        $comment_stmt->bindValue(":cell", $_GET['datacol'], SQLITE3_INTEGER);
        $comment_stmt->execute();
        // Redirecting to home page
        header("Location: index.php");
        exit;
    }
    else {
        header("Location: index.php");
        exit;
    }
?>