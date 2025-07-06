<!DOCTYPE html>
<html data-bs-theme="dark">
    <head>
        <?php
            include "assets/php/head.php";
            include "assets/php/dbconfig.php";
            if (isset($_GET['datacol'])) {
                $datacol_service = $_GET['datacol'];
                $stmt = $db_connect->prepare("SELECT col2, col3, col4,col5 FROM data WHERE col1 = :col1");
                $stmt->bindValue(":col1", $datacol_service, SQLITE3_TEXT);
                $pass_results = $stmt->execute();
            }
            else {
                header("Location: index.php");
                exit;
            }
        ?>
        <title>Password Storage - <?= $datacol_service ?></title>
    </head>
    <body>
        <?= recieve_server_messages() ?>
        
        <div class="container details">
            <?php include "assets/php/navbar.php"; ?>
            <h1 class="fw-bold mb-5">Passwords &gt; <?= $datacol_service ?></h1>
            <div class="row">
                <?php
                    while ($passwords = $pass_results->fetchArray(SQLITE3_ASSOC)) {
                        $notes_stmt = $db_connect->prepare("SELECT * FROM comments WHERE cell = :cell");
                        $notes_stmt->bindValue(":cell", $passwords['col4'], SQLITE3_INTEGER);
                        $notes_results = $notes_stmt->execute();
                        $notes = $notes_results->fetchArray(SQLITE3_ASSOC);
                        echo '                <div class="col">
                    <div class="card">
                        <div class="card-header d-flex">
                            <div class="d-flex">
                                <i class="fa-regular fa-address-card"></i>
                                <strong id="login">'. $passwords['col2'] .'</strong>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                <div class="box">
                                    <div class="d-flex">
                                        <div class="d-flex flex-column">
                                            <span class="text-muted">Password</span>
                                            <div id="password">'. $passwords['col3'] .'</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box">
                                    <div class="d-flex">
                                        <div class="d-flex flex-column">
                                            <span class="text-muted">Notes</span>
                                            ';
                                            if (isset($notes['cell']) && isset($notes['comment'])) {
                                                echo '<span class="text-muted fst-italic notes">'. $notes['comment'] .'</span>';
                                            }
                                            else {
                                                echo '<span class="text-muted fst-italic notes">No Notes</span>';
                                            }
                            echo '
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <div class="btn btn-success rounded-pill"><i class="fa-solid fa-pen"></i> Edit</div>
                                <div class="btn btn-success rounded-pill"><i class="fa-solid fa-trash-can"></i> Delete</div>
                            </div>
                        </div>
                    </div>
                </div>';
                    }
                ?>
            </div>
        </div>
        <?php include "assets/php/body.php" ?>
    </body>
</html>