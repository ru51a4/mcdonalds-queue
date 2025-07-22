<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
* table - "tasks"
* @property string $uuid;
* @property int $status;

*/
class Tasks extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = "tasks";

        
    public function type()
    {
        return $this->belongsTo("\App\Models\TypeTask");
    }

    public function user()
    {
        return $this->belongsTo("\App\Models\User");
    }

}