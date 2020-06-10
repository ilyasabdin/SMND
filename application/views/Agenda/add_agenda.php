<!-- <link href="<?= base_url('assets/')?>css/bootstrap-datetimepicker.css" rel="stylesheet"> -->
<!-- <script src="<?= base_url('assets/')?>js/bootstrap-datetimepicker.min.js"></script> -->
<!-- <link href="<?= base_url('assets/')?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- <script src="<?= base_url('assets/')?>vendor/bootstrap/js/bootstrap.min.js"></script> -->
<?php

$usersdata = [];

foreach ($peserta as $_peserta){
    $usersdata[] = ['value'=>$_peserta->id,'label'=>$_peserta->nama];
}
$configs = [
    ['name'=>'judul','label'=>'Judul rapat'],
    ['name'=>'pembahasan','label'=>'Agenda pembahasan'],
    ['name'=>'tempat','label'=>'Tempat','type'=>'select','options'=>[
        'Gedung F Lantai 7 Ruang 7.4',
        'Gedung F Lantai 7 Ruang 7.7',
        'Gedung F Lantai 5 Ruang 5.4'
    ]],
    ['name'=>'tanggal','type'=>'datetime','label'=>'Tanggal'],
    ['name'=>'pemimpin','label'=>'Pemimpin','type'=>'lstSelected','options'=>$usersdata],
    ['name'=>'peserta[]','multiple'=>true,'label'=>'Peserta','type'=>'lstSelected','options'=>$usersdata],
    ['name'=>'materi','fullwidth'=>true,'label'=>'Materi','type'=>'file'],
    ['name'=>'catatan','fullwidth'=>true,'label'=>'Catatan','type'=>'textarea'],
];
if (isset($agenda_value)){
    d($agenda_value);
    exit();
}
?>
<script>
    window.formconfig = '<?=json_encode($configs)?>';
</script>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1> -->
    <button style="border-radius: 16px; padding: 10px 20px; background-color: #fb861e; display: inline-block; color: white;" class="d-block mr-0 ml-auto" onclick="goBack()">Kembali</button>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color: orange">Buat Agenda</h6>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" action="<?= base_url('Agenda_C/input_agenda')?>" method="post">
                <?php
                require ('form_agenda.php')
                ?>
                <div id="table-container" class="d-none">
                    <h3>Daftar kehadiran</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nama peserta</th>
                            <th>Jabatan</th>
                        </tr>
                        </thead>
                        <tbody id="civitas_table">
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
    <script>
      function goBack() {
        window.history.back();
      }
    </script>