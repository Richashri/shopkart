'use strict';

$(document).ready(function(){
    
    $('#current_password').keyup(function(){
        var curSelf = $(this);
        var curPwd = $(curSelf).val();
        var _token = $('input[name=_token]').val()
        
        if(curPwd.length >= 5){
            $.ajax({
                type: 'post',
                url: '/admin/check-current-pwd',
                data: {curPwd, _token},
                success: function(response){
                    if(response == 'false'){
                        $('#chk_pwd_msg').html('<div style="color: red">Current Password is Incorrect!</div>');
                    }else{
                        $('#chk_pwd_msg').html('<div style="color: green">Current Password is Correct...</div>');
                    }
                },
                error: function(error){
                    console.error(error)
                }
            })
        }
        
    })

    //section add ajax
    
    var errHandler = document.getElementById('handle_errors');

    $('#section_add_form').submit(function(e){        
        e.preventDefault();
        var curForm = $(this);
        var data = curForm.serialize();
       
        $.ajax({
            type: 'post',
            url: '/admin/section-add',
            data: data,
            success: function(resp){
                var count = parseInt(resp.count);
                var lastId = parseInt(resp.last_insert_id);
                var status = 'Active';
                if(resp.status != '1'){
                    status = 'Inactive';
                }
                var clas = 'odd';
                if(count%2 == 0){
                    clas = 'even';
                }
                var deleteUrl = APPURL+'admin/section-delete/'+lastId;
                var updateUrl = APPURL+'admin/section-update/'+lastId;
                var displayRow = `<tr role="row" class="${clas}">`;
                displayRow += `<td tabindex="0" class="sorting_1">${count}</td><td>${resp.name}</td><td>${status}<td> <a href="${deleteUrl}" class="btn btn-danger text-bold"><i class="fa fa-trash"></i>Delete</a> | <a href="javascript:void(0)" data-url="${updateUrl}" data-id="${lastId}" data-name="${resp.name}" data-description="${resp.description}" data-status="${resp.status}" data-loop_id="${count}" class="btn btn-warning text-bold" data-toggle="modal" data-target="#edit-modal-default"> Edit  <i class="fa fa-wrench" aria-hidden="true"></i></a></td></tr>`;
                $('#add_tr_ajax').append(displayRow);
                $('#modal-default').modal('hide');
                document.getElementById('name').value = '';
                document.getElementById('description').value = '';
                toastr.success(resp.success_message)                
            },
            error: function(error){
                var err = error.responseJSON.errors;
                var errHtml = '<div class="alert alert-danger">';
                for (var key in err) {
                    if (err.hasOwnProperty(key)) {
                       errHtml += `<div>${err[key]}</div>`;
                    }
                }
                errHtml += '<div>';

                errHandler.innerHTML = errHtml;
                
            }
        })
    })

    //section add ajax ends

    //section edit ajax

    $('#edit-modal-default').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        
        var eName = button.data('name');
        var eDescription = button.data('description');
        var eStatus = button.data('status');
        var eId = button.data('id');
        var loopId = button.data('loop_id');
        
        var modal = $(this)
        modal.find('#eid').val(eId)
        modal.find('#loop_id').val(loopId)
        modal.find('#ename').val(eName)
        modal.find('#edescription').text(eDescription)

        if(eStatus == '1'){
            modal.find('#option1').attr('checked', true);
            modal.find('#option2').attr('checked', true);
            modal.find('#estatus_label2').removeClass('active')
            modal.find('#estatus_label1').addClass('active')
        }else{
            modal.find('#estatus_label1').removeClass('active')
            modal.find('#estatus_label2').addClass('active')
            modal.find('#option1').attr('checked', false);
            modal.find('#option2').attr('checked', true);
        }
        
      })

      var errHandler = document.getElementById('edit_handle_errors');

    $('#section_edit_form').submit(function(e){        
        e.preventDefault();
        var curForm = $(this);
        var rowId = $('#loop_id').val();
        var data = curForm.serialize();
       
        $.ajax({
            type: 'post',
            url: '/admin/section-update',
            data: data,
            success: function(resp){
                var count = parseInt(resp.count);
                var lastId = parseInt(resp.last_insert_id);
                
                var status = 'Active';
                if(resp.status != '1'){
                    status = 'Inactive';
                }
                var clas = 'odd';
                if(count%2 == 0){
                    clas = 'even';
                }
                var deleteUrl = APPURL+'admin/section-delete/'+lastId;
                var updateUrl = APPURL+'admin/section-update/'+lastId;

                var displayRow = `<td tabindex="0" class="sorting_1">${count}</td><td>${resp.name}</td><td>${status}<td> <a href="${deleteUrl}" class="btn btn-danger text-bold"><i class="fa fa-trash"></i>Delete</a> | <a href="javascript:void(0)" data-url="${updateUrl}" data-id="${lastId}" data-name="${resp.name}" data-description="${resp.description}" data-status="${resp.status}" data-loop_id="${rowId}" class="btn btn-warning text-bold" data-toggle="modal" data-target="#edit-modal-default"> Edit  <i class="fa fa-wrench" aria-hidden="true"></i></a></td>`;
                
                document.getElementById('row_'+rowId).innerHTML = displayRow;
                $('#edit-modal-default').modal('hide');
                
                toastr.success(resp.success_message)                
            },
            error: function(error){
                var err = error.responseJSON.errors;
                var errHtml = '<div class="alert alert-danger">';
                for (var key in err) {
                    if (err.hasOwnProperty(key)) {
                        console.log(key + " -> " + err[key]);
                        errHtml += `<div>${err[key]}</div>`;
                    }
                }
                errHtml += '<div>';

                errHandler.innerHTML = errHtml;
                
            }
        })
    })

    //section edit ajax ends

    //Brand add ajax
    
    var errHandler = document.getElementById('handle_errors');

    $('#brand_add_form').submit(function(e){        
        e.preventDefault();
        var curForm = $(this);
        var data = curForm.serialize();
       
        $.ajax({
            type: 'post',
            url: '/admin/brand-add',
            data: data,
            success: function(resp){
                var count = parseInt(resp.count);
                var lastId = parseInt(resp.last_insert_id);
                var status = 'Active';
                if(resp.status != '1'){
                    status = 'Inactive';
                }
                var clas = 'odd';
                if(count%2 == 0){
                    clas = 'even';
                }
                var deleteUrl = APPURL+'admin/brand-delete/'+lastId;
                var updateUrl = APPURL+'admin/brand-update/'+lastId;
                var displayRow = `<tr id="row_${count}" role="row" class="${clas}">`;
                displayRow += `<td tabindex="0" class="sorting_1">${count}</td><td>${resp.name}</td><td>${resp.slug}</td><td>${status}<td> <a href="${deleteUrl}" class="btn btn-danger text-bold"><i class="fa fa-trash"></i>Delete</a> | <a href="javascript:void(0)" data-url="${updateUrl}" data-id="${lastId}" data-name="${resp.name}" data-description="${resp.description}" data-status="${resp.status}" data-slug="${resp.slug}" data-loop_id="${count}" class="btn btn-warning text-bold" data-toggle="modal" data-target="#edit-modal-default"> Edit  <i class="fa fa-wrench" aria-hidden="true"></i></a></td></tr>`;
                $('#add_tr_ajax').append(displayRow);
                $('#modal-default').modal('hide');
                document.getElementById('name').value = '';
                document.getElementById('description').value = '';
                document.getElementById('slug').value = '';
                toastr.success(resp.success_message)                
            },
            error: function(error){
                var err = error.responseJSON.errors;
                var errHtml = '<div class="alert alert-danger">';
                for (var key in err) {
                    if (err.hasOwnProperty(key)) {
                        console.log(key + " -> " + err[key]);
                        errHtml += `<div>${err[key]}</div>`;
                    }
                }
                errHtml += '<div>';

                errHandler.innerHTML = errHtml;
                
            }
        })
    })

    //section add ajax ends

    //section edit ajax

    $('#edit-modal-default').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        
        var eName = button.data('name');
        var eDescription = button.data('description');
        var eStatus = button.data('status');
        var eSlug = button.data('slug');
        var eId = button.data('id');
        var loopId = button.data('loop_id');
        
        var modal = $(this)
        modal.find('#eid').val(eId)
        modal.find('#loop_id').val(loopId)
        modal.find('#ename').val(eName)
        modal.find('#edescription').text(eDescription)
        modal.find('#eslug').val(eSlug)

        if(eStatus == '1'){
            modal.find('#option1').attr('checked', true);
            modal.find('#option2').attr('checked', true);
            modal.find('#estatus_label2').removeClass('active')
            modal.find('#estatus_label1').addClass('active')
        }else{
            modal.find('#estatus_label1').removeClass('active')
            modal.find('#estatus_label2').addClass('active')
            modal.find('#option1').attr('checked', false);
            modal.find('#option2').attr('checked', true);
        }
        
      })

      var errHandler = document.getElementById('edit_handle_errors');

    $('#brand_edit_form').submit(function(e){        
        e.preventDefault();
        var curForm = $(this);
        var rowId = $('#loop_id').val();
        var data = curForm.serialize();
       
        $.ajax({
            type: 'post',
            url: '/admin/brand-update',
            data: data,
            success: function(resp){
                var count = parseInt(resp.count);
                var lastId = parseInt(resp.last_insert_id);
                
                var status = 'Active';
                if(resp.status != '1'){
                    status = 'Inactive';
                }
                var clas = 'odd';
                if(count%2 == 0){
                    clas = 'even';
                }
                var deleteUrl = APPURL+'admin/brand-delete/'+lastId;
                var updateUrl = APPURL+'admin/brand-update/'+lastId;

                var displayRow = `<td tabindex="0" class="sorting_1">${count}</td><td>${resp.name}</td><td>${resp.slug}</td><td>${status}<td> <a href="${deleteUrl}" class="btn btn-danger text-bold"><i class="fa fa-trash"></i>Delete</a> | <a href="javascript:void(0)" data-url="${updateUrl}" data-id="${lastId}" data-name="${resp.name}" data-description="${resp.description}" data-status="${resp.status}" data-slug="${resp.slug}" data-loop_id="${rowId}" class="btn btn-warning text-bold" data-toggle="modal" data-target="#edit-modal-default"> Edit  <i class="fa fa-wrench" aria-hidden="true"></i></a></td>`;
                
                document.getElementById('row_'+rowId).innerHTML = displayRow;
                $('#edit-modal-default').modal('hide');
                
                toastr.success(resp.success_message)                
            },
            error: function(error){
                var err = error.responseJSON.errors;
                var errHtml = '<div class="alert alert-danger">';
                for (var key in err) {
                    if (err.hasOwnProperty(key)) {                        
                        errHtml += `<div>${err[key]}</div>`;
                    }
                }
                errHtml += '<div>';

                errHandler.innerHTML = errHtml;
                
            }
        })
    })

    //Brand edit ajax ends

    //category delete image
    $('#cat_id').on('click', function(e){
        var catId = $(this).data('id');
        var catImage = $(this).data('image');
        var _token = $(this).data('token');
        $.ajax({
            type: 'post',
            url: '/admin/delete-img-cat',
            data: {catId, catImage, _token },
            success: function(resp){
                $('#remove_after_del').remove();
                toastr.success(resp.success_message)
            },
            error: function(error){
                toastr.error(resp.error_message)
            }
        })
    })
    
})