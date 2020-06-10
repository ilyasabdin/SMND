


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daftar Notula</h6>
        </div>
        <div class="card-body">          
          <div class="box-body table-responsive">
            <table id="table_id" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
              <thead>
              <tr>
                <th>No.</th>
                <th>Judul Rapat</th>
                <th>Agenda Pembahasan</th>
                <th>Tempat</th>
                <th>Tanggal</th>
              </tr>
                <tbody>
                  <?php $no = 1;
                  foreach ($row->result() as $key => $data) {
                   ?>
                  <tr>
                    
                     <td><?=$no++ ?></td> 
                     <td><b><a style="color: orange" href="<?php echo base_url().'Report_C/Detail_notula/'.$data->id_notula;?>"><?= $data->judul; ?></a></b></td>
                     <td><?=$data->pembahasan?></td>
                     <td><?=$data->tempat?></td>
                     <td><?=$data->tanggal?></td>
                     
                    
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

