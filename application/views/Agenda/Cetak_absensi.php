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
	<body onload="window.print()">
    <center>
        <table>
            <tr>
                <td><img src="<?=base_url()?>assets/img/logoub.jpg"  width="100" height="100"></td>
                <td><center>
                    <font size="3">KEMENTRIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI</font><br>
                    <b><font size="4">UNIVERSITAS BRAWIJAYA</font></b><br>
                    <font size="3">Jalan Veteran, Malang 65145, Indonesia</font><br>
                    <font size="3">Telp. +62341 551611, Fax. +62341 565420</font><br>
                    <font size="3">E-mail: rektorat@ub.ac.id    http://ub.ac.id</font><br>
                </td>
            </tr>
            <tr>
                <td colspan="3"> <hr></td>
            </tr>
        </table>
        <table align="center">
            <tr><center>
                <td><b><font size="3">DAFTAR HADIR</font></b></td>
            </tr>
            </table>
            <tr >
                <td><b><font size="3">KEGIATAN: </font></b></td>
                <td><?php echo $detail[0]->judul ?></td>
                <br>
                <br>
            </tr>
            </table>
        </table>
        <table align="left">
            <tr>
                <td><b><font size="3">WAKTU: </font></b></td>
                <td><?php echo $detail[0]->tanggal ?></td>
            </tr>
            <tr>
                <td><b><font size="3">TEMPAT: </font></b></td>
                <td><?php echo $detail[0]->tempat ?></td>
            </tr>
        </table>
		<br>
        <br> 
        <br>
        <tr>
<!--         <table border="3px" style="margin-left:left;">
          
          <th>Peserta</th>
          <th>TTD</th>  
        </tr>
          <td><?=$detailas[0]->peserta?></td>
        </table>
 -->            
  <table  width="600" border="2" align="center">
  <tr>
   <th rowspan="2">No</th>
   <th rowspan="2">Nama Peserta Rapat</th>
   <th colspan="100">TTD</th>
  </tr>
  <tr>
  </tr>
  <?php $no = 1;
      foreach ($detailas as $n) { ?>
  <tr>
   <td align="center"><?= $no++ ?></td>
   <td>
       <?php
           echo $n->peserta;
           echo "<br>";
           echo "<td> </td>";
        } ?>
   </td>
   
  </tr>
  
  
             
          </tbody>
        
	</body>
</html>