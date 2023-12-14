<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/check-gd', function () {
    if (extension_loaded('gd')) {
        return 'GD extension is enabled!';
    } else {
        return 'GD extension is not enabled!';
    }
  });
  
// Route::get('/', function () {
//     //return view (‘welcome');
//     return 'Halaman Homepage. <br> 
//     Selamat belajar Laravel!';

// });

// Route::get('about', function () 
// {
//     return 'Aplikasi <strong> laravelapp</strong> dibuat sebagai latihan untuk mempelajari Laravel.';
// }
// );


// Route::get('/', function() {
// 	return view('pages/homepage');
// });


// Route::get('about', function() {
//     $halaman = 'about';
//     return view('pages.about', compact('halaman'));
// });




// //route latian penamaan alias
// Route::get('halaman-rahasia', ['as' => 'secret', function(){
// 	return 'Anda sedang melihat <strong>Halaman Rahasia</strong>';
//         }
//     ]
// );
// //manggil route yang atas
// Route::get('showmesecret', function(){
//     return redirect()->route('secret');
//   }
// );

//route latian penamaan alias
Route::get('halaman-rahasia', ['as' => 'secret', 'uses' => 'RahasiaController@halamanRahasia'
    ]
);
//manggil route yang atas
Route::get('showmesecret', function(){
    return redirect()->route('secret');
    }
);

// Route ::get('siswa', function() {
//     $halaman= 'siswa';
// 	$siswa = ['Rasmus Lerdorf', 'Taylor Otwell', 'Brendan Eich', 'John Resig'];
// 	return view('siswa.index', compact('halaman','siswa'));
// });


Route::group(['middlewareGroups'=>['web']], function()
{
    
    Route::get('/', 'PagesController@homepage');
    Route::get('about', 'PagesController@about');

    $this->get('login', 'Auth\AuthController@showLoginForm');
    $this->post('login', 'Auth\AuthController@login');
    $this->get('logout', 'Auth\AuthController@logout');

    Route::get('register',function(){
        return redirect('/');
    });

    Route::resource('user','UserController');
    Route::get('siswa/cari','SiswaController@cari');
    Route::resource('siswa','SiswaController');
    Route::resource('kelas','KelasController');
    Route::resource('hobi','HobiController');

});

Route::get('tes-collection','SiswaController@tesCollection');

Route::get('date-mutator','SiswaController@dateMutator');

Route::auth();


