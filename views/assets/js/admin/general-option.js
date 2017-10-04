jQuery(document).ready(function($) {
	$("#city").select2({
		placeholder: "Tỉnh/Thành phố",
	});
	if($("#country").html().length > 0){
		$("#country").select2({
			placeholder: "Quận/Huyện",
		});
	}else{
		$("#country").select2({
			placeholder: "Quận/Huyện",
			disabled: true
		});
	}

	$('#city').on('select2:select', function (evt) {
		$.ajax({
			url: web_url + 'libs/ajax_functions.php',
			type: 'POST',
			dataType: 'json',
			data: {
				action: 'ajax_get_contries_city',
				city_name: evt.currentTarget.value
			},
			success: function(data){
				$('#country').html("");
				$("#country").select2({
					disabled: false,
					data: data
				});
			}
		});
	});
});