<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $orderBy = 'id'; 

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function Owner(){
        return $this->belongsTo(Owner::class);
    }


}
