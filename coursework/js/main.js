    $(document).ready(function () {
        $('.section-content').css('height', $('body').height() - $('header').height());
    });
    

    $(document).on('click', '#content-index-signin-button', function(){
        var signin_email = $('.content-index-signin #email').val();
        var signin_password = $('.content-index-signin #password').val();
        var signin = "signin";
        $.ajax({
            url: '/action/action.php',
            type: "post",
            dataType: "json",
            data: { 
                "signin_email": signin_email,
                "signin_password": signin_password,
                "signin": signin,    

            },
            success: function(data){
                if (data.result == 1){
                    window.location=("projects.php");
                }
                else{
                    $('.content-index-signin .messages').html("Не верный логин или пароль"); 
                }
            }          
        }); 
    });
    $(document).on('click', '#logout', function(){
        var logout = "logout";
        $.ajax({
            url: '/action/action.php',
            type: "post",
            dataType: "json",
            data: { 
                "logout": logout,    

            },
            success: function(data){
                window.location=("index.php");
            }          
        }); 
    });
    $(document).on('click', '#content-index-signup-button', function(){
        var signup_name = $('.content-index-signup #name').val();
        var signup_email = $('.content-index-signup #email').val();
        var signup_password = $('.content-index-signup #password').val();
        var signup_password_confirm = $('.content-index-signup #password-confirm').val();
        var signup = "signup";
        if (signup_password == signup_password_confirm) {                
            $.ajax({
                url: '/action/action.php',
                type: "post",
                dataType: "json",
                data: {
                    "signup_name": signup_name, 
                    "signup_email": signup_email,
                    "signup_password": signup_password,     
                    "signup": signup,            
                },
                success: function(data){
                    if (data.result == 1){
                        window.location=("projects.php");
                    }
                    else{
                        $('.content-index-signup .messages').html("Данный Email уже зарегистрирован"); 
                    }
                    
                }          
            }); 
        }
        else{
            $('.content-index-signup .messages').html("Пароли не совпадают")
        }
    });



    $(document).on('click', '.tags-editor', function(){
        var aspects_editor_id = $(this).attr('id');
        var name = $(this).attr('name');
        $('.create-new-tag').attr('id', $(this).attr('id'));
        $.when($.ajax({  
                url: "components/aspects/tags-option.php", 
                type: "get",
                data: {
                    id_project: id_project, 
                    id_aspects: aspects_editor_id
                }, 
                cache: false,  
                success: function(html){  
                    $(".main-tags1").html(html);  
                }
            })).done($.ajax({  
                url: "components/aspects/tags-editor.php", 
                type: "get",
                data: {
                    id_project: id_project, 
                }, 
                cache: false,  
                success: function(html){  
                    $(".main-tags3-1").html(html);  
                }
            }));
        
        
        
        $('.title-tags-aspects').html(name);
        $('.bg-tags').css('display', 'flex');
    });
    $(document).on('click', '.create-new-tag', function(){
        var create_new_tag = "create_new_tag";
        var new_tag_name = $('#name-tag').val();
        var new_tag_color = $('.new-tags-title>.preview>#tag-preview').css('background-color');
        var aspects_editor_id = $(this).attr('id');
            $.when($.ajax({
                url: '/action/action.php',
                type: "post",
                dataType: "json",
                data: { 
                    "create_new_tag": create_new_tag,
                    "new_tag_name": new_tag_name,
                    "new_tag_color": new_tag_color, 
                    "id_project": id_project               
                },
                success: function(data){
                }
            })).done(function(){
                $.when($.ajax({  
                    url: "components/aspects/tags-option.php", 
                    type: "get",
                    data: {
                        id_project: id_project, 
                        id_aspects: aspects_editor_id
                    }, 
                    cache: false,  
                    success: function(html){  
                        $(".main-tags1").html(html);  
                    }
                })).done(function(){ 
                        $.ajax({  
                            url: "components/aspects/tags-editor.php", 
                            type: "get",
                            data: {
                                id_project: id_project, 
                            }, 
                            cache: false,  
                            success: function(html){  
                                $(".main-tags3-1").html(html);  
                            }
                        });
                        $.ajax({  
                            url: "components/aspects/aspects.php", 
                            type: "post",
                            data: { 
                                "id_project": id_project,
                            },
                            cache: false,  
                            success: function(html){  
                                $(".aspects").html(html);      
                            }  
                        });
                    }
                );
            });   
    });
    

    $(document).on('click', '.editor-tag', function(){
        var editor_tag = "editor_tag";
        var tag_name = $('#name-tag-editor').val();
        var tag_color = $('.new-tags-title>.preview>#tag-preview-editor').css('background-color');
        var aspects_editor_id = $('.create-new-tag').attr('id');
        var id_tag = $(this).attr('id');
            $.when($.ajax({
                url: '/action/action.php',
                type: "post",
                dataType: "json",
                data: { 
                    "editor_tag": editor_tag,
                    "tag_name": tag_name,
                    "tag_color": tag_color, 
                    "id_project": id_project,
                    "id_tag": id_tag               
                },
                success: function(data){
                }
            })).done(function(){
                $.ajax({  
                    url: "components/aspects/aspects.php", 
                    type: "post",
                    data: { 
                        "id_project": id_project,
                    },
                    cache: false,  
                    success: function(html){  
                        $(".aspects").html(html);      
                    }  
                });
                $.when($.ajax({  
                    url: "components/aspects/tags-option.php", 
                    type: "get",
                    data: {
                        id_project: id_project, 
                        id_aspects: aspects_editor_id
                    }, 
                    cache: false,  
                    success: function(html){  
                        $(".main-tags1").html(html);  
                    }
                })).done($.ajax({  
                    url: "components/aspects/tags-editor.php", 
                    type: "get",
                    data: {
                        id_project: id_project, 
                    }, 
                    cache: false,  
                    success: function(html){  
                        $.when($(".main-tags3-1").html(html)).done($.ajax({  
                            url: "components/aspects/tag-editor.php", 
                            type: "get",
                            data: {
                                id_project: id_project, 
                                id_tag: id_tag
                            }, 
                            cache: false,  
                            success: function(html){  
                                $(".main-tags3-1 div[name = " + id_tag + "]").html(html)  
                            }  
                        }));  
                    }
                }));
            });   
    });

    $(document).on('click', '.delete-tag', function(){
        var delete_tag = "delete_tag";
        var aspects_editor_id = $('.create-new-tag').attr('id');
        var id_tag = $(this).attr('id');
            $.when($.ajax({
                url: '/action/action.php',
                type: "post",
                dataType: "json",
                data: { 
                    "delete_tag": delete_tag,
                    "id_project": id_project,
                    "id_tag": id_tag,           
                },
                success: function(data){
                }
            })).done(function(){
                $.ajax({  
                    url: "components/aspects/aspects.php", 
                    type: "post",
                    data: { 
                        "id_project": id_project,
                    },
                    cache: false,  
                    success: function(html){  
                        $(".aspects").html(html);      
                    }  
                });
                $.ajax({  
                    url: "components/aspects/tags-option.php", 
                    type: "get",
                    data: {
                        id_project: id_project, 
                        id_aspects: aspects_editor_id,
                    }, 
                    cache: false,  
                    success: function(html){  
                        $(".main-tags1").html(html);  
                    }  
                });
                $.ajax({  
                    url: "components/aspects/tags-editor.php", 
                    type: "get",
                    data: {
                        id_project: id_project, 
                    }, 
                    cache: false,  
                    success: function(html){  
                        $(".main-tags3-1").html(html); 
                        $('#name-tag-editor').prop("disabled", true);
                        $('#name-tag-editor').val('');
                        $('.delete-tag').prop("disabled", true);
                        $('.editor-tag').prop("disabled", true);
                        $('.new-tags-title>.preview>#tag-preview-editor').html(''); 
                    }  
                });
            });
    });
    
    
    $(document).on('click', '.pallete-color', function(){ 
        $('.new-tags-title>.preview>#tag-preview').css('background-color', $(this).css('background-color'));
        $('.pallete-color>img').css('display', 'none');
        $(this).children('img').css('display', 'flex');
    });
    $("#name-tag").bind("change paste keyup", function() {
        if($("#name-tag").val().length > 0){
            $('.create-new-tag').removeAttr("disabled");
        } else {
            $('.create-new-tag').prop("disabled", true);
        }
        $('.new-tags-title>.preview>#tag-preview').html($("#name-tag").val());
    });

    $("#name-tag-editor").bind("change paste keyup", function() {
        if($("#name-tag-editor").val().length > 0){
            $('.editor-tag').removeAttr("disabled");
        } else {
            $('.editor-tag').prop("disabled", true);
        }
        $('.new-tags-title>.preview>#tag-preview-editor').html($("#name-tag-editor").val());
    });
    $(document).on('click', '.editor-pallete-color', function(){ 
        $('.new-tags-title>.preview>#tag-preview-editor').css('background-color', $(this).css('background-color'));
        $('.editor-pallete-color>img').css('display', 'none');
        $(this).children('img').css('display', 'flex');
    });
    
    $(document).on('click', '#main-tags3', function(){
        if($('#main-tags3 img').css('transform') == 'none'){
            $('#main-tags3 img').css('transform', 'rotate(180deg)');
            $('.main-tags3').css('display', 'block');
        }else{
            $('#main-tags3 img').css('transform', 'none');
            $('.main-tags3').css('display', 'none');
        } 
    });
    $(document).on('click', '#main-tags2', function(){
        if($('#main-tags2 img').css('transform') == 'none'){
            $('#main-tags2 img').css('transform', 'rotate(180deg)');
            $('.main-tags2').css('display', 'block');
        }else{
            $('#main-tags2 img').css('transform', 'none');
            $('.main-tags2').css('display', 'none');
        } 
    });
    $(document).on('click', '#main-tags1', function(){
        if($('#main-tags1 img').css('transform') == 'none'){
            $('#main-tags1 img').css('transform', 'rotate(180deg)');
            $('.main-tags1').css('display', 'none');
        }else{
            $('#main-tags1 img').css('transform', 'none');
            $('.main-tags1').css('display', 'flex');
        } 
    });
    
    $(document).on('click', '.form-tags-footer>div', function(){
        $('.bg-tags').css('display', 'none');
        $('#name-tag-editor').prop("disabled", true);
        $('#name-tag-editor').val('');
        $('.delete-tag').prop("disabled", true);
        $('.editor-tag').prop("disabled", true);
        $('.delete-tag').removeAttr("id");
        $('.editor-tag').removeAttr("id");
        $('.new-tags-title>.preview>#tag-preview-editor').html(''); 
    });

$(document).on('click', '.main-tags3-1 .tag', function(){
    $('.editor-tag').attr('id', $(this).attr('name'));
    $('.delete-tag').attr('id', $(this).attr('name'));
    var id_tag = $(this).attr('name');
    var color = $(this).css('background-color');

    $('#name-tag-editor').removeAttr("disabled");
    $('#name-tag-editor').val($(this).text());
    $('.delete-tag').removeAttr("disabled");
    $('.editor-tag').removeAttr("disabled");
    $('.new-tags-title>.preview>#tag-preview-editor').html($(this).text());

    $.ajax({  
        url: "components/aspects/tags-editor.php", 
        type: "get",
        data: {
            id_project: id_project, 
        }, 
        cache: false,  
        success: function(html){  
            $.when($(".main-tags3-1").html(html)).done($.ajax({  
                url: "components/aspects/tag-editor.php", 
                type: "get",
                data: {
                    id_project: id_project, 
                    id_tag: id_tag,
                }, 
                cache: false,  
                success: function(html){  
                    $(".main-tags3-1 div[name = " + id_tag + "]").html(html)  
                }  
            }));
        }
    });
    $('.new-tags-title>.preview>#tag-preview-editor').css('background-color', $(this).css('background-color'));
    
    $('.editor-pallete-color>img').css('display', 'none');
    $('.editor-pallete-color').map(function(index, el) {
        if ($(this).css('background-color') == color) {
            $(this).children('img').css('display', 'flex');
        }
    });
    
});
$(document).on('click', '.main-tags1 .tag', function(){
    var id_tag = this.id;
    var id_aspects = $(this).attr('name');
    $(".main-tags1 .tag").bind('click',function(){return false;});
    $.ajax({  
        url: "action/action.php", 
        type: "post",
        dataType: "json",
        data: {
            add_tag: "add_tag",
            id_tag: id_tag,
            id_aspects: id_aspects, 
        }, 
        success: function(data){
            $.ajax({  
                url: "components/aspects/tags-option.php", 
                type: "get",
                data: {
                    id_project: id_project, 
                    id_aspects: id_aspects,
                }, 
                cache: false,  
                success: function(html){  
                    $(".main-tags1").html(html);  
                }  
            })
            $.ajax({  
                url: "components/aspects/aspects.php", 
                type: "post",
                data: { 
                    "id_project": id_project,
                },
                cache: false,  
                success: function(html){  
                    $(".aspects").html(html);      
                }  
            })
            
        }
    }); 
});


$(document).on('click', '.notes-new', function(){
    $.ajax({  
        url: "components/projects/notes-editor.php",  
        cache: false,  
        success: function(html){  
            $(".notes").html(html);  
        }  
    });
});

$(document).on('click', '.notes-editor-create', function(){
    var notes_editor_create = "notes_editor_create";
    var notes_editor_name = $('#notes-editor-name').val();
    var notes_editor_text = CKEDITOR.instances.editor.getData();
    var notes_editor_id;    
        $.when($.ajax({
            url: '/action/action.php',
            type: "post",
            dataType: "json",
            data: { 
                "notes_editor_create": notes_editor_create,
                "notes_editor_name": notes_editor_name,
                "notes_editor_text": notes_editor_text,                
            },
            success: function(data){
                notes_editor_id = data.result;
            }
        })).done(function(){
            $.ajax({  
                url: "components/projects/notes-editor.php", 
                type: "get",
                data: {
                    id_notes: notes_editor_id 
                }, 
                cache: false,  
                success: function(html){  
                    $(".notes").html(html);  
                }  
            });
            window.history.pushState('1', 'Title', '?id_notes='+notes_editor_id);
        });   
});

$(document).on('click', '.notes-delete', function(){
    var notes_delete = "notes_delete";
    var notes_delete_id = $(this).attr('id');
    $.when($.ajax({
        url: 'action/action.php',
        type: "post",
        dataType: "json",
        data: { 
            "notes_delete": notes_delete,
            "notes_delete_id": notes_delete_id,
        },
        success: function(data){
        }     
        })).done(function(){
            $.ajax({  
                url: "components/projects/notes-view.php",  
                cache: false,  
                success: function(html){  
                    $(".notes").html(html);  
                }  
            });
        });         
});
$(document).on('click', '.notes-editor', function(){
    var notes_editor_id = $(this).attr('id');
        $.ajax({  
            url: "components/projects/notes-editor.php", 
            type: "get",
            data: {
                id_notes: notes_editor_id 
            }, 
            cache: false,  
            success: function(html){  
                $(".notes").html(html);  
            }  
        });
        window.history.pushState('1', 'Title', '?id_notes='+notes_editor_id);
});

$(document).on('click', '.notes-close', function(){
    $.ajax({  
        url: "components/projects/notes-view.php", 
        type: "get",
        cache: false,  
        success: function(html){  
            $(".notes").html(html);  
        }  
    });
    window.history.pushState('1', 'Title', '?');
});

$(document).on('click', '.notes-editor-save', function(){
    var notes_editor_save = "notes_editor_save";
    var notes_editor_name = $('#notes-editor-name').val();
    var notes_editor_id = $(this).attr('id');
    var notes_editor_text = CKEDITOR.instances.editor.getData();
    $.when($.ajax({
        url: '/action/action.php',
        type: "post",
        dataType: "json",
        data: { 
            "notes_editor_save": notes_editor_save,
            "notes_editor_name": notes_editor_name,
            "notes_editor_id": notes_editor_id,
            "notes_editor_text": notes_editor_text,
        },
        success: function(data){  
        }     
        })).done(function(){
            $.ajax({  
                url: "components/projects/notes-editor.php", 
                type: "get",
                data: {
                    id_notes: notes_editor_id 
                }, 
                cache: false,  
                success: function(html){  
                    $(".notes").html(html);  
                }  
            });
            window.history.pushState('1', 'Title', '?id_notes='+notes_editor_id);
        });     
});




$(document).on('click', '.form-project-footer .close', function(){
    $('.bg-new-project').css('display', 'none');
});
$(document).on('click', '.new-project-create', function(){
    var project_create = "project_create";
    var project_create_name = $('#new-project-name').val();
    $.when($.ajax({
        url: '/action/action.php',
        type: "post",
        dataType: "json",
        data: { 
            "project_create": project_create,
            "project_create_name": project_create_name,
        },
        success: function(data){  
        }     
        })).done(function(){
            $.ajax({  
                url: "components/projects/projects.php", 
                type: "get",
                cache: false,  
                success: function(html){  
                    $(".projects").html(html);      
                }  
            });
            
        });   
    $('.bg-new-project').css('display', 'none');
});
$(document).on('click', '.projects-new', function(){
    $.ajax({  
        url: "components/projects/form-new-project.php", 
        type: "get",
        cache: false,  
        success: function(html){  
            $(".form-new-project").html(html);  
        }  
    });
    $('.bg-new-project').css('display', 'flex');
});


$(document).on('click', '.project-editor', function(){
    var project_editor_id = $(this).attr('id');
    $.ajax({  
        url: "components/projects/form-new-project.php", 
        type: "get",
        data: {
            id_project: project_editor_id 
        }, 
        cache: false,  
        success: function(html){  
            $(".form-new-project").html(html);  
        }  
    });
    $('.bg-new-project').css('display', 'flex');
});

$(document).on('click', '.new-project-save', function(){
    var project_save = "project_save";
    var project_save_id = $(this).attr('id');
    var project_save_name = $('#new-project-name').val();
    $.when($.ajax({
        url: '/action/action.php',
        type: "post",
        dataType: "json",
        data: { 
            "project_save": project_save,
            "project_save_id": project_save_id,
            "project_save_name": project_save_name,
        },
        success: function(data){  
        }     
        })).done(function(){
            $.ajax({  
                url: "components/projects/projects.php", 
                type: "get",
                cache: false,  
                success: function(html){  
                    $(".projects").html(html);      
                }  
            });
            
        });   
    $('.bg-new-project').css('display', 'none');
});

$(document).on('click', '.project-delete', function(){
    var project_delete = "project_delete";
    var project_delete_id = $(this).attr('id');
    $.when($.ajax({
        url: '/action/action.php',
        type: "post",
        dataType: "json",
        data: { 
            "project_delete": project_delete,
            "project_delete_id": project_delete_id,
        },
        success: function(data){  
        }     
        })).done(function(){
            $.ajax({  
                url: "components/projects/projects.php", 
                type: "get",
                cache: false,  
                success: function(html){  
                    $(".projects").html(html);      
                }  
            });
            
        });
});




$(document).on('click', '.form-aspect-footer .close', function(){
    $('.bg-new-aspect').css('display', 'none');
});
$(document).on('click', '.new-aspect-create', function(){
    var aspect_create = "aspect_create";
    var aspect_create_name = $('#new-aspect-name').val();
    $.when($.ajax({
        url: '/action/action.php',
        type: "post",
        dataType: "json",
        data: { 
            "id_project": id_project,
            "aspect_create": aspect_create,
            "aspect_create_name": aspect_create_name,
        },
        success: function(data){  
        }     
        })).done(function(){
            $.ajax({  
                url: "components/aspects/aspects.php", 
                type: "post",
                data: { 
                    "id_project": id_project,
                },
                cache: false,  
                success: function(html){  
                    $(".aspects").html(html);      
                }  
            });
            
        });   
    $('.bg-new-aspect').css('display', 'none');
});
$(document).on('click', '.aspects-new', function(){
    $.ajax({  
        url: "components/aspects/form-new-aspect.php", 
        type: "post",
        data: {
            id_project: id_project,
        }, 
        cache: false,  
        success: function(html){  
            $(".form-new-aspect").html(html);  
        }  
    });
    $('.bg-new-aspect').css('display', 'flex');
});


$(document).on('click', '.aspect-editor', function(){
    var aspect_editor_id = $(this).attr('id');
    $.ajax({  
        url: "components/aspects/form-new-aspect.php", 
        type: "post",
        data: {
            id_aspect: aspect_editor_id,
            id_project: id_project,
        }, 
        cache: false,  
        success: function(html){  
            $(".form-new-aspect").html(html);  
        }  
    });
    $('.bg-new-aspect').css('display', 'flex');
});

$(document).on('click', '.new-aspect-save', function(){
    var aspect_save = "aspect_save";
    var aspect_save_id = $(this).attr('id');
    var aspect_save_name = $('#new-aspect-name').val();
    $.when($.ajax({
        url: '/action/action.php',
        type: "post",
        dataType: "json",
        data: { 
            "id_project": id_project,
            "aspect_save": aspect_save,
            "aspect_save_id": aspect_save_id,
            "aspect_save_name": aspect_save_name,
        },
        success: function(data){  
        }     
        })).done(function(){
            $.ajax({  
                url: "components/aspects/aspects.php", 
                type: "post",
                data: { 
                    "id_project": id_project,
                },
                cache: false,  
                success: function(html){  
                    $(".aspects").html(html);      
                }  
            });
            
        });   
    $('.bg-new-aspect').css('display', 'none');
});

$(document).on('click', '.aspect-delete', function(){
    var aspect_delete = "aspect_delete";
    var aspect_delete_id = $(this).attr('id');
    $.when($.ajax({
        url: '/action/action.php',
        type: "post",
        dataType: "json",
        data: { 
            "id_project": id_project,
            "aspect_delete": aspect_delete,
            "aspect_delete_id": aspect_delete_id,
        },
        success: function(data){  
        }     
        })).done(function(){
            $.ajax({  
                url: "components/aspects/aspects.php", 
                type: "post",
                data: { 
                    "id_project": id_project,
                },
                cache: false,  
                success: function(html){  
                    $(".aspects").html(html);      
                }  
            });
            
        });
});

$(document).on('click', '.aspects-editor-save', function(){
    var aspects_editor_save = "aspects_editor_save";
    var aspects_editor_name = $('#aspects-editor-name').val();
    var aspects_editor_id = $(this).attr('id');
    var aspects_editor_text = CKEDITOR.instances.editor.getData();
    $.when($.ajax({
        url: '/action/action.php',
        type: "post",
        dataType: "json",
        data: { 
            "id_project": id_project,
            "aspects_editor_save": aspects_editor_save,
            "aspects_editor_name": aspects_editor_name,
            "aspects_editor_id": aspects_editor_id,
            "aspects_editor_text": aspects_editor_text,
        },
        success: function(data){  
        }     
        })).done(function(){
            $('.msg-info div').css('display', 'none');
            $('.msg-save').css('display', 'flex');
        });    
});

$("#aspects-editor-name").bind("change paste keyup", function() {
    $('.msg-info div').css('display', 'none');
    $('.msg-non-save').css('display', 'flex');
});




$(document).on('click', '.chapters-string', function(){
    
    $('.chapters-string').removeClass("string-active");
    $(this).addClass("string-active");
    var id = $(this).attr('id');
    if (id){
        window.history.pushState('1', 'Title', '?id-project='+id_project + '&id-chapter='+id);
    }else{
        window.history.pushState('1', 'Title', '?id-project='+id_project);
    }
    
    $.when($.ajax({
        url: '/components/scenes/scenes.php',
        type: "post",
        data: { 
            "id-project": id_project,
            "id-chapter": id,
        },
        cache: false,
        success: function(html){  
            $(".scenes").html(html); 
        }     
        })).done(function(){
        });    
});
$(document).on('click', '.chapters-string div *', function(e){
    e.stopPropagation();
});
$(document).on('click', '.form-chapter-footer .close', function(){
    $('.bg-new-chapter').css('display', 'none');
});
$(document).on('click', '.new-chapter-create', function(){
    var chapter_create = "chapter_create";
    var number = $('.new-chapter-number').val();
    var end_number = $('.number-end').attr('id');
    var chapter_create_name = $('#new-chapter-name').val();
    var id_chapter = $('.string-active').attr("id");
    $.when($.ajax({
        url: '/action/action.php',
        type: "post",
        dataType: "json",
        data: { 
            "number": number,
            "end_number": end_number,
            "id_project": id_project,
            "chapter_create": chapter_create,
            "chapter_create_name": chapter_create_name,
        },
        success: function(data){  
        }     
        })).done(function(){
            $.ajax({  
                url: "components/scenes/chapters.php", 
                type: "post",
                data: { 
                    "id-chapter": id_chapter,
                    "id-project": id_project,
                },
                cache: false,  
                success: function(html){  
                    $(".chapters").html(html);      
                }  
            });
            
        });   
    $('.bg-new-chapter').css('display', 'none');
});
$(document).on('click', '.chapters-new', function(){
    $.ajax({  
        url: "components/scenes/form-new-chapter.php", 
        type: "post",
        data: {
            'id-project': id_project,
        }, 
        cache: false,  
        success: function(html){  
            $(".form-new-chapter").html(html);  
        }  
    });
    $('.bg-new-chapter').css('display', 'flex');
});


$(document).on('click', '.chapter-editor', function(){
    var chapter_editor_id = $(this).attr('id');
    $.ajax({  
        url: "components/scenes/form-new-chapter.php", 
        type: "post",
        data: {
            "id-chapter": chapter_editor_id,
            "id-project": id_project,
        }, 
        cache: false,  
        success: function(html){  
            $(".form-new-chapter").html(html);  
        }  
    });
    $('.bg-new-chapter').css('display', 'flex');
});

$(document).on('click', '.new-chapter-save', function(){
    var chapter_save = "chapter_save";
    var number = $('.new-chapter-number').val();
    var end_number = $('.number-end').attr('id');
    var chapter_save_id = $(this).attr('id');
    var chapter_save_name = $('#new-chapter-name').val();
    var id_chapter = $('.string-active').attr("id");
    $.when($.ajax({
        url: '/action/action.php',
        type: "post",
        dataType: "json",
        data: { 
            "number": number,
            "end_number": end_number,
            "id_project": id_project,
            "chapter_save": chapter_save,
            "chapter_save_id": chapter_save_id,
            "chapter_save_name": chapter_save_name,
        },
        success: function(data){  
        }     
        })).done(function(){
            $.ajax({  
                url: "components/scenes/chapters.php", 
                type: "post",
                data: { 
                    "id-chapter": id_chapter,
                    "id-project": id_project,
                },
                cache: false,  
                success: function(html){  
                    $(".chapters").html(html);      
                }  
            });
            
        });   
    $('.bg-new-chapter').css('display', 'none');
});

$(document).on('click', '.chapter-delete', function(){
    var chapter_delete = "chapter_delete";
    var chapter_delete_id = $(this).attr('id');
    var id_chapter = $('.string-active').attr("id");
    $.when($.ajax({
        url: '/action/action.php',
        type: "post",
        dataType: "json",
        data: { 
            "id_project": id_project,
            "chapter_delete": chapter_delete,
            "chapter_delete_id": chapter_delete_id,
        },
        success: function(data){  
        }     
        })).done(function(){
            $.ajax({  
                url: "components/scenes/chapters.php", 
                type: "post",
                data: { 
                    "id-chapter": id_chapter,
                    "id-project": id_project,
                },
                cache: false,  
                success: function(html){  
                    $(".chapters").html(html);      
                }  
            });
            
        });
});



$(document).on('click', '.form-scene-footer .close', function(){
    $('.bg-new-scene').css('display', 'none');
    
});
$(document).on('click', '.scenes-new', function(){
    var id = this.id;
    $.ajax({  
        url: "components/scenes/form-new-scene.php", 
        type: "post",
        data: {
            "id-chapter": id,
            "id-project": id_project,
        }, 
        cache: false,  
        success: function(html){  
            $(".form-new-scene").html(html);  
        }  
    });
    $('.bg-new-scene').css('display', 'flex');
});


$(document).on('click', '.scene-editor', function(){
    var scene_editor_id = $(this).attr('id');
    $.ajax({  
        url: "components/scenes/form-new-scene.php", 
        type: "post",
        data: {
            "id-scene": scene_editor_id,
            "id-project": id_project,
        }, 
        cache: false,  
        success: function(html){  
            $(".form-new-scene").html(html);  
        }  
    });
    $('.bg-new-scene').css('display', 'flex');
});

$(document).on('click', '.new-scene-create', function(){
    var scene_create = "scene_create";
    var scene_create_name = $('#new-scene-name').val();
    $.when($.ajax({
        url: '/action/action.php',
        type: "post",
        dataType: "json",
        data: { 
            "id_project": id_project,
            "id_project": id_project,
            "scene_create": scene_create,
            "scene_create_name": scene_create_name,
        },
        success: function(data){  
        }     
        })).done(function(){
            $.ajax({  
                url: "components/scenes/scenes.php", 
                type: "post",
                data: { 
                    "id-project": id-project,
                },
                cache: false,  
                success: function(html){  
                    $(".scenes").html(html);      
                }  
            });
            
        });   
    $('.bg-new-scene').css('display', 'none');
});
$(document).on('click', '.new-scene-save', function(){
    var scene_save = "scene_save";
    var scene_save_id = $(this).attr('id');
    var scene_save_name = $('#new-scene-name').val();
    $.when($.ajax({
        url: '/action/action.php',
        type: "post",
        dataType: "json",
        data: { 
            "id_project": id_project,
            "scene_save": scene_save,
            "scene_save_id": scene_save_id,
            "scene_save_name": scene_save_name,
        },
        success: function(data){  
        }     
        })).done(function(){
            $.ajax({  
                url: "components/scenes/scenes.php", 
                type: "post",
                data: { 
                    "id-project": id_project,
                },
                cache: false,  
                success: function(html){  
                    $(".scenes").html(html);      
                }  
            });
            
        });   
    $('.bg-new-scene').css('display', 'none');
});
$(document).on('click', '.scene-delete', function(){
    var scene_delete = "scene_delete";
    var scene_delete_id = $(this).attr('id');
    $.when($.ajax({
        url: '/action/action.php',
        type: "post",
        dataType: "json",
        data: { 
            "id_project": id_project,
            "scene_delete": scene_delete,
            "scene_delete_id": scene_delete_id,
        },
        success: function(data){  
        }     
        })).done(function(){
            $.ajax({  
                url: "components/scenes/scenes.php", 
                type: "post",
                data: { 
                    "id-project": id_project,
                },
                cache: false,  
                success: function(html){  
                    $(".scenes").html(html);      
                }  
            });
            
        });
});

$(document).on('click', '.scenes-editor-save', function(){
    var scenes_editor_save = "scenes_editor_save";
    var scenes_editor_name = $('#scenes-editor-name').val();
    var scenes_editor_id = $(this).attr('id');
    var scenes_editor_text = CKEDITOR.instances.editor.getData();
    $.when($.ajax({
        url: '/action/action.php',
        type: "post",
        dataType: "json",
        data: { 
            "id_project": id_project,
            "scenes_editor_save": scenes_editor_save,
            "scenes_editor_name": scenes_editor_name,
            "scenes_editor_id": scenes_editor_id,
            "scenes_editor_text": scenes_editor_text,
        },
        success: function(data){  
        }     
        })).done(function(){
            $('.msg-info div').css('display', 'none');
            $('.msg-save').css('display', 'flex');
        });    
});

$("#scenes-editor-name").bind("change paste keyup", function() {
    $('.msg-info div').css('display', 'none');
    $('.msg-non-save').css('display', 'flex');
});
