
<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    $_DATA = json_decode(file_get_contents("php://input"));
class galeria{ 
    public $codigo;
    public $lista;
    public $unidad;
    public function __construct(int $codigo, int $unidad){
        $this->codigo = $codigo;
        $this->unidad = $unidad;
        $this->lista = (object) [
             // De la galería de productos, el usuario introducirá 
             // el código y el número de unidades del producto que desea comprar.
             //  El programa determinará el total a pagar, como una factura. Ejemplo de factura
            111 =>  [
                "Nombre" => "Camisa",
                "Precio" => 50,
            ],
            222 =>  [
                "Nombre" => "Pantalon",
                "Precio" => 52,
            ],
            333 =>  [
                "Nombre" => "Medias",
                "Precio" => 45,
            ],
            444 =>  [
                "Nombre" => "Gorra",
                "Precio" => 85,
            ],
            555 =>  [
                "Nombre" => "Buso",
                "Precio" => 45,
            ],
            888 =>  [
                "Nombre" => "Reloj",
                "Precio" => 98,
            ],
            666 =>  [
                "Nombre" => "Pulsera",
                "Precio" => 832,
            ],
        ];
    }
    public function buscar():object{
        $res = (array) $this->lista;
        $men;
        if(array_key_exists($this->codigo, $res)){
            $men = (object) [
                "Codigo" => $this->codigo,
                "Producto" => $res[$this->codigo]["Nombre"],
                "UnidadesCompradas" => $this->unidad,
                "Total" => $res[$this->codigo]["Precio"] * $this->unidad,
            ];
        }else{
            $men = (object) [
                "Codigo" => "Código inválido",
                "Producto" => "Producto inválido",
                "UnidadesCompradas" => 0,
                "Total" => "Ingrese un código válido",
            ];
        }
        return $men;
    }
}
$obj = new galeria($_DATA->codigo, $_DATA->unidad);
echo json_encode(["Factura" => $obj->buscar()],JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

?>