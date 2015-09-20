$(document).ready(function() {
	$("select").select2({dropdownCssClass: 'dropdown-inverse'});
	$("#regionSelect").change(function(){
		var regId = $(this).val();
		var ajaxURL = $("#ajaxURL").val();

		$.ajax({
			url: ajaxURL,
			type: 'POST',
			data: { 
				salt: "tyRd23Cv321ll",
				reg_id: regId
			},
			dataType: 'html',
			success: function(html){

				$("#cityWrapper").html(html);
				$("#citySelect").select2({dropdownCssClass: 'dropdown-inverse'});
			}
		});

	});
});