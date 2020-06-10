<div class="container-fluid">
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1> -->
    <button style="border-radius: 16px; padding: 10px 20px; background-color: #fb861e; display: inline-block; color: white;" class="d-block mr-0 ml-auto" onclick="goBack()">Kembali</button>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color: orange">Dokumentasi Video</h6>
        </div>
        <div class="card-body">
            <form id="form-upload" method="post" action="<?=site_url('Dokumentasi_video_C/store')?>">
                <div class="form-group">
                    <label>Judul Rapat</label>
                    <select name="judul" id="judul" class="form-control input">
                        <option value="">Judul Rapat</option>
                        <?php
                        foreach ($agenda as $row) {
                            echo '<option value="'.$row->id.'">'.$row->judul.'</option>';
                        }
                        ?>
                    </select>
                    <span id="error_judul" class="text-danger"></span>
                    <small class="form-text text-muted">Agenda Yang Akan Diusulkan</small>
                </div>
                <div class="form-group">
                    <label>Agenda Pembahasan</label>
                    <input type="text" name="pembahasan" id="pembahasan"  class="form-control" />
                    <small class="form-text text-muted">Hal Yang Akan Dibahas</small>
                </div>
                <div class="form-group">
                    <label>Tempat</label>
                    <input type="text" name="tempat" id="tempat" class="form-control">
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal" class="form-control">
                </div>
                <video id="myVideo" class="video-js vjs-default-skin" style="margin-left: auto; margin-right: auto;"></video>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
    <script>
      function goBack() {
        window.history.back();
      }
    </script>