<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = ['name'];

    public function forms()
    {
      return $this->hasMany(Form::class);
    }
}
