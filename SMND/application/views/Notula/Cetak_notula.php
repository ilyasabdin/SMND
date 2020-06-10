<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/sb-admin-2.css')?>">
    <style >
        body {
            height: 842px;
            width: 595px;
            /* to centre page on screen*/
            margin-left: auto;
            margin-right: auto;
        }
        @page Section {
            size:8.5in 11.0in;
            margin: 0.7in 0.9in 0.7in 0.9in;
            mso-header-margin: 0.0in;
            mso-footer-margin: 0.0in;
            mso-title-page: yes;
            mso-first-header: fh1;
            mso-paper-source: 0;
            line-height: 20%;
        }
        div.Section {
            page: Section;
        }
    </style>

</head>
<body>

<div class="py-5">
    <div class="row border-bottom pb-2">
        <div class="col-2">
            <img src="<?=base_url()?>assets/img/logoub.jpg"  width="100" height="100">
        </div>
        <div class="col text-center">
            <p class="text-left my-0">
                KEMENTRIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI
            </p>
            <p class="font-weight-bolder my-0">
                UNIVERSITAS BRAWIJAYA
            </p>
            <span class="my-0" >Jalan Veteran, Malang 65145, Indonesia</span><br>
            <span class="my-0"  >Telp. +62341 551611, Fax. +62341 565420</span><br>
            <span class="my-0"  >E-mail: rektorat@ub.ac.id 	http://ub.ac.id</span><br>
        </div>
    </div>
    <p class="text-center my-3">
        BERITA ACARA
    </p>
    <table class="table table-borderless">
        <tr>
            <th>
                JUDUL RAPAT
            </th>
            <td>
                <?=$detail->judul?>
            </td>
        </tr>
        <tr>
            <th>
                AGENDA PEMBAHASAN
            </th>
            <td>
                <?=$detail->pembahasan?>
            </td>
        </tr>

        <tr>
            <th>
                TEMPAT
            </th>
            <td>
                <?=$detail->tempat?>
            </td>
        </tr>
        <tr>
            <th>
                WAKTU
            </th>
            <td>
                <?=$detail->tanggal?>
            </td>
        </tr>
        <tr>
            <th>
                PEMIMPIN RAPAT
            </th>
            <td>
                <?=$detailas[0]->pemimpin?>
            </td>
        </tr>
        <tr>
            <th colspan="2">
                CATATAN
            </th>
        </tr>
        <tr>
            <td colspan="2">
                <div id="quillContainer">
                </div>
            </td>
        </tr>
        <tr>
            <th colspan="2">
                DOKUMENTASI
            </th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">
                <img class="img-fluid"
                     src="<?=base_url('uploads/notula/'.$detail->image)?>"
                     width="256"
                     height="144"
                     alt="">
            </td>
        </tr>
    </table>
</div>
<script src="<?=base_url('assets/js/quill.min.js')?>"></script>
<script>
    let detail = <?=$detail->catatan_notula?>;
		const quill = new Quill('#quillContainer',{
			theme: 'snow',
			readOnly: true,

			modules: {
				toolbar: false
			},
		});
		quill.setContents(detail);

</script>
</body>
</html>