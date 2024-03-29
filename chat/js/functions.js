/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
var janelas = new Array();
var users = new Array();

    function add_janelas(id, nome){
        var html_add='<div class="janela" id="jan_'+id+'"><div class="topo" id="'+id+'"><span>'+nome+'</span><a href="javascript:void(0);" id="fechar">X</a></div><div id="corpo"><div class="mensagens"><ul class="listar"></ul></div><input type="text" class="mensagem" id="'+id+'" maxlength="255"></div></div>';
        $('#janelas').append(html_add);
    }
    
    function abrir_janelas(x){
            $('#contatos ul li a').each(function(){
                    var link = $(this);
                    var id = link.attr('id');

                    if(id == x){
                            link.click();
                    }
            });
    }
    
    var antes = -1;
    var depois = 0;
    
    function verificar(){
            beforeSend: antes = depois;
            
            $('#contatos ul li a').each(function(){
                    var id_u = $(this).attr('id');
                    users.push(id_u);
            });
            var u_online = $('span.online').attr('id');
            users.push(u_online);
            
            $.post('../chat/chat.php', {acao: 'verificar', ids: janelas, users: users}, function(x){

                    if(x.nao_lidos != ''){
                            var arr = x.nao_lidos;
                            for(i in arr){
                                    abrir_janelas(arr[i]);
                            }
                    }

                    if(janelas.length > 0){
                            var mens = x.mensagens;
                            if(mens != ''){
                                    for(i in mens){
                                            $('#jan_'+i+' ul.listar').html(mens[i]).animate({scrollTop:$('#jan_'+i+' ul.listar').height()*1000}, 500);
                                    }
                            }
                    }
                    
                    var users_onlines = x.useronoff;
                    for(i in users_onlines){
                            $('#contatos ul li span#'+i+'').removeClass('on off').addClass(users_onlines[i]);
                    }
                    
                    depois += 1;

            }, 'jSON');

    }
    
    verificar();
    
    $('body').on('click', '.janela', function(){
            var id = $(this).children('.topo').attr('id');
            $.post('../chat/chat.php',{acao: 'mudar_status', user: id});
    });
    
    $('body').on('click', '.comecar', function(){
            var id = $(this).attr('id');
            var nome = $(this).attr('nome');
            janelas.push(id);
            for(var i = 0; i < janelas.length; i++){
                    if(janelas[i] == undefined){
                            janelas.splice(i, 1);
                            i--;
                    }
            }

            add_janelas(id, nome);
            $(this).removeClass('comecar');
            return false;
    });
    
    $('body').on('click', 'a#fechar', function(){
            var id = $(this).parent().attr('id');
            var parent = $(this).parent().parent().hide();
            $('#contatos a#'+id+'').addClass('comecar');

            var n = janelas.length;
            for(i = 0; i < n; i++){
                    if(janelas[i] != undefined){
                            if(janelas[i] == id){
                                    delete janelas[i];
                            }
                    }
            }
    });
    
    $('body').delegate('.topo', 'click', function(){
            var pai = $(this).parent();
            var isto = $(this);

            if(pai.children('#corpo').is(':hidden')){
                    isto.removeClass('fixar');
                    pai.children('#corpo').toggle(100);
            }else{
                    isto.addClass('fixar');
                    pai.children('#corpo').toggle(100);
            }
    });

    setInterval(function(){
            if(antes != depois){
                    verificar();
            }
    }, 2000);
})