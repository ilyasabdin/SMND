

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <button style="border-radius: 16px; padding: 10px 20px; background-color: #fb861e; display: inline-block; color: white;" class="d-block mr-0 ml-auto" onclick="goBack()">Kembali</button>
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1>
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Status</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Judul Rapat</th>
                        <td><?php echo $detail->judul?></td>
                    </tr>
                    <tr>
                        <th>Agenda Pembahasan</th>
                        <td><?php echo $detail->pembahasan?></td>
                    </tr>
                    <tr>
                        <th>Tempat</th>
                        <td><?php echo $detail->tempat?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?php echo $detail->tanggal?></td>
                    </tr>
                    <tr>
                        <th>Pemimpin Rapat</th>
                        <td><?php echo $detailas[0]->pemimpin?></td>
                    </tr>
                    <tr>
                        <th>Catatan</th>
                        <td>
                            <div id="quillContainer">
                              <?=$detail->catatan_notula?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Foto Dokumentasi</th>
                        <td>
                        <div class="row">
                            <?php
                            foreach (json_decode($detail->image) as $image){
                                $image = str_replace('./','',$image);
                                ?>
                              <div class="col-md-2 my-2">
                                  <img src='<?php echo base_url($image) ?>' class="img-fluid">
                              </div>
                                <?php
                            }
                            ?>
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Tambahkan Materi</th>
                        <td>
                            <?php if ($detail->materi == null){ ?>
                                <input type="file" name="materi" id="materi">
                            <?php } else { ?>
                                <a target="_blank" href="<?=base_url('uploads/notula/'.$detail->materi)?>">
                                    <i class="fas fa-file-pdf" style="color: red; cursor:pointer"></i>
                                </a>
                            <?php  } ?>
                        </td>
                    </tr>
                </table>
                <?php
                if (! $detail->is_finish && $this->session->userdata('role_id') == 3 ){
                    ?>
                    <div>
                        <!--                        Id = id agenda-->
                        <form method="post" action="<?=site_url('Notula_C/approve_notula/' . $detail->id) ?>">
                            <input type="hidden" name="id_notula" value="<?=$detail->id_notula?>">
                            <button class="btn btn-success">
                                Setujui notula
                            </button>
                        </form>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url('assets/js/quill.min.js')?>"></script>
<script>

</script>
<script>
      function goBack() {
        window.history.back();
      }
      </script>
<!-- /.container-fluid -->
