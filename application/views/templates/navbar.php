<nav class="navbar navbar-expand-lg navbar-light navbar__app ">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>">BacaBersama</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="form__search" action="<?= base_url() ?>comic" method="post">
                <input class="me-2 form-control" type="search" placeholder="Search" aria-label="Search" name="keyword" autocomplete="off">
                <button class="btn btn__search" type="submit" name="submit"><i class="fas fa-search"></i></button>
            </form>
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url() ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url() ?>comic">All Komik</a>
                </li>
                <?php if (logged_in()) : ?>
                    <li class="nav-item dropdown no-arrow">
                        <a class="btn-primaryku dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="mr-2 "><?= $_SESSION['name']  ?></span>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="<?= base_url('admin') ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Back To Dashboard
                                </a>

                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primaryku" href="<?= base_url() ?>auth">Login</a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>