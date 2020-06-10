$('input[type="datetime"]').datetimepicker();
/*
Bagian table peserta
 */
let selects = ['pemimpin','peserta'];
let table = $('#civitas_table');
let tablecontainer = $('#table-container');
function hideshowcontainer () {
	let check = $('#civitas_table tr');
	if (check.length){
		tablecontainer.removeClass('d-none');
	}else{
		tablecontainer.addClass('d-none');
	}
}
function addRemoveRow(nama , isketua , checked ) {
	let id = nama.trim().split(' ').join('-');
	let RowTD = [];
	let check = $('#civitas_table tr');
	let exist = document.getElementById(id);
	let role = isketua ? 'ketua':'peserta'
	if (!check.length){
		RowTD = [...RowTD, {id ,['aria-role']:role}]
	}
	if (checked){
		if (exist){
			let _role = exist['aria-role'];
			if (_role!==role){
				$(exist.lastElementChild).text(role);
				Array.from($(exist).siblings()).forEach(function (item) {
					$(item.lastElementChild).text(role === 'ketua'?'peserta':'ketua');
				})
			}
		}else if (!exist && check.length){
			RowTD = [...RowTD, {id , innerText : nama.trim(), ['aria-role']:role}]
		}
		if (RowTD.length){
			RowTD.forEach(function () {
				let row = $('<tr />', {id});
				[nama.trim(), isketua ? 'ketua':'peserta'].forEach(function (item) {
					let td = $('<td />');
					td.text(item);
					row.append(td);
				});
				table.append(row);
			});
		}
	}else{
		document.getElementById(id).remove();
	}
}
function getSelect(name){
	console.log(window[name]);
	if (window[name]){
		if (Array.isArray(window[name])){
			return window[name].map(function (item) {
				return item.id;
			});
		}
		return window[name];
	}
	return  [];
}
let selectorOnChange = function(element, checked){
	let nama = element.text();
	let isketua = element.parents('.lstSelected')[0].name === 'pemimpin';
	addRemoveRow(nama, isketua, checked);
	hideshowcontainer();
}
selects.forEach(function (name) {
		let selector = $('.'+name);
		selector.multiselect({
			nonSelectedText: `Pilih ${name} Rapat`.toUpperCase(),
			enableFiltering: true,
			enableCaseInsensitiveFiltering:true,
			buttonWidth:'100%',
			onChange : selectorOnChange,
		});
		selector.multiselect('deselect',[])
	}
)
if (window.pesertas){
	$('.peserta').multiselect('select', window.pesertas.map(function (item) {
		return item.id;
	}).filter(function (item) {
		return item !== window.pemimpin
	}), selectorOnChange);
}
if (window.pemimpin){
	$('.pemimpin').multiselect('select', [window.pemimpin], selectorOnChange);
}