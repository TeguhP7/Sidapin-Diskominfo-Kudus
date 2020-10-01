<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pdf_tcpdf
{

    function __construct()
    {
        include_once APPPATH . '/third_party/tcpdf/tcpdf.php';
    }
}
