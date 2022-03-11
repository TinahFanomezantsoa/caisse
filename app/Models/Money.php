<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Money extends Model
{
   
    protected $table = 'moneys';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $true = false;
    protected $connection = 'mysql';

    
}