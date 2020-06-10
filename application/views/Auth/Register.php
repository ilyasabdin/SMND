
  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru</h1>
              </div>
              <form class="user" method="post" action="<?= base_url('Auth_C/Register')?>">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="nama" placeholder="Nama Lengkap" name="nama" value="<?= set_value('nama')?>">
                   <?= form_error('nama' , '<small class="text-danger pl-3">', '</small>') ?> 
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Alamat Email" value="<?= set_value('email')?>">
                  <?= form_error('email' , '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                    <?= form_error('password1' , '<small class="text-danger pl-3">', '</small>') ?>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password">
                  </div>
                </div>
                <button style="background-color: #fb861e; color: white;" type="submit" class="btn btn-user btn-block">
                  Register Akun
                </button>
                <hr>
              </form>
              <hr>
              <div class="text-center">
                <a style="color: #fb861e;" class="small" href="<?php echo base_url('Auth_C/lupaPassword'); ?>">Lupa Password?</a>
              </div>
              <div class="text-center">
                <a style="color: #fb861e;" class="small" href="<?php echo base_url('Auth_C'); ?>">Sudah Memiliki Akun? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

