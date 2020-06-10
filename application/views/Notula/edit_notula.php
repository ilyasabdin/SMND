
<!-- Begin Page Content -->
<div class="container-fluid">
<button style="border-radius: 16px; padding: 10px 20px; background-color: #fb861e; display: inline-block; color: white;" class="d-block mr-0 ml-auto" onclick="goBack()">Kembali</button>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color: orange">Edit Notula</h6>
        </div>
        <div class="card-body">
			<?php $edit = $detail;  ?>
            <form enctype="multipart/form-data" action="<?= base_url('Notula_C/update')?>" method="post">
                <input type="hidden" name="id_agenda" value="<?=$edit->id?>">
                <div class="form-group">
                    <label>Judul Rapat</label>
                    <input type="text" name="judul" id="judul" class="form-control" value="<?= $edit->judul?>" readonly="readonly" />

                </div>
                <div class="form-group">
                    <label>Agenda Pembahasan</label>
                    <input type="text" name="pembahasan" id="pembahasan"  class="form-control" value="<?= $edit->pembahasan?>" readonly="readonly" />
                </div>
                <div class="form-group">
                    <label>Tempat</label>
                    <select disabled name="tempat" id="tempat" class="form-control">
                        <option><?= $edit->tempat?></option>
                        <option>Gedung F Lantai 7 Ruang 7.4</option>
                        <option>Gedung F Lantai 7 Ruang 7.7</option>
                        <option>Gedung F Lantai 5 Ruang 5.4</option>
						<?= form_error('tempat' , '<small class="text-danger pl-3">', '</small>') ?>
                    </select>
                </div>
                <label>Tanggal</label>
                <div class='input-group date' id='datetimepicker'>
                    <input value="<?=$edit->tanggal ?>" type="text" readonly class="form-control">
					<?= form_error('tanggal' , '<small class="text-danger pl-3">', '</small>') ?>
                    <span class="input-group-addon"></span>
                </div>
                <br />
                <span id="error_tanggal" class="text-danger"></span>
                <div class="form-group">
                    <label>Pimpinan Rapat</label>
                    <input readonly value="<?=$edit->pemimpin?>" class="form-control" type="text" name="pemimpin" id="pemimpin">
                    </select>
                </div>
                <div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>NAMA</th>
                            <th>KEHADIRAN</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php
							foreach ($peserta as $row)
							{
								?>
                                <tr>
                                    <td>
										<?=$row->peserta?>
                                    </td>
                                    <td>
										<?=$row->kehadiran? 'Hadir' :'Tidak hadir'?>
                                    </td>
                                </tr>
								<?php
							}
						?>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <label>Peserta Rapat</label>
                </div>
                <p>
                    Catatan rapat
                </p>
                <div id="quillContainer" class="">
                  <?=$edit->catatan_notula?>
                </div>
                <input type="hidden" name="catatan_notula" >
                <script>
                    window.delta = <?=$edit->catatan_notula?"'".$edit->catatan_notula."'" : '""' ?>
                </script>
                <div class="form-group">
                    <label>Tambahkan Materi PDF*</label>
                    <input type="file" name="materi" id="materi" class="form-control">
                </div>
                <br>
                <br>
                <button id="submit" type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</div>
<script>
      function goBack() {
        window.history.back();
      }
</script>
<script src="<?=base_url('assets/js/quill.min.js')?>"></script>
<script src="<?=base_url('assets/js/spesifik/notula-editor.js')?>"></script>
