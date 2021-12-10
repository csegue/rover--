<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function proyecto(Request $request){

/*      
    // Variables para ejecutarlos en localhost
        $instrucciones_movimiento="ALRRALRLRARRSSAAALALRRR"; echo "<br>";
        $pos= strlen($instrucciones_movimiento);
        $orientacion_i= "O";
        $ancho_cuadricula=  16;
        $alto_cuadricula=   16;        
        $posicion_inicial_x= 4;
        $posicion_inicial_y= 6;      
*/
    // Variables para ejecutarlo en Composer 
        $instrucciones_movimiento= $request->input('instrucciones_movimiento');
        $orientacion_i=            $request->input('orientacion_i');
        $ancho_cuadricula=         $request->input('ancho_cuadricula');
        $alto_cuadricula=          $request->input('alto_cuadricula');
        $posicion_inicial_x=       $request->input('posicion_inicial_x');
        $posicion_inicial_y=       $request->input('posicion_inicial_y');
  
        $pos= strlen($instrucciones_movimiento);
  
/*  
        return response()->json([
          'Movimientos'      => $instrucciones_movimiento,
          'Orientacion_ini'  => $orientacion_i,
          'ancho_cuadricula' => $ancho_cuadricula,
          'alto_cuadricula'  => $alto_cuadricula,
          'Pos_inicial_x'    => $posicion_inicial_x,
          'Pos_inicial_y'    => $posicion_inicial_y,
        ]);   
  
        $data=[
          'Movimientos'      => $instrucciones_movimiento,
          'Orientacion_ini'  => $orientacion_i,
          'ancho_cuadricula' => $ancho_cuadricula,
          'alto_cuadricula'  => $alto_cuadricula,
          'Pos_inicial_x'    => $posicion_inicial_x,
          'Pos_inicial_y'    => $posicion_inicial_y,
        ];
        return response()->json($data);
*/
  
  
  //Cálculo Orientación  
  //********************************************************************************************** */
        $orientacion_f= $orientacion_i;
        $orientacion_temp="";
        $array1[]="";
  
        echo "Movimientos :".$instrucciones_movimiento."<br>";
        echo "Orientación inicial: ".$orientacion_i."<br>";
        echo "Movimientos y orientaciones : "."<br>"."<br>"; 
        for($i=0; $i<$pos; $i++ ){
          $accion= substr($instrucciones_movimiento,$i,1);  
  
            //............................................................................................
            if($orientacion_f==="N" && $accion==="L"){
                $orientacion_temp= "O"; 
                echo $i." - "."NL- Movimiento [ ".$accion." ]"." Orientacion final :".$orientacion_temp."<br>"; 
              };   
            if($orientacion_f==="N" && $accion==="R"){
                $orientacion_temp= "E"; 
                echo $i." - "."NR- Movimiento [ ".$accion." ]"." Orientacion final :".$orientacion_temp."<br>";  
              };   
            //............................................................................................
            if($orientacion_f==="S" && $accion==="L"){
                $orientacion_temp= "E"; 
                echo $i." - "."SL- Movimiento [ ".$accion." ]"." Orientacion final :".$orientacion_temp."<br>";  
              };
            if($orientacion_f==="S" && $accion==="R"){
                $orientacion_temp= "O"; 
                echo $i." - "."SR- Movimiento [ ".$accion." ]"." Orientacion final :".$orientacion_temp."<br>";  
              };
            //............................................................................................
            if($orientacion_f==="E" && $accion==="L"){
                $orientacion_temp= "N"; 
                echo $i." - "."EL- Movimiento [ ".$accion." ]"." Orientacion final :".$orientacion_temp."<br>";  
              };
            if($orientacion_f==="E" && $accion==="R"){
                $orientacion_temp= "S"; 
                echo $i." - "."ER- Movimiento [ ".$accion." ]"." Orientacion final :".$orientacion_temp."<br>";  
              };
            //............................................................................................
            if($orientacion_f==="O" && $accion==="L"){
                $orientacion_temp= "S"; 
                echo $i." - "."OL- Movimiento [ ".$accion." ]"." Orientacion final :".$orientacion_temp."<br>";  
              };
            if($orientacion_f==="O" && $accion==="R"){
                $orientacion_temp= "N"; 
                echo $i." - "."OR- Movimiento [ ".$accion." ]"." Orientacion final :".$orientacion_temp."<br>";  
              };
            //............................................................................................  
            if($accion==="A" && $i==0 ){
              $orientacion_temp= $orientacion_f;   
              echo $i." - "."AA- Movimiento [ ".$accion." ]"." Orientacion final :".$orientacion_f."<br>";  
              $desplaza1= $orientacion_f.$accion;
              array_push($array1,$desplaza1);
            };
            if($accion==="A" && $i>0){    
              echo $i." - "."AA- Movimiento [ ".$accion." ]"." Orientacion final :".$orientacion_temp."<br>";  
              $desplaza1= $orientacion_temp.$accion;
              array_push($array1,$desplaza1);
            };
            //............................................................................................
              
              $orientacion_f= $orientacion_temp;
            
            //............................................................................................  
          }
  
            echo "<hr>";     
  
  //Validar posición dentro de su cuadrícula
  //********************************************************************************************** */
  
        echo "Margenes antes de movimientos"."<br>";  
          echo "m_de: ".$margen_der= $ancho_cuadricula-$posicion_inicial_x; echo "<br>";
          echo "m_iz: ".$margen_izq= $posicion_inicial_x-1;                   echo "<br>";
          echo "m_sp: ".$margen_sup= $alto_cuadricula-$posicion_inicial_y;  echo "<br>";
          echo "m_if: ".$margen_inf= $posicion_inicial_y-1;   echo "<br>"."<br>";
        
        echo "Avances del Rover:";  
          for($j=0; $j<count($array1);$j++) {
              echo $array1[$j];
                  if($array1[$j]=="NA"){$margen_sup -=1; $margen_inf +=1;
                    if($margen_sup <0 || $margen_inf <0 ){
                      return " - WARNING - El Rover se sale de la cuadrícula";
                    }else{
                      echo " - "."Movimiento VALIDO";
                    };
                  };
  
                  if($array1[$j]=="SA"){$margen_sup +=1; $margen_inf -=1;
                    if($margen_sup <0 || $margen_inf <0 ){
                      return " - WARNING - El Rover se sale de la cuadrícula";
                    }else{
                      echo " - "."Movimiento VALIDO";
                    };
                  };
  
                  if($array1[$j]=="EA"){$margen_der +=1; $margen_izq -=1;
                    if($margen_der <0 || $margen_izq <0 ){
                      return " - WARNING - El Rover se sale de la cuadrícula";
                    }else{
                      echo " - "."Movimiento VALIDO";
                    };
                  };
  
                  if($array1[$j]=="OA"){$margen_der -=1; $margen_izq +=1;
                    if($margen_der <0 || $margen_izq <0 ){
                      return " - WARNING - El Rover se sale de la cuadrícula";
                    }else{
                      echo " - "."Movimiento VALIDO";
                    };
                  };
                echo "<br>";
          }
        echo "<br>";
        echo "Margenes despues de movimientos"."<br>";    
            echo "m_de: ".$margen_der."<br>";
            echo "m_iz: ".$margen_izq."<br>";
            echo "m_sp: ".$margen_sup."<br>";
            echo "m_if: ".$margen_inf."<br>";
        echo "<br>";
  
  /*
            if($margen_der <0){ return redirect()->route('proyecto.aviso', "Rover sobrepasa el margen Derecho");}
            if($margen_izq <0){ return redirect()->route('proyecto.aviso', "Rover sobrepasa el margen Izquierdo");}
            if($margen_sup <0){ return redirect()->route('proyecto.aviso', "Rover sobrepasa el margen Superior");}
            if($margen_inf <0){ return redirect()->route('proyecto.aviso', "Rover sobrepasa el margen Inferior");}
  */
  
            if($margen_der <0){ echo "Rover sobrepasa el margen Derecho";}
            if($margen_izq <0){ echo "Rover sobrepasa el margen Izquierdo";}
            if($margen_sup <0){ echo "Rover sobrepasa el margen Superior";}
            if($margen_inf <0){ echo "Rover sobrepasa el margen Inferior";}
  
  
            
  
  
  
  
  
  }
  
  //Aviso movimientos no posibles
  //********************************************************************************************** */          
  
  public function aviso($param){
  
    return "Hola - ".$param;
  
  }
  
  }
  