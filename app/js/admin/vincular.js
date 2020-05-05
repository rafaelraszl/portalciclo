$(function(){
    //baseUri
    $('head').append('<script src="js/default/baseuri.js" type="text/javascript"></script>');
    //stupidtable
    $(".table").stupidtable();
    //editar
    $('.edit').live('click',function(){
        var id = $(this).attr('id');
        var prof = $(this).attr('prof');
        var mat = $(this).attr('mat');
        
        $('#profmat_prof').val(prof);
        $('#profmat_mat').val(mat);
        
        $('#add-categoria').find('b').html('Editar Relacionamento Professor X Disciplina');
        $('#add-categoria').find('.icon-plus-sign').removeClass('icon-plus-sign').addClass('icon-edit');
        $('#collapseOne').collapse('show');
        $('#btn-add').html('Atualizar');
        $('#f-categoria').attr('action',$('#f-categoria').attr('action').replace('/vincularAdd/','/vincularUp/'+id+'/'));
        $('#professor_nome').removeClass('invalid');
    })
    //cancel
    $('.cancel').live('click',function(){
        $('#sub_categoria').val('');
        $('#collapseOne').collapse('hide'); 
        $('#add-categoria').find('b').html('Criar Relacionamento Professor X Disciplina');
        $('#f-categoria').attr('action',$('#f-categoria').attr('action').replace('/vincularUp/','/vincularAdd/'));
        $('#btn-add').html('Vincular');
        $('#add-categoria').find('.icon-edit').removeClass('icon-edit').addClass('icon-plus-sign');
        $('#professor_nome').removeClass('invalid');
    })
    //remove
    $('.remove').live('click',function(){
        var id = $(this).attr('id');
        $('#modal-remove').modal('show');
        var url = baseUri +'/admin/professor/vincularRem/'+id+'/';
        $('#btn-remove').attr('href',url);
    })      
    //event change
    $('#sub_categoria').live('change',function(){
        if($('#sub_categoria option:selected').val() != ""){
            $('#sub_categoria').removeClass('invalid');            
        }
    })
})
function valida(){
    if($.trim($('#professor_nome').val()) == ""){
        $('#professor_nome').addClass('invalid');
        $('#professor_nome').focus();
        return false;
    }
    else{
        $('#professor_nome').removeClass('invalid');
    }
}

