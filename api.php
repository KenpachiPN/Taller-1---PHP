
<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    $_DATA = json_decode(file_get_contents("php://input"));
// class galeria{ 
//     public $codigo;
//     public $lista;
//     public $unidad;
//     public function __construct(int $codigo, int $unidad){
//         $this->codigo = $codigo;
//         $this->unidad = $unidad;
//         $this->lista = (object) [
//             // Escribir un programa que permita ingresar para los N alumnos de una universidad:
//             // SEXO (‘M’ o ‘F’), edad y carrera (‘A’,’B’,’C’). Imprimir la carrera con menor 
//             // promedio de edad de sus alumnos que son varones
//             111 =>  [
//                 "Nombre" => "Camisa",
//                 "Precio" => 50,
//             ],
//             222 =>  [
//                 "Nombre" => "Pantalon",
//                 "Precio" => 52,
//             ],
//             333 =>  [
//                 "Nombre" => "Medias",
//                 "Precio" => 45,
//             ],
//             444 =>  [
//                 "Nombre" => "Gorra",
//                 "Precio" => 85,
//             ],
//             555 =>  [
//                 "Nombre" => "Buso",
//                 "Precio" => 45,
//             ],
//             888 =>  [
//                 "Nombre" => "Reloj",
//                 "Precio" => 98,
//             ],
//             666 =>  [
//                 "Nombre" => "Pulsera",
//                 "Precio" => 832,
//             ],
//         ];
//     }
//     public function buscar():object{
//         $res = (array) $this->lista;
//         $men;
//         if(array_key_exists($this->codigo, $res)){
//             $men = (object) [
//                 "Codigo" => $this->codigo,
//                 "Producto" => $res[$this->codigo]["Nombre"],
//                 "UnidadesCompradas" => $this->unidad,
//                 "Total" => $res[$this->codigo]["Precio"] * $this->unidad,
//             ];
//         }else{
//             $men = (object) [
//                 "Codigo" => "Código inválido",
//                 "Producto" => "Producto inválido",
//                 "UnidadesCompradas" => 0,
//                 "Total" => "Ingrese un código válido",
//             ];
//         }
//         return $men;
//     }
// }
// $obj = new galeria($_DATA->codigo, $_DATA->unidad);
// echo json_encode(["Factura" => $obj->buscar()],JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
class universidad{ 
    public $sexo;
    public $edad;
    public $lista;
    public $carrera;

    public function __construct(string $sexo, string $carrera, int $edad){
        $this->sexo = $sexo;
        $this->carrera = $carrera;
        $this->edad = $edad;
        
        // Escribir un programa que permita ingresar para los N alumnos de una universidad:
        // SEXO (‘M’ o ‘F’), edad y carrera (‘A’,’B’,’C’). Imprimir la carrera con menor 
        // promedio de edad de sus alumnos que son varones

        
        $data = json_decode(file_get_contents($this->carrera.".json"), true);
        array_push($data, (object) [
            "Universidad" =>  [
                "Sexo" => $this->sexo,
                "Edad" => $this->edad,
            ]
        ]);
        $file = fopen($this->carrera.".json", "w+");
        fwrite($file, json_encode($data, JSON_PRETTY_PRINT));
        fclose($file);
        
    }

}
 //https://www.php.net/manual/es/function.min.php
$obj = new universidad($_DATA->sexo, $_DATA->carrera, $_DATA->edad);
// echo json_encode(["Factura" => $obj->buscar()],JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>