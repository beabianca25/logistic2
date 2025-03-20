<?php

namespace App\Services;

use Spatie\PdfToText\Pdf;
use thiagoalessio\TesseractOCR\TesseractOCR;

class OcrService  // ✅ Ensure this class is correctly declared
{
    public function extractText($filePath)
    {
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $fullFilePath = storage_path("app/public/{$filePath}"); // ✅ Full file path

        if (!file_exists($fullFilePath)) {
            return "Error: File does not exist at path {$fullFilePath}";
        }

        if ($extension === 'pdf') {
            return Pdf::getText($fullFilePath);
        } elseif (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            return (new TesseractOCR($fullFilePath))
                ->executable('C:\Program Files\Tesseract-OCR\tesseract.exe') // ✅ Ensure correct path
                ->run();
        }

        return "Error: Unsupported file type.";
    }
}
