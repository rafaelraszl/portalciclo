$(function(){
    $('head').append('<script src="js/default/baseuri.js" type="text/javascript"></script>');
    
    $('.read').live('click',function(){
        var id = $(this).attr('id');
        window.location = baseUri + '/aluno/recados/'+id+'/'
    })
    
    $('#mat').live('change',function(){
        var id = $('#mat option:selected').val();
        if(id != ""){
            window.location = baseUri + '/aluno/material/disciplina/'+id+'/';        
        }else{
            window.location = baseUri + '/aluno/material/';        
        }
    })
 
})
