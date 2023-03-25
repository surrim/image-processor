<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Surrim\ImageProcessor\GdImageProcessor;

class ImageProcessorTest extends TestCase {
    const FILE = __DIR__ . '/test.png';

    public function testGd(): void {
        $imageProcessor = (new GdImageProcessor())->open(self::FILE);
        $this->assertSame($imageProcessor->getSize(), [192, 108]);
    }
}
