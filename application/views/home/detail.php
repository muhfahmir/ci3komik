<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('templates/head') ?>
</head>
<?php $this->load->view('templates/navbar') ?>

<!-- BANNER -->
<section id="banner-detail" class="bg-primary">
    <div class="banner__container d-flex justify-content-center  align-items-center">
        <h1 class="heading-banner"><?= $comic['jenis'] ?></h1>
    </div>
</section>
<!-- END BANNER -->

<!-- CONTENT -->
<section id="content-detail">
    <div class="container">
        <div class="detail__comicContainer">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title heading"><?= $comic['judul'] ?></h5>
                    <!-- <div class="breadcrumb__container"> -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>">BacaBersama</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $comic['jenis'] ?></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $comic['judul'] ?></li>
                        </ol>
                    </nav>
                    <!-- </div> -->
                    <!-- <p class="card-text text">
                        <?= $comic['deskripsi'] ?>
                    </p> -->
                    <div class="card-text row datacomic__container">
                        <div class="col-md-3 ">
                            <div class="img__wrapperDetail">
                                <img src="<?= base_url() ?>assets/images/comic/<?= $comic['imageUrl'] ?>" alt="<?= $comic['judul'] ?>">
                            </div>
                            <span class="rate " style="color:#246f14;"><i class="fas fa-star"></i><?= $comic['rating'] ?></span>
                        </div>
                        <div class="col">
                            <div class="row my-3">
                                <div class="col">
                                    <p class="text-table">Status : <?= $comic['status'] == 1 ? 'Ongoing' : 'Tamat' ?> </p>
                                    <p class="text-table">Dirilis : <?= $comic['rilis'] ?></p>
                                    <p class="text-table">Jenis Komik : <?= $comic['jenis'] ?></p>
                                </div>

                                <div class="col">
                                    <p class="text-table">Penulis : <?= $comic['penulis'] ?></p>
                                    <p class="text-table">Usia Pembaca : <?= $comic['usia_pembaca'] ?></p>
                                </div>
                            </div>

                            <h5 class="heading-table my-3">
                                Genre
                            </h5>


                            <?php foreach ($genres as $genre) : ?>
                                <?php foreach ($genreComics as $check) : ?>
                                    <?php if ($check['id_genre'] == $genre['id_genre']) : ?>
                                        <!-- <span class="btn btn-secondary"> -->
                                        <span class="text-table"><?= $genre['nama_genre'] ?></span>
                                        <!-- </span> -->
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- END CONTENT -->

<!-- CONTENT FOOTER -->
<section id="content-footer">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title heading">Sinopsis</h5>
                <p class="card-text text"><?= $comic['deskripsi'] ?></p>
            </div>
        </div>
        <div class="card my-5">
            <div class="card-body">
                <h5 class="card-title heading">Related Comic</h5>
                <div class="row d-flex flex-nowrap overflow-auto">
                    <?php foreach ($relatedComic as $comic) : ?>
                        <div class="comics">
                            <div class="card card__wrapper">
                                <div class="img__wrapper">
                                    <a href="<?= base_url() ?>comic/detail/<?= $comic['id_komik'] ?>">
                                        <span class="rate"><i class="fas fa-star"></i><?= $comic['rating'] ?></span>
                                        <img src="<?= base_url() ?>assets/images/comic/<?= $comic['imageUrl'] ?>" class="card-img-top" alt="<?= $comic['judul'] ?>">
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
        </div>
    </div>
</section>
<!-- END CONTENT FOOTER -->

<?php $this->load->view('templates/footer') ?>

<body>

</body>

</html>