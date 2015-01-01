<?php
namespace Valiknet\MusicBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;

class AppFixture extends DataFixtureLoader
{
    /**
     * {@inheritDoc}
     */
    protected function getFixtures()
    {
        return  array(
            __DIR__.'/fixtures.yml',
        );
    }
}
