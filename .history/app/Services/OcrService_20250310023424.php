<?php

namespace App\Services;

use Spatie\PdfToText\Pdf;
use TesseractOCR;

class OcrService
{
    public function extractText($filePath)
    {
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        if (in_array($extension, ['pdf'])) {
            return Pdf::getText(storage_path("app/public/{$filePath}"));
        } elseif (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            return (new TesseractOCR(storage_path("app/public/{$filePath}")))->run();
        }

        return null;
    }
}
