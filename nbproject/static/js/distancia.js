var map;
function formatNumber(number)
{
    //number.toFixed(0) representa o número de casa decimais = 0
    number = number.toFixed(0) + '';
    x = number.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}
function initialize()
{
   // Carrega o Google Maps
    if (GBrowserIsCompatible()) {
            map = new GMap2(document.getElementById("mapa"));
            map.setCenter(new GLatLng(-3.74530, -38.53075), 11)
            
            // Cria o objeto de roteamento
             var dir = new GDirections(map);
             //verifica qual radio foi selecionado
             if (document.formTrajeto.ponto1[0].checked) 
             {
         	var pt1 = document.getElementById("ponto1").value
                document.getElementById("ponto1persist").value = "Casa";
             }else{
                 var pt1 = document.getElementById("ponto1-1").value
                 document.getElementById("ponto1-1persist").value = "Computex";
             }
            
            //pega o valor da pesquisa
             var pt2 = document.getElementById("ponto2").value
            
            //verifica qual radio foi selecionado
            if (document.formTrajeto.ponto3[0].checked) 
             {
         	var pt3 = document.getElementById("ponto3").value
                document.getElementById("ponto3persist").value = "Casa";
             }else{
                 var pt3 = document.getElementById("ponto3-1").value
                 document.getElementById("ponto3-1persist").value = "Computex";
             }

             // Carrega os pontos dados os endereços
            dir.loadFromWaypoints([pt1,pt2,pt3], {locale:"pt-br", getSteps:true});
           // O evento load do GDirections é executado quando chega o resultado do geocoding.
           GEvent.addListener(dir,"load", function() {
                var route1 = dir.getRoute(0);
                var dist1 = route1.getDistance()
                $('#ab').val(dist1.meters);

                var route2 = dir.getRoute(1);
                var dist2 = route2.getDistance();
                
                $('#bc').val(dist2.meters);
                
                var total = dist1.meters + dist2.meters;
                //adciona 10% de depreciação
                
                total = total + (20*total/100);
                
                total = formatNumber(total);
                
                $('#abc').val(total);
                 
           });

        }
}