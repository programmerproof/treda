<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    //
    use SoftDeletes;

    protected $table = 'store';

    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    public $timestamps = false;

    protected $guarded = ['_token'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function scopeNameLike($query, $search){
        return $query->where('name', 'LIKE', '%'.$search.'%');
    }

    public function scopeOrderByNameAsc($query)
    {
        return $query->orderBy('name', 'ASC');
    }

    public function scopeWhereId($query, $id)
    {
        return  $query->where('id', $id)->OrderByNameAsc()->get();
    }

    public static function validate($attr)
    {
       //
       $max = Store::max($attr->name);
       $validator = \Validator::make([$attr->name => $attr->value], [
            $attr->name => 'numeric|max:'.$max
         ]);
        
       if ($validator->fails()) {
           $err = $attr->err;
           return $err();
         } else{
               $success = $attr->success;
               return ($success());
           }
    }
}
