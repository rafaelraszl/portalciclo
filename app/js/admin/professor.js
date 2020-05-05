$(function(){
    //baseUri
    $('head').append('<script src="js/default/baseuri.js" type="text/javascript"></script>');
    //stupidtable
    $(".table").stupidtable();
    //editar
    $('.edit').live('click',function(){
        var id = $(this).attr('id');
        var nome = $(this).attr('name');
        var login = $(this).attr('log');
        $('#professor_login').val(login);
        $('#add-categoria').find('b').html('Editar Professor');
        $('#add-categoria').find('.icon-plus-sign').removeClass('icon-plus-sign').addClass('icon-edit');
        $('#collapseOne').collapse('show');
        $('#professor_nome').val(nome);
        $('#btn-add').html('Atualizar');
        $('#f-categoria').attr('action',$('#f-categoria').attr('action').replace('/incluir/','/atualizar/'+id+'/'));
        $('#professor_nome').removeClass('invalid');
    })
    //cancel
    $('.cancel').live('click',function(){
        $('#collapseOne').collapse('hide'); 
        $('#add-categoria').find('b').html('Cadastrar Novo Professor');
        $('#f-categoria').attr('action',$('#f-categoria').attr('action').replace('/atualizar/','/incluir/'));
        $('#btn-add').html('Cadastrar');
        $('#professor_nome').val('');
        $('#professor_login').val('');
        $('#professor_senha').val('');
        $('#add-categoria').find('.icon-edit').removeClass('icon-edit').addClass('icon-plus-sign');
        $('#professor_nome').removeClass('invalid');
        $('#professor_senha').removeClass('invalid');
        $('#professor_login').removeClass('invalid');
    })
    //remove
    $('.remove').live('click',function(){
        var id = $(this).attr('id');
        $('#modal-remove').modal('show');
        var url = baseUri +'/admin/professor/remover/'+id+'/';
        $('#btn-remove').attr('href',url);
    })      
    //event change
    $('#sub_categoria').live('change',function(){
        if($('#sub_categoria option:selected').val() != ""){
            $('#sub_categoria').removeClass('invalid');            
        }
    })
    $('input').attr('autocomplete','off');
})
function valida(){
    var isV = true;
    if($.trim($('#professor_nome').val()) == ""){
        $('#professor_nome').addClass('invalid');
        $('#professor_nome').focus();
        isV = false;
        return false;
    }
    else{
        $('#professor_nome').removeClass('invalid');
    }
    if($.trim($('#professor_login').val()) == ""){
        $('#professor_login').addClass('invalid');
        $('#professor_login').focus();
        isV = false;
        return false;
    }
    else{
        $('#professor_login').removeClass('invalid');
    }
    
    var act = $('#f-categoria').attr('action').split('/');
    act = act[act.length - 2];
    if(act == 'incluir')
    {
        if($.trim($('#professor_senha').val()) == ""){
            $('#professor_senha').addClass('invalid');
            $('#professor_senha').focus();
            return false;
            isV = false;
        }
        else{
            $('#professor_senha').removeClass('invalid');
            isV = true;
        }
    }
    return isV;
}

