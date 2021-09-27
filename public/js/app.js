function ajaxLoad(filename, cont_table) {
    cont_table = typeof cont_table !== 'undefined' ? cont_table : 'cont_table';
    $(document).ajaxStart(function() {
        Pace.restart();
    });
    // $('.loading').show();
    $("#" + cont_table).html('<center>Cargando ...</center>');        
    $.ajax({
        type: "GET",
        url: filename,
        contentType: false,
        success: function(data) {
            //alert(data);
            $("#" + cont_table).html(data);
            // $('.loading').hide();
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}


function ajaxLoadPaginate(filename, cont_table) {
  cont_table = typeof cont_table !== 'undefined' ? cont_table : 'cont_table';
  $(document).ajaxStart(function() {
      Pace.restart();
  });
  $("#" + cont_table).html('<center>Cargando ....</center>');
  $.ajax({
      type: "GET",
      url: filename,
      contentType: false,
      success: function(data) {
          $("#" + cont_table).html(data);
      },
      error: function(xhr, status, error) {
          alert(xhr.responseText);
      }
  });
}

function datatableEdit(id, modal_id, url) {   
    $.ajax({
        type: 'GET',
        url: url + '/' + id,
        context: this,
        success: function(data) {
            $('#content_' + modal_id).html(data);
            $('#'+modal_id).modal({ backdrop: 'static', keyboard: false, show: true });
        }
    });
}

function datatableNew(modal_id, url) {   
    $.ajax({
        type: 'GET',
        url: url,
        context: this,
        success: function(data) {
            $('#content_' + modal_id).html(data);
            $('#'+modal_id).modal({ backdrop: 'static', keyboard: false, show: true });
        }
    });
}

/****  otros **/

function get_inputs_error(form, data) {
  $('#' + form).find(':input').each(function() {                
      var index_name = $(this).attr('name');
      var cadena = $(this).attr('name');
      if (index_name != '') {   

          if (index_name.substr(-2) == '[]') {

              //var index_id = index_name.substr(-2);
              /*if (index_name in data.errors) {                          
                  $("#error_" + index_id + "").html(data.errors[index_name]);
              } else {                           
                  $("#error_" + index_id + "").empty();
              }*/
              var index_id = $(this).attr('name');
              if (index_name in data.errors) {                          
                  $("#error_" + index_id + "").html(data.errors[index_name]);
              } else {                           
                  $("#error_" + index_id + "").empty();
              }

          }else{                                     
              var index_id = $(this).attr('name');
              if (index_name in data.errors) {                          
                  $("#error_" + index_id + "").html(data.errors[index_name]);
              } else {                           
                  $("#error_" + index_id + "").empty();
              }
          }
          
      }
  });
}

/*function get_inputs_error(form, data) {
    $('#' + form).find(':input').each(function() {
        var cadena = $(this).attr('id');
        var index_name = $(this).attr('name');
        //alert('name:' + index_name);
        if (index_name != '') {
            if (index_name.substr(-2) == '[]') {
                if (typeof cadena != 'undefined') {
                    var index_id = cadena.replace("-", ".");
                }
                //alert('/index_id:'+index_id+'/index_name:'+index_name+'/'+data.errors['nombre.0']);
                if (index_id in data.errors) {
                    
                    $("#span_" + cadena + "").html(data.errors[index_id]);
                } else {
                    
                    $("#span_" + cadena + "").empty();
                }
            } else {
                var index_id = $(this).attr('id');
                //alert('id:' + index_id);
                if (index_name in data.errors) {
                    
                    $("#span_" + index_id + "").html(data.errors[index_name]);
                } else {
                
                    $("#span_" + index_id + "").empty();
                }
            }
        }
    });
}*/


function clear_form(form_name) {
    $("#" + form_name + "").find(':input').each(function() {
        var elemento = this;
        if (elemento.id != '') {
            $('#' + elemento.id + '').val('');
        }
    });
}

function clear_inputs_error(form) {
    $('#' + form).find(':input').each(function() {
        var index_name = $(this).attr('id');                
        $("#error_" + index_name + "").empty();
    });
}

function v1_form(form, method, urls, url_reload, modal, tabla) { 
    $('.save').attr('disabled', true);
    $('.load').html('<center><img src="img/app/load.gif" class="align-items-center" width="15%" heigth="15%" alt="Cargando ..." /></center>');
    $.ajax({
        type: method, 
        url: urls, 
        data: $('#' + form + '').serialize(),
        success: function(data) {
            var html = '';
            //var data = eval('(' + data + ')'); //cuando recibo el json desde el servidor
            $('.save').attr('disabled', false);
            $('.form-content').removeClass('disabled');
            $('.load').html('');
            if (data.fail) //si fail es igual true mostrar errores 
            {                       
                console.log('errores', data);
                var render = '<div class="alert alert-danger" role="alert">Los campos con asterisco(*) son requeridos</div>';
                $('#get_errors').html(render);
                $('#get_errors').show(1000);
                
                setTimeout(function(){
                    $('#get_errors').hide(1000);
                }, 5000);

                get_inputs_error(form, data);
            } else {

                if (data.success) 
                {
                    clear_inputs_error(form);
                    clear_form(form);                            
                    var render = '<div class="alert alert-success role="alert"><i class="fa fa-check"></i> '+data.message+'</div>';
                    $('#get_errors').html(render);
                    $('#get_errors').show(1000);
                    setTimeout(function(){
                        $('#get_errors').hide(1000);
                    }, 5000);

                    if(modal != null){
                        var oTable = $('#'+tabla).dataTable();
                        oTable.fnDraw(); 
                    }

                    if(url_reload != null){
                        alert('entro');
                        window.location.href=url_reload;
                    }
                    
                } else if (data.error) {
                    alert(data.message);
                }
            }
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });
    return false;
}

function v1_form_edit(form, method, urls, url_reload, modal,  tabla) { 
    $('.save').attr('disabled', true);
    $('.load').html('<center><img src="img/app/load.gif" class="align-items-center" width="15%" heigth="15%" alt="Cargando ..." /></center>');
    $.ajax({
        type: method, 
        url: urls, 
        data: $('#' + form + '').serialize(),
        success: function(data) {
            var html = '';
            //var data = eval('(' + data + ')'); //cuando recibo el json desde el servidor
            $('.save').attr('disabled', false);
            $('.form-content').removeClass('disabled');
            $('.load').html('');
            if (data.fail)
            {                        
                console.log('errores', data);
                var render = '<div class="alert alert-danger" role="alert">Los campos con asterisco(*) son requeridos</div>';
                $('#get_errors').html(render);
                $('#get_errors').show(1000);                
                console.log('index', data.errors['nombre']);               
                setTimeout(function(){
                    $('#get_errors').hide(1000);
                }, 5000);
                get_inputs_error(form, data);
            } else {
                if (data.success) 
                {
                    console.log('request',data.request);
                    clear_inputs_error(form);
                    //clear_form(form)                            
                    var render = '<div class="alert alert-success role="alert"><i class="fa fa-check"></i> '+data.message+'</div>';
                    $('#get_errors').html(render);
                    $('#get_errors').show(1000);

                    setTimeout(function(){
                        $('#get_errors').hide(1000);
                    }, 5000);
                    if(modal != null){
                        var oTable = $('#'+tabla).dataTable();
                        oTable.fnDraw();  
                    } 
                    
                    if(url_reload != null){
                        alert('entro');
                        window.location.href=url_reload;
                    }
                } else if (data.error) {
                    alert(data.message);
                }
            }
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });
    return false;
}


$('#editFor').submit(function(e){
    e.preventDefault();     
    v1_form_edit('editForm', 'POST', 'update');
});


function validarQuery(fieldValue){
    console.log('valida', fieldValue.match( /^[a-zA-Z]+$/));
    /*if(fieldValue.match( /^[a-zA-Z]+$/)){
      alert('noooo cumple')
    }else {
        alert("Validar(Query) Esto no son números");
    }*/

}

//validacion Jquery
var $regexname =/^([a-zA-Z]{3,16})$/;
var $regexnumeros  =  /^[a-zA-Z]+$/;
var $regexemail = /^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/;
$('#nombre').on('keypress keydown keyup',function(){
    if (!$(this).val().match($regexnumeros)) {
        // there is a mismatch, hence show the error message
        $("#error_nombre").html('Valida Query: No puede estar vacio y no puede contener números');
    }else{
        // else, do not display message
        $("#error_nombre").empty();
    }
});

$('#email').on('blur',function(){
    if (!$(this).val().match($regexemail)) {
        // there is a mismatch, hence show the error message
        $("#error_email").html('Valida Query: formato de correo invalido.');
    }else{
        // else, do not display message
        $("#error_email").empty();
    }
});

$('#nombre_').on('keypress keydown keyup',function(){
    if (!$(this).val().match($regexnumeros)) {
        // there is a mismatch, hence show the error message
        $("#error_nombre_").html('Valida Query: No puede estar vacio y no puede contener números');
    }else{
        // else, do not display message
        $("#error_nombre_").empty();
    }
});

$('#email_').on('blur',function(){
    if (!$(this).val().match($regexemail)) {
        // there is a mismatch, hence show the error message
        $("#error_email_").html('Valida Query: formato de correo invalido.');
    }else{
        // else, do not display message
        $("#error_email_").empty();
    }
});

