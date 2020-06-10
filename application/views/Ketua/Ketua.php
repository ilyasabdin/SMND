


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1>
          	<div class="card">
          	<div class="card shadow mb-4">
			  <p style="text-align: center;">
			  SMND merupakan suatu perangkat lunak dengan <code>platform web</code> yang terintegrasi dengan proses bisnis yang berjalan pada Fakultas Ilmu Komputer Universitas Brawijaya. Untuk memastikan perangkat lunak ini berjalan secara baik, gunakan browser yang kami rekomendasikan seperti <code>Google Chrome</code> dan <code>Mozilla Firefox</code>. Rasakan pengalaman anda mengoperasikan SMND.
			  </p>
			</div>  
      <div class="row">  
         <div class="col-xl-3 col-md-6 mb-4">
          <div style="background-color: DodgerBlue; color: white;" class="card shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div style="color: white" class="text-xs text-left font-weight-bold  text-uppercase mb-1">
                    <a style="color: white" href="<?php echo base_url('Agenda_C/manageAgenda') ?>">Total Agenda</a> 
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar fa-2x" style="text-align: center;">
                      <a style="color: white" href="<?php echo base_url('Agenda_C/manageAgenda') ?>"><?php 
                      echo $total
                      ?></a>
                    </i>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
          <div style="background-color: MediumSeaGreen; color: white;" class="card shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div style="color: white" class="text-xs text-left font-weight-bold  text-uppercase mb-1">
                    <a style="color: white" href="<?php echo base_url('Notula_C/manageNotula') ?>">Total Notula Terarsip</a>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar-check fa-2x" style="text-align: center;"> 
                      <a style="color: white" href="<?php echo base_url('Notula_C/manageNotula') ?>"><?php 
                      echo $totaln
                      ?></a>
                    </i>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
          <div style="background-color: Tomato; color: white;" class="card shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div style="color: white" class="text-xs text-left font-weight-bold  text-uppercase mb-1">
                    <a style="color: white" href="<?php echo base_url('Agenda_C/AgendaTanpaNotula') ?>">Total Agenda tanpa notula</a>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar-times fa-2x" style="text-align: center;"> 
                      <a style="color: white" href="<?php echo base_url('Agenda_C/AgendaTanpaNotula') ?>"><?php 
                      echo $total - $totaln
                      ?></a>
                    </i>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php foreach ($notulaterbaru as $key => $data) {?>
        <div class="col-xl-3 col-md-6 mb-4">
          <div style="background-color: Orange; color: white;" class="card shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div style="color: white" class="text-xs text-left font-weight-bold  text-uppercase mb-1">
                    Notula Terbaru
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-file fa-2x" style="text-align: left;"> 
                      
                    </i>
                    <a href="<?php echo base_url().'Report_C/Detail_notula/'.$data->id_notula;?>" style="color: black;  text-transform: capitalize;"><font size="5";><?php echo $data->judul ?></font></a>
                    <a style="color: black"> Pembahasan: <?php echo $data->pembahasan ?></a>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  
      </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

