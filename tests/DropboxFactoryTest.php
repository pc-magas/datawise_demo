<?php

namespace PcMagas\Tests;

use PcMagas\DropBoxFactory;
use PcMagas\Exceptions\FileNotFoundException;
use phpmock\MockBuilder;
use phpmock\functions\FixedValueFunction;
use PHPUnit\Framework\TestCase;

class DropboxFactoryTest extends TestCase
{
    /**
     * Test whether The correct exception is thrown
     * when the configuration file does not exist.
     */
    public function testIfExceptionIsThrownWhenFileDoesNotExist()
    {
        //Kind Ugly But this mock is Isolated and tesat specific.
        $builder = new MockBuilder();
        $builder->setNamespace(__NAMESPACE__)
         ->setName("file_exists")
         ->setFunctionProvider(new FixedValueFunction(FALSE));

        $mockGuzzleClient = $this->getMockBuilder(\GuzzleHttp\Client::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();
        
        $this->expectException(FileNotFoundException::class);
        DropboxFactory::fromIniFile('example.ini', $mockGuzzleClient);
    }

    public function testIfExceptionIsThrownWhenFileMisparsed()
    {
        $this->markTestSkipped('To be implemented.');
    }
}