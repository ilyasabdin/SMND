let photoCollections = [];
let pesertaActive = [];
if ($.fn.multiselect){
	$('#peserta').multiselect({
		nonSelectedText: 'Pilih Peserta Hadir',
		enableFiltering: true,
		enableCaseInsensitiveFiltering:true,
		buttonWidth:'100%',
		onChange:function (e, checked) {
			let value = e.val();
			if (checked){
				pesertaActive = [...pesertaActive,value ];
			}else{
				pesertaActive = pesertaActive.filter(function (item) {
					return item !== value;
				});
			}
		}
	});
}
if (typeof Webcam !== 'undefined' ){
	Webcam.set({
		width: 480,
		height: 360,
		image_format: 'jpeg',
		jpeg_quality: 200
	});
	if ($('#camera-container').length){
		Webcam.attach( '#camera-container' );
	}
	function snap(){
		let id = 'Photo-' + (photoCollections.length + 1);
		let imgContainer = $('<div class="col-md-4 position-relative" />',{id})
		let img = $('<img class="img-fluid my-2" />')
		let button = $('<button title="hapus foto ini" style="right: 1.2rem;top: 1rem" class="rounded-pill position-absolute btn btn-sm btn-danger"> X </button>')
		Webcam.snap( function(data_uri) {
			img.attr('src', data_uri);
			function dataURLtoBlob(dataurl) {
				var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
					bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
				while(n--){
					u8arr[n] = bstr.charCodeAt(n);
				}
				photoCollections = [...photoCollections, {
					itemid :id,
					blob : new Blob([u8arr], {type:mime, name : id+'.jpg'})
				}]
			}
			dataURLtoBlob(data_uri);
		});
		imgContainer.append(img);
		imgContainer.append(button);
		button.click(function () {
			imgContainer.remove();
			photoCollections = photoCollections.filter(function (item) {
				return item.itemid !== id;
			})
			console.log(photoCollections);
		})
		$('#image-container').append(imgContainer)
	}
	let btnphoto = $('#btn-photo');
	btnphoto.click(snap);
}
const quill = new Quill('#quillContainer',{
	theme: 'snow',
	modules: {
		toolbar: [
			[{ header: [1, 2, false] }],
			['bold', 'italic', 'underline'],
			['image', 'code-block']
		]
	},
});
if (window.delta){
	// quill.setContents(window.delta);
	let quilinput =  $('input[name="catatan_notula"]');
	if (quilinput.length){
		try {
			quilinput.val(JSON.stringify(window.delta));
			$('form').submit(function (e) {
				let quilstring = $('.ql-editor')[0].innerHTML;
				quilinput.val(quilstring);			
			})
		} catch (e) {
			alert("eerrrrr")
		}

	}
}
function getCommonData(){
	let obj = {};
	['judul','pembahasan','tempat','tanggal','pemimpin'].map(function (item) {
		obj[item] = $(document.getElementsByName(item)).val();
	});
	return obj;
}
function getCatatanData(){
	let quilstring = $('.ql-editor')[0].innerHTML;
	return {catatan : quilstring};
}
function getPesertaData(){
	return {'peserta[]' : pesertaActive};
}
function getMateriData(){
	let el = document.getElementById('materi');
	return {
		'materi' : el.files[0],
	}
}
if ($('#image-notula-usai-rapat').length){
	let input = $('#image-notula-usai-rapat');
	input.on('change',function (e) {
		let files = e.target.files;
		let items = [];
		Array.from(files).forEach(function (file, index) {
			let id = 'Photo-' + (index + 1);
			items = [...items,{
				itemid :id,
				blob : file
			}];
		})
		photoCollections = items;
	})
}
$('#submit').on('submit', function (e) {
	e.preventDefault();
	let formdata = new FormData();
	let dataobject = {};
	let peserta = getPesertaData();
	console.log(peserta);
	if (peserta["peserta[]"] && Array.isArray(peserta["peserta[]"]) && peserta['peserta[]'].length ) {
		[getMateriData(),getCommonData(), getCatatanData(), getPesertaData()].forEach(function (item) {
			dataobject = {...dataobject, ...item}
		})
		Object.keys(dataobject).forEach(function (name) {
			formdata.append(name, dataobject[name]);
		});
		photoCollections.forEach(function (item) {
			formdata.append('image[]', item.blob,item.itemid+'.jpg');
		});
		let request = $.ajax({
			url: window.saveurl,
			type: "post",
			data : formdata,
			cache: false,
			contentType: false,
			processData: false,
		});
		request.done(function (e) {
			e = JSON.parse(e);
			alert(e.message ? e.message :  'Notula berhasil di simpan');
			if (! e.errors){
				window.location.href = e.redirect;
			}else{
				Object.keys(e.errors).forEach(function (item) {
					let target = $(`[data-target="${item}"]`);
					if (target.length){
						target.text(e.errors[item])
					}
				})
			}
		})
	}else{
		alert("Peserta yang hadir belum di masukan")
	}
});
