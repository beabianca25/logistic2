<?php

namespace App\Services;

use Spatie\PdfToText\Pdf;
use thiagoalessio\TesseractOCR\TesseractOCR;

{
    public function extractText($filePath)
    {
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        if ($extension === 'pdf') {
            return Pdf::getText(storage_path("app/public/{$filePath}"));
        } elseif (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            return (new TesseractOCR(storage_path("app/public/{$filePath}")))->run();
        }

        return null;
    }
}
