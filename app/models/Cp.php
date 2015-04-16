<?php

class Cp extends Eloquent {



    protected $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany('Post');
    }


 public function charakters()
    {
        return $this->belongsToMany('Charakter');
    }

 public function circle()
    {
        return $this->belongsTo('Circle');
    }


}