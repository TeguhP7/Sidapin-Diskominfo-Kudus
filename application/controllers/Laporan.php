<?php
class Laporan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('Pdf_tcpdf');
        $this->load->model('Inventaris_model');
        $this->load->model('Pegawai_model');
        $this->load->model('Assets_model');

        if (!$this->session->userdata('logined') || $this->session->userdata('logined') != true) {
            redirect('/');
        }
    }

    function kartu_pegawai($id)
    {
        $data['data'] =  $this->Pegawai_model->ambil_data_id($id);
        $this->load->view('kartu_pegawai', $data);
    }

    function qrinven()
    {
        $data['data'] =  $this->Inventaris_model->ambil_data2();
        $this->load->view('cetak_qr_inven', $data);
    }

    function aset()
    {
        // Include the main TCPDF library (search for installation path).
        // require_once('tcpdf_include.php');

        // create new PDF document
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Anonim');
        $pdf->SetTitle('Laporan Aset');
        $pdf->SetSubject('Laporan');
        $pdf->SetKeywords('Laporan, Cetak, Aset');

        // set default header data
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 041', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------
        //ukuran A4 210 x 297 mm
        // set font
        $pdf->SetFont('times', '', 12);

        // add a page
        $pdf->AddPage();
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.1, 'depth_h' => 0.1, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        $pdf->Image('assets/img/white.jpg', 0,  0, 200, 27, 'JPG', '', '', true);
        $pdf->Image('assets/img/white.jpg', 200,  0, 200, 27, 'JPG', '', '', true);
        $pdf->Image('assets/img/logo2.png', 45,  8, 20, 24, 'PNG', '', '', true);
        $pdf->Text(115, 10, 'PEMERINTAH KABUPATEN KUDUS');
        $pdf->Text(122, 15, 'KECAMATAN KOTA KUDUS');
        $pdf->Text(109, 20, 'DINAS KOMUNIKASI DAN INFORMATIKA');
        $pdf->Text(66, 25, 'Jl. Sunan Muria No.9, Kudus, Glantengan, Kec. Kota Kudus, Kabupaten Kudus, Jawa Tengah 59313');
        $pdf->Rect(15, 33.5, 267, 0, 'D');
        $pdf->Rect(15, 34.2, 267, 0.2, 'D');
        $pdf->Rect(15, 34.5, 267, 0.2, 'D');
        $pdf->Rect(15, 34.8, 267, 0, 'D');

        // mencetak string 
        $pdf->Cell(10, 14, '', 0, 1);
        $pdf->Cell(270, 5, 'LAPORAN ASET', 0, 1, 'C');

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 1, '', 0, 1);
        $pdf->Cell(10, 6, 'No.', 1, 0, 'C');
        $pdf->Cell(40, 6, 'Kode Aset', 1, 0, 'C');
        $pdf->Cell(65, 6, 'Nama Aset', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Tahun Masuk', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Kondisi', 1, 0, 'C');
        $pdf->Cell(92, 6, 'Keterangan Lain', 1, 1, 'C');

        // ---------------------------------------------------------
        $ass = $this->Assets_model->ambil_data();
        $no = 1;
        foreach ($ass as $row) {

            $pdf->Cell(10, 6, $no . '.', 1, 0, 'C');
            $pdf->Cell(40, 6, $row->kode_aset, 1, 0, 'C');
            $pdf->Cell(65, 6, $row->nama_aset, 1, 0);
            $pdf->Cell(30, 6, $row->tahun, 1, 0, 'C');
            $pdf->Cell(30, 6, $row->kondisi, 1, 0, 'C');
            $pdf->Cell(92, 6, $row->ket_lain, 1, 1);
            $no++;
        }

        //Close and output PDF document
        $pdf->Output('Laporan Assets.pdf', 'I');
    }

    function pegawai()
    {
        // Include the main TCPDF library (search for installation path).
        // require_once('tcpdf_include.php');

        // create new PDF document
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Anonim');
        $pdf->SetTitle('Laporan Pegawai');
        $pdf->SetSubject('Laporan');
        $pdf->SetKeywords('Laporan, Cetak, Pegawai');

        // set default header data
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 041', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------
        //ukuran A4 210 x 297 mm
        // set font
        $pdf->SetFont('times', '', 12);
        // add a page
        $pdf->AddPage();
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.1, 'depth_h' => 0.1, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        $pdf->Image('assets/img/white.jpg', 0,  0, 200, 27, 'JPG', '', '', true);
        $pdf->Image('assets/img/white.jpg', 200,  0, 200, 27, 'JPG', '', '', true);
        $pdf->Image('assets/img/logo2.png', 45,  8, 20, 24, 'PNG', '', '', true);
        $pdf->Text(115, 10, 'PEMERINTAH KABUPATEN KUDUS');
        $pdf->Text(122, 15, 'KECAMATAN KOTA KUDUS');
        $pdf->Text(109, 20, 'DINAS KOMUNIKASI DAN INFORMATIKA');
        $pdf->Text(66, 25, 'Jl. Sunan Muria No.9, Kudus, Glantengan, Kec. Kota Kudus, Kabupaten Kudus, Jawa Tengah 59313');
        $pdf->Rect(15, 33.5, 267, 0, 'D');
        $pdf->Rect(15, 34.2, 267, 0.2, 'D');
        $pdf->Rect(15, 34.5, 267, 0.2, 'D');
        $pdf->Rect(15, 34.8, 267, 0, 'D');

        // mencetak string 
        $pdf->Cell(10, 14, '', 0, 1);
        $pdf->Cell(270, 5, 'LAPORAN PEGAWAI', 0, 1, 'C');

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 1, '', 0, 1);
        $pdf->Cell(15, 6, 'No.', 1, 0, 'C');
        $pdf->Cell(40, 6, 'NIP', 1, 0, 'C');
        $pdf->Cell(65, 6, 'Nama', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Jabatan', 1, 0, 'C');
        $pdf->Cell(35, 6, 'Status Pegawai', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Telepon', 1, 1, 'C');

        // ---------------------------------------------------------
        $ass = $this->Pegawai_model->ambil_data();
        $no = 1;
        foreach ($ass as $row) {
            $pdf->Cell(15, 6, $no . '.', 1, 0, 'C');
            $pdf->Cell(40, 6, $row->nip_pegawai, 1, 0, 'C');
            $pdf->Cell(65, 6, $row->nama_pegawai, 1, 0);
            $pdf->Cell(45, 6, $row->jabatan, 1, 0, 'C');
            $pdf->Cell(35, 6, $row->status_p, 1, 0, 'C');
            $pdf->Cell(45, 6, $row->telepon, 1, 1, 'C');
            $no++;
        }
        //Close and output PDF document
        $pdf->Output('Laporan Pegawai.pdf', 'I');
    }

    function kartu_pegawai1($id)
    {
        // Include the main TCPDF library (search for installation path).
        // require_once('tcpdf_include.php');

        // create new PDF document
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Anonim');
        $pdf->SetTitle('Kartu Pegawai');
        $pdf->SetSubject('Laporan');
        $pdf->SetKeywords('Laporan, Cetak, Kartu Pegawai');

        // set default header data
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 041', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------
        //ukuran A4 210 x 297 mm
        // set font
        $pdf->SetFont('times', '', 12);
        // add a page
        $pdf->AddPage();
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.1, 'depth_h' => 0.1, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        $pdf->Image('assets/img/white.jpg', 0,  0, 200, 27, 'JPG', '', '', true);
        $pdf->Image('assets/img/white.jpg', 200,  0, 200, 27, 'JPG', '', '', true);
        $pdf->Image('assets/img/logo2.png', 33,  12, 25, 29, 'PNG', '', '', true);
        $pdf->Text(75, 12, 'PEMERINTAH KABUPATEN KUDUS');
        $pdf->Text(69, 19, 'DINAS KOMUNIKASI DAN INFORMATIKA');
        $pdf->Text(64, 26, 'Jl. Sunan Muria No.9, Kudus, Glantengan, Kec. Kota');
        $pdf->Text(77, 33, 'Kabupaten Kudus, Jawa Tengah 59313');
        $pdf->Rect(15, 44.5, 180, 0, 'D');
        $pdf->Rect(15, 45.2, 180, 0.2, 'D');
        $pdf->Rect(15, 45.5, 180, 0.2, 'D');
        $pdf->Rect(15, 45.8, 180, 0, 'D');

        // mencetak Cell
        $pdf->Cell(10, 30, '', 0, 1);
        $pdf->Cell(180, 8, 'KARTU PEGAWAI', 0, 1, 'C');

        $ass = $this->Pegawai_model->ambil_data_id($id);

        //ukuran B2 id card 126 mm x 79mm

        //Close and output PDF document
        $pdf->Output('Kartu Pegawai ' . $ass->nama_pegawai . '.pdf', 'I');
    }
}
