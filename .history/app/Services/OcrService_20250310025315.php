<?php

namespace App\Services;

use Spatie\PdfToText\Pdf;
use thiagoalessio\TesseractOCR\TesseractOCR;

class OcrService // ✅ Added missing class declaration
{
    public function extractText($filePath)
    {
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    
        if ($extension === 'pdf') {
            return Pdf::getText(storage_path("app/public/{$filePath}"));
        } elseif (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            return (new TesseractOCR(storage_path("app/public/{$filePath}")))
                ->executable('C:\Program Files\Tesseract-OCR\tesseract.exe') // ✅ Set correct path
                ->run();
        }
    
        return null;
    }
    
}
