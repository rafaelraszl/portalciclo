$(function(){
    
    //notify plugin
    $('head').append('<link href="js/jquery/notify/style.css" rel="stylesheet" type="text/css" />');
    $('head').append('<script src="js/jquery/notify/notify.js" type="text/javascript"></script>');
    $('dt').find('b').removeClass('icon-chevron-down');
    //tables
    $('.tabler b').tooltip({
        placement:'top'
    });
    $('.btn-action').live('click',function(){
        //$(this).button('loading');
        });
    $('.tips').tooltip({
        placement:'right'
    });  
    $('.tips-top').tooltip({
        placement:'top'
    });    
    $('.tips-left').tooltip({
        placement:'left'
    });    
    $('.tips-bottom').tooltip({
        placement:'bottom'
    });    
    $('.tips-right').tooltip({
        placement:'right'
    });   
    //$('#dash').popover({placement:'right',title:'Dashboard',html: true, content:'Informações das últimas ocorrências do site'});
    var url = window.location.href.split('/');
    base = url[5];
    link = url[6];
    $('#nav-left').find('dt').removeClass('active');
    $('#nav-left').find('ul > li > a').removeClass('active');
    if(base != ""){
        $('.'+base).addClass('active');
    }
    else{
        $('.home').addClass('active');    
    }
    $('#nav-left').find('dd > ul > li > a').each(function(){
        var murl = window.location.href;
        if( $(this).attr('href') == murl){
            $(this).addClass('active');
        }
    })
    
//:contains("+link+")
})

function popr(elm,title,msg,place) {
    $('#'+elm).popover({
        placement:place,
        title:title,
        html: true, 
        content: msg
    }); 
    $('#'+elm).popover('show');
}


function refreshTips() {
       
    $('.tips').tooltip('hide');
    $('.tips').removeData('tooltip'); 
    $('.tips').tooltip({
        placement:'right'
    });  
    $('.tips-top').tooltip('hide');
    $('.tips-top').removeData('tooltip'); 
    $('.tips-top').tooltip({
        placement:'top'
    });    
    $('.tips-left').tooltip('hide');
    $('.tips-left').removeData('tooltip'); 
    $('.tips-left').tooltip({
        placement:'left'
    });    
    $('.tips-bottom').tooltip('hide');
    $('.tips-bottom').removeData('tooltip'); 
    $('.tips-bottom').tooltip({
        placement:'bottom'
    });    
    $('.tips-right').tooltip('hide');
    $('.tips-right').removeData('tooltip'); 
    $('.tips-right').tooltip({
        placement:'right'
    });    
}
