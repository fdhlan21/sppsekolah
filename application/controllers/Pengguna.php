<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{


	function __construct(){

		parent::__construct();
    }
    public function index()
    {
        $data['title'] = 'SPP - Siswa';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();

        // Cek role_id pengguna
        if ($data['admin']['role_id'] == 1) {
            // Jika role_id adalah 1 (admin), tampilkan view admin
            $this->load->view('templates/header', $data);
            $this->load->view('topbar', $data);
            $this->load->view('page/pengguna/pengguna', $data);
            $this->load->view('templates/footer');  
        } elseif ($data['admin']['role_id'] == 2) {
            // Jika role_id adalah 2 (user), tampilkan view user
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('page/pengguna/pengguna', $data);
            $this->load->view('templates/footer');
        } else {
            // Jika role_id tidak valid, tampilkan pesan error
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/error', $data);
            $this->load->view('templates/footer');
        }
    }

   public function ubah() {
        $data['title'] = 'SPP - Ubah Data Siswa';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();


        $this->load->view('templates/header', $data);
        // $this->load->view('topbar', $data);
        $this->load->view('page/pengguna/ubah-pengguna', $data);
        $this->load->view('templates/footer');
    }

    public function edit()

    {
        $data['title'] = 'Zavastock - Data Admin';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('page/slider/edit_slider', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $data['title'] = 'BESTI - Tambah Slider';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();


        $this->load->view('templates/header', $data);
        // $this->load->view('topbar', $data);
        $this->load->view('page/pengguna/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function cetak($id)
    {
        $this->load->library('pdf');
        $this->load->model('Transaksi_model'); // Pastikan Anda telah membuat model Transaksi sesuai dengan struktur tabel transaksi

        // Mengambil data transaksi berdasarkan ID
        $data['transaksi'] = $this->Transaksi_model->get_transaksi_by_id($id);

        // Membuat dokumen PDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Kwitansi Transaksi');
        $pdf->SetHeaderData('', '', 'Kwitansi Transaksi', '', '', 30, '', '', '');
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetFont('helvetica', '', 12);
        $pdf->AddPage();

        // Membuat isi kwitansi
        $html = $this->load->view('kwitansi', $data, true); // Buat view kwitansi

        // Tambahkan isi ke dokumen PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output dokumen PDF ke browser
        $pdf->Output('Kwitansi.pdf', 'I');
    }
}
