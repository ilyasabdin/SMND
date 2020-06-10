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


<!--  Code to handle taking the snapshot and displaying it locally-->

<script src="<?=base_url('assets/record/js/RecordRTC.js')?>"></script>
<script src="<?= base_url('assets/')?>record/js/adapter.js"></script>
<script src="<?= base_url('assets/')?>record/js/video.min.js"></script>
<script src="<?= base_url('assets/')?>record/js/videojs.record.js"></script>
<script type="text/javascript">
	$('#judul').on('change', getAgendaInfo)
	
	function getAgendaInfo()
	{
		
		var id = $('#judul').val()
		//console.log(id)
		$.ajax({
				url: '<?php echo site_url("Audiovideo_C/getAgenda?id=")?>'+id,
				type : "get",
			})
			.done(function(result){
				let agenda = JSON.parse(result)
				$.each(agenda,function(i,val){
					['pembahasan','tempat','tanggal'].map(function (id) {
						let input = $( '#'+id);
						input.val(val[id]);
						input.attr('disabled','disabled');
					})
				})
			})
			.fail(function (jqXHR,status,err) {
				alert("Terjadi Kesalahan pada agenda.");
			})
	}
</script>


<script>
	var player = videojs("myVideo", {
		controls: true,
		width: 720,
		height: 360,
		fluid: false,
		plugins: {
			record: {
				audio: true,
				video: true,
				maxLength: 10,
				debug: true
			}
		}
	}, function(){
		// print version information at startup
		var msg = 'Using video.js ' + videojs.VERSION +
			' with videojs-record ' + videojs.getPluginVersion('record') +
			' and recordrtc ' + RecordRTC.version;
		videojs.log(msg);
	});
	window.player = player;
	// error handling
	player.on('deviceError', function() {
		console.log('device error:', player.deviceErrorCode);
	});
	player.on('error', function(error) {
		console.log('error:', error);
	});
	// user clicked the record button and started recording
	player.on('startRecord', function() {
		console.log('started recording!');
	});
	// player.on('finishRecord', function() {
	//     console.log('finished recording: ', player.recordedData);
	//     var formData = new FormData();
	//     formData.append('audiovideo', player.recordedData.video);
	//     xhr('servers/upload-video.php', formData, function (fName) {
	//         console.log("Video succesfully uploaded ! " + fName);
	//         alert("video berhasil ditambahkan");
	//     });
	//     function xhr(url, data, callback) {
	//         var request = new XMLHttpRequest();
	//         request.onreadystatechange = function () {
	//             if (request.readyState == 4 && request.status == 200) {
	//                 callback(location.href + request.responseText);
	//             }
	//         };
	//         request.open('POST', url);
	//         request.send(data);
	//     }
	// });
</script>
<script src="<?= base_url('assets/')?>js/spesifik/notula-video.js"></script>

</body>

</html>
