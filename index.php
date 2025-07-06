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
            // Fetching all passwords data
            $count = $db_connect->querySingle("SELECT COUNT(*) FROM data");            
        ?>
        <title>Password Storage</title>
    </head>
    <body>
        <?= recieve_server_messages() ?>
        <?php include "assets/php/navbar.php" ?>
        <div class="container">
            <div class="table-box">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Platform/Service</th>
                        <th scope="col">URL</th>
                        <th scope="col">Handle</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                        <form action="details.php" method="post">
                            <?php
                                $services_names = [];
                                if ($count > 0) {
                                    $data = $db_connect->query("SELECT col1, col2, col3, col4, col5 FROM data");
                                    while ($row = $data->fetchArray(SQLITE3_ASSOC)) {
                                        if (!in_array($row['col1'], $services_names)) {
                                            echo "<tr data-redirect='". $row['col4'] ."'><th scope='row' data-index='". $row['col5'] ."'></th>";
                                            echo "<td class='service-name'>" . htmlspecialchars($row['col1']) . "</td>";
                                            echo "<td class='text-primary text-decoration-underline service-url'><a href='' target='_blank'></a></td>";
                                            echo "<td><a href='details.php?datacol=". $row['col1'] ."'><img src='https://mcicons.ccleaf.com/thumbnails/10.%20Items/6.%20Bows/Crossbow_Arrow.png' height='40'></a></td>";
                                            echo "<td><a href='delete.php?datacol=". $row['col4'] ."'><img src='https://mcicons.ccleaf.com/thumbnails/80.%20Particles/lava.png' height='40'></a></td>";
                                            echo "</tr>";
                                            array_push($services_names, $row['col1']);
                                        }
                                    }
                                } else {
                                    echo "<tr><td colspan='4' class='text-center'>No passwords stored yet.</td></tr>";
                                }
                            ?>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include "assets/php/body.php" ?>
    </body>
</html>