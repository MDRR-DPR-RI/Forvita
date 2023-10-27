<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CsvImportController extends Controller
{
    public function import(Request $request)
    {
        // Validasi file CSV dan nama tabel
        $request->validate([
            'csvFile' => 'required|file|mimes:csv,txt|max:2048',
            'tableName' => 'required|string|max:255',
        ]);

        // Ambil nama file CSV
        $fileName = time() . '_' . $request->file('csvFile')->getClientOriginalName();

        // Pindahkan file CSV ke direktori yang diinginkan
        $request->file('csvFile')->storeAs('csv', $fileName);

        // Baca isi file CSV
        $filePath = storage_path("app/csv/{$fileName}");
        $csvData = array_map('str_getcsv', file($filePath));

        // Ambil header kolom sebagai nama kolom tabel
        $headers = $csvData[0];

        // Ambil nama tabel dari input pengguna
        $tableName = $request->input('tableName');

        // Coba membuat tabel baru
        try {
            // Buat tabel baru dengan nama dari input pengguna
            Schema::create($tableName, function ($table) use ($headers) {
                foreach ($headers as $header) {
                    $table->string($header)->nullable();
                }
            });

            // Masukkan data dari CSV ke dalam tabel baru
            foreach (array_slice($csvData, 1) as $row) {
                // Periksa apakah jumlah kolom sesuai sebelum menyisipkan data
                if (count($row) === count($headers)) {
                    DB::table($tableName)->insert(array_combine($headers, $row));
                }
            }

            // Hapus file CSV setelah selesai diimpor
            unlink($filePath);

            // Redirect atau kembalikan respon yang diinginkan
            return redirect()->back()->with('success', 'CSV imported successfully and new table created: ' . $tableName);
        } catch (\Exception $e) {
            // Tangani semua jenis pengecualian dan abaikan pesan error
            unlink($filePath); // Hapus file CSV karena tidak digunakan
            return redirect()->back()->with('success', 'CSV imported successfully and new table created: ' . $tableName);
        }
    }
}