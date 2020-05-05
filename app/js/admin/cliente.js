$(function(){
    //baseUri
    $('head').append('<script src="js/default/baseuri.js" type="text/javascript"></script>');
    //formata preco
    $('head').append('<script src="js/jquery/jquery.price.js" type="text/javascript"></script>');
    $('.valor').priceFormat({
        prefix: ''
    });
    //stupidtable
    $(".table").stupidtable();   
    //button submit
    $('#btn-add').live('click',function(){
        $('#f-cliente').submit();
    })
    //editar cliente
    $('.edit').live('click',function(){
        var id = $(this).attr('id');
        window.location = baseUri+'/admin/cliente/editar/'+id+'/';
    })
    //remover anotação de cobrança
    $('.remInfo').live('click',function(){
        var id = $(this).attr('id');
        var cliente = $(this).attr('cliente');
        $('#modal-remove').modal('show');
        var url = baseUri +'/admin/cliente/remInfo/'+id+'/'+cliente+'/';
        $('#btn-remove').attr('href',url);
    })
    //event change
    $('<option>').val('').text('Antes, selecione um turno').appendTo('#cliente_sub');
    $('#cliente_sub').attr('disabled','disabled');
    $('#cliente_categoria').live('change',function(){
        if($('#cliente_categoria option:selected').val() != ""){
            $('<option>').val('').text('carregando séries...').appendTo('#cliente_sub');
            var cat = $('#cliente_categoria option:selected').val();
            var url = baseUri+'/admin/cliente/fillSubCategoria/'+cat+'/'
            $.getJSON(url, {
                cat:cat
            }, 
            function(data){
                $('#cliente_sub option').remove();
                $('#cliente_sub').removeAttr('disabled');
                if(data != 0){
                    $(data.rs).each(function (k,v) {
                        $('<option>').val(v.sub_id).text(v.sub_title).appendTo('#cliente_sub'); 
                    })
                }
                else{
                    $('<option>').val('').text('Nenhuma série cadastrada').appendTo('#cliente_sub');
                    $('#cliente_sub').attr('disabled','disabled');
                }
            })
        }
        else{
            $('#cliente_sub option').remove();
            $('<option>').val('').text('Antes, selecione um turno').appendTo('#cliente_sub');
            $('#cliente_sub').attr('disabled','disabled');
        }
    })    
    //load sub categoria item editar
    loadSub = function (cat) {
        //console.log(cat)
        var url = baseUri+'/admin/cliente/fillSubCategoria/'+cat+'/'
        $.getJSON(url, {
            cat:cat
        }, 
        function(data){
            $('#cliente_sub option').remove();
            $('#cliente_sub').removeAttr('disabled');
            if(data != 0){
                $(data.rs).each(function (k,v) {
                    $('<option>').val(v.sub_id).text(v.sub_title).appendTo('#cliente_sub'); 
                })
            }
            else{
                $('<option>').val('').text('Nenhuma séria cadastrada').appendTo('#cliente_sub');
                $('#cliente_sub').attr('disabled','disabled');
            }
        })    
    }    
    //load sub categoria item editar
    loadSetSub = function (cat,sub) {
        //console.log(cat)
        var url = baseUri+'/admin/cliente/fillSubCategoria/'+cat+'/'
        $.getJSON(url, {
            cat:cat
        }, 
        function(data){
            $('#cliente_sub option').remove();
            $('#cliente_sub').removeAttr('disabled');
            if(data != 0){
                $(data.rs).each(function (k,v) {
                    $('<option>').val(v.sub_id).text(v.sub_title).appendTo('#cliente_sub'); 
                })
            }
            else{
                $('<option>').val('').text('Nenhuma séria cadastrada').appendTo('#cliente_sub');
                $('#cliente_sub').attr('disabled','disabled');
            }
            $('#cliente_sub').val(sub)
        })    
    }    
    //cancel
    $('.cancel').live('click',function(){
        $('#sub_categoria').val('');
        $('#collapseOne').collapse('hide'); 
        $('#add-categoria').find('b').html('Cadastrar Nova Série');
        $('#f-categoria').attr('action',$('#f-categoria').attr('action').replace('/atualizar/','/incluir/'));
        $('#btn-add').html('Cadastrar');
        $('#sub_title').val('');
        $('#add-categoria').find('.icon-edit').removeClass('icon-edit').addClass('icon-plus-sign');
        $('#sub_title').removeClass('invalid');
    })
    //remover item
    $('.remove').live('click',function(){
        var id = $(this).attr('id');
        $('#modal-remove').modal('show');
        var url = baseUri +'/admin/cliente/remover/'+id+'/';
        $('#btn-remove').attr('href',url);
    })    
    
    //atualiza mensalidades
    $('.btn-updateMensal').live('click',function(e){
        e.preventDefault();
        e.stopPropagation();
        var arr = $('#f-mensal').serialize();        
        var url = $('#f-mensal').attr('action');
        $.post(url,{
            arr: arr
        },function(data){
            var pagos = $.parseJSON(data)
            $.each(pagos,function(k,v){
                $('#'+v).addClass('pago');
            })
            notify('<h1>Mensalidades atualizadas com sucesso!</h1>');
        })
    })
//$('#alunos').addClass('active');
//$('#alunos').find('dd > ul > li > a').first().addClass('active');
  
})


function goTo(url) {
    window.location = url;
}