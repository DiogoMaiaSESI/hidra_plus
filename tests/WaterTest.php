<?php

use Model\WaterCalc;
use PHPUnit\Framework\TestCase;

use Controller\watercalcController;

class WaterTest extends TestCase {

    //IRÁ FAZER A REFERENCIA A CLASSE CONTROLLER
    //RESPONSÁVEL POR REALIZAR A COMUNICAÇÃO COM O BD
    // E A LÓGICA DA APLICAÇÃO
    private $watercalcController;

    // ATRIBUTO DO BD FAKE
    private $mockWaterModel;

    protected function setUp(): void {
        //ACESSANDO O  ATRIBUTO (mockWaterModel) QUE VAI RECEBER A FUNÇÃO CREATEMOCK
        //Em vez de criar uma conexão com o bd real, ele cria o bd fake
        $this->mockWaterModel =$this->createMock(WaterCalc::class);
        //PASSO ESSE FAKE PARA O CONTROLLER , ASSIM ME PERMITE UTILIZAR 
        // AS MESMAS FUNCIONALIDADES , SÓ QUE SEM MODIFICAR O BANCO DE DADOS REAL
        $this->watercalcController = new watercalcController($this->mockWaterModel);
    }

    

    // Verificar a validação/retorno de campos inválidos (menores que 0)
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_shouldnt_be_able_to_calculate_water_with_invalid_inputs() {
        $weight = -55;
        $result = $this->watercalcController->calculateWeight($weight);
        $this->assertEquals('O peso deve conter valores positivos.', $result['water']);
    }


    //  nulos
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_shouldnt_be_able_to_calculate_water_with_null_input () {
        $result = $this->watercalcController->calculateWeight(null);
        $this-> assertEquals('Por favor, informe o peso para obter o seu consumo diário de água.', $result['water']);
    }   

    //obter o peso e calcular
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_get_an_weight(){
        $weight = 55;
        $result=$this -> watercalcController->calculateWeight($weight);
        $this->assertStringNotContainsString('O peso deve conter valores positivos.', $result['water']);
        $this->assertStringNotContainsString('Por favor, informe o peso para obter o seu consumo diário de água.', $result['water']);
        $this->assertEquals(1.93, $result['water']);
    }

    #[PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_save_the_water_calculation () {
        $waterResult = $this->watercalcController->calculateWeight(55);
        $this->assertStringNotContainsString('Por favor, informe o peso para obter o seu consumo diário de água.', $waterResult['water']);
        $this->assertStringNotContainsString('O peso deve conter valores positivos.', $waterResult['water']);
        $this->mockWaterModel->expects($this->once())->method('tabWater')->with($this->equalTo(55), $this->equalTo(1.93))->willReturn(true);
        $result = $this->watercalcController->save(55, $waterResult['water']);
        $this->assertTrue($result);
    }
}
?>