<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('helloworld',function(){
    return '<h1>Hellos World :) </h1>';
});
Route::get('sayhello/{name}',function(){
    $say = '';
    return '<h1>👍 Hello: ' . request()->name . '</h1>';
});
Route::get('getallpets',function(){
    $pets = App\Models\Pet::take(10)->get();
    dd($pets->toArray());
});
Route::get('show/pet/{id}',function(){
    $pet = App\Models\Pet::find(request()->id);
    dd($pet->toArray());
});

Route::get('view/allpets',function(){
    $pets = App\Models\Pet::all() ;
    return view('listpets')->with('pets',$pets);
});

Route::get('challenge',function(){
    $users = App\Models\User::take(20)->get();
    echo '<table style="border: 1px solid"> 
            <tr style="border: 1px solid; background-color: black; color: white">
                <td style="border: 1px solid">nombre</td>
                <td style="border: 1px solid">Correo</td>
                <td style="border: 1px solid">Telefono</td>
                <td style="border: 1px solid">Edad</td>
                <td style="border: 1px solid">Creado</td>
                <td style="border: 1px solid">photo</td>
            </tr>';
    foreach ($users as $user) {
        echo '<tr style="border: 1px solid">';
        $name=$user->fullname;
        $mail=$user->email;
        $phone=$user->phone;
        $edad = Carbon::parse($user->birthdate)->age;
        $created=$user->created_at->diffForHumans();
        $photo=asset("images/" . $user->photo);
        echo '<td style="border: 1px solid; background-color: gray; color: white">'. $name .' </td>
                <td style="border: 1px solid; background-color: gray; color: white">'. $mail .'</td>
                <td style="border: 1px solid; background-color: gray; color: white">'. $phone .'</td>
                <td style="border: 1px solid; background-color: gray; color: white">'. $edad .' años </td>
                <td style="border: 1px solid; background-color: gray; color: white">' . $created . '</td>
                <td style="border: 1px solid"><img width="50px" height="50px" src="' . $photo . '"></td>
            </tr>';
    }
    echo '</table>';
});

Route::get('view/pet/{id}',function(){
    $pet = App\Models\Pet::find(request()->id);
    return view('showpet')->with('pet',$pet);
});