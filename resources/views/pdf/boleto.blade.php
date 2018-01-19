<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Boleto  {{$data['cedula']}}</title>
    <style type="text/css">
      span{
          font: arial;

        font-size: 14px;
      
      }
    </style>
   
  </head>
  <body>
    <img src="img/boleto.png" width="750" height="300"> 
    
    <!-- Lado Derecho -->
     <SPAN style="position: absolute; top: 80 px; left: 30 px;">
      {{$data['cedula']}}
    </SPAN>
    <SPAN style="position: absolute; top: 117 px; left: 30 px;">
      {{$data['nombreapellido']}}
    </SPAN>
    <SPAN style="position: absolute; top: 155 px; left: 30 px;">
      {{$data['origen']}}
    </SPAN>
    <SPAN style="position: absolute; top: 195 px; left: 30 px;">
      {{$data['destino']}}
    </SPAN>
    <SPAN style="position: absolute; top: 155 px; left: 350 px;">
      {{$data['idvuelo']}}
    </SPAN>
    <SPAN style="position: absolute; top: 155 px; left: 500 px;">
      {{$data['fecha']}}
    </SPAN>
    <SPAN style="position: absolute; top: 155 px; left: 620 px;">
       {{$data['hora']}}
    </SPAN>
    <SPAN style="position: absolute; top: 235 px; left: 30 px;">
      {{$data['boletoid']}}
    </SPAN>
    <SPAN style="position: absolute; top: 235 px; left: 365 px;">
      {{$data['asiento']}}
    </SPAN>
    <SPAN style="position: absolute; top: 235 px; left: 490 px;">
      {{$data['costo']}}
    </SPAN>
    

    
    
    

 
  
  </body>
</html>