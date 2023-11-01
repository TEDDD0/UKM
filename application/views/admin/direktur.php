<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-home"></i>
                </span> Direktur
            </h3>
        </div>
        <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="<?php echo base_url('assets/images/dashboard/circle.svg') ?>" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Laporan Baru <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                        </h4>
                        <?php $no = 0;
                        foreach ($rencana as $key) {
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

                                $no++;
                            }
                        }
                        foreach ($persetujuan as $pjt) {
                            if ($pjt->status == 'Direvisi Direktur') {
                                foreach ($rencana as $ren) {
                                    if ($ren->id_rencana == $pjt->id_rencana) {
                                        if ($ren->status == 'Telah Direvisi') {
                                            $no++;
                                        }
                                    }
                                }
                            }
                        } ?>
                        <h2 class="mb-5">
                            <?php echo $no; ?> Laporan
                        </h2>
                        <h6 class="card-text"></h6>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- content-wrapper ends -->