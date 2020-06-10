<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <link rel="stylesheet" type="text/css" href="">
  <style >
    body {
        height: 842px;
        width: 595px;
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
    }
    ol{
    }
    @page Section {
/*    size:8.5in 11.0in;
    margin: 0.7in 0.9in 0.7in 0.9in;
    mso-header-margin: 0.0in;
    mso-footer-margin: 0.0in;
    mso-title-page: yes;
    mso-first-header: fh1;
    mso-paper-source: 0;
    line-height: 20%;*/
  }
  div.Section {
      page: Section;
  }
  p{
    margin: 0;
    padding: 0;
  }
  body{
/*    width: 1240px;
    height: 1754px;
    display: flex;
    justify-content: center;*/
  }
  .custom-td{
    vertical-align: top;
  }
  .list-td ol{
    display: block;
    list-style-type: decimal;
    padding-inline-start: 1em;
    margin: 0;  
  }
    </style>

</head>
  <body onload="window.print()">
    <div style="">
      <table style="border-bottom: solid 1px black">
        <tr>
          <td>
            <img src="<?=base_url()?>assets/img/logoub.jpg"  width="100" height="100">
          </td>
          <td style="text-align: center;margin-bottom: 0">
            <span>
            KEMENTRIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI
          </p>
          <strong style="margin: 0">UNIVERSITAS BRAWIJAYA</strong>
          <br>
          <strong style="margin: 0">FAKULTAS ILMU KOMPUTER</strong>
          <p >Jalan Veteran, Malang 65145, Indonesia</p>
          <p>Telp. +62-341 -577911, Fax. +62-341-57791</p>
          <p>E-mail: filkom@ub.ac.id       http://filkom.ub.ac.id</p>
        </td>
      </tr>
    </table>
    <p style="text-transform: uppercase; text-align: center;">
      berita acara
    </p>
    <table style="text-transform: capitalize;">
      <tr>
        <td>
          judul
        </td>
        <td>:</td>
        <td><?=$detail->judul?></td>
      </tr>
      <tr>
        <td>
          pembahasan
        </td>
        <td>:</td>
        <td><?=$detail->pembahasan?></td>
      </tr>
      <tr>
        <td>
          tempat
        </td>
        <td>:</td>
        <td><?=$detail->tempat?></td>
      </tr>
      <tr>
        <td>
          waktu
        </td>
        <td>:</td>
        <td><?=$detail->tanggal?></td>
      </tr>
      <tr>
        <td>
          pemimpin rapat
        </td>
        <td>:</td>
        <td><?=$detailas[0]->pemimpin?></td>
      </tr>
      <tr>
        <td class="custom-td">
          Agenda pembahasan
        </td>
        <td class="custom-td">:</td>
        <td class="list-td" id="agenda-container"></td>
      </tr>
      <tr>
        <td class="custom-td">pembahasan</td>
        <td class="custom-td">:</td>
        <td class="list-td" id="pembahasan-container"></td>
      </tr>      
    </table>
    <div style="display: none;" id="quillContainer">
      <?=$detail->catatan_notula?>
      </div>
      <table style="margin-top: 1rem;text-transform: capitalize;">
      <tr>
        <td>
          Dokumentasi
        </td>
        <td>
          :
        </td>
        <td>
          <?php foreach (json_decode($detail->image) as $image){ ?>
             <img src='<?php echo base_url($image) ?>' class="img-fluid" width="144" height="81">
          <?php } ?>
        </td>
      </tr>
    </table>
    <br>
    <br>
    <div style="display: flex;justify-content: flex-end;">
      <div style="width: 250px">
        <h4>
          Ketua jurusan,
        </h4>
        <div style="height: 80px">
          
        </div>
        <div>
          <small>
            Tri Astoto Kurniawan, S.T., M.T., Ph.D.
          </p>
          <small>
            NIP : 19710518 200312 1 001 
          </p>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      let quillcontainer = document.querySelectorAll('#quillContainer ol');

      let olArr = (quillcontainer);

      let agendaOL =(olArr[0]);
      let pembahasanText = (olArr[1]);
      let agendaContainer = document.getElementById('agenda-container');
      let pContainer = document.getElementById('pembahasan-container');    
      agendaContainer.appendChild(agendaOL);
      pContainer.appendChild(pembahasanText);

    </script>
  </body>
</html>