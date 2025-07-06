<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top <?= (!isset($_GET['datacol'])) ? "container" : "" ?>" style="<?= (isset($_GET['datacol'])) ? "width: 30% !important;transform: translateX(-85px) !important" : "" ?>">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="favicon.png?v=<?= time() ?>"> <span>Storage.</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php
                if (!isset($_GET['datacol'])) {
                    echo '<ul class="navbar-nav mx-auto"><form class="d-flex" role="search">
                        <input class="form-control me-2" id="filter" type="search" placeholder="Search" aria-label="Search" autofocus/>
                    </form></ul>';
                }
            ?>
            <?php 
                if (!isset($_GET['datacol'])) {
                    echo '<div class="btn btn-success"><i class="fa-solid fa-circle-plus"></i> New Password</div>';
                }
            ?>
        </div>
    </div>
</nav>