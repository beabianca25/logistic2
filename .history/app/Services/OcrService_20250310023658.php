<?php

namespace App\Services;

use thiagoalessio\TesseractOCR\TesseractOCR;

class OcrService
{
    public function extractText($filePath)
    {
        return (new TesseractOCR(storage_path("app/public/{$filePath}")))->run();
    }
}
