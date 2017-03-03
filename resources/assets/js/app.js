$(document).ready(function(){
    if(window.location.search == '?referrer=extension'){
        window.close();
    }
    $('#timezone').val(new Date().getTimezoneOffset());
    $('#timezone1').val(new Date().getTimezoneOffset());
    $("#datepicker").datetimepicker({
        format: 'DD-MM-YYYY HH:mm'
    });
    $("#datepicker1").datetimepicker({
        format: 'DD-MM-YYYY HH:mm'
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image_preview').show();
                $('#image_preview').css({'width' : '100%'});
                $('#image_preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readEditImageURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image_preview_edit').show();
                $('#image_preview_edit').css({'width' : '100%'});
                $('#image_preview_edit').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image").change(function(){
        readURL(this);
    });
    $("#image_edit").change(function(){
        readEditImageURL(this);
    });
    //$(document).on('blur','#search_subreddit_for_text',function(){
    //    $('#json-datalist').html('');
    //    var query = $(this).val();
    //    $.ajax({
    //        url: "/serachSubreddit",
    //        type:'POST',
    //        data:{
    //            query:query
    //        },
    //        success: function(response){
    //            var result = $.parseJSON(response);
    //            var subreddits = '';
    //            if(result.data.children.length > 0){
    //                $.each(result.data.children,function(key,value){
    //                    subreddits += '<option value="'+value.data.display_name+'">'+value.data.display_name+'</option>';
    //                });
    //            }
    //            $('#json-datalist').html(subreddits);
    //        }});
    //});
    $("#subreddit_for_text, #subreddit_for_link, #subreddit_for_search").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "/serachSubreddit",
                dataType: "json",
                type:'POST',
                beforeSend: function() {
                    $(".page-loader").show();
                },
                data: {
                    query : request.term
                },
                success: function(result) {
                    $(".page-loader").hide();
                    response(result);
                }
            });
        },
        min_length: 3
    });
    $("#update_list_button").attr("disabled", true);
    $("#filter_by_subreddit").autocomplete({
        minLength: 2,
        source: function(request, response) {
            $.ajax({
                url: "/serachSubreddit",
                dataType: "json",
                type:'POST',
                beforeSend: function() {
                    $(".page-loader").show();
                },
                data: {
                    sub_arch : true,
                    query : request.term
                },
                success: function(result) {
                    $(".page-loader").hide();
                    if(result.length>0){
                        if(result[0] != 'NO MATCHING FOUND !'){
                            $("#update_list_button").attr("disabled", false);
                        }
                    }
                    response(result);
                }
            });
        }
    });
    $('#arch_sub').DataTable();
    var datatable_content = $('#arch_content').DataTable({
        "ordering": true,
        columnDefs: [{
            orderable: false,
            targets: "no-sort"
        }]
    });
    var posts = [];
    $('#update_list_button').on('click', function() {
        var filter = $('#filter_by_subreddit').val();
        $('.page-loader').show();
        $.ajax({
            type: 'post',
            url: '/update_posts_list',
            data: {subreddit: filter},
            success: function (response) {
                datatable_content.clear();
                if(response.length>2){
                    var array = JSON.parse(response);
                    posts =  array['posts'];
                    var users =  array['author'];
                    var type =  array['type'];
                    if(posts != 'undefined'){
                        if(posts.length > 0){
                            var dataTableArray = [];
                            $.each(posts, function(key,value){
                                dataTableArray.push([value.url,value.user,value.type,'<button type="button" class="btn btn-default post_delete" id="post-id-'+value.id+'" data-id="'+value.id+'" data-fullname="'+value.data_id+'" data-toggle="confirmation">Delete</button>']);
                            });
                            datatable_content.rows.add(dataTableArray);
                            datatable_content.draw();
                        }
                    }
                    if(users){
                        $('#filter_by_user').empty();
                        $('#filter_by_user').append("<option value='default' selected='selected'>By all users</option>");
                        $.each(users, function(key,value){
                            $('#filter_by_user').append("<option value='"+ value +"'>"+ value +"</option>");
                        });
                    }
                    if(type){
                        $('#filter_by_type').empty();
                        $('#filter_by_type').append("<option value='default' selected='selected'>Of all types</option>")
                        $.each(type, function(key,value){
                            $('#filter_by_type').append("<option value='"+ value +"'>"+ value +"</option>");
                        });
                    }
                    $("#update_list_button").attr("disabled", true);
                }
                else{
                    console.log('No matching found!');
                }
                $('.page-loader').hide();
            }
        });
    });
    $('#arch_content tbody').on('click','.post_delete',function () {
        $('[data-toggle="confirmation"]').confirmation({
            rootSelector: '[data-toggle="confirmation"]',
            singleton: true,
            onConfirm: function() {
                var button = $(this);
                var id = button.attr('data-id');
                var name = $(this).parent().prev().prev().html();
                $.ajax({
                    type: 'post',
                    url: '/delete-archive-post',
                    data: {id: id},
                    success: function (response) {
                        if(response.success){
                            var all = datatable_content.data().toArray();
                            var del = [];
                            $.each(all, function(key,value){
                                if(value[1] == name){
                                    del.push(value[1]);
                                }
                            });
                            if(del.length == 1){
                                $("#filter_by_user option[value='"+ name +"']").remove();
                            }
                            datatable_content
                                .row( button.parents('tr') )
                                .remove()
                                .draw();
                            posts = posts.filter(function(el) {
                                return el.id != id;
                            });
                            $.bootstrapGrowl(response.message,{
                                type: 'success',
                                ele: 'body',
                                offset: {from: 'top', amount: 10},
                                align: 'right',
                                width: 250,
                                delay: 2000,
                                allow_dismiss: true,
                                stackup_spacing: 10
                            });
                        }else{
                            $.bootstrapGrowl(response.message,{
                                type: 'danger',
                                ele: 'body',
                                offset: {from: 'top', amount: 10},
                                align: 'right',
                                width: 250,
                                delay: 2000,
                                allow_dismiss: true,
                                stackup_spacing: 10
                            });
                        }
                    }
                });
            },
            placement : 'top',
            buttons: [
                {
                    class: 'btn btn-danger',
                    icon: 'glyphicon glyphicon-ok',
                    onClick: function() {
                    }
                },
                {
                    class: 'btn btn-default',
                    icon: 'glyphicon glyphicon-remove',
                    cancel: true
                }
            ]
        });
        $(this).confirmation( 'show' );
    });
    $('#filter_by_user').on('change', function() {
        var user_filter = $(this).val();
        var type_filter = $('#filter_by_type').val();
        if(user_filter === 'default' && type_filter === 'default'){
            if(posts.length > 0){
                var dataTableArray = [];
                datatable_content.clear();
                $.each(posts, function(key,value){
                    dataTableArray.push([value.url,value.user,value.type,'<button type="button" class="btn btn-default post_delete" id="post-id-'+value.id+'" data-id="'+value.id+'" data-fullname="'+value.data_id+'" data-toggle="confirmation">Delete</button>']);
                });
                datatable_content.rows.add(dataTableArray);
                datatable_content.draw();
            }
        }
        if(user_filter === 'default' && type_filter != 'default') {
            var filtered_post = posts.filter(function (el) {
                return (el.type === type_filter);
            });
            var dataTableArray = [];
            datatable_content.clear();
            $.each(filtered_post, function(key,value){
                dataTableArray.push([value.url,value.user,value.type,'<button type="button" class="btn btn-default post_delete" id="post-id-'+value.id+'" data-id="'+value.id+'" data-fullname="'+value.data_id+'" data-toggle="confirmation">Delete</button>']);
            });
            datatable_content.rows.add(dataTableArray);
            datatable_content.draw();
        }
        if(user_filter != 'default' && type_filter === 'default') {
            var filtered_post = posts.filter(function (el) {
                return (el.user === user_filter);
            });
            var dataTableArray = [];
            datatable_content.clear();
            $.each(filtered_post, function(key,value){
                dataTableArray.push([value.url,value.user,value.type,'<button type="button" class="btn btn-default post_delete" id="post-id-'+value.id+'" data-id="'+value.id+'" data-fullname="'+value.data_id+'" data-toggle="confirmation">Delete</button>']);
            });
            datatable_content.rows.add(dataTableArray);
            datatable_content.draw();
        }
        if(user_filter != 'default' && type_filter != 'default') {
            var filtered_post = posts.filter(function (el) {
                return (el.user === user_filter && el.type === type_filter);
            });
            datatable_content.clear();
            var dataTableArray = [];
            $.each(filtered_post, function(key,value){
                dataTableArray.push([value.url,value.user,value.type,'<button type="button" class="btn btn-default post_delete" id="post-id-'+value.id+'" data-id="'+value.id+'" data-fullname="'+value.data_id+'" data-toggle="confirmation">Delete</button>']);
            });
            datatable_content.rows.add(dataTableArray);
            datatable_content.draw();
        }
    });
    $('#filter_by_type').on('change', function() {
        var type_filter = $(this).val();
        var user_filter = $('#filter_by_user').val();
        if(user_filter === 'default' && type_filter === 'default'){
            if(posts.length > 0){
                var dataTableArray = [];
                $.each(posts, function(key,value){
                    dataTableArray.push([value.url,value.user,value.type,'<button type="button" class="btn btn-default post_delete" id="post-id-'+value.id+'" data-id="'+value.id+'" data-fullname="'+value.data_id+'" data-toggle="confirmation">Delete</button>']);
                });
                datatable_content.rows.add(dataTableArray);
                datatable_content.draw();
            }
        }
        if(user_filter === 'default' && type_filter != 'default') {
            var filtered_post = posts.filter(function (el) {
                return (el.type === type_filter);
            });
            var dataTableArray = [];
            datatable_content.clear();
            $.each(filtered_post, function(key,value){
                dataTableArray.push([value.url,value.user,value.type,'<button type="button" class="btn btn-default post_delete" id="post-id-'+value.id+'" data-id="'+value.id+'" data-fullname="'+value.data_id+'" data-toggle="confirmation">Delete</button>']);
            });
            datatable_content.rows.add(dataTableArray);
            datatable_content.draw();
        }
        if(user_filter != 'default' && type_filter === 'default') {
            var filtered_post = posts.filter(function (el) {
                return (el.user === user_filter);
            });
            var dataTableArray = [];
            datatable_content.clear();
            $.each(filtered_post, function(key,value){
                dataTableArray.push([value.url,value.user,value.type,'<button type="button" class="btn btn-default post_delete" id="post-id-'+value.id+'" data-id="'+value.id+'" data-fullname="'+value.data_id+'" data-toggle="confirmation">Delete</button>']);
            });
            datatable_content.rows.add(dataTableArray);
            datatable_content.draw();
        }
        if(user_filter != 'default' && type_filter != 'default') {
            var filtered_post = posts.filter(function (el) {
                return (el.user === user_filter && el.type === type_filter);
            });
            datatable_content.clear();
            var dataTableArray = [];
            $.each(filtered_post, function(key,value){
                dataTableArray.push([value.url,value.user,value.type,'<button type="button" class="btn btn-default post_delete" id="post-id-'+value.id+'" data-id="'+value.id+'" data-fullname="'+value.data_id+'" data-toggle="confirmation">Delete</button>']);
            });
            datatable_content.rows.add(dataTableArray);
            datatable_content.draw();
        }
    });
    $('#change_info_nav').on('click', function() {
        $("#msg").empty();
        $("#msg").removeClass();
        $(".show_err").remove();
        $(".form-group>div").removeClass();
        $(".form-group>div").addClass('form-group text-left');
        $("#old_pass").val("");
        $("#new_pass").val("");
        $("#confirm_pass").val("");
    });
    $('#submit_pass_change').on('click', function() {
        $("#msg").empty();
        $("#msg").removeClass();
        $("#pass_form").validate({
            rules: {
                old_pass: {
                    required: true,
                    minlength : 6,
                },
                new_pass: {
                    required: true,
                    minlength : 6,
                },
                confirm_pass: {
                    required: true,
                    equalTo : "#new_pass",
                }
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                offset = element.offset();
                error.insertAfter(element);
                error.css('margin-top','5px');
                error.css('color','#a94442');
                error.addClass('show_err');
            },
            highlight: function (element) {
                $(element).parent().addClass('has-error has-danger');
            },
            unhighlight: function (element) {
                $(element).parent().removeClass('has-error has-danger');
            },
            messages: {
                old_pass: {
                    required: "Please enter your old password",
                    minlength: "Your password must be at least 6 characters long"
                },
                new_pass: {
                    required: "Please enter your new password",
                    minlength: "Your password must be at least 6 characters long"
                },
                confirm_pass: {
                    required: "Please confirm your new password",
                    minlength: "Your password must be at least 6 characters long",
                    equalTo: "Password confirmation doesn't match New password"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
        if($("#pass_form").valid()){
            var old_pass = $("#old_pass").val();
            var new_pass = $("#new_pass").val();
            var confirm_pass = $("#confirm_pass").val();
            $.ajax({
                type: 'post',
                url: '/update_pass',
                data: {
                    old_pass: old_pass,
                    new_pass: new_pass,
                    confirm_pass: confirm_pass,
                },
                success: function (response) {
                    if(response === 'success'){
                        $("#msg").empty();
                        $("#msg").removeClass();
                        $("#old_pass_div").removeClass('has-error has-danger');
                        $("#msg").addClass("alert alert-success");
                        $("#msg").append("Password has been successfully changed");
                        $("#old_pass").val("");
                        $("#new_pass").val("");
                        $("#confirm_pass").val("");
                    }
                    if(response.error){
                        $("#msg").empty();
                        $("#msg").removeClass();
                        $("#old_pass_div").addClass('has-error has-danger');
                        $("#msg").addClass("alert alert-danger");
                        $("#msg").append(response.error);
                    }
                }
            });
        }
    });
    var countries = [];
    if($('#country_name').html() == 'Empty'){
        var currernt_country = '';
    }
    else{
        var currernt_country = $('#country_name').html();
    }
    $.ajax({
        type: 'get',
        url: '/get_countries',
        data: {q: 1},
        success: function (response) {
            countries.push({value:'',text:'Choose your country'});
            $.each(response, function(key,value){
                countries.push({value:value,text:value});
            });
        }
    });
    $.fn.editable.defaults.mode = 'popup';
    $('#username').editable({
        type: 'text',
        title: 'Change username',
        validate: function(value) {
            if($.trim(value) == '')
                return 'Value is required.';
        },
        success: function(response) {
            $("#logged_usert_name_title").empty();
            $("#logged_usert_name_title").append(response + " <b class='caret'></b>");
        }
    });
    $("#country_name").editable({
        type: 'select',
        value: currernt_country,
        source: countries,
        title: 'Change country',
        validate: function(value) {
            if($.trim(value) == '')
                return 'Value is required.';
        },
    });
});

