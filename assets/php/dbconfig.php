<?php
    $db_connect = new SQLite3("assets/passwords.db");

    if (!$db_connect) {
        $error = "Database connection failed: " . $db_connect->lastErrorMsg();
    }
?>