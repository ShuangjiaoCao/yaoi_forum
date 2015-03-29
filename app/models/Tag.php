<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Tag extends Eloquent {

    use SoftDeletingTrait;

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany('Post');
    }
}


