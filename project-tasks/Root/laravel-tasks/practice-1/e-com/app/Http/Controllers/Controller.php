<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;


abstract class Controller
{
    //

    public function exportToCSV(array $data, array $headers, string $fileName = 'export.csv')
    {
        $responseHeaders = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        $callback = function () use ($data, $headers) {
            $handle = fopen('php://output', 'w');

            // Write header row
            fputcsv($handle, $headers);

            // Write each row of data
            foreach ($data as $row) {
                // Ensure we only export keys that match the headers
                $csvRow = [];
                foreach ($headers as $key) {
                    $csvRow[] = $row[$key] ?? ''; // fallback if key doesn't exist
                }

                fputcsv($handle, $csvRow);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, $responseHeaders);
    }

}
