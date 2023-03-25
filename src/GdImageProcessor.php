<?php

namespace Surrim\ImageProcessor;

use GdImage;
use function getimagesize;
use function imageavif;
use function imagecreatefromavif;
use function imagecreatefromjpeg;
use function imagecreatefrompng;
use function imagecreatefromwebp;
use function imagejpeg;
use function imagepng;
use function imagewebp;
use const IMAGETYPE_AVIF;
use const IMAGETYPE_JPEG;
use const IMAGETYPE_PNG;
use const IMAGETYPE_WEBP;

class GdImageProcessor extends ImageProcessor {
    private GdImage $image;

    public function open(string $source): GdImageProcessor {
        $type = getimagesize($source)[2];
        $this->image = match ($type) {
            IMAGETYPE_AVIF => @imagecreatefromavif($source),
            IMAGETYPE_JPEG => @imagecreatefromjpeg($source),
            IMAGETYPE_PNG => @imagecreatefrompng($source),
            IMAGETYPE_WEBP => @imagecreatefromwebp($source),
        };
        return $this;
    }

    public function getSize(): array {
        return [imagesx($this->image), imagesy($this->image)];
    }

    public function resize(int $size): GdImageProcessor {
        $this->image = imagescale($this->image, $size);
        return $this;
    }

    public function save(string $target, string $target_ext): GdImageProcessor {
        match ($target_ext) {
            'avif' => @imageavif($this->image, $target),
            'jpg' => @imagejpeg($this->image, $target),
            'png' => @imagepng($this->image, $target),
            'webp' => @imagewebp($this->image, $target),
        };
        return $this;
    }
}