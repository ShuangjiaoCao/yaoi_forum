<?php

class Circle extends Eloquent {



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


