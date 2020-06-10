


        <!-- Begin Page Content -->
  <div class="container-fluid">

          <!-- Page Heading -->
          
          
          	 <button style="border-radius: 16px; padding: 10px 20px; background-color: #fb861e; display: inline-block; color: white;" class="d-block mr-0 ml-auto" onclick="goBack()">Kembali</button>
    			
      
            <!-- /.container-fluid -->

      <div class="card shadow mb-4">
      <div class="card-body">
      <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold" style="color: orange;">History Rapat</h6>
        </div>          
          <div class="box-body table-responsive">
            <table id="table_id" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
              <thead>
              <tr>
                <th>No.</th>
                <th>Judul Rapat</th>
                <th>Agenda Pembahasan</th>
                <th>Tanggal</th>
                <th>Hasil Notula</th>
              </tr>
                <tbody>
                  <?php $no = 1;
                  foreach ($row as $key => $data) {
                   ?>
                  <tr>
                    
                     <td><?=$no++ ?></td> 
                     <td><?=$data->judul?></td>
                     <td><?=$data->pembahasan?></td>
                     <td><?=$data->tanggal?></td>
                     <td width="130px">
                     <a href="<?php echo base_url().'Report_C/Detail_notula/'.$data->id_notula;?>" class="badge badge-warning">lihat</a>
                     <a href="<?php echo base_url().'Report_C/Report_notula/'.$data->id_notula;?>" class="badge badge-success" target="_blank">Cetak</a>
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
        <script>
      function goBack() {
        window.history.back();
      }
      </script>
      <!-- End of Main Content -->

