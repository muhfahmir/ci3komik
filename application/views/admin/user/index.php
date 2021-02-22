<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('admin/templates/head'); ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('admin/templates/sidebar'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view('admin/templates/navbar'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php if (($this->session->flashdata('message'))) : ?>
                        <?= $this->session->flashdata('message'); ?>

                    <?php endif ?>
                    <!-- Page Heading -->
                    <div class="card">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center justify-content-between ">
                                <h1 class="h3 mb-0 text-gray-800">User</h1>
                                <a href="#" data-toggle="modal" data-target="#userTambahModal" class="ml-3 btn btn-primary btn-icon-split">
                                    <span class="text" id="tambah-user">Tambah User</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 21px;" id="no-sorting">ID</th>
                                            <th>Nama User</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th style="width: 21px;" id="no-sorting"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user) : ?>
                                            <tr>
                                                <td><?= $user['id_user'] ?></td>
                                                <td><?= $user['name'] ?></td>
                                                <td><?= $user['email'] ?></td>
                                                <td><?= $user['is_active'] == 1 ? 'Active' : 'Tidak Active' ?></td>
                                                <td><?= date('d M Y', $user['date_created']) ?></td>
                                                <td>
                                                    <div class="dropdown no-arrow">
                                                        <a class="btn dropdown-toggle" type="button" id="dropdownAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownAction">
                                                            <a class="dropdown-item edit-btn" href="<?= base_url() ?>admin/user_edit/<?= $user['id_user'] ?>" data-toggle="modal" data-target="#userTambahModal" data-id="<?= $user['id_user'] ?>" data-active="<?= $user['is_active'] ?>" data-email="<?= $user['email'] ?>" data-name="<?= $user['name'] ?>">
                                                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                                                Edit
                                                            </a>

                                                            <a class="dropdown-item delete-btn" href="<?= base_url() ?>admin/user_delete/<?= $user['id_user'] ?>">
                                                                <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
                                                                delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>


                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('admin/templates/stickyFooter'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php $this->load->view('admin/templates/scrollTop'); ?>

    <!-- Logout Modal-->
    <?php $this->load->view('admin/templates/modal'); ?>

    <div class="modal fade" id="userTambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleField">Form Tambah User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/user') ?>" method="post" id="formUser">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">
                            <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                            <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="form-group" id="form-password">
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

                        <div class="form-group" id="form-status">
                            <label>Status</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status" name="status">
                                <label class="custom-control-label" for="status" id="labelStatus">Tidak Active</label>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Bootstrap core JavaScript-->
    <?php $this->load->view('admin/templates/js'); ?>

    <script>
        $(document).ready(function() {
            jQuery('#dataTable').dataTable({
                "bDestroy": true,
                "bAutoWidth": true,
                "bFilter": true,
                "bSort": true,
                "aaSorting": [
                    [0]
                ],
                "aoColumns": [{
                        "bSortable": true
                    },
                    {
                        "bSortable": true
                    },
                    {
                        "bSortable": true
                    },
                    {
                        "bSortable": true
                    },
                    {
                        "bSortable": true
                    },
                    {
                        "bSortable": false
                    }
                ]
            });
        });
    </script>


    <script>
        let editBtn = document.querySelectorAll('.edit-btn');
        let formPass = document.querySelector('#form-password')
        let formStats = document.querySelector('#form-status')

        let formUser = document.querySelector('#formUser');
        let tambahUser = document.querySelector('#tambah-user');
        let name = document.querySelector('#name')
        let email = document.querySelector('#email')
        let active = document.querySelector('#active')
        let titleField = document.querySelector('#titleField');

        let status = document.querySelector('#status');

        status.addEventListener('click', function() {
            let labelStatus = document.querySelector('#labelStatus')
            status.classList.toggle('checked');
            if (status.classList.contains('checked')) {
                labelStatus.innerHTML = 'Active';
            } else {
                labelStatus.innerHTML = 'Tidak Active';
            }

        });

        tambahUser.addEventListener('click', function(e) {
            formUser.setAttribute('action', '<?= base_url() ?>admin/user');
            titleField.innerHTML = "Form Tambah User"
            name.setAttribute('value', '');
            email.setAttribute('value', '');
            formPass.style.display = 'block';
            // formStats.style.display = 'block';
        })

        editBtn.forEach((btn) => {
            btn.addEventListener('click', function(e) {
                var dataActive = btn.getAttribute('data-active');
                let id = btn.getAttribute('data-id');
                let dataEmail = btn.getAttribute('data-email');
                let dataName = btn.getAttribute('data-name');
                titleField.innerHTML = "Form Edit User"
                name.setAttribute('value', dataName);
                email.setAttribute('value', dataEmail);
                // formStats.style.display = 'none';
                formPass.style.display = 'none';
                if (dataActive == 1) {
                    status.setAttribute('checked', 'true');
                    status.classList.add('checked');
                    labelStatus.innerHTML = "Active";
                } else {
                    status.classList.remove('checked');
                    labelStatus.innerHTML = "Tidak Active";
                }

                formUser.setAttribute('action', `<?= base_url() ?>admin/user_edit/${id}`);
            });
        });
    </script>

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

    <script>
        let deletebtn = document.querySelectorAll('.delete-btn')
        deletebtn.forEach((btn) => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const url = btn.getAttribute('href');
                swal({
                        title: "Are you sure?",
                        text: "But you will still be able to retrieve this file.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel please!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            window.location.href = url; // submitting the form when user press yes
                        } else {
                            swal("Cancelled", "Your imaginary file is safe :)", "error");
                        }
                    });
            })
        })
    </script>

</body>

</html>