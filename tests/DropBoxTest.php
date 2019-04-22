<?php

namespace PcMagas\Tests;
use PHPUnit\Framework\TestCase;

final class DropBoxTest extends TestCase
{

    private function generateDropBoxClientForErrorTessting($errorCode)
    {
        $plugin = new Guzzle\Plugin\Mock\MockPlugin();
        $plugin->addResponse(new Guzzle\Http\Message\Response($errorCode));
        $client = new Guzzle\Http\Client();
        $client->addSubscriber($plugin);

        return new Dropbox("dummyappId","dummySecret",$client);
    }

    private function httpErrorTest($errorCode)
    {
        $dropbox=generateDropBoxClientForErrorTessting(400);
    }
}