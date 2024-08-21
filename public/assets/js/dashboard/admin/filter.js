$(document).on('change', '#graduation_', function (e) {
	_request($(this).data("url"), { id: $(this).val() }, 'json', 'post', $(this).attr('token'), function (data) {
		$('#qualification_').html("<option value=''>Select Qualification</option>");
		if (data.status) {
			$.each(data.data, function (key, value) {
				$('#qualification_').append($("<option value=" + value.CourseName + ">" + value.CourseName + "</option>"));
			});
			$('#qualification_').prop("disabled", false);
		} else {
			$('#qualification_').prop("disabled", true);
		}
	});
});
_request($('#graduation_').data("url"), { id: $('#graduation_').val() }, 'json', 'post', $('#graduation_').attr('token'), function (data) {
	$('#qualification_').html("<option value=''>Select Qualification</option>");
	if (data.status) {
		$.each(data.data, function (key, value) {
			$('#qualification_').append($("<option value=" + value.CourseName + ">" + value.CourseName + "</option>"));
		});
		$('#qualification_').prop("disabled", false);
		$('#qualification_').val($('#graduation_').data('select'));
	} else {
		$('#qualification_').prop("disabled", true);
	}
});
$(document).on('change','.perferred_state',function(e){
	_request($(this).data("url"),{id:$('.perferred_state option:selected').data('id')},'json','post',$(this).attr('token'),function(data){
		$('.perferred_city').html("<option value=''>Select City</option>");
		if(data.status){
			$.each(data.data, function(key, value) {   
			     $('.perferred_city').append($("<option value="+value.CityName+">"+value.CityName+"</option>"));
			});
			$('.perferred_city').prop("disabled", false);
		} else{
			$('.perferred_city').prop("disabled", true);
		}
	});
});
_request($('.perferred_state').data("url"),{id:$('.perferred_state option:selected').data('id')},'json','post',$('.perferred_state').attr('token'),function(data){
	$('.perferred_city').html("<option value=''>Select City</option>");
	if(data.status){
		$.each(data.data, function(key, value) {   
			 $('.perferred_city').append($("<option value="+value.CityName+">"+value.CityName+"</option>"));
		});
		$('.perferred_city').prop("disabled", false);
	} else{
		$('.perferred_city').prop("disabled", true);
	}
});

$(document).on('change','.current_state',function(e){
	_request($(this).data("url"),{id:$('.current_state option:selected').data('id')},'json','post',$(this).attr('token'),function(data){
		$('.current_city').html("<option value=''>Select City</option>");
		if(data.status){
			$.each(data.data, function(key, value) {   
			     $('.current_city').append($("<option value="+value.CityName+">"+value.CityName+"</option>"));
			});
			$('.current_city').prop("disabled", false);
		} else{
			$('.current_city').prop("disabled", true);
		}
	});
});
_request($('.current_state').data("url"),{id:$('.current_state option:selected').data('id')},'json','post',$('.current_state').attr('token'),function(data){
	$('.current_city').html("<option value=''>Select City</option>");
	if(data.status){
		$.each(data.data, function(key, value) {   
			 $('.current_city').append($("<option value="+value.CityName+">"+value.CityName+"</option>"));
		});
		$('.current_city').prop("disabled", false);
	} else{
		$('.current_city').prop("disabled", true);
	}
});


function _request(requesturl, data, type_s, method, token, cb) {
	$.ajax({
		url: requesturl,
		type: method,
		data: data,
		headers: { 'X-CSRF-TOKEN': token },
		dataType: type_s,
		success: function (data) {
			cb(data);
		}
	}).done().fail(function (data) {
		// alert("Internal Server error");
		cb(data);
	});
}