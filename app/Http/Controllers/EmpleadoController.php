<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use App\Role;
use App\Area;
use App\Empleado;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $request = Request::all();
        $rules = [
            'nombre'        => 'required',
            'email'        => 'required|email|unique:empleados,email,id',
            'sexo'          => 'required',
            'area_id'       => 'required',
            'descripcion'   => 'required',
            'roles'   => 'required|array'
        ];
        $validator = Validator::make($request, $rules);
        if($validator->fails())
        {
            return response()->json(['fail' => true, 'errors' => $validator->getMessageBag()->toArray()]);
        }else
        {
            $id = Empleado::create($request)->id;
            if($id)
            {
                if(!empty($request['roles']))//SI TIENE PARTICIPANTE
                {
                    $empleado = Empleado::find($id);
                    foreach($request['roles'] as $item_id)
                    {
                        $empleado->role()->attach($item_id);
                    }
                } 
                return response()->json(['success' => true, 'message' => 'Guardado correctamente']);
            }
        }
    }

    public function showsTable()
    {
        
        return view('listaEmpleados');
    }

    public function viewTableEmpleado()
    {
        return view('listaEmpleados');
    }

    public function getDatos()
    {
        $arreglo =array();
        $empleados = Empleado::all();
        foreach($empleados as $item)
        {
            array_push($arreglo, array('id'=>$item->id, 'nombre'=>$item->nombre, 'email'=>$item->email, 'sexo'=>$item->sexo, 'area'=>$item->sexo, 'boletin'=>$item->boletin));    
        }
       
       return datatables()->of($arreglo)->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $areas = Area::all()->pluck('nombre', 'id');
        $roles = Role::all()->pluck('nombre', 'id');
        $roles_select = array();
        $empleado = Empleado::find($id);

        foreach($empleado->role as $item){
                
            $roles_select[$item->id] = $item->nombre;
        }
        return view('form.edit', ['empleado'=>$empleado, 'areas'=>$areas, 'roles'=>$roles, 'roles_select'=>$roles_select]);
    }

    public function newModal(){
        $areas = Area::all()->pluck('nombre', 'id');
        $roles = Role::all()->pluck('nombre', 'id');
        $roles_select = array();
        return view('form.newModal', ['areas'=>$areas, 'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $request = Request::all();
        $id = (int) $request['id'];
        $empleado= Empleado::find($id);

        $rules = [
            'nombre'        => 'required',
            'email'        =>  'required|email|unique:empleados,email,'.$id.',id',
            'sexo'          => 'required',
            'area_id'       => 'required',
            'descripcion'   => 'required',
            'roles'   => 'required|array'
        ];
        $validator = Validator::make($request, $rules);
        if($validator->fails())
        {
            return response()->json(['fail' => true, 'errors' => $validator->getMessageBag()->toArray()]);
        }else
        {
            ///$empleado->fill($request);
            if($id)
            {   
                $empleado->nombre  =  $request['nombre'];
                $empleado->email   =  $request['email'];
                $empleado->sexo    =  $request['sexo'];
                $empleado->area_id =  $request['area_id'];
                $empleado->descripcion =  $request['descripcion'];
                $empleado->save();

                if(!empty($request['roles']))//SI TIENE PARTICIPANTE
                {
                    foreach($empleado->role AS $item)
                    {
                        $empleado->role()->detach($item->id);
                    }

                    $empleado = Empleado::find($id);
                    foreach($request['roles'] as $item_id)
                    {
                        $empleado->role()->attach($item_id);
                    }
                } 
                return response()->json(['success' => true, 'message' => 'Guardado correctamente', 'request'=>$request]);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id);
        foreach($empleado->role AS $item)
        {
            $empleado->role()->detach($item->id);
        }
        $delete = $empleado->delete();
        return response()->json($delete);
    }
}
