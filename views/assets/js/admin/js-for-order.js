jQuery(document).ready(function($){
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

	$('#add-printcurcuit').click(function(){
		var cur_num = $('.order-item').length;
		$('.order-item').each(function(){
			if($(this).data('sort') > cur_num)
				cur_num = $(this).data('sort');
		});
		$.ajax({
			url: web_url + 'libs/ajax_functions.php',
			type: 'POST',
			data: {
				action: 'ajax_add_printcurt_to_order',
				cur_num: cur_num
			},
			success: function(data){
				$('#list-printcurcuit').append(data);
				cur_num++;
				$('[name="num-printcurcuit"]').val(cur_num);
			}
		});
	});
});

var change_price = function(e) {
	var list_chose = [];

	var print_id = $(e).attr('id').match(/\d+/)[0];

	$('input[type="radio"].property-value-'+print_id+':checked').each(function(){
		list_chose.push($(this).val());
	});

	var num = $('#num-printcurcuit-'+print_id).val();

	$.ajax({
		url: web_url + 'libs/ajax_functions.php',
		type: 'post',
		dataType: 'json',
		data: {
			action : 'ajax_caculator_price_from_chose',
			list_chose: list_chose,
			'num-printcurcuit' : num
		},
		success: function(data){
			$('#price-num-'+ print_id).html(data['html']);
			$('[name="printcurcuit_'+print_id+'[price-num]"]').val(data['num']);
			total_cost();
		}
	});
};

var total_cost = function(){
	var total = 0;
	$('.price-num').each(function(){
		total += parseInt($(this).val());
	});
	var string = total.toString().split("").reverse().join("");
	var result = '';
	console.log(string);
	for(var i = 0; i < string.length; i++){
		result += string[i];
		if((i + 1)%3 == 0 && i != string.length - 1){
			result += '.';
		}
	}

	result = result.split("").reverse().join("") + "<sup>đ</sup>";

	$('#total_cost').html(result);
}

var delete_printcurcuit = function(e){
	var target = e.parentNode.parentNode;
	target.remove();
}