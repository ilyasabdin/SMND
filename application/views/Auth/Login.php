

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-8">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
            <div class="col-lg-6 d-lg-block"><img src="assets/img/meeting1.jpg" style="width: 400; height: 500px;"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-left">
                    <h1 class="h4 text-gray-900 mb-4">SISTEM MANAJEMEN NOTULENSI DOKUMENTASI RAPAT FILKOM UB</h1>
                  </div>
                  <?= $this->session->flashdata('message'); ?>
                  <form class="user" method="post" action="<?= base_url('Auth_C');?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email')?>">
                      <?= form_error('email' , '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                      <?= form_error('password' , '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <button type="submit" class="btn btn-user btn-block" style="background-color: #fb861e; color: white;">LOGIN</button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a style="color: #fb861e;" class="small" href="<?php echo base_url('Auth_C/lupaPassword'); ?>">Lupa Password?</a>
                  </div>
                  <div class="text-center">
                    <a style="color: #fb861e;" class="small" href="<?php echo base_url('Auth_C/Register'); ?>">Buat Akun Baru</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
