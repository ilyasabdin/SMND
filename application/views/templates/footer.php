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
<link href="<?= base_url('assets/')?>css/modal-video.min.css" rel="stylesheet">
<link href="<?= base_url('assets/')?>js/jquery-modal-video.min.js" rel="stylesheet">
<script src="<?=base_url('assets/js/formbuilder.js')?>"></script>
<script type="text/javascript">
	if ($.fn.modalVideo) {
			$(".videopopup").modalVideo();
			
		}
</script>




<script type="text/javascript">
	$(document).ready( function () {
		$('#table_id').DataTable();
	} );
</script>
<!-- <script type="text/javascript">

       $('#pemimpin').multiselect({
          nonSelectedText: 'Pilih Pemimpin Rapat',
          enableFiltering: true,
          enableCaseInsensitiveFiltering:true,
          buttonWidth:'100%',

        });
</script> -->
<script type="text/javascript">

	$('#peserta').multiselect({
		nonSelectedText: 'Pilih Peserta Hadir',
		enableFiltering: true,
		enableCaseInsensitiveFiltering:true,
		buttonWidth:'100%',

	});

	$('#judul').on('change', getAgendaInfo)

	function getAgendaInfo()
	{
		var id = $('#judul').val()

		$.ajax({
				url: '<?php echo site_url("Capture_C/getAgendaById?id=")?>'+id,
				type : "get",
				// data : {'id':$id},
			})
			.done(function(result){
				let agenda = JSON.parse(result)

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

				$('#peserta').multiselect('rebuild');

			})
			.fail(function (jqXHR,status,err) {
				alert("Terjadi kesalahan pada peserta.");
			})
	}

	function resetListPeserta()
	{
		$('#peserta').children().remove()
	}
</script>

</body>

</html>
