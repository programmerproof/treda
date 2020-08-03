<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use SoftDeletes;

    protected $table = 'product';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = ['_token'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function scopeSkuLike($query, $search){
        return $query->where('sku', 'LIKE', '%'.$search.'%');
    }

    public function scopeOrderByNameAsc($query)
    {
        return $query->orderBy('name', 'ASC');
    }

    public static function validate($attr)
    {
       //
       $max = Product::max($attr->name);
       $validator = \Validator::make([$attr->name => $attr->value], [
            $attr->name => 'numeric|max:'.$max
         ]);
        
       if ($validator->fails()) {
           $err = $attr->err;
           $result = Product::where($attr->name, $attr->value);
            if($result->count() > 0 ){
                $success = $attr->success;
                return ($success());
            }else{
                    return $err();
            }
         } else{
               $success = $attr->success;
               return ($success());
           }
    }

    public static function file($attr){
        if($attr->data->hasFile($attr->name) && $attr->type == 'create'){
            $has = true;
            $file = $attr->data->file($attr->name);
            $fileName = uniqid().$file->getClientOriginalName();
            $file->move(public_path($attr->path), $fileName);
            
            $upload = $attr->upload;
            return ($upload(url($attr->path.$fileName)));
        }else
        if($attr->data->hasFile($attr->name) && $attr->type == 'update'){
            $has = true;
            $find = explode('/',$attr->prev);
            $size = count($find);
            $path = $find[$size-3].'/'.$find[$size-2].'/'.$find[$size-1];
            $exist = File::exists($path); 
            if($exist){
                File::delete($path);
            }
            $file = $attr->data->file($attr->name);
            $fileName = uniqid().$file->getClientOriginalName();
            $file->move(public_path($attr->path), $fileName);
            
            $upload = $attr->upload;
            return ($upload(url($attr->path.$fileName)));
        }else
        if(!$attr->data->hasFile($attr->name) && $attr->type == 'update'){
            return '';
        }else
        {
            $err = $attr->err;
            return $err();
        }  
    }

    public static function info($attr)
    {
        if($attr->data->count() > 0){
            if($attr->name == 'image'){
                foreach($attr->data AS $key=>$value){
                    $path = $attr->data[$key]->image;
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    $attr->data[$key]->image = $base64;
                }
            }
            
            Product::logInfo($attr->file,
                             [
                              'date' => date('Y-m-d H:i:s', time()),
                              'message' => 'The data was obtained satisfactorily.',
                              'store_id' => $attr->store_id,
                              'ip' =>  $attr->request->ip(),
                              'host' => $attr->request->server('HTTP_HOST'),
                              'browser_detect' => $attr->request->header('user-agent'),
                              'os' => php_uname()
                             ]);

            $success = $attr->success;
            return ($success($attr->data));
        }else{
            Product::logInfo($attr->file, 
                             [
                              'date' => date('Y-m-d H:i:s', time()),
                              'message' => 'There were no data.',
                              'store_id' => $attr->store_id, 
                              'ip' =>  $attr->request->ip(),
                              'host' => $attr->request->server('HTTP_HOST'),
                              'browser_detect' => $attr->request->header('user-agent'),
                              'os' => php_uname()
                             ]);
            $err = $attr->err;
            return $err();
        }
    }

    private static function logInfo($file , $info){
           $exist = \Storage::exists($file); 
             if($exist){
                 $content = \Storage::get($file);
                 \Storage::put($file, $content.json_encode($info).PHP_EOL);
                }else {
                    \Storage::put($file, json_encode($info).PHP_EOL);
                }
    }

}
