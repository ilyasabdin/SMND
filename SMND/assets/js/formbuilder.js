let values = window.olds;
values && Object.keys(values).forEach(function (name) {
	let input = $(`[name="${name.trim()}"]`);
	if (input&& name!== 'materi'){
		input.val(values[name]);
	}
})