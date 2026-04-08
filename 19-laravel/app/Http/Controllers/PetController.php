<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PetsExport;
use App\Imports\PetsImport;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$pets = Pet::all();
        $pets = Pet::orderBy('id', 'desc')->paginate(12);
        return view('pets.index')->with('pets', $pets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validation = $request->validate([
            // All rules validation
            'document' => ['required', 'unique:' . Pet::class],
            'fullname' => ['required', 'string'],
            'gender' => ['required'],
            'birthdate' => ['required', 'date'],
            'photo' => ['required', 'image'],
            'phone' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Pet::class],
            'password' => ['required', 'confirmed'],
        ]);

        if ($validation) {
            //dd($request->all());
            if ($request->hasFile('photo')) {
                $photo = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('images'), $photo);
            }
            // Save Pet
            $pet = new Pet;
            $pet->document = $request->document;
            $pet->fullname = $request->fullname;
            $pet->gender = $request->gender;
            $pet->birthdate = $request->birthdate;
            $pet->photo = $photo;
            $pet->phone = $request->phone;
            $pet->email = $request->email;
            $pet->password = $request->password;

            if ($pet->save()) {
                return redirect('pets')->with('message', 'The Pet: ' . $pet->fullname . 'was added succesfully.');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        //
        return view('pets.show')->with('pet', $pet);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        //
        return view('pets.edit')->with('pet', $pet);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        //
        $validation = $request->validate([
            // All rules validation
            'document' => ['required', 'unique:' . Pet::class . ',document,' . $pet->id],
            'fullname' => ['required', 'string'],
            'gender' => ['required'],
            'birthdate' => ['required', 'date'],
            'phone' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Pet::class . ',email,' . $pet->id],
        ]);

        if ($validation) {
            //dd($request->all());
            if ($request->hasFile('photo')) {
                $photo = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('images'), $photo);
                if ($request->originphoto != 'no-photo.png' && file_exists(public_path('images/' . $pet->photo))) {
                    unlink(public_path('images/' . $pet->photo));
                }
            } else {
                $photo = $request->originphoto;
            }
            // Save Pet
            $pet->document = $request->document;
            $pet->fullname = $request->fullname;
            $pet->gender = $request->gender;
            $pet->birthdate = $request->birthdate;
            $pet->photo = $photo;
            $pet->phone = $request->phone;
            $pet->email = $request->email;

            if ($pet->save()) {
                return redirect('pets')->with('message', 'The Pet: ' . $pet->fullname . 'was edited succesfully.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        //
        if ($pet->photo != 'no-photo.png' && file_exists(public_path('images/' . $pet->photo))) {
            unlink(public_path('images/' . $pet->photo));
        }
        if ($pet->delete()) {
            return redirect('pets')->with('message', 'The Pet: ' . $pet->fullname . ' was deleted succesfully.');
        }
    }

    /**
     * Export a file to pdf
     * @return void
     */
    public function pdf()
    {
        $pets = Pet::all();
        $pdf = PDF::loadView('pets.pdf', compact('pets'));
        return $pdf->download('allpets.pdf');

    }

    public function excel()
    {
        return Excel::download(new PetsExport,'allpets.xlsx');

    }

    public function import(Request $request){
        $file=$request->file('file');
        Excel::import(new PetsImport, $file);
        return redirect()->back()->with('message','Pets imported succesfsful!');
    }

    /**
     * Search
     */

    Public function search(Request $request){
        $pets = Pet::names($request->q)->orderBy('id','desc')->paginate(12);
        return view('pets.search')->with('pets',$pets);
    }
}