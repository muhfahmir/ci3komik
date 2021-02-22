<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('auth/templates/head') ?>
    <title><?= $judul; ?></title>
</head>

<body>

    <?php $this->load->view('auth/templates/navbar') ?>
    <section id="register">
        <div class="container">
            <div class="row justify-content-center app__form">
                <div class="col-md-7">
                    <?php if (($this->session->flashdata('message3'))) : ?>
                        <?= $this->session->flashdata('message3'); ?>
                    <?php endif ?>
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Form Register</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?= base_url('auth/register') ?>">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="masukkan nama lengkap ..." aria-describedby="emailHelp">
                                    <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                                    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" placeholder="masukkan email ..." class="form-control" id="email" name="email" aria-describedby="emailHelp">
                                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="password1" class="form-label">Password</label>
                                            <div class="d-flex form__password">
                                                <input type="password" id="password1" name="password1" placeholder="masukkan password ..."><button type="button" name="passwordBtn" id="passwordBtn" autocomplete="off"><i id="passwordIcon" class="far fa-eye"></i></button>
                                            </div>
                                            <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password2" class="form-label">Konfirmasi Password</label>
                                            <input type="password" class="form-control" id="password2" name="password2" placeholder="confirm password ..." autocomplete="off">
                                            <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primaryku form-control" name="submit">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- <?php $this->load->view('auth/templates/footer') ?> -->
    <script>
        let passBtn = document.querySelector("#passwordBtn");
        let passIcon = document.querySelector("#passwordIcon");
        let passInput = document.querySelector("#password1");
        let passInput2 = document.querySelector("#password2");
        passBtn.addEventListener("click", function() {
            if (passIcon.classList.contains('fa-eye')) {
                passIcon.setAttribute("class", 'far fa-eye-slash');
                passInput.setAttribute('type', 'text');
                passInput2.setAttribute('type', 'text');
            } else {
                passIcon.setAttribute('class', 'far fa-eye');
                passInput.setAttribute('type', 'password');
                passInput2.setAttribute('type', 'password');
            }
        });
    </script>

</body>

</html>