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
                        <div class="card-body">
                            <h1 class="h3 mb-0 text-gray-800 card-title">Tambah Comic</h1>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>

                    <?php echo form_open_multipart('admin/comic_add'); ?>
                    <div class="row my-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-5 ">
                                            <label for="image" class="frame" id="frameImage">
                                                <img src="https://source.unsplash.com/random/800x600" width="100%" height="100%" style="border-radius: 5px;">
                                            </label>
                                            <input type="file" id="image" name="image" style="opacity: 0;">
                                        </div>
                                        <div class="col-md-7">

                                            <div class="form-group">
                                                <label for="judul">Judul Komik</label>
                                                <input type="text" class="form-control" id="judul" aria-describedby="emailHelp" name="judul">
                                                <?= form_error('judul', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis">Jenis Komik</label>
                                                <input type="text" class="form-control" id="jenis" aria-describedby="emailHelp" name="jenis">
                                                <?= form_error('jenis', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status Komik</label>
                                                <select class="form-control" id="status" name="status">
                                                    <?php foreach ($status as $stat) : ?>
                                                        <option value="<?= $stat['id_status'] ?>"><?= $stat['nama_status'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                                            </div>

                                        </div>
                                    </div>
                                    <h5 class="card-title">Detail Komik</h5>
                                    <hr>
                                    <div class="form-row mb-3">
                                        <div class="col-md-8">
                                            <label for="penulis">Penulis</label>
                                            <input type="text" class="form-control" id="penulis" name="penulis">
                                            <?= form_error('penulis', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="rilis">Tahun Rilis</label>
                                            <input type="text" class="form-control" id="rilis" name="rilis">
                                            <?= form_error('rilis', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-md-4">
                                            <label for="rating">Rating</label>
                                            <input type="text" class="form-control" id="rating" name="rating">
                                            <?= form_error('rating', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="usia_pembaca">Usia Pembaca</label>
                                            <input type="text" class="form-control" id="usia_pembaca" name="usia_pembaca">
                                            <?= form_error('usia_pembaca', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="form-is_active">
                                                <label>Status</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active">
                                                    <label class="custom-control-label" for="is_active" id="isActive_status">Tidak Active</label>
                                                </div>
                                            </div>
                                            <?= form_error('is_active', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="genre">Genre</label>
                                        <select class="form-control" id="genre" name="genre[]" required multiple>
                                            <?php foreach ($genres as $genre) : ?>
                                                <option value="<?= $genre['id_genre'] ?>"><?= $genre['nama_genre'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Deskripsi Komik</h5>
                                    <hr>
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi Komik</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex justify-content-end m-3">
                            <a class="btn btn-secondary" href="<?= base_url() ?>admin/comic">Kembali</a>
                            <button type="submit" class="btn btn-primary mx-3">Submit</button>
                        </div>
                    </div>
                    </form>
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
        $(document).ready(function() {
            $('#genre').select2({
                placeholder: 'Select Genre',
                allowClear: true
            });

            $('#image').change(function() {
                let foto = readURL(this);
                foto.onload = function(e) {
                    $('#frameImage').html(
                        `<div class="position-relative w-100 h-100" >
                        <img src="${e.target.result}" alt="..." width="100%" height="100%" style="border-radius: 5px;">
                        <a href="#" class="close-img">
                        <i class="fa fa-times"></i>
                        </a>
                        </div>
                        
                        `
                    );
                };
            })
        });

        function readURL(input, element) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.readAsDataURL(input.files[0]); // convert to base64 string
                // reader.onload = function(e) {
                //     return e;
                // }

                return reader;
                // var reader = new FileReader();

                // console.log(element);
                // reader.onload = function(e) {
                //     $(`${element}`).attr('src', e.target.result);
                // }
                // reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
    </script>
    <script>
        let isActive = document.querySelector('#is_active');

        let labelActive = document.querySelector('#isActive_status')
        isActive.addEventListener('click', function() {
            isActive.classList.toggle('checked');
            if (isActive.classList.contains('checked')) {
                labelActive.innerHTML = 'Active';
            } else {
                labelActive.innerHTML = 'Tidak Active';
            }

        });
        CKEDITOR.replace('deskripsi');
    </script>

</body>

</html>