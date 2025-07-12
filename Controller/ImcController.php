<?php

namespace Controller;

use Model\Imcs;
use Exception;

class ImcController
{

    private $imcsModel;

    public function __construct()
    {
        $this->imcsModel = new Imcs();
    }

    //CALCULO E CLASSIFICAÇÃO 
    public function calculateImc($weight, $height)
    {
        try {
            /*  Exemplo de cálculo de IMC
            * $result = {
            * "Imc": 22.82,
            * "BMIrange" : "Sobrepeso"
            * ];
            */

            $result = [];
            if(isset($weight) or isset($height)){
                if($weight > 0 and $height > 0){
                    $imc = round($weight / ($height * $height), 2);
                    $result['imc'] = $imc;

                    $result['BMIrange'] = match (true){
                        $imc < 18.5 => 'Abaixo do peso',
                        $imc >= 18.5 && $imc < 24.9 => 'Peso normal',
                        $imc >= 25 and $imc < 29.9 => 'Sobrepeso',
                        $imc >= 30 and $imc < 34.9 => 'Obesidade grau I',
                        $imc >= 35 and $imc < 39.9 => 'Obesidade grau II',
                        default => 'Obesidade grau III ou mórbida'
                    };
                } else {
                    $result['BMIrange'] = "O peso e altura deve conter alturas menores.";
                }
                
            } else {
                $result['BMIrange'] = "Por favor, informe peso e altura para obter o seu IMC.";
            }
        } catch (Exception $error) {
            echo "Erro ao calcular o IMC:" . $error->getMessage();
            return false;
        }
    }
}
?>