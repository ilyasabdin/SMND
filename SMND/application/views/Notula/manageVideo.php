


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold" style="color: orange">Daftar Video</h6>
        </div>
        <div class="card-body">          
          <div class="box-body table-responsive">
            <table id="table_id" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
              <thead>
              <tr>
                <th>No.</th>
                <th>Video</th>
                <th>Aksi</th>
              </tr>
                <tbody>
                  <?php $no = 1;
                  foreach ($row->result() as $key => $data) {
                   ?>
                  <tr>
                     <td><?=$no++ ?></td> 
                     <td><?=$data->judul?></td>
                      <td class="text-center" width="160px">
                        <div class="videopopup">
                     <a href="<?php echo base_url('uploads/video/').''.$data->path?>" class="badge badge-primary" target="_blank">Lihat</i></a>
                        </div>
                          <?php
                          if (!$data->is_finish){
                              ?>
                              <a href="<?=site_url('Dokumentasi_video_C/delete/'. $data->id_video)?>" class="badge badge-danger">Hapus</i></a>
                              <?php
                          }
                          
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
      <!-- End of Main Content -->

