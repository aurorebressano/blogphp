<!-- Page Header-->
<header class="masthead" style="<?= $header_img; ?>">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1><?= $post->displayTitle() ?></h1>
                    <!-- <h2 class="subheading">Problems look mighty small from 150 miles up</h2> -->
                    <span class="meta">
                        Posted by
                        <a href="#!"><?= $post->findAuthor($post->displayAuthor())->getFirstName()?></a>
                        <?= $post->displayDate() ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>