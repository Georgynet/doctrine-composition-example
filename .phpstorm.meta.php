<?php

namespace PHPSTORM_META
{
    override(\Psr\Container\ContainerInterface::get(0), map([
        '' => '@',
    ]));
    override(\PHPUnit\Framework\TestCase::createMock(0), map([
        '' => '@',
    ]));
}