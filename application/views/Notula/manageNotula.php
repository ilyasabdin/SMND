


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1> -->
    <button style="border-radius: 16px; padding: 10px 20px; background-color: #fb861e; display: inline-block; color: white;" class="d-block mr-0 ml-auto" onclick="goBack()">Kembali</button>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color: orange">Daftar Notula</h6>
        </div>
        <div class="card-body">
            <div class="box-body table-responsive">
                <table id="table_id" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                    <thead class="text-center">
                    <tr>
                        <th>No.</th>
                        <th>Judul Rapat</th>
                        <th>Agenda Pembahasan</th>
                        <th>Tempat</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                    <tbody class="text-center">
					<?php $no = 1;
						foreach ($row as $key => $data) {
							// print_r($data);
							?>
                            <tr>

                                <td><?=$no++ ?></td>
                                <td><?= $data->judul; ?></a></b></td>
                                <td><?=$data->pembahasan?></td>
                                <td><?=$data->tempat?></td>
                                <td><?=$data->tanggal?></td>
                                <td width="160px">
                                    <a href="<?=site_url('Report_C/Detail_notula/'.$data->id_notula)?>" class="badge badge-info" >Detail Notula</a>
                                    <?php
                                    $role = (int) $this->session->userdata('role_id');
                                        if ($role != 2){
                                            ?>
                                             <a href="<?=site_url('Report_C/Report_notula/' .$data->id_notula)?>" class="badge badge-success" target="_blank">Cetak</a>
                                            <?php
                                        }
                                    ?>
                                			
                                    <?php  
                                    $role = (int) $this->session->userdata('role_id');

                                    if ($role != 3 and $role != 2 ){
										if (! (int) $data->is_finish){
									?>
                                    <a href="<?php echo base_url().'Notula_C/edit_notula/'.$data->id_notula;?>" class="badge badge-primary">Edit</i></a>
                                    <a href="<?=site_url('Notula_C/delete_notula/' .$data->id_notula.'/'.$data->id)?>"
                                       onclick="return confirm('Apakah Anda Yakin?')" class="badge badge-danger">Hapus</i></a>
									<?php
										}}
                                    ?>
                                </td>

                            </tr>
							<?php
							
						} ?>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<script>
      function goBack() {
        window.history.back();
      }
</script>
<!-- End of Main Content -->

