<?php

require_once 'Model/ChatModel.php';
use PHPUnit\Framework\TestCase;

class ChatModelTest extends TestCase
{
    private $chatModel;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->chatModel = new ChatModel();
    }

    public function testSend()
    {
        $this->assertSame(1, $this->chatModel->send(1, ['message' => 'Test']));
    }
}