<?php

namespace Surrim\ImageProcessor;

use Exception;
use Imagick;
use ImagickException;

class ImageMagickImageProcessor extends ImageProcessor {
    private Imagick $image;

    /**
     * @throws ImagickException
     */
    public function open(string $source): ImageMagickImageProcessor {
        $this->image = new Imagick($source);
        return $this;
    }

    /**
     * @throws ImagickException
     */
    function getSize(): array {
        return [$this->image->getImageWidth(), $this->image->getImageHeight()];
    }

    /**
     * @throws Exception
     */
    public function resize(int $size): ImageMagickImageProcessor {
        if ($size > $this->image->getImageWidth()) {
            throw new Exception('No up-scaling');
        }
        $this->image->resizeImage($size, 0, imagick::FILTER_CUBIC, 1);
        return $this;
    }

    /**
     * @throws ImagickException
     */
    public function save(string $target, string $target_ext): ImageMagickImageProcessor {
        $this->image->stripImage();
        $this->image->setImageCompressionQuality(60);
        $this->image->setImageFormat($target_ext);
        $this->image->writeImage($target);
        return $this;
    }
}
