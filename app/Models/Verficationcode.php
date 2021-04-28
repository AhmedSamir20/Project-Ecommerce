<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verficationcode extends Model
{

    protected $table = 'verficationcodes';

    protected $fillable=['code','user_id','create_at','update_at'];
}
