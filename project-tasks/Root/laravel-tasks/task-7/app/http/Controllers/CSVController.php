<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Products;
use FFI\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class CSVController extends Controller
{
    // import excel data into the database
    public function uploadCSV(Request $request)
    {
        $user = $request->user();
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => "Unauthorized access!!"
            ],404);
        }
        // Step 1: Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|file|mimes:csv,txt,excel'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $file = $request->file('csv_file');
            $path = $file->getRealPath();
            $data = array_map('str_getcsv', file($path));

            if (empty($data) || count($data) < 2) {
                return response()->json([
                    'success' => false,
                    'message' => 'CSV file is empty or missing header row.'
                ], 400);
            }

            $header = array_map('strtolower', array_map('trim', $data[0]));
            unset($data[0]);

            $imported = 0;
            foreach ($data as $row) {
                $row = array_combine($header, $row);

                $rowValidator = Validator::make($row, [
                    'name' => 'required|string',
                    'price' => 'required|numeric',
                    'category' => 'required|string',
                    'stock' => 'required|integer',
                ]);

                if ($rowValidator->fails()) {
                    continue; // Optionally collect errors per row
                }

                Products::create([
                    'name' => $row['name'],
                    'price' => $row['price'],
                    'category' => $row['category'],
                    'stock' => $row['stock'],
                ]);

                $imported++;
            }

            DB::commit();
            Log::info("CSV uploaded successful");

            return response()->json([
                'success' => true,
                'message' => "CSV import successful. {$imported} records added."
            ], 201);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('CSV Upload Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing the CSV file.'
            ], 500);
        }
    }

    // show excel data in the application
    public function showData(Request $request){
        $user = $request->user();
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => "Unauthorized access!!"
            ],404);
        }
        $getData = Products::all();
        // dd($getData);
        return response()->json([
            'success' => true,
            'data' => $getData
        ],200);
    }

    // export data to excel
    public function exportData(Request $request){

        $fileName = 'products_export.csv';
        $products = Products::all();

        // Define CSV headers
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
        ];

        // Create CSV content using a callback
        $callback = function () use ($products) {
            $handle = fopen('php://output', 'w');

            // Write the column headers
            fputcsv($handle, ['Name', 'Price', 'Category', 'Stock']);

            // Write each product row
            foreach ($products as $product) {
                fputcsv($handle, [
                    $product->name,
                    $product->price,
                    $product->category,
                    $product->stock,
                ]);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);

    }

    // function using Generic CSV Export Function
    public function exportProducts()
    {
        $products = Products::select('name', 'price', 'category', 'stock', 'created_at')->get();

        $data = $products->toArray();
        $headers = ['name', 'price', 'category', 'stock', 'created_at'];

        return $this->exportToCSV($data, $headers, 'products_export.csv');
    }


}
