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
                    <!-- <?php var_dump($genres); ?> -->
                    <!-- Page Heading -->
                    <div class="card">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center justify-content-between ">
                                <h1 class="h3 mb-0 text-gray-800">Genre</h1>
                                <a href="#" data-toggle="modal" data-target="#genreTambahModal" class="ml-3 btn btn-primary btn-icon-split" id="tambah-genre">
                                    <span class="text">Tambah Genre</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 21px;" id="no-sorting">ID</th>
                                            <th>Nama Genre</th>
                                            <th style="width: 21px;" id="no-sorting"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($genres as $genre) : ?>
                                            <tr>
                                                <td><?= $genre['id_genre'] ?></td>
                                                <td><?= $genre['nama_genre'] ?></td>
                                                <td>
                                                    <div class="dropdown no-arrow">
                                                        <a class="btn dropdown-toggle" type="button" id="dropdownAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownAction">
                                                            <a class="dropdown-item edit-btn" href="#" data-toggle="modal" data-target="#genreTambahModal" data-id="<?= $genre['id_genre'] ?>" data-name="<?= $genre['nama_genre'] ?>">
                                                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                                                Edit
                                                            </a>

                                                            <a class="dropdown-item delete-btn" href="<?= base_url() ?>admin/genre_delete/<?= $genre['id_genre'] ?>">
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

    <div class="modal fade" id="genreTambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleField">Form Tambah Genre</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/genre') ?>" method="post" id="formGenre">
                        <div class="form-group">
                            <label for="nama_genre">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_genre" aria-describedby="emailHelp" name="nama_genre">
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
                        "bSortable": false
                    }
                ]
            });
        });
    </script>

    <script>
        let editBtn = document.querySelectorAll('.edit-btn');

        let formGenre = document.querySelector('#formGenre');
        let tambahGenre = document.querySelector('#tambah-genre');
        let nama_genre = document.querySelector('#nama_genre')
        let titleField = document.querySelector('#titleField');


        tambahGenre.addEventListener('click', function(e) {
            formGenre.setAttribute('action', '<?= base_url('') ?>admin/genre');
            titleField.innerHTML = "Form Tambah Genre"
            nama_genre.setAttribute('value', '');
            CKEDITOR.instances["description"].setData('');
        })

        editBtn.forEach((btn) => {
            btn.addEventListener('click', function(e) {
                let id = btn.getAttribute('data-id');
                let dataNama = btn.getAttribute('data-name');
                titleField.innerHTML = "Form Edit Genre"

                nama_genre.setAttribute('value', dataNama);
                // description.innerHTML = dataDescription;
                formGenre.setAttribute('action', `<?= base_url() ?>admin/genre_edit/${id}`);

            });
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