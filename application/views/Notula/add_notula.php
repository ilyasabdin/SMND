<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800">
        <?= $title;  ?>
    </h1> -->
    <button style="border-radius: 16px; padding: 10px 20px; background-color: #fb861e; display: inline-block; color: white;" class="d-block mr-0 ml-auto" onclick="goBack()">Kembali</button>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color: orange">Buat Notula</h6>
        </div>
        <div class="card-body">
            <form method="post" id="submit">
                <div class="form-group">
                    <label>Judul Rapat</label>
                    <select name="judul" id="judul" class="form-control input">
                        <option value="">Judul Rapat</option>
                        <?php
                        foreach ($agenda as $row) {
                            echo '
            <option value="'.$row->id.'">'.$row->judul.'</option>';
                        }
                        ?>
                    </select>
                    <span id="error_judul" class="text-danger"></span>
                    <small class="form-text text-muted">Agenda Yang Akan Diusulkan</small>
                </div>
                <div class="form-group">
                    <label>Agenda Pembahasan</label>
                    <input readonly type="text" name="pembahasan" id="pembahasan"  class="form-control" />
                    <span id="error_agenda" class="text-danger"></span>
                    <small class="form-text text-muted">Hal Yang Akan Dibahas</small>
                </div>
                <div class="form-group">
                    <label>Tempat</label>
                    <input readonly type="text" name="tempat" id="tempat" class="form-control">
                </div>
                <label>Tanggal</label>
                <input readonly type="text" name="tanggal" id="tanggal" class="form-control"/>
                <span id="error_tanggal" class="text-danger"></span>
                <div class="form-group">
                    <label>Pimpinan Rapat</label>
                    <input readonly type="text" name="pemimpin" id="pemimpin" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Peserta yang hadir</label>
                    <p data-target="peserta" class="invalid-feedback d-block">
                    </p>
                    <select name="peserta[]" id="peserta" multiple="multiple" class="lstSelected" >
                    </select>
                </div>
                <div class="">
                    <label>Catatan</label>
                    <p data-target="catatan" class="invalid-feedback d-block">
                    </p>
                    <div id="quillContainer" class="">
                        <h4>
                           <strong>Agenda Pembahasan : </strong>
                        </h4>
                        <ol>
                            <li>

                            </li>
                            <li>

                            </li>
                            <li>

                            </li>
                            <li>

                            </li>
                            <li>

                            </li>
                        </ol>
                        <h4>
                           <strong>Pembahasan : </strong>
                        </h4>
                        <ol>
                            <li>

                            </li>
                            <li>

                            </li>
                            <li>

                            </li>
                            <li>

                            </li>
                            <li>

                            </li>
                        </ol>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tambahkan Materi PDF*</label>
                    <input type="file" name="materi" id="materi" accept="application/pdf" class="form-control"/>
                </div>
                <div class="card">
                    <h3 class="card-header">
                     Dokumentasi
                    </h3>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <div class="" id="camera-container">

                                </div>
                            </div>
                        </div>
                        <div id="image-container" class="row"></div>
                    </div>
                </div>
                <div class="form-group">
                </div>
                <button type='button' class="btn btn-primary" id="btn-photo">Ambil Photo!</button>
                <button id="btn-submit" disabled="disabled" type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>
    <script>
      function goBack() {
        window.history.back();
      }
    </script>
