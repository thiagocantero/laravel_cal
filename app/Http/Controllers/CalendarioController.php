<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function index(Request $request)
    {
  
        if($request->ajax()) {
       
             $data = Evento::whereDate('inicio', '>=', $request->start)
                       ->whereDate('fim',   '<=', $request->end)
                       ->get(['id', 'titulo', 'inicio', 'fim']);
  
             return response()->json($data);
        }
  
        return view('calendario');
    }
 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {
 
        switch ($request->type) {
           case 'add':
              $evento = Evento::create([
                  'titulo' => $request->title,
                  'inicio' => $request->start,
                  'fim' => $request->end,
              ]);
 
              return response()->json($evento);
             break;
  
           case 'update':
              $evento = Evento::find($request->id)->update([
                  'titulo' => $request->title,
                  'inicio' => $request->start,
                  'fim' => $request->end,
              ]);
 
              return response()->json($evento);
             break;
  
           case 'delete':
              $evento = Evento::find($request->id)->delete();
  
              return response()->json($evento);
             break;
             
           default:
             # 
             break;
        }
    }
}

