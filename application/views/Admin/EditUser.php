
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <button style="border-radius: 16px; padding: 10px 20px; background-color: #fb861e; display: inline-block; color: white;" class="d-block mr-0 ml-auto" onclick="goBack()">Kembali</button>
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1>
    <div class="card  shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color: orange">Edit User</h6>
        </div>
        <div class="card-body">
            <div class="box-body table-responsive">
                <form action="<?=site_url('Admin_C/update/' .$id) ?>" method="post">
                    <?php
                    $inputs = [
                        ['name'=>'nama','value'=>$nama],
                        ['name'=>'email','type'=>'email','value'=>$email],
                    ];
                    ?>
                    <div class="row w-100">
                        <?php
                        foreach ($inputs as $input){
                            $id = uniqid();
                            ?>
                            <div class="col-6 my-3">
                                <label class="label text-uppercase" for="<?php echo $id ?>"><?php echo isset($input['label'])?$input['label']:$input['name']?></label>
                                <input
                                    value="<?php echo $input['value']?>"
                                    id="<?php echo $id?>"
                                    name="<?php echo $input['name'] ?>"
                                    type="<?php echo isset($input['type'] )? ($input['type'] ) : 'text'   ?>"
                                    class="form-control">
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                        $roles = [
                            ['value'=>1,'label'=>'admin'],
                            ['value'=>2,'label'=>'sekertaris'],
                            ['value'=>3,'label'=>'ketua'],
                            ['value'=>4,'label'=>'user'],
                        ];
                        ?>
                        <div class="col-12 my-3">
                            <select
                                value="<?php echo $role_id?>"
                                name="role_id"
                                class="form-control text-uppercase"
                            >
                                <?php
                                foreach ($roles as $role){
                                    ?>
                                    <option
                                        class="text-uppercase"
                                        value="<?php echo  $role['value'] ?>"
                                    >
                                        <?php echo  $role['label'] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button class="btn w-100" style="background-color: #fb861e; color: white;">
                        Simpan
                    </button>
                </form>
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

