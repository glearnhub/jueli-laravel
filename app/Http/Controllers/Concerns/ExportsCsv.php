<?php

namespace App\Http\Controllers\Concerns;

use App\Exports\GenericExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

trait ExportsCsv
{
    /**
     * Render an export in whichever format the caller asked for
     * (?format=xlsx|pdf|csv, defaults to csv) using one shared row set.
     */
    private function respondWithExport(array $headings, array $rows, string $title, string $filenamePrefix): Response|BinaryFileResponse|StreamedResponse
    {
        $filename = $filenamePrefix.'-'.now()->format('Y-m-d-His');

        return match (request('format', 'csv')) {
            'xlsx' => Excel::download(new GenericExport($headings, $rows), "{$filename}.xlsx"),
            'pdf' => Pdf::loadView('admin.exports.pdf', compact('title', 'headings', 'rows'))->download("{$filename}.pdf"),
            default => $this->csvResponse(array_merge([$headings], $rows), $filenamePrefix),
        };
    }

    private function csvResponse(array $rows, string $filenamePrefix): Response
    {
        $handle = fopen('php://temp', 'w+');
        foreach ($rows as $row) {
            fputcsv($handle, $row);
        }
        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        $filename = $filenamePrefix . '-' . now()->format('Y-m-d-His') . '.csv';

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }
}
