<?php

use App\Http\Controllers\Perubahan\CifController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Belajar API
Route::get('perubahan-cif', [CifController::class, 'BelajarApi']);


 // belajar API basic
//  public function BelajarApi()
//  {
//      $data = Cif::OrderBy('created_at', 'desc')->get();
//      return response()->json([
//          'status' => true,
//          'message' => 'Success',
//          'data' => $data
//      ], 200);
//  }

 // untuk client
 // composer require guzzlehttp/guzzle
 // install guzzle terlebih dahulu
//  public function APIGET()
//  {
//      $client = new Client();
//      $response = $client->request('GET', 'http://ksb-siputa-v2.test/api/perubahan-cif');
//      $data = json_decode($response->getBody()->getContents(), true);

//      return $data;

//      return view('Page.Rbb.neraca.add', [
//          'title' => 'Tambah RAB Neraca',
//          'data' => $data['data']
//      ]);
//  }