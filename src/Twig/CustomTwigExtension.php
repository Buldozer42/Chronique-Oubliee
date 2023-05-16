<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class CustomTwigExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('class_name', [$this, 'getClassName']),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('json_decode', [$this, 'jsonDecode']),
        ];
    }

    public function jsonDecode($string, $assoc = false)
    {
        return json_decode($string, $assoc);
    }

    public function getClassName($object)
    {
        return (new \ReflectionClass($object))->getShortName();
    }
}
