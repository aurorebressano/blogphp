<!-- Navigation-->

<?php 
    $root = $_SERVER['WEB_ROOT'] = str_replace($_SERVER['SCRIPT_NAME'],'',$_SERVER['SCRIPT_FILENAME']); 
    $host = $_SERVER['HTTP_HOST'];
    $protocol=$_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';
?>

<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="<?= "$protocol://$host/index.php" ?>">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?= "$protocol://$host/view/assets/aurorebdev.pdf"?>" target="_blank">Mon cv</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?= "$protocol://$host/index.php?action=blogposts"?>">Blogposts</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?= "$protocol://$host/index.php?action=contact"?>">Contact</a></li>
                <?php 
                if (isset($_SESSION['auth']) && $_SESSION['auth'] != null )
                {
                    echo '<li class="nav-item">
                    <a class="nav-link px-lg-3 py-3 py-lg-4" href="disconnect.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16">
                            <path d="M7.5 1v7h1V1h-1z"/>
                            <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"/>
                        </svg>
                    </a>
                  </li>';
                }?>
            </ul>
        </div>
    </div>
</nav>