<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Operation extends Model
{
   
    protected $table = 'operation';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $true = false;
    protected $connection = 'mysql';

    public function operationType()
    {
        return $this->belongsTo(OperationType::class);
    }

    public function moneys() {

        return $this->hasMany(Money::class, 'operation_id','id');
    }
}