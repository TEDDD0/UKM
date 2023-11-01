<?php if ($this->session->flashdata('flash')) : ?>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<?php if ($this->session->flashdata('flash-tolak')) : ?>
    <div class="flash-tolak" data-flashdata="<?= $this->session->flashdata('flash-tolak'); ?>"></div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                </span> Data Rencana Kegiatan UKM
            </h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <!-- <div class="col-md-9">
                        <h4>Data Rencana Kegiatan UKM</h4><br>
                    </div> -->
                </div>
                <a href="" class="btn btn-gradient-success btn-rounded btn-fw" data-toggle="modal" data-target=".tambah">Tambah Rencana
                    Kegiatan</a>
                <br>
                <br>
                <div class="card">
                    <div class="card-header">
                        <h4>Laporan Rencana "MENUNGGU"</h4>
                    </div>
                    <div class="card-body">
                        <table id="datatabel" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama UKM</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Waktu Acara</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($rencana_kegiatan as $key) {
                                    $idk = $key->id_rencana;
                                    if ($key->id_ukm == $ukm->id_ukm) {

                                        if ($key->status == 'Menunggu' || $key->status == 'Telah Direvisi') { ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo $no++; ?>
                                                </th>
                                                <td>
                                                    <?php echo $ukm->nm_ukm; ?>
                                                </td>
                                                <td>
                                                    <?php echo $key->judul; ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo site_url('/upload_file/' . $key->file) ?>" target="_blank">
                                                        <button type="button" class="btn btn-gradient-dark btn-icon-text btn-sm">
                                                            File
                                                            <i class="mdi mdi-file-check btn-icon-append"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php echo $key->waktu; ?>
                                                </td>
                                                <td>
                                                    <?php echo $key->status; ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-outline-danger tombolhapus" href="<?php echo site_url('Ukm/hapus_rencana/' . $idk) ?>">Hapus</a>
                                                </td>
                                            </tr>
                                <?php }
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div><br>
                <div class="card">
                    <div class="card-header">
                        <h4>Laporan Rencana "DIREVISI"</h4>
                    </div>
                    <div class="card-body">
                        <table id="datatabel3" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama UKM</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($rencana_kegiatan as $key) {
                                    $idk = $key->id_rencana;
                                    if ($key->id_ukm == $ukm->id_ukm) {
                                        if ($key->status == 'Direvisi') { ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo $no++; ?>
                                                </th>
                                                <td>
                                                    <?php echo $ukm->nm_ukm; ?>
                                                </td>
                                                <td>
                                                    <?php echo $key->judul; ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo site_url('/upload_file/' . $key->file) ?>" target="_blank">
                                                        <button type="button" class="btn btn-gradient-dark btn-icon-text btn-sm">
                                                            File
                                                            <i class="mdi mdi-file-check btn-icon-append"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php echo $key->status; ?>
                                                </td>
                                                <td>
                                                    <?php echo $key->ket_tolak; ?>
                                                </td>
                                                <td>

                                                    <button type="button" class="btn btn-gradient-dark btn-icon-text btn-sm" data-toggle="modal" data-target="<?php echo "#Modal_" . $idk ?>">
                                                        Upload Ulang
                                                        <i class="mdi mdi-file-check btn-icon-append"></i>
                                                    </button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="<?php echo "Modal_" . $idk ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Form Upload Ulang</h5>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="<?php echo site_url('Ukm/revisi_rencana') ?>" enctype="multipart/form-data">
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlInput1">Nama UKM</label>
                                                                    <input type="text" class="form-control" required name="" value="<?php echo $ukm->nm_ukm; ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlInput1">Judul</label>
                                                                    <input type="text" class="form-control" required name="judul" value="<?php echo $key->judul ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlInput1">Waktu</label>
                                                                    <input type="text" id="datetimeInput" class="form-control" required name="waktu" value="<?php echo $key->waktu ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlInput1">Tempat</label>
                                                                    <input type="text" class="form-control" required name="tempat" value="<?php echo $key->tempat ?>" readonly>
                                                                </div>
                                                                <input type="hidden" class="form-control" required name="id_ukm" value="<?php echo $ukm->id_ukm; ?>">
                                                                <input type="hidden" class="form-control" required name="id_rencana" value="<?php echo $idk; ?>">
                                                                <div class=" form-group">
                                                                    <label for="exampleFormControlInput1">Deskripsi</label>
                                                                    <input type="text" class="form-control" required name="deskripsi" value="<?php echo $key->deskripsi ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlInput1">Upload Ulang File Laporan</label>
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" name="file" id="file-upload<?php echo '_' . $no; ?>" aria-describedby="inputGroupFileAddon01" required>
                                                                        <label class="custom-file-label" id="file-name<?php echo '_' . $no; ?>" for="inputGroupFile01">Choose
                                                                            file</label>
                                                                    </div>
                                                                </div>
                                                                <button type="submit" class="btn btn-gradient-primary btn-icon-text">
                                                                    <i class=""></i> Submit </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                <?php
                                        }
                                    }
                                    $z = $no;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div><br>
                <div class="card">
                    <div class="card-header">
                        <h4>Laporan Rencana "DITERIMA"</h4>
                    </div>
                    <div class="card-body">
                        <table id="datatabel2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama UKM</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Waktu Acara</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($rencana_kegiatan as $key) {
                                    $idk = $key->id_rencana;
                                    if ($key->id_ukm == $ukm->id_ukm) {
                                        if ($key->status == 'Diterima') { ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo $no++; ?>
                                                </th>
                                                <td>
                                                    <?php echo $ukm->nm_ukm; ?>
                                                </td>
                                                <td>
                                                    <?php echo $key->judul; ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo site_url('/upload_file/' . $key->file) ?>" target="_blank">
                                                        <button type="button" class="btn btn-gradient-dark btn-icon-text btn-sm">
                                                            File
                                                            <i class="mdi mdi-file-check btn-icon-append"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php echo $key->waktu; ?>
                                                </td>
                                                <td>
                                                    <?php echo $key->status; ?>
                                                </td>
                                            </tr>
                                <?php }
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div><br>
                <div class="card">
                    <div class="card-header">
                        <h4>Laporan Rencana "DITOLAK"</h4>
                    </div>
                    <div class="card-body">
                        <table id="datatabel3" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama UKM</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($rencana_kegiatan as $key) {
                                    $idk = $key->id_rencana;
                                    if ($key->id_ukm == $ukm->id_ukm) {
                                        if ($key->status == 'Ditolak') { ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo $no++; ?>
                                                </th>
                                                <td>
                                                    <?php echo $ukm->nm_ukm; ?>
                                                </td>
                                                <td>
                                                    <?php echo $key->judul; ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo site_url('/upload_file/' . $key->file) ?>" target="_blank">
                                                        <button type="button" class="btn btn-gradient-dark btn-icon-text btn-sm">
                                                            File
                                                            <i class="mdi mdi-file-check btn-icon-append"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php echo $key->status; ?>
                                                </td>
                                                <td>
                                                    <?php echo $key->ket_tolak; ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-outline-danger tombolhapus btn-sm" href="<?php echo site_url('Ukm/hapus_rencana/' . $idk) ?>">Hapus</a>
                                                </td>
                                            </tr>

                                <?php }
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- content-wrapper ends -->

    <!-- Modal Tambah laporan-->
    <div class="modal fade tambah" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Laporan Kegiatan UKM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo site_url('Ukm/add_rencana') ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama UKM</label>
                            <input type="text" class="form-control" required name="" value="<?php echo $ukm->nm_ukm; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Judul</label>
                            <input type="text" class="form-control" required name="judul">
                        </div>
                        <div class=" form-group">
                            <label for="exampleFormControlInput1">Waktu</label>
                            <input type="datetime-local" id="datetimeInput" class="form-control" required name="waktu">
                        </div>
                        <div class=" form-group">
                            <label for="exampleFormControlInput1">Tempat</label>
                            <input type="text" class="form-control" required name="tempat">
                        </div>
                        <input type="hidden" class="form-control" required name="id_ukm" value="<?php echo $ukm->id_ukm; ?>">
                        <div class=" form-group">
                            <label for="exampleFormControlInput1">Deskripsi</label>
                            <input type="text" class="form-control" required name="deskripsi">
                        </div>
                        <div class=" form-group">
                            <label for="exampleFormControlInput1">Upload File Laporan</label>
                        </div>
                        <div class=" input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file" id="file-upload" aria-describedby="inputGroupFileAddon01" required>
                                <label class="custom-file-label" id="file-name" for="inputGroupFile01">Choose
                                    file</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary btn-icon-text">
                            <i class=""></i> Submit </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End Modal Tambah -->
    <script>
        document.querySelector("#file-upload").onchange = function() {
            document.querySelector("#file-name").textContent = this.files[0].name;
        }
    </script>
    <?php for ($i = 0; $i <= $z; $i++) {
        echo '<script>
        document.querySelector("#file-upload_' . $i . '").onchange = function() {
            document.querySelector("#file-name_' . $i . '").textContent = this.files[0].name;
        }
    </script>';
    } ?>