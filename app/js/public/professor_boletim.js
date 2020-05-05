$(function(){
       
    $('#sub').live('change',function(){
        var sub = $('#sub option:selected').val()    
        if(sub == ""){
            window.location = baseUri + '/professor/boletim/';
        }
        else{
            window.location = baseUri + '/professor/boletim/turma/'+sub+'/';
        }
    })
        
    $('#mat').live('change',function(){
        var sub = $('#sub option:selected').val()    
        var mat = $('#mat option:selected').val()    
        if(mat == ""){
            window.location = baseUri + '/professor/boletim/turma/'+sub+'/';
        }
        else{
            window.location = baseUri + '/professor/boletim/turma/'+sub+'/disciplina/'+mat+'/';
        }
    })
    
    $('.btfake').live('click',function(e){
        e.preventDefault();
        if($('#titulo').val() == ""){
            poprr('titulo','Informe o título do arquivo','');
            $('#titulo').focus();
        }
    })
    
    $('.matdelete').live('click',function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#modal-remove').modal('show');
        var url = baseUri+'/professor/removeMaterial/'+id+'/';
        $('#btn-remove').attr('href',url);        
    //window.location = baseUri+'/professor/removeMaterial/'+id+'/';
    })
    
    $('#aluno').live('change',function(){
        var sub = $('#sub option:selected').val()    
        var mat = $('#mat option:selected').val()         
        var aluno = $('#aluno option:selected').val()    
        if(aluno == ""){
            window.location = baseUri + '/professor/boletim/turma/'+sub+'/disciplina/'+mat+'/';
        }
        else{
            window.location = baseUri + '/professor/boletim/turma/'+sub+'/disciplina/'+mat+'/aluno/'+aluno+'/';
        }
    })    
 
})
function valida() {
    var flag = false;
    $('.checked').each(function(){
        var id = $(this).attr('id');
        if( $('#ch_'+id).val() != 0)
        {
            flag = true;
        }
    })
    if(flag == true){
        if( $.trim ( $('#assunto').val()) == '')
        {
            poprr('callr','Campo obrigatório','<p>Por favor, informe o assunto da mensagem!</p>');
            flag = false;
        }
        if( $.trim ( $('#notificacao').val()) == '')
        {
            poprr('callr','Campo obrigatório','<p>Por favor, digite a mensagem!</p>');
            flag = false;
        }
    }
    else{
        poprr('call','Campo obrigatório','<p>Por favor, selecione os destinatarios!</p>');
    }
    return flag;        
}            
           
function poprr(elm,title,html) {
    $('#'+elm).popover({
        placement:'top',
        title:title,
        html: true, 
        content:html
    });         
    $('#'+elm).popover('show');
    setTimeout(function(){
        $('#'+elm).popover('hide');
    },4000)
    return false;
}
