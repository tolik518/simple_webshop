<?php
declare(strict_types=1);
namespace webShop;
use PHPUnit\Framework\TestCase;

/**
 * @covers \webShop\Factory
 */

class FactoryTest extends TestCase
{
    //TODO: gemockte application aufrufen
    public function testFactoryCanBeConstructed()
    {
        self::assertInstanceOf(Factory::class, new Factory());
    }

    /**
     * @runInSeparateProcess
     */
    public function testCreateApplication()
    {
        $mySqlConnectorMock = $this->getMockBuilder(MySQLConnector::class)
                        ->disableOriginalConstructor()
                        ->getMock();
        $pdoMock = $this->getMockBuilder(\PDO::class)
                        ->disableOriginalConstructor()
                        ->getMock();
        $mySqlConnectorMock->method("getConnection")
                           ->willReturn($pdoMock);

        $_SERVER['REQUEST_URI'] = '';

        $factory = new Factory();
        self::assertInstanceOf(Application::class, $factory->createApplication($mySqlConnectorMock));
    }
}