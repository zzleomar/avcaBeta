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
    <SPAN style="position: absolute; top: 110 px; left: 30 px;">
      {{$data['nombreapellido']."SIIIIIIIIII"}}
    </SPAN>
    <SPAN style="position: absolute; top: 110 px; left: 560 px;">
      Machado Jesus
    </SPAN>
    <SPAN style="position: absolute; top: 150 px; left: 30 px;">
      {{$data['origen']."NOOOOOOOO"}}
    </SPAN>
     <SPAN style="position: absolute; top: 150 px; left: 250 px;">
      {{$data['idvuelo']}}
    </SPAN>
     <SPAN style="position: absolute; top: 150 px; left: 350 px;">
      {{$data['fecha']}}
    </SPAN>
    <SPAN style="position: absolute; top: 150 px; left: 430 px;">
       {{$data['hora']}}
    </SPAN>
     <SPAN style="position: absolute; top: 150 px; left: 560 px;">
      {{$data['origen_min']}}
    </SPAN>
    <SPAN style="position: absolute; top: 150 px; left: 690 px;">
      {{$data['destino_min']}}
    </SPAN>
    <SPAN style="position: absolute; top: 190 px; left: 30 px;">
      {{$data['destino']}}
    </SPAN>
    <SPAN style="position: absolute; top: 190 px; left: 555 px;">
      {{$data['idvuelo']}}
    </SPAN>
    <SPAN style="position: absolute; top: 190 px; left: 615 px;">
      {{$data['fecha']}}
    </SPAN>
    <SPAN style="position: absolute; top: 190 px; left: 665 px;">
      {{$data['hora']}}
    </SPAN>
    <SPAN style="position: absolute; top: 240 px; left: 555 px;">
      {{$data['boletonro']}}
    </SPAN>
    <SPAN style="position: absolute; top: 240 px; left: 625 px;">
      {{$data['embarquehasta']}}
    </SPAN>
    <SPAN style="position: absolute; top: 240 px; left: 695 px;">
      {{$data['asiento']}}
    </SPAN>
    <SPAN style="position: absolute; top: 240 px; left: 25 px;">
      {{$data['boletonro']}}
    </SPAN>
    <SPAN style="position: absolute; top: 240 px; left: 110 px;">
      {{$data['embarquehasta']}}
    </SPAN>
    <SPAN style="position: absolute; top: 240 px; left: 250 px;">
      {{$data['asiento']}}
    </SPAN>

 
  
  </body>
</html>