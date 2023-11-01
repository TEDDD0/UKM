<?php
class Direktur extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mcrud');
        $this->cek_login();
    }
    public function cek_login()
    {
        if (empty($this->session->userdata('username'))) {
            redirect('Login');
        } elseif ($this->session->userdata('level') == 'Warek') {
            redirect('Warek');
        } elseif ($this->session->userdata('level') == 'Kemahasiswaan') {
            redirect('Adminpanel');
        }
    }
    public function index()
    {
        // cek login
        $data['content'] = "admin/direktur";
        $data['ukm'] = $this->Mcrud->get_all_data('tbl_ukm')->result();
        $data['rencana'] = $this->Mcrud->get_all_data('tbl_rencana_kegiatan')->result();
        $data['kegiatan'] = $this->Mcrud->get_all_data('tbl_kegiatan')->result();
        $data['persetujuan'] = $this->Mcrud->get_all_data('tbl_persetujuan')->result();
        //load view
        $this->load->view('template_direktur', $data);
    }
    public function rencana_kegiatan()
    {
        // cek login
        $data['content'] = "admin/ren_kegiatan_direk";
        $data['ukm'] = $this->Mcrud->get_all_data('tbl_ukm')->result();
        $data['rencana_kegiatan'] = $this->Mcrud->get_all_data('tbl_rencana_kegiatan')->result();
        $data['kegiatan'] = $this->Mcrud->get_all_data('tbl_kegiatan')->result();
        $data['persetujuan'] = $this->Mcrud->get_all_data('tbl_persetujuan')->result();

        //load view
        $this->load->view('template_direktur', $data);
    }
    public function edit_rencana()
    {
        // get data
        $id_rencana = $_POST['id_rencana'];

        $id_persetujuan = $_POST['id_persetujuan'];
        $status = $_POST['status'];
        $keterangan = $_POST['keterangan'];
        $allert = 'Di Edit';
        if (empty($status)) {
            $this->session->set_flashdata('flash-tolak', 'Data Status Harus diisi');
            redirect('Direktur/rencana_kegiatan');
        }
        if ($status == "Diterima Direktur") {
            $id_ukm = $_POST['id_ukm'];
            $id_admin = $this->session->userdata('id_admin');
            $allert = 'Diterima';
            $datainsert = array(
                'id_rencana' => $id_rencana,
                'id_ukm' => $id_ukm,
                'id_admin' => $id_admin
            );
            $this->Mcrud->insert('tbl_kegiatan', $datainsert);
            $dataupdate = array(
                'status' => 'Diterima'
            );
            $this->Mcrud->update('tbl_rencana_kegiatan', $dataupdate, 'id_rencana', $id_rencana);
            if (empty($id_persetujuan)) {
                $data_persetujuan = array(
                    'id_rencana' => $id_rencana,
                    'status' => $status,
                    'keterangan' => $keterangan
                );
                // save data
                $this->Mcrud->insert('tbl_persetujuan', $data_persetujuan);
                $this->session->set_flashdata('flash', $allert);
                redirect('Direktur/rencana_kegiatan');
            } else {
                $data_persetujuan = array(
                    'status' => $status
                );
                // save data
                $this->Mcrud->update('tbl_persetujuan', $data_persetujuan, 'id_persetujuan', $id_persetujuan);
                $this->session->set_flashdata('flash', $allert);
                redirect('Direktur/rencana_kegiatan');
            }
        } elseif ($status == "Ditolak Direktur") {
            if (empty($keterangan)) {
                $this->session->set_flashdata('flash-tolak', 'Keterangan Tolak Harus Diisi');
                redirect('Direktur/rencana_kegiatan');
            }
            $dataupdate = array(
                'status' => 'Ditolak',
                'ket_tolak' => $keterangan
            );
            $this->Mcrud->update('tbl_rencana_kegiatan', $dataupdate, 'id_rencana', $id_rencana);
            $allert = 'Ditolak';
            if (empty($id_persetujuan)) {
                $data_persetujuan = array(
                    'id_rencana' => $id_rencana,
                    'status' => $status,
                    'keterangan' => $keterangan
                );
                // save data
                $this->Mcrud->insert('tbl_persetujuan', $data_persetujuan);
                $this->session->set_flashdata('flash', $allert);
                redirect('Direktur/rencana_kegiatan');
            } else {
                $data_persetujuan = array(
                    'status' => $status
                );
                // save data
                $this->Mcrud->update('tbl_persetujuan', $data_persetujuan, 'id_persetujuan', $id_persetujuan);
                $this->session->set_flashdata('flash', $allert);
                redirect('Direktur/rencana_kegiatan');
            }
        } elseif ($status == "Direvisi Direktur") {
            if (empty($keterangan)) {
                $this->session->set_flashdata('flash-tolak', 'Keterangan Harus Diisi');
                redirect('Direktur/rencana_kegiatan');
            }
            $dataupdate = array(
                'status' => 'Direvisi',
                'ket_tolak' => $keterangan
            );
            $this->Mcrud->update('tbl_rencana_kegiatan', $dataupdate, 'id_rencana', $id_rencana);
            $allert = 'Direvisi';
            if (empty($id_persetujuan)) {
                $data_persetujuan = array(
                    'id_rencana' => $id_rencana,
                    'status' => $status,
                    'keterangan' => $keterangan
                );
                // save data
                $this->Mcrud->insert('tbl_persetujuan', $data_persetujuan);
                $this->session->set_flashdata('flash', $allert);
                redirect('Direktur/rencana_kegiatan');
            } else {
                $data_persetujuan = array(
                    'status' => $status
                );
                // save data
                $this->Mcrud->update('tbl_persetujuan', $data_persetujuan, 'id_persetujuan', $id_persetujuan);
                $this->session->set_flashdata('flash', $allert);
                redirect('Direktur/rencana_kegiatan');
            }
        } elseif ($status == "Ke Warek") {
            $dataupdate = array(
                'status' => 'Diproses',
                'ket_tolak' => $keterangan
            );
            $this->Mcrud->update('tbl_rencana_kegiatan', $dataupdate, 'id_rencana', $id_rencana);
            $allert = 'Dialihkan Ke Warek';
            if (empty($id_persetujuan)) {
                $data_persetujuan = array(
                    'id_rencana' => $id_rencana,
                    'status' => $status,
                    'keterangan' => $keterangan
                );
                // save data
                $this->Mcrud->insert('tbl_persetujuan', $data_persetujuan);
                $this->session->set_flashdata('flash', $allert);
                redirect('Direktur/rencana_kegiatan');
            } else {
                $data_persetujuan = array(
                    'status' => $status
                );
                // save data
                $this->Mcrud->update('tbl_persetujuan', $data_persetujuan, 'id_persetujuan', $id_persetujuan);
                $this->session->set_flashdata('flash', $allert);
                redirect('Direktur/rencana_kegiatan');
            }
        }
        // $data_persetujuan = array(
        //     'id_rencana' => $id_rencana,
        //     'status' => $status,
        //     'keterangan' => $keterangan
        // );
        // save data
        // $this->Mcrud->insert('tbl_persetujuan', $data_persetujuan);
        // $this->session->set_flashdata('flash', $allert);
        // redirect('Direktur/rencana_kegiatan');


        // $dataupdate = array(
        //     'status' => $status
        // );
        // // Update data ke tabel 'tbl_seleksi'
        // $this->Mcrud->update('tbl_rencana_kegiatan', $dataupdate, 'id_rencana', $id_rencana);
        // $this->session->set_flashdata('flash', 'Diedit');
        // redirect('Adminpanel/rencana_kegiatan');
    }
}
