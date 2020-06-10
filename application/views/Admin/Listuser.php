
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1> -->
    <button style="border-radius: 16px; padding: 10px 20px; background-color: #fb861e; display: inline-block; color: white;" class="d-block mr-0 ml-auto" onclick="goBack()">Kembali</button>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color: orange">Daftar User</h6>
        </div>
        <div class="card-body">
            <div class="box-body table-responsive">
                <table id="table_id" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                    <thead class="text-center">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                    <tbody class="text-center">
                    <?php $no = 1;
                    foreach ($row->result() as $key => $data) {
                        ?>
                        <tr>

                            <td><?=$no++ ?></td>
                            <td><?=$data->nama?></td>
                            <td><?=$data->email?></td>
                            <td><?=$data->role?></td>
                            <td class="text-center" width="160px">
                                <a href="<?=site_url('Admin_C/edit/' .$data->id) ?>" class="badge badge-primary">Edit</i></a>
                                <a href="<?=site_url('Admin_C/delete_user/' .$data->id)?>"
                                   onclick="return confirm('Apakah Anda Yakin?')" class="badge badge-danger">Hapus</i></a>
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
<script>
      function goBack() {
        window.history.back();
      }
</script>
<!-- End of Main Content -->

