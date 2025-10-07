<?php

namespace Controller;

use Model\WaterCalc;

use Exception;

class watercalcController
{
    private $waterModel;

    public function __construct()
    {
        $this->waterModel = new WaterCalc();
    }

    // CALCULO E CLASSIFICAÇÃO 
    public function calculateWeight($weight)
    {
        try {
            $result = [];
            if (!isset($weight) || $weight === "" || is_null($weight)) {
                $result['water']  = "Por favor, informe o peso para obter o seu consumo diário de água.";
            } elseif ($weight > 0) {
               $result['water']  = round($weight * 35 / 1000, 2);
            } else {
                $result['water']  = "O peso deve conter valores positivos.";
            }
            return $result;
        } catch (Exception $error) {
            echo "Erro ao calcular o Consumo diário de água: " . $error->getMessage();
            return false;
        }
    }


    // PEGAR PESO E RESULTADO DO FRONT E ENVIAR PARA O BANCO DE DADOS
    public function save($weight, $waterResult)
    {
        return $this->waterModel->tabWater($weight, $waterResult);
    }
    public function getUserWater()
    {
        return $this->waterModel->getWater();
    }
    public function getUserWaterLastWeek()
    {
        return $this->waterModel->getWaterLastWeek();
    }
}
?>