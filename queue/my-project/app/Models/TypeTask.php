<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
* table - "type_task"
* @property string $name;

*/
class TypeTask extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = "type_task";

        
    public function user()
    {
        return $this->belongsToMany("\App\Models\User", "users_type_task");
    }

    public function taskss()
    {
        return $this->hasMany("\App\Models\Tasks");
    }

}