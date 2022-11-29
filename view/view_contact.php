<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Contact</title>
        <!-- Liens -->
        <?php require "view/components/links.php"; ?>
    </head>
    <body>
        <!-- Navigation-->
        <?php require "view/components/nav.php"; ?>
        <!-- Page Header-->
        <?php 
            $header_img = "background-image: url('view/assets/img/contact-bg.jpg')";
            require "view/components/header.php"; 
        ?>
        <!-- Main Content-->
        <main class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <p>Une petite question ?</p>
                        <div class="my-5">
                            <?php require "view/components/contact_form.php"; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer-->
        <?php require "view/components/footer.php"; ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="view/js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
