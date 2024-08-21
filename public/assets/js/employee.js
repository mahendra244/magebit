$('#btn-filter').click(function(e){  
	// var url = 'admin/employee_filter_company';
	// $('#employee_filter_company').attr('action',url);
	$('#employee_filter_company').submit();
});
$('#btn-search').click(function(e){  
	var url = '';
	$('#employee_filter').attr('action',url);
	$('#employee_filter').submit();
});
$('#company').change(function() {
	var id = $(this).val();
	$('#company_id').val(id);
});
$('#btn-update').click(function(e){ 
	var id = $('#company_id').val();
	// alert(id);
	if(!id){
		$('#msg_text').text('');
		$('#msg_text').text('Please select the company name.');
		$('#createmessage').removeClass('hidden');
		setTimeout(function() {$('#createmessage').addClass('hidden');}, 1200);
		return false;
	}
	updateSelected();
});
function updateSelected()
{
	var records = $('.records').is(':checked');
	if(!records){
		$('#msg_text').text('');
		$('#msg_text').text('Please select atleast one record');
		$('#createmessage').removeClass('hidden');
		setTimeout(function() {$('#createmessage').addClass('hidden');}, 1200);
		return false;
	}
	var lists = $('input[type=checkbox]:checked');;
	var url = '../update-status';
	var _list=[];
	$.each(lists,function(k,v){
		_list.push($(v).attr('value'));
	});
	_list = _list.toString();
	$('#company_lists').val($('#companys').val())
	// return false;
	$('.list').val(_list);
	$('#update-status').attr('action',url);
	$('#update-status').submit();
}
$('.selectall').change(function() {
	if($(this).is(':checked')) {
		$("input[type='checkbox']").prop({checked: true});
	} else {
		$("input[type='checkbox']").prop({checked: false});
	}
});
$("#company").chosen();
$('#company_chosen input').autocomplete({
	minLength: 3,
	source: function(request, response) {
		$.ajax({
			url: "../get-company/" + request.term,
			dataType: "json",
			beforeSend: function(){ 
				$('#company').empty();
				$('#company').html(""); 
			},
			success: function(data) {
				var search_text = $('#search_suggestion').val();
				   var html = "";
				   console.log(data.companylist);


				if (data.companylist.length) {
					for (var i = 0; i < data.companylist; i++) {
						if (data.companylist[i].pe_name1 == search_text) {
							html += '<option selected value="' + data.companylist[i].id + '">' + data.companylist[i].pe_name1 + '</option>';
						} else {
							html += '<option value="' + data.companylist[i].id + '">' + data.companylist[i].pe_name1 + '</option>';
						}
					}

				} else {
					var html = "";
					html += "<option value=''>No matching data</option>";
				}
				$('#company').append(html);
				$("#company").trigger("chosen:updated");
				// $("#company_chosen input").val(request.term);
			}
		});
	}
});