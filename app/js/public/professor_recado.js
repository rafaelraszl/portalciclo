$(function(){
    
    $("#notificacao").focus(function()
    {
        $(this).animate({
            "height": "85px"
        }, "fast" );
        $("#button_block").slideDown("fast");
        return false;
    });

    $("#cancel").click(function()
    {
        $("#notificacao").animate({
            "height": "30px"
        }, "fast" );
        $("#button_block").slideUp("fast");
        $("#notificacao").val('');
        $('#call').popover('hide');
        return false;
    });
        
    $('.unchecked').live('click',function(){
        $(this).attr('src','images/professor/checked.png');
        $(this).removeClass('unchecked').addClass('checked');
        $(this).attr('title','desmarcar');
        var id = $(this).attr('id');
        $('#ch_'+id).val(id);
        $('.tip-left').tooltip('destroy');
        $('.tip-left').tooltip({
            'placement':'left'
        });    
        $('#call').popover('hide');
    })
    
    $('.checked').live('click',function(){
        $(this).attr('src','images/professor/unchecked.png');
        $(this).removeClass('checked').addClass('unchecked');
        $(this).attr('title','marcar');
        var id = $(this).attr('id');
        $('#ch_'+id).val(0);        
        $('.tip-left').tooltip('destroy');       
        $('.tip-left').tooltip({
            'placement':'left'
        });
        $('#call').popover('hide');        
    })
    
    $('.checkAll').live('click',function(){
        $('.unchecked').each(function(){
            $(this).attr('src','images/professor/checked.png');
            $(this).removeClass('unchecked').addClass('checked');
            $(this).attr('title','desmarcar');
            var id = $(this).attr('id');
            $('#ch_'+id).val(id);
            console.log($('#ch_'+id).val())
            
            $('.tip-left').tooltip('destroy');
            $('.tip-left').tooltip({
                'placement':'left'
            });        
        })
        $(this).removeClass('checkAll').addClass('uncheckAll');
        $(this).attr('title','desmarcar todos');
        $('.tip-top').tooltip('destroy');
        $('.tip-top').tooltip({
            'placement':'top'
        });  
        $('#call').popover('hide');
    })
    
    $('.uncheckAll').live('click',function(){
        $('.checked').each(function(){
            $(this).attr('src','images/professor/unchecked.png');
            $(this).removeClass('checked').addClass('unchecked');
            $(this).attr('title','marcar');
            var id = $(this).attr('id');
            $('#ch_'+id).val(0);        
            $('.tip-left').tooltip('destroy');       
            $('.tip-left').tooltip({
                'placement':'left'
            });       
        })
        $(this).removeClass('uncheckAll').addClass('checkAll');
        $(this).attr('title','marcar todos');
        $('.tip-top').tooltip('destroy');
        $('.tip-top').tooltip({
            'placement':'top'
        });       
        $('#call').popover('hide');
    })
    
    $('#sub').live('change',function(){
        var sub = $('#sub option:selected').val()    
        if(sub == ""){
            window.location = baseUri + '/professor/recados/';
        }
        else{
            window.location = baseUri + '/professor/recados/turma/'+sub+'/';
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
