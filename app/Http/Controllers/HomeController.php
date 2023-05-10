<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $search = $request->input('search')??'';
        // $alumnos = Alumno::with('certificados')->where('nombre','LIKE','%'.$search.'%')->orWhere('dni','LIKE','%'.$search.'%')->paginate(20);
        $alumnos = Alumno::with('certificados')->where('nombre','LIKE','%'.$search.'%')->orWhere('dni','LIKE','%'.$search.'%')->orderBy('id','DESC')-> paginate(10);
        
        return view('home',compact('alumnos'));
    }
}
