<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Certificado;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    //
    public function create()
    {
        return view('alumnos.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {

            $request->validate(
                [
                    'dni' => "required",
                    "nombre" => "required"
                ]
            );

            $existsAlumno = !Alumno::where("dni", $request->input('dni'))->get()->isEmpty();

            if ($existsAlumno) {
                return redirect()->route('alumno.create')->with("message", "Ya existe un alumno con el dni: " . $request->input('dni'))->with("status", "danger");
            }

            $alumno = new Alumno();
            $alumno->nombre = $request->input('nombre');
            $alumno->dni = $request->input('dni');

            $result = $alumno->save();
            // $result = true;
            // dd($request->hasFile('file'));
            if ($result == true && $request->has('nombreCertificado') && $request->hasFile('file')) {
                foreach ($request->input('nombreCertificado') as $key => $nombreCert) {
                    $certificado = new Certificado();
                    $certificado->nombre = $nombreCert;
                    $file = pathinfo($request->file('file')[$key]->getClientOriginalName(), PATHINFO_FILENAME) . Carbon::now()->format('YmdHis') .".". $request->file('file')[$key]->getClientOriginalExtension();
                    $request->file('file')[$key]->move(public_path('certificados'), $file);
                    $certificado->file = 'certificados/' . $file;
                    $certificado->id_alumno = $alumno->id;
                    $certificado->save();
                }
            }

            return redirect()->route('home')->with("message", "Alumno creado correctamente")->with("status", "success");
        } catch (\Throwable $th) {
            return redirect()->route('alumno.create')->with('message', "Ocurrió un error al guardar el registro. Error: " . $th->getMessage())->with('status', 'danger');
        }
    }

    public function show($alumno)
    {
        # code...
        $alumno = Alumno::with('certificados')->where('id', $alumno)->first();
        return view('alumnos.show', compact('alumno'));
    }

    public function edit($alumno)
    {
        try {
            $alumno = Alumno::findOrFail($alumno);
            return view('alumnos.edit', compact('alumno'));
        } catch (\Throwable $th) {
            return redirect()->route('alumno.show', ["alumno" => $alumno])->with('message', "Ocurrió un error al buscar el registro. Error: " . $th->getMessage())->with('status', 'danger');
        }
    }

    public function update($alumno, Request $request)
    {
        try {

            $request->validate([
                'nombre' => 'required',
                'dni' => 'required'
            ]);

            $alumno = Alumno::findOrFail($alumno);
            $alumno->nombre = $request->input('nombre');
            $alumno->dni = $request->input('dni');
            $alumno->save();

            return redirect()->route('alumno.show', ['alumno' => $alumno->id])->with('message', "Alumno actualizado correctamente")->with('status', "success");
        } catch (\Throwable $th) {
            return redirect()->route('alumno.edit', ["alumno" => $alumno])->with('message', "Ocurrió un error al actualizar el registro. Error: " . $th->getMessage())->with('status', 'danger');
        }
    }
}
