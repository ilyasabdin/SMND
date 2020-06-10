


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1>
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="box-body table-responsive">
                <?php
                if ( (int) $detail[0]->status){
                    ?>
                    <div class="d-flex justify-content-end">
                        <p class="badge badge-success">
                            Agenda telah di setujui
                        </p>
                    </div>
                    <?php
                }
                ?>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="font-weight-bolder text-uppercase">
                            <?=$detail[0]->status ? 'disetujui' : 'belum disetujui' ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Judul Rapat</th>
                        <td><?= $detail[0]->judul?></td>
                    </tr>
                    <tr>
                        <th>Agenda Pembahasan</th>
                        <td><?= $detail[0]->pembahasan?></td>
                    </tr>
                    <tr>
                        <th>Tempat</th>
                        <td><?= $detail[0]->tempat?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?= $detail[0]->tanggal?></td>
                    </tr>
                    <tr>
                        <th>Catatan</th>
                        <td><?= $detail[0]->catatan?></td>
                    </tr>
                    <tr>
                        <th>Pemimpin Rapat</th>
                        <td><?= $detail[0]->pemimpin?></td>
                    </tr>
                    <tr>
                        <th>Peserta Rapat</th>
                        <td>
                            <?php foreach ($detailas as $d):
                                echo $d->peserta;
                                echo "<br>";
                            endforeach ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Materi</th>
                        <td><?= $detail[0]->materi?></td>
                    </tr>

                </table>
                <?php
                if (! (int) $detail[0]->status&& $this->session->userdata['role_id'] == 1) {
                    ?>
                    <form method="post" action="<?=site_url('Agenda_C/accept/' . $id)?>">
                        <div class="row w-100">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="true">
                                        <label class="form-check-label" for="inlineCheckbox1">Centang apabila mengganti tempat rapat</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input readonly class="form-control" value="<?=$detail[0]->tempat?>" name="tempat" type="text" id="ganti-tempat">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Setujui</button>
                    </form>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    let input = $('#ganti-tempat');
    let check = $('#inlineCheckbox1');
    function trigger(){
    	if (input.attr('readonly')){
    		return input.removeAttr('readonly');
        }
    	return input.attr('readonly','readonly');
    }
    check.change(trigger);
</script>