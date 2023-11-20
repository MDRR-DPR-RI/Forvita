<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\ListImport;

class CsvImportController extends Controller
{
    public function show()
    {
        return view('etc.tables.csv-file', [
            'csvFiles' => ListImport::where('type', 'csv')
                ->get()
        ]);
    }
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

        // Ambil nama tabel dari input pengguna
        $tableName = $request->input('tableName');

        if (Schema::hasTable($tableName)) {
            return redirect()->back()->with('deleted', 'Failed to import! The name is exits from tables!');
        }

        $isExists = ListImport::where('name', $tableName)->exists();
        if ($isExists) {
            return redirect()->back()->with('deleted', 'CSV imported failed because data is exits!');
        } else {
            DB::table('list_imports')->insert([
                'name' => $tableName,
                'file' => $fileName,
                'type' => 'csv',
            ]);

            return redirect()->back()->with('success', 'CSV imported successfully with name : ' . $tableName);
        }
    }

    public function createTable(Request $request)
    {
        // Coba membuat tabel baru
        $request->validate(['id' => 'required']);
        $idImport = $request->query('id');
        $data = ListImport::find($idImport);
        if ($data) {
            $tableName = $data->name;
            $fileName = $data->file;
            $filePath = storage_path("app/csv/{$fileName}");
            $csvData = array_map('str_getcsv', file($filePath));

            // Ambil header kolom sebagai nama kolom tabel
            $headers = $csvData[0];
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
                // unlink($filePath);
                $data->action = 1;
                $data->save();

                // Redirect atau kembalikan respon yang diinginkan
                return redirect()->back()->with('success', 'CSV imported successfully and new table created: ' . $tableName);
            } catch (\Exception $e) {
                // Tangani semua jenis pengecualian dan abaikan pesan error
                // unlink($filePath); // Hapus file CSV karena tidak digunakan
                $data->action = 1;
                $data->save();
                return redirect()->back()->with('success', 'CSV imported successfully and new table created: ' . $e);
            }
        } else {
            return redirect()->back()->with('deleted', 'Data not valid!');
        }
    }

    public function removeTable(Request $request)
    {
        // Coba membuat tabel baru
        $request->validate(['id' => 'required']);
        $idImport = $request->query('id');
        $data = ListImport::find($idImport);
        if ($data) {
            // Tangani semua jenis pengecualian dan abaikan pesan error
            $filePath = storage_path("app/csv/{$data->file}");
            unlink($filePath); // Hapus file CSV karena tidak digunakan
            $data->delete();
            return redirect()->back()->with('success', 'CSV file success deleted!');
        } else {
            return redirect()->back()->with('deleted', 'Data not valid!');
        }
    }

    public function deleteTable(Request $request)
    {
        // Coba membuat tabel baru
        $request->validate(['id' => 'required']);
        $idImport = $request->query('id');
        $data = ListImport::find($idImport);
        if ($data) {
            try {
                Schema::dropIfExists($data->name);
                $data->action = 0;
                $data->save();
                return redirect()->back()->with('success', 'CSV table success deleted!');
            } catch (\Exception $e) {
                return redirect()->back()->with('success', 'CSV table error deleted!');
            }
        } else {
            return redirect()->back()->with('deleted', 'Data not valid!');
        }
    }
}
