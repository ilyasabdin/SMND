<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1> -->
    <button style="border-radius: 16px; padding: 10px 20px; background-color: #fb861e; display: inline-block; color: white;" class="d-block mr-0 ml-auto" onclick="goBack()">Kembali</button>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color: orange">Daftar Agenda</h6>
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
                    </thead>
                    <tbody class="text-center">
					<?php $no = 1;
						foreach ($row->result() as $key => $data) {
							?>
                            <tr>
                                <td><?=$no++ ?></td>
                                <td><?=$data->judul?></td>
                                <td><?=$data->pembahasan?></td>
                                <td><?=$data->tempat?></td>
                                <td><?=$data->tanggal?></td>
                                <td class="text-center" width="160px">
									<?php
                                        /*
                                         * Role id 3
                                         * Pre : agenda status === 0
                                         * Aksi edit dan delete agende
                                         */
										$role = (int) $this->session->userdata('role_id');
										if (! (int) $data->status){
											if( $role === 3){
												?>
                                                <a href="<?=site_url('Agenda_C/edit/' .$data->id)?>" class="badge badge-primary" >Edit</a>
                                                <a href="<?=site_url('Agenda_C/delete_agenda/' .$data->id)?>"
                                                   onclick="return confirm('Apakah Anda Yakin?')" class="badge badge-danger">Hapus</i></a>
												<?php
											}
										}
									?>
									<?php
										if ($role === 1 || 3){
											?>
                                            <a href="<?=site_url('Report_C/Detail_agenda/' .$data->id)?>" class="badge badge-info" >Detail agenda</a>
											<?php
										}
									?>
                                    <?php
                                        if ($role != 2){
                                            ?>
                                            <a href="<?=site_url('Report_C/Cetak_Absensi/' .$data->id)?>" class="badge badge-success" target="_blank">Cetak Presensi</a>
                                            <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
      function goBack() {
        window.history.back();
      }
</script>