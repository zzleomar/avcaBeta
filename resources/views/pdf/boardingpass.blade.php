<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Boleto  {{$data['cedula']}}</title>
    <style type="text/css">
      span{
          font: arial;

        font-size: 12px;

      
      }

      div{
        padding: 10px;
      }
    </style>
   
  </head>
  <body>
    <img src="img/boardingpass.png" width="750" height="300" style="position: absolute;"> 
    
    <!-- Lado Derecho -->
    <SPAN style="position: absolute; top: 70 px; left: 30 px;">
      {{$data['cedula']}}
    </SPAN>
    <SPAN style="position: absolute; top: 115 px; left: 30 px;">
      {{$data['nombreapellido']}}
    </SPAN>
    <SPAN style="position: absolute; top: 155 px; left: 30 px;">
      {{$data['origen']}}
    </SPAN>
    <SPAN style="position: absolute; top: 195 px; left: 30 px;">
      {{$data['destino']}}
    </SPAN>
    <SPAN style="position: absolute; top: 155 px; left: 170 px;">
      {{$data['idvuelo']}}
    </SPAN>
    <SPAN style="position: absolute; top: 155 px; left: 280 px;">
      {{$data['fecha']}}
    </SPAN>
    <SPAN style="position: absolute; top: 155 px; left: 370 px;">
       {{$data['hora']}}
    </SPAN>
    <SPAN style="position: absolute; top: 235 px; left: 30 px;">
      {{$data['boletoid']}}
    </SPAN>
    <SPAN style="position: absolute; top: 235 px; left: 180 px;">
      {{$data['equipaje']}}
    </SPAN>
    <SPAN style="position: absolute; top: 235 px; left: 285 px;">
      {{$data['peso']}}
    </SPAN>
    <SPAN style="position: absolute; top: 235 px; left: 380 px;">
      {{$data['sobrepeso']}}
    </SPAN>
    <!-- Lado Izquierdo -->
    <SPAN style="position: absolute; top: 70 px; left: 555 px;">
      @if($data['equipaje'] > 0)
        {{"E - ".$data['equipaje']}}
     
      @else
         {{$data['equipaje']}}
      @endif
      
    </SPAN>
    <SPAN style="position: absolute; top: 70 px; left: 630 px;">
      {{$data['peso']}}
    </SPAN>
    <SPAN style="position: absolute; top: 70 px; left: 700 px;">
      {{$data['sobrepeso']}}
    </SPAN>
    <SPAN style="position: absolute; top: 125 px; left: 550 px;">
      {{$data['cedula']}}
    </SPAN>
    <SPAN style="position: absolute; top: 165 px; left: 550 px;">
      {{$data['nombrecorto']}}
    </SPAN>
    <SPAN style="position: absolute; top: 205 px; left: 565 px;">
      {{$data['origenmin']}}
    </SPAN>
    <SPAN style="position: absolute; top: 205 px; left: 625 px;">
      {{$data['destinomin']}}
    </SPAN>
    <SPAN style="position: absolute; top: 205 px; left: 700 px;">
      {{$data['boletoid']}}
    </SPAN>
    <SPAN style="position: absolute; top: 205 px; left: 700 px;">
      {{$data['boletoid']}}
    </SPAN>
    <SPAN style="position: absolute; top: 245 px; left: 545 px;">
      {{$data['idvuelo']}}
    </SPAN>
    <SPAN style="position: absolute; top: 245 px; left: 614 px;">
      {{$data['fecha']}}
    </SPAN>
    <SPAN style="position: absolute; top: 245 px; left: 675 px;">
      {{$data['hora']}}
    </SPAN>
   
   
   
   


    @for ($i = 1; $i <= $data['equipaje']; $i++)
      <img src="img/maleta.png" width="250" height="250" style="position: absolute; top: 350px; left: 1px"> 
            <SPAN style="position: absolute; top: 410 px; left: 30 px;">
              1
            </SPAN>
            <SPAN style="position: absolute; top: 410 px; left: 190 px;">
              {{$data['boletoid']}}
            </SPAN>
            <SPAN style="position: absolute; top: 445 px; left: 30 px;">
              {{$data['cedula']}}
            </SPAN>
            <SPAN style="position: absolute; top: 485 px; left: 30 px;">
              {{$data['nombreapellido']}}
            </SPAN>
             <SPAN style="position: absolute; top: 515 px; left: 40 px;">
              {{$data['origenmin']}}
            </SPAN>
            <SPAN style="position: absolute; top: 515 px; left: 190 px;">
              {{$data['destinomin']}}
            </SPAN>
            <SPAN style="position: absolute; top: 550 px; left: 20 px;">
              {{$data['idvuelo']}}
            </SPAN>
            <SPAN style="position: absolute; top: 550 px; left: 100 px;">
              {{$data['fecha']}}
            </SPAN>
            <SPAN style="position: absolute; top: 550 px; left: 190 px;">
              {{$data['hora']}}
            </SPAN>
    @endfor
      
    
     


  
  
   



    
   
      
    
   
   
    
    
