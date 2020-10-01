<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/'); ?>img/box.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>SIDAPIN - Sistem Data Pegawai dan Inventaris</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1" name="viewport" />

    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?php echo base_url('assets/'); ?>css/animate.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="<?php echo base_url('assets/'); ?>css/light-bootstrap-dashboard.css" rel="stylesheet" />

    <link href="<?php echo base_url('assets/'); ?>css/styleqr.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="<?= base_url('assets/css/pe-icon-7-stroke.css') ?>" rel="stylesheet" />

</head>

<body>
    <nav class="navbar container-fluid" style="background-color: red; padding: 20px 20px 0px 20px; color:antiquewhite;">
        <a href="<?php if ($this->session->userdata('logined')) {
                        echo base_url('Home');
                    } else {
                        echo base_url('Login');
                    } ?>" class="h1" style="text-decoration: none;">
            <img src="<?= base_url('assets/img/logo2.png') ?>" width="59.125px" height="73.425px" alt="Logo">
            Sidapin
        </a>
        <span style="float: right" class="container-fluid">
            <br>
            <?php if ($this->session->userdata('logined')) {
                echo anchor(
                    base_url('Home'),
                    '<i class="fa fa-reply"></i> <strong>Kembali ',
                    'class="btn" style="border:none; background-color:black; color:white; width:120px; opacity:100;"'
                );
            } else {
                echo anchor(
                    base_url('Login'),
                    '<i class="fa fa-sign-in"></i> Login ',
                    'class="btn" style="border:none; background-color:black; color:white; width:120px; opacity:100"'
                );
            } ?>
        </span>
    </nav>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Selamat Datang di Sidapin (Sistem Data Pegawai dan Inventaris)</h4>
                            <p class="category">Kantor Dinas Komunikasi dan Informatika, Kec. Kota, Kab. Kudus, Jawa Tengah</p>
                            <p class="category">Permudah pencarian informasi data pegawai dan inventaris!</p>
                            <br>
                        </div>
                        <div class="container-fluid">
                            <div class=" panel panel-info">
                                <div class="panel-heading">
                                    <div class="navbar-left">
                                        <h4>QR Code Scanner Data Inventaris</h4>
                                    </div>
                                </div>
                                <div class="panel-body text-center">
                                    <p class="category">Arahkan QR Code ke dalam kamera!</p>
                                    <br>
                                    <div class="well" style="position: relative; display: inline-block;">
                                        <center>
                                            <canvas width="320" height="240" style="background-color: black;"></canvas>
                                            <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                                            <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                                            <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                                            <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                                        </center>
                                    </div>
                                    <div>
                                        <center>
                                            <select id="camera-select"> </select>
                                        </center>
                                    </div>
                                    <ul id="ul2">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="container-fluid">
                        <center>
                            <p class="copyright">
                                &copy; <script>
                                    document.write(new Date().getFullYear())
                                </script> DISKOMINFO</a> KUDUS, All right reserved
                            </p>
                        </center>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="<?php echo base_url('assets/'); ?>js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/'); ?>js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/'); ?>js/jquery.min.js" type="text/javascript"></script>


    <script src="<?php echo base_url('assets/js/jquery.js'); ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/DecoderWorker.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/qrcodelib.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/webcodecamjquery.js') ?>"></script>


    <script type="text/javascript">
        var arg = {
            resultFunction: function(result) {
                // $('.hasilscan').append($('<input name="noijazah" value=' + result.code + ' readonly><input type="submit" value="Cek"/>'));
                // $.post("../cek.php", {
                //   noijazah: result.code
                // });
                var redirect = '<?= base_url('Data_scan/aset') ?>';
                $.redirectPost(redirect, {
                    kode_aset: result.code,
                });
            },
        };
        var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
        decoder.buildSelectMenu("select");
        decoder.play();
        /*  Without visible select menu
            decoder.buildSelectMenu(document.createElement('select'), 'environment|back').init(arg).play();
        */
        $('select').on('change', function() {
            decoder.stop().play();
        });

        // jquery extend function
        $.extend({
            redirectPost: function(location, args) {
                var form = '';
                $.each(args, function(key, value) {
                    form += '<input type="hidden" name="' + key + '" value="' + value + '">';
                });
                $('<form action="' + location + '" method="POST">' + form + '</form>').appendTo('body').submit();
            }
        });
    </script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="<?php echo base_url('assets/'); ?>js/bootstrap-checkbox-radio-switch.js"></script>

    <!--  Charts Plugin -->
    <script src="<?php echo base_url('assets/'); ?>js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="<?php echo base_url('assets/'); ?>js/bootstrap-notify.js"></script>

</body>

</html>