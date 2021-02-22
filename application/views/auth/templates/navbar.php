<nav class="navbar navbar-expand-lg navbar-light navbar__app ">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>">BacaBersama</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url() ?>auth">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url() ?>auth/register">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>