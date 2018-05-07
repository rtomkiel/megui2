<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataDB extends Model
{
     protected $fillable = [
        'database',
        'db_size',
    ];
   
    protected $guarded = ['id', 'created_at', 'update_at'];
    
    protected $table = 'datadb';
    
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
