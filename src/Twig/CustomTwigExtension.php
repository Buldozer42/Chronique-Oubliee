<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class CustomTwigExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('class_name', [$this, 'getClassName']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('json_decode', [$this, 'jsonDecode']),
        ];
    }

    public function jsonDecode($string, $assoc = false): array
    {
        return json_decode($string, $assoc);
    }

    public function getClassName($object): string
    {
        return (new \ReflectionClass($object))->getShortName();
    }
}
