$('.search').change(function () {
    $('#search').submit();
});
var flag = true;
$('.selectall').click(function (e) {
    $('.select_count').html('');
    var lists = $('input[class=records]');
    if (flag) {
        $.each(lists, function (k, v) {
            $(v).prop('checked', 'checked');
        });
        flag = false;
    } else {
        $.each(lists, function (k, v) {
            $(v).removeAttr('checked');

        });
        flag = true;
    }

});
$('#update_status').on('show.bs.modal', function (e) {
    $('#partner').removeClass('active');
    var btn = $(e.relatedTarget);
    var src = btn.data('from');

    var lists = $('input[class=records]:checked');

    if (lists.length > 0) {
        $('.err_msg').html("");
        var _list = [];
        var _list_email = '';
        $.each(lists, function (k, v) {
            _list.push($(v).attr('data-id'));
            var email = $(v).attr('data-email');
            if (email != undefined) {
                _list_email += "<option selected='selected' value=" + $(v).attr('data-id') + ">" + email + "</option>";
            }
        });
        _list = _list.toString();
        $('#list').val(_list);
        $('#list_email').html(_list_email);
        $('#list_email').chosen().trigger("chosen:updated");
    } else {
        // $('.err_msg').html("Select the records to download the report.");
        // return false;
        var notifyt = { Message: '<div class="text-center">Select the records to download the report.</div>', type: 'success' };
        shownot(notifyt);
        return false;
    }
});
function Allocation() {
    $('span[id$=\'_e\']').text('');
    var data = $('.allocation_form').serialize();
    var url = $('.allocation_form').attr('action');
    $.ajax({
        type: 'post',
        data: data,
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            // $('.btn-allocate').button('loading');
        },
        complete: function () {
            // $('.btn-allocate').button('reset');
        },
        success: function (res) {
            if (res.success) {
                //window.location.reload();
                $.each(res.list, function (k, v) {
                    console.log('.tr_bg' + v);
                    $('.tr_bg' + v).addClass(res.status_class);
                });
                $('#update_status').modal('hide');
                var notifyt = { Message: '<div class="text-center">Successfully allocated to partner.</div>', type: 'success' };
                shownot(notifyt);
                return false;
            }
        },
        statusCode: {
            422: function (res) {
                var err = res.responseJSON;
                if (err) {
                    $.each(err.errors, function (k, v) {
                        $('.' + k + "_e").text(v[0]);
                    })
                }
            }
        }

    });
    return false;
}
$('.download').click(function (e) {
    var lists = $('input[type=checkbox]:checked');
    var btn = $(e.relatedTarget);

    if (lists.length > 0) {
        DownloadExcel(lists);
    }
    else {
        var notifyt = { Message: '<div class="text-center">Select the records to download the report.</div>', type: 'success' };
        shownot(notifyt);
        return false;
    }
});

function DownloadExcel(lists) {
    var _list = [];
    $.each(lists, function (k, v) {
        _list.push($(v).attr('data-id'));
    });
    _list = _list.toString();
    $('.list').val(_list);
    $('#downloadexcel_form').submit();
}
//  excel donwload preloader

$(document).on("click", "#btn-report", function (e) {
    var value = $('#report_download').val();

    if(value==""){
        var notifyt = { Message: '<div class="text-center">Please select the download option.</div>', type: 'success' };
            shownot(notifyt);
            return false;
    }
    if(value == 'Download selected'){
        var lists = $('input[type=checkbox]:checked');
        var btn = $(e.relatedTarget);

        if (lists.length > 0) {
            DownloadExcel(lists);
        }else {
            var notifyt = { Message: '<div class="text-center">Select the records to download the report.</div>', type: 'success' };
            shownot(notifyt);
            return false;
        }
    }
    if(value == 'Download all'){
    // $('#downloadexcel_all').submit(); 
        var  data= $('.filter_seacrh').serialize();
        $.ajax({
            type: 'POST',
            url: '../admin/aspirant/all-report',
            data: data,
            beforeSend: function () {
                $('.se-pre-con').css("display", "block");
            },
            complete: function () {
                $('.se-pre-con').css("display", "none");
            },
            success: function (res) {
                // const url = data.file_path;
                const url = res.from;
                // console.log(url);
                const link = document.createElement("a");
                link.href = url;
                link.setAttribute("download",res.file); 
                document.body.appendChild(link);
                link.click();
                link.remove();
            }
        }); 
    }
});


$(document).on("submit", "#downloadexcel_form", function (e) {
    $.removeCookie('fileDownload', { path: '/' });
    $.fileDownload($(this).prop('action'), {
        preparingMessageHtml: '<img src="../assets/img/loading.gif" style="width:80px;margin-left: 90px;"/> <br><span style="font-size:13px;">Wait while we download your report.</span>',
        failMessageHtml: "There was a problem generating your report, please try again.",
        httpMethod: "POST",
        data: $(this).serialize()
    });
    e.preventDefault(); //otherwise a normal form submit would occur
});

$(document).on("submit", "#downloadexcel_all", function (e) {
    $.removeCookie('fileDownload', { path: '/' });
    var url = $('#downloadexcel_all').prop('action');
    $.fileDownload(url, {
        preparingMessageHtml: '<img src="../assets/img/loading.gif" style="width:80px;margin-left: 90px;"/> <br><span style="font-size:13px;">Wait while we download your report.</span>',
        failMessageHtml: "There was a problem generating your report, please try again.",
        httpMethod: "POST",
        data: $('#downloadexcel_all').serialize()
    });
    e.preventDefault(); //otherwise a normal form submit would occur
});
$(document).on("click", ".downloadall", function () {
    $.removeCookie('fileDownload', { path: '/' });

    $.fileDownload($(this).prop('href'), {
        preparingMessageHtml: '<img src="../assets/img/loading.gif" style="width:80px;margin-left: 90px;"/> <br><span style="font-size:12px;">Wait while we download your report.</span>',
        failMessageHtml: "There was a problem generating your report, please try again."
    });
    return false; //this is critical to stop the click event which will trigger a normal file download!
});
//  excel donwload preloader end
//   View more 
$('#more_details').on('show.bs.modal', e => {
    var btn = $(e.relatedTarget);
    $('.view_title').html(btn.data('heading'));
    var url = btn.data('url');
    $.ajax({
        type: 'get',
        url: url,
        success: res => {
            $('#_view_model').html(res);
        }
    });
});
 // View more END
 $('#mail-modal').on('show.bs.modal', e => {
    var lists = $('input[type=checkbox]:checked');
    var btn = $(e.relatedTarget);

    if (lists.length > 0) {
        var _list = [];
        $.each(lists, function (k, v) {
            _list.push($(v).attr('data-id'));
        });
        _list = _list.toString();
        $('.send-mail .send_list').val(_list);
    }
    else {
        var notifyt = { Message: '<div class="text-center">Select the records to send email.</div>', type: 'success' };
        shownot(notifyt);
        return false;
    }
});
$('.SendEmail').click(function () {
    $('p[class$=\'_e\']').text('');
    tinymce.triggerSave();
    var url = $(this).attr('data-base');
    var input = $('.send-mail input[type=hidden],.send-mail input[type=text]');
    var form = new FormData();
    input.each(function (k, v) {
        form.append($(v).attr('name'), $(v).val());

    });
    if ($('#message').html() == '<p><br data-mce-bogus="1"></p>') {
        $('#message').html('');
    }

    form.append('message', $('#message').html());
    $.ajax({
        type: 'post',
        url: url,
        data: form,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            $('.SendEmail').button('loading');
        },
        complete: function () {
            $('.SendEmail').button('reset');
        },
        success: function (res) {
            if (res.status = 'success') {
                $('#mail-modal').modal('hide');
                var notifyt = { Message: '<div class="text-center">Email Sent Successfully</div>', type: 'success' };
                shownot(notifyt);
                window.location.reload();
                return false;
            }
        },
        statusCode: {
            422: function (request, error) {
                $.each(request.responseJSON.errors, function (k, v) {
                    $('p.' + k + '_e').text(v[0]);
                });
            }
        }

    });
});




//partner mail



$('.SendEmailPartner').click(function () {
    $('p[class$=\'_e\']').text('');
    tinymce.triggerSave();
    var url = $(this).attr('data-base');
    console.log(url);
    var input = $('.send-mail-partner input[type=hidden],.send-mail-partner input[type=text]');
    var form = new FormData();
    input.each(function (k, v) {
        form.append($(v).attr('name'), $(v).val());

    });
    if ($('#message').html() == '<p><br data-mce-bogus="1"></p>') {
        $('#message').html('');
    }

    form.append('message', $('#message').html());
    $.ajax({
        type: 'post',
        url: url,
        data: form,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            $('.SendEmailPartner').button('loading');
        },
        complete: function () {
            $('.SendEmailPartner').button('reset');
        },
        success: function (res) {
            if (res.status = 'success') {
                $('#partner_mail-modal').modal('hide');
                var notifyt = { Message: '<div class="text-center">Email Sent Successfully</div>', type: 'success' };
                shownot(notifyt);
                window.location.reload();
                return false;
            }
        },
        statusCode: {
            422: function (request, error) {
                $.each(request.responseJSON.errors, function (k, v) {
                    $('p.' + k + '_e').text(v[0]);
                });
            }
        }

    });
});







