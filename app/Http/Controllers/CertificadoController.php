<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Certificado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CertificadoController extends Controller
{
    //
    public function create(Request $request)
    {
        // dd($request->input());
        $alumno = Alumno::findOrFail($request->input('alumno'));
        return view("certificado.create",compact('alumno'));
    }

    public function store(Request $request)
    {
        
        
        $request->validate([
            "alumno"=>"required",
            "nombre"=>"required|string",
            "file"=>"required|file|mimes:pdf"
        ]);
        // dd($request->input('alumno'));
        $alumno = Alumno::findOrFail($request->input('alumno'));
        // dd($alumno);

        // $alumno = Alumno::findOrFail($request->input('alumno'));
        // // dd($request->hasFile('file'));
        if($request->hasFile('file')){

            // $file = Storage::disk('public')->put('certificados',$request->file('file'));
            // $file = $request->file('file')->store('certificados');
            $file = $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('certificados'),$file);
            $certificado = new Certificado();
            $certificado->id_alumno = $alumno->id;
            $certificado->nombre = $request->input('nombre');
            $certificado->file = 'certificados/'.$file; 
            $certificado->save();

            return redirect()->route('alumno.show',['alumno'=>$alumno->id])->with('message',"Certificado subido correctamente")->with('status','success');

        }
        // $certificado = new Certificado();


    }

    public function edit($certificado,Request $request)
    {
        try {
            
            $certificado = Certificado::findOrFail($certificado);
            $alumno = Alumno::findOrFail($request->input('alumno'));
            return view('certificado.edit',compact('certificado','alumno'));
            
        } catch (\Throwable $th) {
            return redirect()->route('alumno.show',['alumno'=>$request->input('alumno')])->with('message','Ocurrió un error al buscar certificado')->with('status','danger');
        }
    }

    public function destroy($certificado,Request $request)
    {
        // dd($request->input('alumno'));
        try {

            $certificado = Certificado::findOrFail($certificado);
            $res = $certificado->delete();
            // dd(public_path().$certificado->file);
            $fileDelete = File::delete(public_path().'/'.$certificado->file);
            
            if($res){
                if($fileDelete){
                    return redirect()->route('alumno.show',['alumno'=>$request->input('alumno')])->with('message',"Se eliminó el certificado correctamente")->with('status',"success");
                }
                return redirect()->route('alumno.show',['alumno'=>$request->input('alumno')])->with('message',"Se eliminó el registro correctamente. Ocurrió una excepción al eliminar el archivo, puede que el archivo no exista.")->with('status',"warning");
            }
        } catch (\Throwable $th) {
            return redirect()->route('alumno.show',['alumno'=>$request->input('alumno')])->with('message','Ocurrió un error al borrar el certificado. Error: '.$th->getMessage())->with('status','danger');
            //throw $th;
        }
    }
}
