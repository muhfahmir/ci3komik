<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('templates/head') ?>
</head>
<?php $this->load->view('templates/navbar') ?>

<!-- CONTENT -->
<section id="content">
    <div class="container">
        <!-- <?php var_dump($allComics) ?> -->
        <div class="d-flex justify-content-between">
            <h1 class="heading">All Comics</h1>
        </div>
        <div class="row">
            <?php foreach ($allComics as $comic) : ?>
                <div class="comics">
                    <div class="card card__wrapper">
                        <div class="img__wrapper">
                            <a href="<?= base_url() ?>comic/detail/<?= $comic['id_komik'] ?>">
                                <span class="rate"><i class="fas fa-star"></i><?= $comic['rating'] ?></span>
                                <img src="<?= $url_img ?><?= $comic['imageUrl'] ?>" class="card-img-top" alt="<?= $comic['judul'] ?>">
                            </a>
                        </div>
                        <div class="card-body text__container">
                            <a href="<?= base_url() ?>comic/detail/<?= $comic['id_komik'] ?>">
                                <h5 class="card-title subheading"><?= $comic['judul'] ?></h5>
                            </a>
                            <p class="card-text text"><?= $comic['deskripsi'] ?> ...</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row align-self-center">
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>
</section>
<!-- END CONTENT -->

<?php $this->load->view('templates/footer') ?>

<body>

</body>

</html>