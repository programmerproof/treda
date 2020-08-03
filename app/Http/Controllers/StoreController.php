<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\User;
use App\Store;
use App\Product;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user_id = \Auth::id();
        $search = $request->get('search');
        if($search != ''){
            $stores = Store::nameLike($search)->paginate();
        }else{
            $stores = Store::with('products')->OrderByNameAsc()->paginate();
        }
        return view('store.index', compact('stores'))->with('user', $user_id); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('store.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $exception = '';
        try{
            $user_id = \Auth::id();
            $user = User::find( $user_id);
            $store = new Store();
            $store->user()->associate($user);
            $this->validate($request,
                            [
                            'name'=>'required|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/|max:30', 
                            'opening_date'=>'required|regex:/^([0-9]{1,2})\\-([0-9]{1,2})\\-([0-9]{4})$/', 
                            ]
                        ); 
            $store->name = $request->name;
            $opening_date = \DateTime::createFromFormat('d-m-Y', $request->opening_date)->format('Y-m-d');
            $store->opening_date = $opening_date;
            $store->created_at = date('Y-m-d H:i:s', time());
            $store->save();
        }catch(\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[1];
                $err = '';
                switch ($errorCode) {
                    case 1364:
                        $err = response([
                            'errors'=>$e->getMessage()
                        ],Response::HTTP_NOT_FOUND);
                        $exception = 'Error de trasabilidad.';
                    break;
                }
        }
            
        if($exception != ''){
                return redirect()->back()->with('errorAccess', $exception)->withInput($request->all());
        }else {
                return redirect()->route('store.index')->with('success','Registro creado satisfactoriamente.')
                                ->with('action','create');     
            }  
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
        $show = Store::validate(
        (object) [
                'name' => 'id',
                'value' => $id,
                'success' => function() use($id){
                    $stores = Store::where('id', $id)->with('products')->get();
                    return view('store.show', compact('stores'));
                },
                'err' => function(){
                    return redirect()->route('store.index')->with('errorAccess', 'Esa Tienda no existe.');
                }  
            ]
        );
        return $show;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $edit = Store::validate(
        (object) [
                'name' => 'id',
                'value' => $id,
                'success' => function() use($id){
                    $user_id = \Auth::id();
                    $stores = Store::where('id', $id)->with('products')->get();
                    
                    if($stores[0]->user_id != $user_id){
                        return redirect()->route('store.index')->with('errorAccess', 'No tiene acceso a esa Tienda.');
                    }else{
                        return view('store.edit', compact('stores'));
                    }
                },
                'err' => function(){
                    return redirect()->route('store.index')->with('errorAccess', 'Esa Sucursal no existe.');
                }  
            ]
        );
        return $edit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $exception = '';
    try{
        $user_id = \Auth::id();
        $user = User::find($user_id);
        $store = Store::find($id);
        $store->user()->associate($user);
        $this->validate($request,
                        [
                         'name'=>'required|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/|max:30', 
                         'opening_date'=>'required|regex:/^([0-9]{1,2})\\-([0-9]{1,2})\\-([0-9]{4})$/', 
                        ]
                       );
        $store->name = $request->name;
        $opening_date = \DateTime::createFromFormat('d-m-Y', $request->opening_date)->format('Y-m-d');
        $store->opening_date = $opening_date;
        $store->updated_at = date('Y-m-d H:i:s', time());
        $store->save();
    }catch(\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        $err = '';
        switch ($errorCode) {
            case 1364:
                $err = response([
                    'errors'=>$e->getMessage()
                ],Response::HTTP_NOT_FOUND);
                $exception = 'Error de trasabilidad consulte con el Dpto. de Sistemas.';
            break;
        }
    }
    
    if($exception != ''){
        return redirect()->back()->with('errorAccess', $exception)->withInput($request->all());
    }else {
        return redirect()->route('store.index')->with('success','Registro actualizado satisfactoriamente.')
                         ->with('action','edit');
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
        //
        $destroy = Store::validate(
        (object) [
                'name' => 'id',
                'value' => $id,
                'success' => function() use($id){
                    $user_id = \Auth::id();
                    $stores = Store::find($id);

                    if($stores->user_id != $user_id){
                        return redirect()->route('store.index')->with('errorAccess', 'No tiene acceso a esa Tienda.');
                    }else{
                        $stores->delete();
                        return redirect()->route('store.index')->with('success','Registro eliminado satisfactoriamente.')
                             ->with('action','destroy');
                    }
                },
                'err' => function(){
                    return redirect()->route('store.index')->with('errorAccess', 'Esa Tienda no existe.');
                }  
            ]
        );
        return $destroy;
    }

    /**
     * Display the specific resource
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, $id)
    {
        //
        $result = Store::scopeWhereId($id);
        return \Response::json($result);
    }

    /**
     * Display the specific resource
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function info(Request $request)
    {
        //
        $store_id = $request->get('id');
        $response = Product::info(
            (object) [
                       'store_id' =>  $store_id,
                       'file' => 'public/infoProduct.log',
                       'request' => $request,
                       'name' => 'image',
                       'data' => Product::where('store_id', $store_id)->get([
                                                                     'store_id',
                                                                     'sku',
                                                                     'name', 
                                                                     'description',
                                                                     'value',
                                                                     'image'
                                                                    ]),
                      'success' => function($data) {
                        return array(['result' => array([
                                                    'success' => true,
                                                    'message' => 'The data was obtained satisfactorily.',
                                                    'data' => $data
                                                ])]);    
                        }, 
                        'err' => function(){
                            return array(['result' => array([
                                                       'success' => false,
                                                       'message' => 'There were no data.',
                                                       'data' => array()
                                                     ])]);
                        }  
                    ]
                ); 
        return \Response::json($response);
    }
}
