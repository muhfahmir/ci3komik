<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('admin/templates/head'); ?>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

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
                    <!-- PAGE HEADING -->
                    <div class="card">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center justify-content-between ">
                                <h1 class="h3 mb-0 text-gray-800">Comic</h1>
                                <a href="<?= base_url() ?>admin/comic_add" class="ml-3 btn btn-primary btn-icon-split">
                                    <span class="text" id="tambah-fitur">Tambah Comic</span>
                                </a>
                            </div>
                        </div>
                        <!-- <?php var_dump($url_img) ?>
                        <?php var_dump($comics) ?> -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Judul</th>
                                            <th>Jenis</th>
                                            <th>Penulis</th>
                                            <th>Deskripsi</th>
                                            <th>Status</th>
                                            <th>Rilis</th>
                                            <th>Usia Pembaca</th>
                                            <th>Rating</th>
                                            <th>Is Active</th>
                                            <th style="width: 21px;" id="no-sorting"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($comics as $comic) : ?>
                                            <tr>
                                                <td>
                                                    <?php if ($comic['imageUrl'] != null) : ?>
                                                        <img src="<?= $url_img ?><?= $comic['imageUrl'] ?>" alt="" width="100">
                                                    <?php else : ?>
                                                        Belum ada Gambar
                                                    <?php endif; ?>

                                                </td>
                                                <td><?= $comic['judul'] ?></td>
                                                <td><?= $comic['jenis'] ?></td>
                                                <td><?= $comic['penulis'] ?></td>
                                                <td><?= $comic['deskripsi'] ?> ...</td>
                                                <td><?= $comic['status'] ?></td>
                                                <td><?= $comic['rilis'] ?></td>
                                                <td><?= $comic['usia_pembaca'] ?></td>
                                                <td><?= $comic['rating'] ?></td>
                                                <td><?= $comic['is_active'] == 1 ? 'Active' : 'Tidak Active' ?></td>
                                                <td>
                                                    <div class="dropdown no-arrow">
                                                        <a class="btn dropdown-toggle" type="button" id="dropdownAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownAction">
                                                            <a class="dropdown-item" href="<?= base_url() ?>admin/comic_edit/<?= $comic['id_komik'] ?>" data-id="<?= $comic['id_komik'] ?>">
                                                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                                                Edit
                                                            </a>

                                                            <a class="dropdown-item delete-btn" href="<?= base_url() ?>admin/comic_delete/<?= $comic['id_komik'] ?>">
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

    <!-- Bootstrap core JavaScript-->
    <?php $this->load->view('admin/templates/js'); ?>

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
                            swal("Cancelled", "Your file is safe :)", "error");
                        }
                    });
            })
        })
    </script>
</body>

</html>