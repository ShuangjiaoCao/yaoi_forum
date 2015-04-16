<?php


class Charakter extends Eloquent {
   protected $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany('Post');
    }


 public function cps()
    {
        return $this->belongsToMany('Cp');
    }

 public function circle()
    {
        return $this->belongsTo('Circle');
    }


}