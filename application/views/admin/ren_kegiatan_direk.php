<?php if ($this->session->flashdata('flash')) : ?>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
<?php if ($this->session->flashdata('flash-tolak')) : ?>
    <div class="flash-tolak" data-flashdata="<?= $this->session->flashdata('flash-tolak'); ?>"></div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
<?php $level = $this->session->userdata('level');
// Untuk Direktur
if ($level == 'Direktur') { ?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                    </span> Laporan Rencana Kegiatan UKM
                </h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <!-- <div class="col-md-9">
                        <h4>Data Rencana Kegiatan UKM</h4><br>
                    </div> -->
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="datatabel" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama UKM</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">File</th>
                                        <th scope="col">Waktu Pengiriman</th>
                                        <th scope="col">Waktu Acara</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($rencana_kegiatan as $key) {
                                        $idk = $key->id_rencana;
                                        $showData = true; // Inisialisasi variabel untuk menampilkan data

                                        // Cek apakah idk sama dengan id_rencana dalam $persetujuan
                                        foreach ($persetujuan as $per) {
                                            if ($idk == $per->id_rencana) {
                                                $showData = false; // Jika idk ada dalam $persetujuan, jangan tampilkan data
                                                break; // Keluar dari loop jika sudah ditemukan
                                            }
                                        }

                                        if ($showData && $key->status == 'Diproses') { // Hanya tampilkan jika showData true dan status Diproses
                                    ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo $no++; ?>
                                                </th>
                                                <td>
                                                    <?php foreach ($ukm as $val) {
                                                        if ($val->id_ukm == $key->id_ukm) {
                                                            echo $val->nm_ukm;
                                                        }
                                                    } ?>
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
                                                    <?php echo $key->tgl_kirim; ?>
                                                </td>
                                                <td>
                                                    <?php echo $key->waktu; ?>
                                                </td>
                                                <td>
                                                    <?php echo $key->status; ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-outline-warning" href="" data-toggle="modal" data-target=".id_<?php echo $idk; ?>">Edit</a>
                                                </td>
                                                <div class="modal fade id_<?php echo $idk ?>" id="id_<?php echo $idk ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Form Persetujuan</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="<?php echo site_url('Direktur/edit_rencana') ?>">
                                                                    <div class="form-group">
                                                                        <label for="">Judul</label>
                                                                        <input type="text" class="form-control" value="<?php echo $key->judul; ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleFormControlInput1">Status</label>
                                                                        <select name="status" class="form-control">
                                                                            <option value="">--PILIH--</option>
                                                                            <option value="Diterima Direktur">Diterima</option>
                                                                            <option value="Ditolak Direktur">Ditolak</option>
                                                                            <option value="Direvisi Direktur">Direvisi</option>
                                                                            <option value="Ke Warek">Persejuan Warek</option>
                                                                        </select>

                                                                        <input type="hidden" class="form-control" name="id_rencana" value="<?php echo $idk; ?>">

                                                                        <input type="hidden" class="form-control" name="id_ukm" value="<?php echo $key->id_ukm; ?>">
                                                                    </div>
                                                                    <hr>
                                                                    <span><b>*Jika Laporan Ditolak/Direvisi, wajib diisi</b></span>
                                                                    <div class="form-group">
                                                                        <label for="exampleFormControlInput1">Keterangan</label>
                                                                        <textarea type="text" class="form-control" name="keterangan"></textarea>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-gradient-primary btn-icon-text">
                                                                        <i class=""></i> Submit </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Edit UKM -->
                                            </tr>
                                            <!-- Modal Edit UKM-->
                                            <?php }
                                    }
                                    foreach ($persetujuan as $ptj) {
                                        if ($ptj->status == 'Direvisi Direktur') {
                                            foreach ($rencana_kegiatan as $ren) {
                                                if ($ren->id_rencana == $ptj->id_rencana) {
                                                    if ($ren->status == 'Telah Direvisi') {
                                                        $idk = $ren->id_rencana; ?>
                                                        <tr>
                                                            <th scope="row">
                                                                <?php echo $no++; ?>
                                                            </th>
                                                            <td>
                                                                <?php foreach ($ukm as $val) {
                                                                    if ($val->id_ukm == $ren->id_ukm) {
                                                                        echo $val->nm_ukm;
                                                                    }
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $ren->judul; ?>
                                                            </td>
                                                            <td>
                                                                <a href="<?php echo site_url('/upload_file/' . $ren->file) ?>" target="_blank">
                                                                    <button type="button" class="btn btn-gradient-dark btn-icon-text btn-sm">
                                                                        File
                                                                        <i class="mdi mdi-file-check btn-icon-append"></i>
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <?php echo $ren->tgl_kirim; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $ren->waktu; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $ren->status; ?>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-outline-warning" href="" data-toggle="modal" data-target=".id_<?php echo $idk; ?>">Edit</a>
                                                            </td>
                                                            <div class="modal fade id_<?php echo $idk ?>" id="id_<?php echo $idk ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Form Persetujuan</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="POST" action="<?php echo site_url('Direktur/edit_rencana') ?>">
                                                                                <div class="form-group">
                                                                                    <label for="">Judul</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $ren->judul; ?>" readonly>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="exampleFormControlInput1">Status</label>
                                                                                    <select name="status" class="form-control">
                                                                                        <option value="">--PILIH--</option>
                                                                                        <option value="Diterima Direktur">Diterima</option>
                                                                                        <option value="Ditolak Direktur">Ditolak</option>
                                                                                        <option value="Direvisi Direktur">Direvisi</option>
                                                                                        <option value="Ke Warek">Persejuan Warek</option>
                                                                                    </select>

                                                                                    <input type="hidden" class="form-control" name="id_rencana" value="<?php echo $idk; ?>">
                                                                                    <input type="hidden" class="form-control" name="id_persetujuan" value="<?php echo $ptj->id_persetujuan; ?>">
                                                                                    <input type="hidden" class="form-control" name="id_ukm" value="<?php echo $ren->id_ukm; ?>">
                                                                                </div>
                                                                                <hr>
                                                                                <span><b>*Jika Laporan Ditolak/Direvisi, wajib diisi</b></span>
                                                                                <div class="form-group">
                                                                                    <label for="exampleFormControlInput1">Keterangan</label>
                                                                                    <textarea type="text" class="form-control" name="keterangan"></textarea>
                                                                                </div>
                                                                                <button type="submit" class="btn btn-gradient-primary btn-icon-text">
                                                                                    <i class=""></i> Submit </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Edit UKM -->
                                                        </tr>
                                    <?php }
                                                }
                                            }
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div><br><br>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <h4>Data Kegiatan UKM Yang Diterima</h4>
                                </div>
                            </div><br>
                            <table id="datatabel" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama UKM</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">File</th>
                                        <th scope="col">Waktu Pengiriman</th>
                                        <th scope="col">Waktu Acara</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($rencana_kegiatan as $key) {
                                        $idk = $key->id_rencana;
                                        if ($key->status == "Diterima") { ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo $no++; ?>
                                                </th>
                                                <td>
                                                    <?php foreach ($ukm as $val) {
                                                        if ($val->id_ukm == $key->id_ukm) {
                                                            echo $val->nm_ukm;
                                                        }
                                                    } ?>
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
                                                    <?php echo $key->tgl_kirim; ?>
                                                </td>
                                                <td>
                                                    <?php echo $key->waktu; ?>
                                                </td>
                                                <td>
                                                    <?php echo $key->status;
                                                    foreach ($persetujuan as $per) {
                                                        if ($idk == $per->id_rencana) {
                                                            echo ' <b> (' . $per->status . ')</b>';
                                                        }
                                                    }
                                                    ?>
                                                </td>

                                            </tr>
                                            <!-- Modal Edit UKM-->
                                            <div class="modal fade id_<?php echo $idk ?>" id="id_<?php echo $idk ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Form Edit UKM</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="<?php echo site_url('Adminpanel/edit_ukm') ?>">
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlInput1">Nama UKM</label>
                                                                    <input type="text" class="form-control" name="nm_ukm" value="<?php echo $key->nm_ukm; ?>">
                                                                    <input type="hidden" class="form-control" name="id_ukm" value="<?php echo $idk; ?>">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Edit UKM -->
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- content-wrapper ends -->

    <!-- Untuk Warek -->
<?php } else { ?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                    </span> Laporan Rencana Kegiatan UKM
                </h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <!-- <div class="col-md-9">
                        <h4>Data Rencana Kegiatan UKM</h4><br>
                    </div> -->
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="datatabel" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama UKM</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">File</th>
                                        <th scope="col">Waktu Pengiriman</th>
                                        <th scope="col">Waktu Acara</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;

                                    foreach ($rencana_kegiatan as $key) {
                                        $idk = $key->id_rencana;
                                        foreach ($persetujuan as $per) {
                                            if ($idk == $per->id_rencana) {
                                                if ($per->status == 'Ke Warek') { // Hanya tampilkan jika showData true dan status Diproses

                                    ?>
                                                    <tr>
                                                        <th scope="row">
                                                            <?php echo $no++; ?>
                                                        </th>
                                                        <td>
                                                            <?php foreach ($ukm as $val) {
                                                                if ($val->id_ukm == $key->id_ukm) {
                                                                    echo $val->nm_ukm;
                                                                }
                                                            } ?>
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
                                                            <?php echo $key->tgl_kirim; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $key->waktu; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $key->status; ?>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-outline-warning" href="" data-toggle="modal" data-target=".id_<?php echo $idk; ?>">Edit</a>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal Edit UKM-->
                                                    <div class="modal fade id_<?php echo $idk ?>" id="id_<?php echo $idk ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Form Persetujuan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST" action="<?php echo site_url('Warek/edit_rencana') ?>">
                                                                        <div class="form-group">
                                                                            <label for="">Judul</label>
                                                                            <input type="text" class="form-control" value="<?php echo $key->judul; ?>" readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleFormControlInput1">Status</label>
                                                                            <select name="status" class="form-control">
                                                                                <option value="">--PILIH--</option>
                                                                                <option value="Diterima Warek">Diterima</option>
                                                                                <option value="Ditolak Warek">Ditolak</option>
                                                                                <option value="Direvisi Warek">Revisi</option>
                                                                            </select>

                                                                            <input type="hidden" class="form-control" name="id_rencana" value="<?php echo $idk; ?>">
                                                                            <input type="hidden" class="form-control" name="id_persetujuan" value="<?php echo $per->id_persetujuan; ?>">
                                                                            <input type="hidden" class="form-control" name="id_ukm" value="<?php echo $key->id_ukm; ?>">
                                                                        </div>
                                                                        <hr>
                                                                        <span><b>*Jika Laporan Ditolak/Direvisi, wajib diisi</b></span>
                                                                        <div class="form-group">
                                                                            <label for="exampleFormControlInput1">Keterangan</label>
                                                                            <textarea type="text" class="form-control" name="keterangan"></textarea>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-gradient-primary btn-icon-text">
                                                                            <i class=""></i> Submit </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Edit UKM -->
                                    <?php }
                                            }
                                        }
                                    } ?>
                                    <?php
                                    foreach ($persetujuan as $ptj) {
                                        if ($ptj->status == 'Direvisi Warek') {
                                            foreach ($rencana_kegiatan as $ren) {
                                                if ($ren->id_rencana == $ptj->id_rencana) {
                                                    if ($ren->status == 'Telah Direvisi') {
                                                        $idk = $ren->id_rencana; ?>
                                                        <tr>
                                                            <th scope="row">
                                                                <?php echo $no++; ?>
                                                            </th>
                                                            <td>
                                                                <?php foreach ($ukm as $val) {
                                                                    if ($val->id_ukm == $ren->id_ukm) {
                                                                        echo $val->nm_ukm;
                                                                    }
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $ren->judul; ?>
                                                            </td>
                                                            <td>
                                                                <a href="<?php echo site_url('/upload_file/' . $ren->file) ?>" target="_blank">
                                                                    <button type="button" class="btn btn-gradient-dark btn-icon-text btn-sm">
                                                                        File
                                                                        <i class="mdi mdi-file-check btn-icon-append"></i>
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <?php echo $ren->tgl_kirim; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $ren->waktu; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $ren->status; ?>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-outline-warning" href="" data-toggle="modal" data-target=".id_<?php echo $idk; ?>">Edit</a>
                                                            </td>
                                                            <div class="modal fade id_<?php echo $idk ?>" id="id_<?php echo $idk ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Form Persetujuan</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="POST" action="<?php echo site_url('Warek/edit_rencana') ?>">
                                                                                <div class="form-group">
                                                                                    <label for="">Judul</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $ren->judul; ?>" readonly>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="exampleFormControlInput1">Status</label>
                                                                                    <select name="status" class="form-control">
                                                                                        <option value="">--PILIH--</option>
                                                                                        <option value="Diterima Warek">Diterima</option>
                                                                                        <option value="Ditolak Warek">Ditolak</option>
                                                                                        <option value="Direvisi Warek">Direvisi</option>
                                                                                    </select>

                                                                                    <input type="hidden" class="form-control" name="id_rencana" value="<?php echo $idk; ?>">
                                                                                    <input type="hidden" class="form-control" name="id_persetujuan" value="<?php echo $ptj->id_persetujuan; ?>">
                                                                                    <input type="hidden" class="form-control" name="id_ukm" value="<?php echo $ren->id_ukm; ?>">
                                                                                </div>
                                                                                <hr>
                                                                                <span><b>*Jika Laporan Ditolak/Direvisi, wajib diisi</b></span>
                                                                                <div class="form-group">
                                                                                    <label for="exampleFormControlInput1">Keterangan</label>
                                                                                    <textarea type="text" class="form-control" name="keterangan"></textarea>
                                                                                </div>
                                                                                <button type="submit" class="btn btn-gradient-primary btn-icon-text">
                                                                                    <i class=""></i> Submit </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Edit UKM -->
                                                        </tr>
                                    <?php }
                                                }
                                            }
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div><br><br>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <h4>Data Kegiatan UKM Yang Diterima</h4>
                                </div>
                            </div><br>
                            <table id="datatabel" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama UKM</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">File</th>
                                        <th scope="col">Waktu Pengiriman</th>
                                        <th scope="col">Waktu Acara</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($rencana_kegiatan as $key) {
                                        $idk = $key->id_rencana;
                                        if ($key->status == "Diterima") { ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo $no++; ?>
                                                </th>
                                                <td>
                                                    <?php foreach ($ukm as $val) {
                                                        if ($val->id_ukm == $key->id_ukm) {
                                                            echo $val->nm_ukm;
                                                        }
                                                    } ?>
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
                                                    <?php echo $key->tgl_kirim; ?>
                                                </td>
                                                <td>
                                                    <?php echo $key->waktu; ?>
                                                </td>
                                                <td>
                                                    <?php echo $key->status;
                                                    foreach ($persetujuan as $per) {
                                                        if ($idk == $per->id_rencana) {
                                                            echo ' <b> (' . $per->status . ')</b>';
                                                        }
                                                    }
                                                    ?>
                                                </td>

                                            </tr>
                                            <!-- Modal Edit UKM-->
                                            <div class="modal fade id_<?php echo $idk ?>" id="id_<?php echo $idk ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Form Edit UKM</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="<?php echo site_url('Adminpanel/edit_ukm') ?>">
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlInput1">Nama UKM</label>
                                                                    <input type="text" class="form-control" name="nm_ukm" value="<?php echo $key->nm_ukm; ?>">
                                                                    <input type="hidden" class="form-control" name="id_ukm" value="<?php echo $idk; ?>">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Edit UKM -->
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- content-wrapper ends -->
    <?php } ?>