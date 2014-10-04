/**
  * Função para criar um objeto XMLHTTPRequest
  */
 function CriaRequest() {
     try{
         request = new XMLHttpRequest();        
     }catch (IEAtual){
         
         try{
             request = new ActiveXObject("Msxml2.XMLHTTP");       
         }catch(IEAntigo){
         
             try{
                 request = new ActiveXObject("Microsoft.XMLHTTP");          
             }catch(falha){
                 request = false;
             }
         }
     }
     
     if (!request) 
         alert("Seu Navegador não suporta Ajax!");
     else
         return request;
 }
  function CriaRequest2() {
     try{
         request2 = new XMLHttpRequest();        
     }catch (IEAtual){
         
         try{
             request2 = new ActiveXObject("Msxml2.XMLHTTP");       
         }catch(IEAntigo){
         
             try{
                 request2 = new ActiveXObject("Microsoft.XMLHTTP");          
             }catch(falha){
                 request2 = false;
             }
         }
     }
     
     if (!request2) 
         alert("Seu Navegador não suporta Ajax!");
     else
         return request2;
 }
 /**
  * Fun��o para enviar os dados
  */
 
 
 function getDados() {
     
     // Declaração de Variáveis
     var pesquisa   = document.getElementById("pesquisa").value;
     var result = document.getElementById("ponto2");
     var result2 = document.getElementById("ponto2persist");
     var loading = document.getElementById("loading");
     var xmlreq = CriaRequest();
     var xmlreq2 = CriaRequest2();
     
     // Exibi a imagem de progresso
     loading.innerHTML = '<img src="../static/img/loading.gif"/>';
     
     // Iniciar uma requisi��o
     
     xmlreq.open("GET", "../control/ConsultaEscola.php?pesquisa=" + pesquisa, true);
     xmlreq2.open("GET", "../control/ConsultaEscola2.php?pesquisa=" + pesquisa, true);

     // Atribui uma fun��o para ser executada sempre que houver uma mudan�a de ado
     xmlreq.onreadystatechange = function(){
         
         // Verifica se foi conclu�do com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.value = xmlreq.responseText;
                 result2.value = xmlreq2.responseText;
                 loading.innerHTML = null;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
                 result2.innerHTML = "Erro: " + xmlreq2.statusText;
             }
         }
     };
     
     xmlreq.send(null);
     xmlreq2.send(null);
 }