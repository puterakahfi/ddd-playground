<?php

namespace Tests\Leos\Infrastructure\CommonBundle\Factory;

use Lakion\ApiTestCase\ApiTestCase;
use Tests\Leos\Infrastructure\CommonBundle\Factory\Fixture\FixtureFactory;

class FactoryTest extends ApiTestCase
{

    /**
     * @group unit
     *
     * @expectedException Leos\Infrastructure\CommonBundle\Exception\Form\FormFactoryException
     */
    public function testConstruct()
    {
        new FixtureFactory($this->client->getContainer()->get('form.factory'));
    }
}