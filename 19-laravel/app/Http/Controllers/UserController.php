<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PDF\DomPDF\PDF;
use Maatwebsite\Excel\Facades\Excel;
use app\Exports\UsersExport;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$users = User::all();
        $users = User::orderBy('id', 'desc')->paginate(12);
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validation = $request->validate([
            // All rules validation
            'document' => ['required', 'unique:' . User::class],
            'fullname' => ['required', 'string'],
            'gender' => ['required'],
            'birthdate' => ['required', 'date'],
            'photo' => ['required', 'image'],
            'phone' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed'],
        ]);

        if ($validation) {
            //dd($request->all());
            if ($request->hasFile('photo')) {
                $photo = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('images'), $photo);
            }
            // Save User
            $user = new User;
            $user->document = $request->document;
            $user->fullname = $request->fullname;
            $user->gender = $request->gender;
            $user->birthdate = $request->birthdate;
            $user->photo = $photo;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->password = $request->password;

            if ($user->save()) {
                return redirect('users')->with('message', 'The User: ' . $user->fullname . 'was added succesfully.');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $validation = $request->validate([
            // All rules validation
            'document' => ['required', 'unique:' . User::class . ',document,' . $user->id],
            'fullname' => ['required', 'string'],
            'gender' => ['required'],
            'birthdate' => ['required', 'date'],
            'phone' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class . ',email,' . $user->id],
        ]);

        if ($validation) {
            //dd($request->all());
            if ($request->hasFile('photo')) {
                $photo = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('images'), $photo);
                if ($request->originphoto != 'no-photo.png' && file_exists(public_path('images/' . $user->photo))) {
                    unlink(public_path('images/' . $user->photo));
                }
            } else {
                $photo = $request->originphoto;
            }
            // Save User
            $user->document = $request->document;
            $user->fullname = $request->fullname;
            $user->gender = $request->gender;
            $user->birthdate = $request->birthdate;
            $user->photo = $photo;
            $user->phone = $request->phone;
            $user->email = $request->email;

            if ($user->save()) {
                return redirect('users')->with('message', 'The User: ' . $user->fullname . 'was edited succesfully.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        if ($user->photo != 'no-photo.png' && file_exists(public_path('images/' . $user->photo))) {
            unlink(public_path('images/' . $user->photo));
        }
        if ($user->delete()) {
            return redirect('users')->with('message', 'The User: ' . $user->fullname . ' was deleted succesfully.');
        }
    }
    public function pdf(){
    $users = User::all():
    $pdf = PDF::loadView('users.pdf', compact('users'));
    return $pdf->dowload('allusers.pdf');
    }
}
