<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class OperationType extends Model
{
   
    protected $table = 'operation_type';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $true = false;
    protected $connection = 'mysql';
}