


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daftar Video</h6>
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
                     <td><?=$data->pathvideo?></td>
                     <td class="text-center" width="160px">
                     <a href="" class="badge badge-primary">Lihat</i></a>
                     <a href="<?php echo base_url()?>Report_C/Putar_video?pathvideo=<?php echo $data->pathvideo?>" class="badge badge-primary" target="_blank">Lihat</i></a>
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

