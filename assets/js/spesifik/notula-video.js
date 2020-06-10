
function getVideodata () {


	return {
		video : new File ([window.video_player.recordedData.video],
			'video.webm',
			{
				type : 'video/webm'
			}
		)
	}
}
function getCommondata () {
	let obj = {};
	['judul','pembahasan','tempat','tanggal','pemimpin'].map(function (item) {
		obj[item] = $(document.getElementsByName(item)).val();
	});
	return obj;
}

$('#form-upload').on('submit', function (e) {
	e.preventDefault();
	let data = {};
	[getCommondata(), getVideodata()].forEach(function (item) {
		data = {...data, ...item}
	});
	let action = $(e.target).attr('action') + '/' + data.judul;
	let formdata = new FormData();
	Object.keys(data).forEach(function (name) {
		formdata.append(name, data[name]);
	})
	
	let request = $.ajax({
		url: action,
		type: "post",
		data : formdata,
		cache: false,
		contentType: false,
		processData: false,
		success : function(e){
		e = JSON.parse(e);
		alert(e.message);

		window.location.href = e.link;	
		}
	});
});