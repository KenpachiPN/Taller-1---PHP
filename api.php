<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
$_DATA = json_decode(file_get_contents("php://input"));
$_DATA->accion = apache_request_headers()["accept"];

class universidad
{
    public $sexo;
    public $edad;
    public $lista;
    public $carrera;

    public function __construct(string $sexo, string $carrera, int $edad)
    {
        $this->sexo = $sexo;
        $this->carrera = $carrera;
        $this->edad = $edad;

        $data = json_decode(file_get_contents($this->carrera . ".json"), true);
        array_push(
            $data,
            (object) [
                "Universidad" => [
                    "Sexo" => $this->sexo,
                    "Edad" => $this->edad,
                ]
            ]
        );
        $file = fopen($this->carrera . ".json", "w+");
        fwrite($file, json_encode($data, JSON_PRETTY_PRINT));
        fclose($file);

    }
    public function Calcular()
    {
        $a = json_decode(file_get_contents("A.json"), true);
        $b = json_decode(file_get_contents("B.json"), true);
        $c = json_decode(file_get_contents("C.json"), true);
        $totalAlumnosCarreras = count($a) + count($b) + count($c);
        $alumnosA = count($a);
        $alumnosB = count($b);
        $alumnosC = count($c);


        $sexoAlumnosA = array_column(array_column($a, 'Universidad'), 'Sexo');
        $edadesVaronesA = 0;
        $totalVaronesA = 0;
        if ($alumnosA) {
            foreach ($sexoAlumnosA as $key => $value) {
                if ($a[$key]["Universidad"]["Sexo"] == "M") {
                    $edadesVaronesA += $a[$key]["Universidad"]["Edad"];
                    $totalVaronesA++;
                }
            }
        }
        $sexoAlumnosB = array_column(array_column($b, 'Universidad'), 'Sexo');
        $edadesVaronesB = 0;
        $totalVaronesB = 0;
        if ($alumnosB) {
            foreach ($sexoAlumnosB as $key => $value) {
                if ($b[$key]["Universidad"]["Sexo"] == "M") {
                    $edadesVaronesB += $b[$key]["Universidad"]["Edad"];
                    $totalVaronesB++;
                }
            }
        }
        $sexoAlumnosC = array_column(array_column($c, 'Universidad'), 'Sexo');
        $edadesVaronesC = 0;
        $totalVaronesC = 0;
        if ($alumnosC) {
            foreach ($sexoAlumnosC as $key => $value) {
                if ($c[$key]["Universidad"]["Sexo"] == "M") {
                    $edadesVaronesC += $c[$key]["Universidad"]["Edad"];
                    $totalVaronesC++;
                }
            }
        }

        $lista = (object) [
            "A" => [
                "Carrera" => "A",
                "Total de edades de los varones" => $edadesVaronesA,
                "Promedio de varones" => ($totalVaronesA) ? $edadesVaronesA / $totalVaronesA : 0,
                "Promedio de varones por el total de alumnos" => $edadesVaronesA / ($alumnosA) ? $alumnosA : 0,
                "Total de alumnos" => $alumnosA,
                "Total de alumnos Varones" => $totalVaronesA
            ],
            "B" => [
                "Carrera" => "B",
                "Total de edades de los varones" => $edadesVaronesB,
                "Promedio de varones" => ($totalVaronesB) ? $edadesVaronesB / $totalVaronesB : 0,
                "Promedio de varones por el total de alumnos" => ($alumnosB) ? $edadesVaronesB / $alumnosB : 0,
                "Total de alumnos" => $alumnosB,
                "Total de alumnos Varones" => $totalVaronesB
            ],
            "C" => [
                "Carrera" => "C",
                "Total de edades de los varones" => $edadesVaronesC,
                "Promedio de varones" => ($totalVaronesC) ? $edadesVaronesC / $totalVaronesC : 0,
                "Promedio de varones por el total de alumnos" => ($alumnosC) ? $edadesVaronesC / $alumnosC : 0,
                "Total de alumnos" => $alumnosC,
                "Total de alumnos Varones" => $totalVaronesC
            ]
        ];
        foreach (glob("*.json") as $file) {
            $file = fopen($file, "w+");
            fwrite($file, "[]");
            fclose($file);
        }
        return $lista;

    }

}

if ($_DATA->accion == "Calcular") {
    $obj = new universidad($_DATA->sexo, $_DATA->carrera, $_DATA->edad);
    echo json_encode(["Promedios" => call_user_func_array([$obj, $_DATA->accion], [])], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} else {
    $obj = new universidad($_DATA->sexo, $_DATA->carrera, $_DATA->edad);
}


?>