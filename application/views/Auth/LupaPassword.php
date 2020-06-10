
  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Lupa Password</h1>
              </div>
              <?= $this->session->flashdata('message'); ?>
              <form class="user" method="post" action="<?= base_url('Auth_C/lupaPassword')?>">
                
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Alamat Email" value="<?= set_value('email')?>">
                  <?= form_error('email' , '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <button type="submit" class="btn btn-user btn-block" style="background-color:#fb861e;  color: white;">
                  Reset Password
                </button>
                
              </form>
              <hr>
              <div class="text-center">
                <a style="color: #fb861e;" class="small" href="<?php echo base_url('Auth_C'); ?>">Kembali Ke Halaman Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

