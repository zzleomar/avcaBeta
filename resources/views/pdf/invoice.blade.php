<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Example 2</title>
    <style type="text/css">
      span{
        font-size: 12px;
      }
    </style>
   
  </head>
  <body>
    <img src="img/boleto.png" width="750" height="300"> 
    
    <!-- Lado Derecho -->
     <SPAN style="position: absolute; top: 100 px; left: 30 px;">
      {{$data['cedula']}}
    </SPAN>
    <SPAN style="position: absolute; top: 130 px; left: 30 px;">
      {{$data['nombreapellido']}}
    </SPAN>
    <SPAN style="position: absolute; top: 170 px; left: 30 px;">
      {{$data['origen']}}
    </SPAN>
    <SPAN style="position: absolute; top: 170 px; left: 250 px;">
      {{$data['idvuelo']}}
    </SPAN>
    <SPAN style="position: absolute; top: 170 px; left: 360 px;">
      {{$data['fecha']}}
    </SPAN>
    <SPAN style="position: absolute; top: 170 px; left: 440 px;">
       {{$data['hora']}}
    </SPAN>
     <SPAN style="position: absolute; top: 210 px; left: 30 px;">
      {{$data['destino']}}
    </SPAN>
    <SPAN style="position: absolute; top: 240 px; left: 350 px;">
      {{$data['costo']}}
    </SPAN>
    <SPAN style="position: absolute; top: 240 px; left: 110 px;">
      {{$data['embarquehasta']}}
    </SPAN>
    <SPAN style="position: absolute; top: 240 px; left: 250 px;">
      {{$data['asiento']}}
    </SPAN>

    <!-- Lado Izquierdo-->
    <SPAN style="position: absolute; top: 100 px; left: 560 px;">
      {{$data['cedula']}}
    </SPAN>
     <SPAN style="position: absolute; top: 130 px; left: 560 px;">
      {{$data['nombrecorto']}}
    </SPAN>
     <SPAN style="position: absolute; top: 165 px; left: 570 px;">
      {{$data['origen_min']}}
    </SPAN>
    <SPAN style="position: absolute; top: 165 px; left: 705 px;">
      {{$data['destino_min']}}
    </SPAN>
    <SPAN style="position: absolute; top: 205 px; left: 560 px;">
      {{$data['idvuelo']}}
    </SPAN>
    <SPAN style="position: absolute; top: 205 px; left: 620 px;">
      {{$data['fecha']}}
    </SPAN>
    <SPAN style="position: absolute; top: 205 px; left: 700 px;">
      {{$data['hora']}}
    </SPAN>


    <SPAN style="position: absolute; top: 240 px; left: 560 px;">
      {{$data['boletonro']}}
    </SPAN>
    <SPAN style="position: absolute; top: 250 px; left: 635 px;">
      {{$data['embarquehasta']}}
    </SPAN>
    
    <SPAN style="position: absolute; top: 240 px; left: 30 px;">
      {{$data['boletonro']}}
    </SPAN>
     <SPAN style="position: absolute; top: 240 px; left: 700 px;">
      {{$data['asiento']}}
    </SPAN>
    
    

 
  
  </body>
</html>