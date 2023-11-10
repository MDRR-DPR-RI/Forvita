<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmbedTableauController extends Controller
{
  public function refresh(Request $request)
  {
    // Your data to be sent in the POST request
    $postData = [
      'username' => 'mentee'
    ];

    // Make a POST request
    $response = Http::post('https://visualisasi.dpr.go.id/trusted', $postData);

    // Get the response body as a string
    $responseBody = $response->body();

    // Display the response body
    dd($responseBody);
    // return back()->with(['response' => $responseBody]);
  }
}
