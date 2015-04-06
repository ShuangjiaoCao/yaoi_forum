<?php

class Update extends \Eloquent {
	//protected $fillable = [];
	 protected $fillable = ['content'];


	 public function post()
  {
    return $this->belongsTo('Post');
  }
}