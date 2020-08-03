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
}
