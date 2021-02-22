<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('templates/head') ?>
</head>
<?php $this->load->view('templates/navbar') ?>

<!-- BANNER -->
<section id="banner">
    <div class="container">
        <div class="row">
            <!-- <?php var_dump($hotComics) ?> -->
            <h1 class="heading">Hot Comics</h1>
            <?php foreach ($hotComics as $comic) : ?>
                <div class="col">
                    <a href="<?= base_url() ?>comic/detail/<?= $comic['id_komik'] ?>">
                        <div class="card text-white card__wrapper card__gradient">
                            <img src="<?= $url_img ?><?= $comic['imageUrl'] ?>" class="card-img" alt="<?= $comic['judul'] ?>">
                            <div class="card-img-overlay card__titleContainer" style="z-index: 1;">
                                <h5 class="card-title "><?= $comic['judul'] ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- END BANNER -->

<!-- CONTENT -->
<section id="content">
    <div class="container">
        <div class="d-flex justify-content-between">
            <!-- <?php var_dump($allComics)  ?> -->
            <h1 class="heading">All Comics </h1>
            <a href="<?= base_url('comic') ?>">See More</a>
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
    </div>
</section>
<!-- END CONTENT -->

<?php $this->load->view('templates/footer') ?>

<body>

</body>

</html>