<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Circle extends Eloquent {

    use SoftDeletingTrait;

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->hasMany('Post');
    }


 public function charakters()
    {
        return $this->hasMany('Charakter');
    }

     public function cps()
    {
        return $this->hasMany('Cp');
    }



}


