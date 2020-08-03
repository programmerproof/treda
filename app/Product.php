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
}
