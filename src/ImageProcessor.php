<?php

namespace Surrim\ImageProcessor;
abstract class ImageProcessor {
    public abstract function open(string $source): ImageProcessor;

    public function getAspectRatio() {
        [$width, $height] = $this->getSize();
        $gcd = static::gcd($width, $height);
        return ($width / $gcd) . ' / ' . ($height / $gcd);
    }

    public abstract function getSize(): array;

    private static function gcd($x, $y) {
        return $y ? static::gcd($y, $x % $y) : $x;
    }

    public abstract function resize(int $size): ImageProcessor;

    public abstract function save(string $target, string $target_ext): ImageProcessor;
}