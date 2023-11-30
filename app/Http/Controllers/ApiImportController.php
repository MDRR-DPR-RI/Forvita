<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use App\Models\ListImport;

class ApiImportController extends Controller
{
    public function show()
    {
        return view('etc.tables.api-list', [
            'apiLists' => ListImport::where('type', 'api')->get(),
            'pageApi' => true
        ]);
    }

    public function import(Request $request)
    {
        $url = $request->input('api_url');
        $tableName = $request->input('tableName') . '_' . time();

        if (Schema::hasTable($tableName)) {
            return redirect()->back()->with('deleted', 'Gagal mengimpor! Nama sudah ada dalam tabel!');
        }

        $isExists = ListImport::where('name', $tableName)->exists();
        if ($isExists) {
            return redirect()->back()->with('deleted', 'Gagal mengimpor API karena nama sudah ada!');
        } else {
            DB::table('list_imports')->insert([
                'name' => $tableName,
                'file' => $url,
                'type' => 'api',
            ]);

            return redirect()->back()->with('success', 'API berhasil diimpor dengan nama: ' . $tableName);
        }
    }

    public function createTable(Request $request)
    {
        $request->validate(['id' => 'required']);
        $idImport = $request->query('id');
        $data = ListImport::find($idImport);
        if ($data) {
            $tableName = $data->name;
            $url = $data->file;
            // Ambil data JSON dari API
            $jsonData = $this->fetchDataFromApi($url);

            // Inisialisasi variabel untuk menyimpan nama kolom
            $firstRow = reset($jsonData);
            $columnNames = [];

            // Periksa tipe data dari elemen pertama (objek atau string)
            if (gettype($firstRow) == 'string') {
                // Jika itu string, ekstrak nama kolom dari kunci JSON
                $columnNames = array_keys($jsonData);
            } else {
                // Jika itu array, asumsikan JSON bersarang dan ekstrak nama kolom dari baris kedua
                if (gettype($firstRow) == 'array') {
                    $secondRow = reset($firstRow);
                    $columnNames = array_keys($secondRow);
                }
            }

            // Buat tabel database baru dengan nama tabel yang dihasilkan dan kolom dinamis
            Schema::create($tableName, function (Blueprint $table) use ($columnNames) {
                $table->id();
                $table->timestamps();

                // Buat kolom tabel berdasarkan nama kolom yang diekstrak
                foreach ($columnNames as $columnName) {
                    $table->string($columnName, 1000); // Tentukan kolom string dengan panjang maksimum 1000 karakter
                }
            });

            // Masukkan data JSON ke dalam tabel yang baru dibuat
            if (gettype($firstRow) == 'string') {
                // Jika itu string, masukkan seluruh objek JSON sebagai satu baris
                DB::table($tableName)->insert($jsonData);
            } else {
                // Jika itu array, masukkan setiap objek JSON bersarang sebagai baris terpisah
                if (gettype($firstRow) == 'array') {
                    foreach ($firstRow as $row) {
                        DB::table($tableName)->insert($row);
                    }
                }
            }
            $data->action = 1;
            $data->save();

            // Redirect kembali ke halaman sebelumnya dengan pesan keberhasilan
            return redirect()->back()->with('success', 'Import berhasil, dan tabel baru dibuat: ' . $tableName);
        } else {
            return redirect()->back()->with('deleted', 'Data tidak valid!');
        }
    }

    public function viewTable(Request $request)
    {
        $request->validate(['id' => 'required']);
        $idImport = $request->query('id');
        $data = ListImport::find($idImport);
        if ($data) {
            return view('etc.view.api-view', [
                'dataAPI' => $data
            ]);
        } else {
            return redirect()->back()->with('deleted', 'Error melihat Data!');
        }
    }

    public function fetchDataFromApi($apiUrl)
    {
        $response = Http::get($apiUrl);

        if ($response->successful()) {
            // Jika permintaan berhasil, Anda dapat mengekstrak data JSON.
            $jsonData = $response->json();

            // Sekarang, $jsonData berisi data respons JSON dari API.
            return $jsonData;
        } else {
            // Tangani kasus di mana permintaan tidak berhasil (mis., penanganan kesalahan).
            return null;
        }
    }

    public function deleteList(Request $request)
    {
        $request->validate(['id' => 'required']);
        $idImport = $request->query('id');
        $data = ListImport::find($idImport);
        if ($data) {
            $data->delete();
            return redirect()->back()->with('deleted', 'Daftar API berhasil dihapus!');
        } else {
            return redirect()->back()->with('deleted', 'Data tidak valid!');
        }
    }

    public function deleteTable(Request $request)
    {
        $request->validate(['id' => 'required']);
        $idImport = $request->query('id');
        $data = ListImport::find($idImport);
        if ($data) {
            try {
                Schema::dropIfExists($data->name);
                $data->action = 0;
                $data->save();
                return redirect()->back()->with('deleted', 'Tabel API berhasil dihapus!');
            } catch (\Exception $e) {
                return redirect()->back()->with('success', 'Tabel API error dihapus!');
            }
        } else {
            return redirect()->back()->with('deleted', 'Data tidak valid!');
        }
    }
}
