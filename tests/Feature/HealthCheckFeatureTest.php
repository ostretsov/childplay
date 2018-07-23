<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 23.07.18 8:38.
 */

namespace App\Tests\Feature;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HealthCheckFeatureTest extends WebTestCase
{
    public function testHealthCheck()
    {
        $client = self::createClient();

        $client->request('GET', '/v1/health-check');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }
}
