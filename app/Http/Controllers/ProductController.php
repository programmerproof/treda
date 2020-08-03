<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\User;
use App\Store;
use App\Product;

class ProductController extends Controller
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
            $products = Product::skuLike($search)->paginate();
        }else{
            $products = Product::with('store')->OrderByNameAsc()->paginate();
        }
        return view('product.index', compact('products'))->with('user', $user_id); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $stores = Store::orderByNameAsc()->get();
        return view('product.create', compact('stores'));
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
            $user = User::find($user_id);
            $store = Store::find($request->store_id);
            $product = new Product();
            $product->user()->associate($user);
            $product->store()->associate($store);
            $this->validate($request,
                            [
                            'sku'=>'required|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/|max:30', 
                            'name'=>'required|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/|max:30', 
                            'description'=>'required|regex:/^([0-9,.()a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9,.()a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/|max:300', 
                            'value'=>'required|numeric|min:1|max:999999999', 
                            'store_id'=>'required|numeric',
                            'image' => 'required|mimes:jpeg,jpg,png,gif,svg|max:10000',
                            ]
                        );            
            $product->sku = $request->sku;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->value = $request->value;
            $exception = Product::file(
                (object) [
                          'type' => 'create',
                          'name' => 'image',
                          'data' => $request,
                          'prev' => '', 
                          'path' => 'img/product/',  
                          'upload' => function($data) use($product){
                                $product->image = $data;
                            }, 
                            'err' => function(){
                                return 'Error cargando el archivo.';
                            }  
                        ]
                    );      
            $product->created_at = date('Y-m-d H:i:s', time());
            $product->save();
        }catch(\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[1];
                $err = '';
                switch ($errorCode) {
                    case 1062: 
                        $err = response([
                            'errors'=>$e->getMessage()
                        ],Response::HTTP_NOT_FOUND);
                        $exception = 'El sku '.$request->sku.' ya existe.';
                    break;
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
                return redirect()->route('product.index')->with('success','Registro creado satisfactoriamente.')
                                ->with('action','create');     
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sku)
    {
        //
        $show = Product::validate(
            (object) [
                'name' => 'sku',
                'value' => $sku,
                'success' => function() use($sku){
                    $products = Product::where('sku', $sku)->with('store')->get();
                    return view('product.show', compact('products'));
                },
                'err' => function(){
                    return redirect()->route('product.index')->with('errorAccess', 'Ese Producto no existe.');
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
        $edit = Product::validate(
        (object) [
                  'name' => 'id',
                  'value' => $id,
                  'success' => function() use($id){
                        $user_id = \Auth::id();
                        $stores = Store::orderByNameAsc()->get();
                        $products = Product::where('id', $id)->with('store')->get();
                        
                        if($products[0]->user_id != $user_id){
                            return redirect()->route('product.index')->with('errorAccess', 'No tiene acceso a ese Producto.');
                        }else{
                            return view('product.edit', compact('products', 'stores'));
                        }
                    },
                    'err' => function(){
                        return redirect()->route('product.index')->with('errorAccess', 'Ese Producto no existe.');
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
        $store = Store::find($request->store_id);
        $product = Product::find($id);
        $product->user()->associate($user);
        $product->store()->associate($store);
        $this->validate($request,
                        [
                         'sku'=>'required|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/|max:30', 
                         'name'=>'required|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/|max:30', 
                         'description'=>'required|regex:/^([0-9,.()a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9,.()a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/|max:300', 
                         'value'=>'required|numeric|min:1|max:999999999', 
                         'store_id'=>'required|numeric',
                         'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048', 
                        ]
                       );
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->value = $request->value;   
        $exception = Product::file(
            (object) [
                      'type' => 'update',
                      'name' => 'image',
                      'data' => $request,
                      'prev' => $product->image, 
                      'path' => 'img/product/',  
                      'upload' => function($data) use($product){
                            $product->image = $data;
                        }, 
                        'err' => function(){
                            return 'Error cargando el archivo.';
                        }  
                    ]
                );
        $product->updated_at = date('Y-m-d H:i:s', time());
        $product->save();
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
        return redirect()->route('product.index')->with('success','Registro actualizado satisfactoriamente.')
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
        $destroy = Product::validate(
            (object) [
                'name' => 'id',
                'value' => $id,
                'success' => function() use($id){
                    $user_id = \Auth::id();
                    $products = Product::find($id);

                    if($products->user_id != $user_id){
                        return redirect()->route('product.index')->with('errorAccess', 'No tiene acceso a ese Producto.');
                    }else{
                        $products->delete();
                        return redirect()->route('product.index')->with('success','Registro eliminado satisfactoriamente.')
                             ->with('action','destroy');
                    }
                },
                'err' => function(){
                    return redirect()->route('product.index')->with('errorAccess', 'Ese Empleado no existe.');
                }  
            ]
        );
        return $destroy;
    }
}
