<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; SMND 2019</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Anda Yakin Akan Logout?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('Auth_C/logout')  ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/')?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/')?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/')?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/')?>js/sb-admin-2.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />

<script type="text/javascript">
	$(document).ready( function () {
		$('#table_id').DataTable();
	} );
</script>

<script>


</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>
<script language="JavaScript">
</script>
<!--  Code to handle taking the snapshot and displaying it locally-->
<script type="text/javascript">

	$('#judul').on('change', getAgendaInfo)

	function getAgendaInfo()
	{
		var id = $('#judul').val()
		//console.log(id)
		$.ajax({
				url: '<?php echo site_url("Capture_C/getAgendaById?id=")?>'+id,
				type : "get",
				// data : {'id':$id},
			})
			.done(function(result){
				let agenda = JSON.parse(result)
				// console.log(agenda)
                $('#btn-submit').removeAttr('disabled')
				$.each(agenda,function(i,val){

					$('#pembahasan').val(val.pembahasan)
					$('#tempat').val(val.tempat)
					$('#tanggal').val(val.tanggal)
					$('#pemimpin').val(val.pemimpin)
				})

				getListPeserta(id)

			})
			.fail(function (jqXHR,status,err) {
				alert("Terjadi Kesalahan pada agenda.");
			})
	}

	function getListPeserta(id_agenda)
	{
		$.ajax({
				url: '<?php echo site_url("Capture_C/getPesertaByAgenda?id=")?>'+id_agenda,
				type: "get",
			})
			.done(function(result){

				let peserta = JSON.parse(result);

				resetListPeserta()

				$.each(peserta, function(key, value){
					$('#peserta').append('<option value="'+value.id+'">'+value.peserta+'</option>')
				})

				window.peserta_list = $('#peserta').multiselect('rebuild');

			})
			.fail(function (jqXHR,status,err) {
				alert("Terjadi kesalahan pada peserta.");
			})
	}

	function resetListPeserta()
	{
		$('#peserta').children().remove()
	}

	var imageuri, reader

	function ambilphoto(){
		Webcam.snap( function(data_uri) {
			$('#previewImage').attr('src', data_uri);
			imageuri = data_uri;
			function dataURLtoBlob(dataurl) {
				var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
					bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
				while(n--){
					u8arr[n] = bstr.charCodeAt(n);
				}
				return new Blob([u8arr], {type:mime});
			}
			window.imageuri = dataURLtoBlob(data_uri);
		});
	}

	$('#materi').on('change', function(e){
		let file = e.target.files[0]
		reader = new FileReader()
		var filepath = e.target.value
		var filename = filepath.replace(/^.*[\\\/]/, '');
		reader.readAsDataURL(file)

	})

	//$('#submit').on('submit', function (event) {
	//  event.preventDefault();
	//  var judul = $('#judul').val();
	//  var catatan = $('#catatan').val();
	//  var materi
	//  try{
	//    materi = reader.result
	//  } catch(e){
	//    materi = null
	//  }
	//  var image = imageuri
	//  $.ajax({
	//    url: '<?php //echo site_url("Capture_C/save");?>//',
	//    type: 'POST',
	//    dataType: 'json',
	//    data: {judul:judul, catatan:catatan, materi:materi, image:image},
	//  })
	//  .always(function(){
	//    alert('insert data sukses');
	//    // $('#submit')[0].reset();
	//    location.href = 'Notula_C/manageNotula';
	//    console.log("success");
	//  })
	//});
	window.saveurl = '<?=isset($custom)?$custom : site_url("Capture_C/save")?>';
</script>
<script src="<?=base_url('assets/js/quill.min.js')?>"></script>
<script src="<?=base_url('assets/js/spesifik/notula-editor.js')?>"></script>
</body>
</html>