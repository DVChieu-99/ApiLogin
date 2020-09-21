<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account_table extends Model
{
    use SoftDeletes;
    public $table = 'account_table'; 
}
