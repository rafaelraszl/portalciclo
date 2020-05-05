$(function(){
    $('head').append('<script src="js/default/baseuri.js" type="text/javascript"></script>');
    $('#cliente_nome').live('change',function(){
        if($('#cliente_nome option:selected').val() != 0){
            $('.list-ano').show();
            $('.btn-cad').find('span').html('de ' + $('#cliente_nome option:selected').text());
            $('.btn-cad').show();
        }
        else{
            $('.list-ano').hide();
            $('.btn-men').hide();
            $('.btn-cad').hide();
            $('#cliente_ano').val(0);
        }
        
    })
    $('#cliente_ano').live('change',function(){
        if($('#cliente_ano option:selected').val() != 0){
            $('.btn-men').find('span').html('de ' + $('#cliente_ano option:selected').text() );
            $('.btn-men').show();
        }
        else{
            $('.btn-men').hide();
        }        
    })
    $('#cliente_ano2').live('change',function(){
        if($('#cliente_ano2 option:selected').val() != 0){
            $('.list-mes').show();
            $('#cliente_mes').val(0)
            $('.btn-t-ano').find('span').html('de ' + $('#cliente_ano2 option:selected').text() );
            $('.btn-t-ano').show();
            $('.btn-t-mes').hide();
        }
        else{
            $('.list-mes').hide();
            $('.btn-t-mes').hide();
            $('.btn-t-ano').hide();
            $('.btn-t-sit').hide(); 
        }        
    })
    $('#cliente_mes').live('change',function(){
        if($('#cliente_mes option:selected').val() != 0){
            $('.btn-t-mes').find('span').html('de ' + $('#cliente_mes option:selected').text() + '/' + $('#cliente_ano2 option:selected').text() );
            $('.btn-t-mes').show();
            $('.list-sit').show();
        }
        else{
            $('.btn-t-mes').hide();
            $('.btn-t-sit').hide(); 
            $('.list-sit').hide(); 
            $('#situacao').val(0);
        }        
    })
    
    $('#situacao').live('change',function(){
        if($('#situacao option:selected').val() != 0){
            $('.btn-t-sit').find('span').html('de ' + $('#situacao option:selected').text()  );
            $('.btn-t-sit').show();
        }
        else{
            $('.btn-t-sit').hide();            
        }        
    })
    
    
    $('.btn-cad').live('click',function(){
        var cliente = $('#cliente_nome option:selected').val();
        var url = baseUri + '/admin/relatorio/imprimir/'+cliente+'/';
        $(this)
        .attr('href',url)
        .attr('target','_blank');                
    })
    
    $('.btn-men').live('click',function(){
        var cliente = $('#cliente_nome option:selected').val();
        var ano = $('#cliente_ano option:selected').val();
        var url = baseUri + '/admin/relatorio/imprimir/'+cliente+'/'+ano+'/';
        $(this)
        .attr('href',url)
        .attr('target','_blank');                
    })
    
    $('.btn-t-ano').live('click',function(){
        var ano = $('#cliente_ano2 option:selected').val();
        var url = baseUri + '/admin/relatorio/total/'+ano+'/';
        $(this)
        .attr('href',url)
        .attr('target','_blank');                
    })
    $('.btn-t-mes').live('click',function(){
        var ano = $('#cliente_ano2 option:selected').val();
        var mes = $('#cliente_mes option:selected').val();
        var url = baseUri + '/admin/relatorio/total/'+ano+'/'+mes+'/';
        $(this)
        .attr('href',url)
        .attr('target','_blank');                
    })
    $('.btn-t-sit').live('click',function(){
        var ano = $('#cliente_ano2 option:selected').val();
        var mes = $('#cliente_mes option:selected').val();
        var sit = $('#situacao option:selected').val();
        var url = baseUri + '/admin/relatorio/totalN/'+ano+'/'+mes+'/'+sit+'/';
        $(this)
        .attr('href',url)
        .attr('target','_blank');                
    })
    
    $('#serie').live('change',function(){
        if($('#serie option:selected').val() != 0){
            $('.btn-serie').show();
        }
        else{
            $('.btn-serie').hide();
        }        
    })
    $('.btn-serie').live('click',function(){
        var sub = $('#serie option:selected').val()
        var url = baseUri + '/admin/relatorio/boletimSerie/'+sub+'/';
        $(this)
        .attr('href',url)
        .attr('target','_blank');  
    })
    
    $('#aluno').live('change',function(){
        if($('#aluno option:selected').val() != 0){
            $('.btn-aluno').show();
        }
        else{
            $('.btn-aluno').hide();
        }        
    })
    $('.btn-aluno').live('click',function(){
        var aluno = $('#aluno option:selected').val()
        var url = baseUri + '/admin/relatorio/boletimAluno/'+aluno+'/';
        $(this)
        .attr('href',url)
        .attr('target','_blank');  
    })
})


