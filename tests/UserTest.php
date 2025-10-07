<?php

use Controller\UserController;
use PHPUnit\Framework\TestCase;
use Model\User;

class UserTest extends TestCase {
    private $userController;
    private $mockUserModel;
    protected function setUp (): void {
        $this->mockUserModel = $this->createMock(User::class);
        $this->userController = new UserController($this->mockUserModel);
    }

    #[PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_create_user_with_data_given () {
        $expectedUser = [
            'user_fullname' => 'Bia Mota',
            'email' => 'bia@example.com',
            'password' => password_hash('133', PASSWORD_DEFAULT)
        ];
        $this->mockUserModel->method('registerUser')->willReturn($expectedUser);
        $createdUser = $this->userController->createUser('Bia Mota', 'bia@example.com', '133');
        $this->assertEquals('Bia Mota', $createdUser['user_fullname']);
        $this->assertEquals('bia@example.com', $createdUser['email']);
        $this->assertTrue(password_verify('133', $createdUser['password']));
    }
        
    #[PHPUnit\Framework\Attributes\Test]
    public function it_shouldnt_be_able_to_create_user_with_email_already_used () {
        $this->mockUserModel->method('getUserByEmail')->willReturn([
            'id' => 1,
            'user_fullname' => 'Bia Mota',
            'email' => 'bia@example.com',
            'password' => password_hash('133',PASSWORD_DEFAULT)
        ]);
        $this->mockUserModel->method('registerUser')->willThrowException(new \Exception('Este email já está cadastrado.'));
        $this->expectExceptionMessage('Este email já está cadastrado.');
        $this->userController->createUser('Chata Mota', 'bia@example.com', '133');
    }

    #[PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_sign_in_with_valid_credentials () {
        $this->mockUserModel->method('loginUser')->willReturn([
            'id' => 1,
            'user_fullname' => 'Bia Mota',
            'email' => 'bia@example.com',
            'password' => '133'
        ]);
        $expected = [
            'id' => 1,
            'user_fullname' => 'Bia Mota',
            'email' => 'bia@example.com',
            'password' => '133'
        ];
        $this->assertEquals($expected, $this->userController->loginUser('bia@example.com', '133'));
    }

    #[PHPUnit\Framework\Attributes\Test]
    public function it_shouldnt_be_able_to_login_with_invalid_credentials () {
        $this->mockUserModel->method('loginUser')->willReturn(false);
        $this->assertFalse($this->userController->loginUser('bia@example.com', '132'));
    }
}

?>