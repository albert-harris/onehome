$(document).ready(init);

function init() {
	setCheckboxState();
	initCheckboxAction();
}

function setCheckboxState() {
	var ar = jQuery.parseJSON($('#course').val());
	if (!ar) ar=[];
	$('.rowCheckbox').each(function() {
		if (ar.indexOf(this.value)>-1)
			this.checked = true;
	});
}

function initCheckboxAction() {
	$('#course-grid_c0_all').change(function() {
		$('#course').val('');
		$('.rowCheckbox').change();
	});
	
	$('.rowCheckbox').change(function(){
		var ar = jQuery.parseJSON($('#course').val());
		if (!ar) ar=[];
		
		if ($(this).is(':checked')) {
			// add course to list
			ar.push(this.value);
		} else {
			// remove course from list
			var index = ar.indexOf(this.value);
			if (index > -1) {
				ar.splice(index, 1);
			}
		}
		$('#course').val(ar.length>0 ? JSON.stringify(ar) : '');
	});
}

