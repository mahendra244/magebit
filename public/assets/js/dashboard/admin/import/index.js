$(document).on('change', '#excel_input', function () {
    var file = this.files[0];
    var validExts = new Array(".csv",'.xlsx','.xls');
    var fileExt = file.name;
    fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
    var size = file.size;
    if (1978699 < size) {
        alert("Your file size is more than 2MB");
        $(this).val('');
        return false;
    }
    if (validExts.indexOf(fileExt) < 0) {
        alert("Invalid file format. Select only " + validExts.toString() + " file.");
        $(this).val('');
        return false;
    }
    var data = new FormData();
    data.append('imported_file', file);
    if (file) {
        $('.no_file').hide();
        $('.show_file').removeClass('hidden');
        $('.show_file').text(file.name);
        $.ajax({
            type: 'post',
            url: $(this).data('url'),
            data: data,
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#preloader').show();
            },
            complete: function () {
                $('#preloader').hide();
            },
            success: function (res) {
                    if(res.success == true){
                        $('.step_2').removeClass('hidden');
                    }
                    if(res.success == false){
                        $('.step_2').removeClass('hidden');
                        file ="";
                    }
            },
            // error: function (jqXHR, status, err) {
            //     alert("Local error callback.");
            // }
        })
    }
});
$(document).on('click', '#btn-import', function (e) { 
    e.preventDefault();
    var file = $('#excel_input').val();
    var template = $('#template').val();
    if(!file){
        alert("Please upload the  files.");
          $(this).val('');
            return false;
    }
    if(template == ""){
        alert("Please select the template type.");
        return false;
    }
    var url = 'post-employee-data';
  $('#importform').attr('action',url);
  $('#importform').submit();
});
$(document).on('click', '#btn-import-company', function (e) { 
    e.preventDefault();
    var file = $('#excel_input').val();
    var template = $('#template').val();
    if(!file){
        alert("Please upload the  files.");
          $(this).val('');
            return false;
    }
    if(template == ""){
        alert("Please select the template type.");
        return false;
    }
    var url = 'post-employee-data';
  $('#importform').attr('action',url);
  $('#importform').submit();
});
$(document).ready(function(){
   $(".reset-btn").click(function(){
        $('.no_file').show();
        $('.show_file').addClass('hidden');
        $('.show_file').text("");
       $("#importform").trigger("reset");
   });
});

setTimeout(function() {

    $('.successMessage').fadeOut('fast');
    
    }, 1200);