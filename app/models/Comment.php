<?php

class Comment extends Eloquent {

	protected $table = 'comments';

 protected $fillable = ['name', 'content'];

  // many-to-one relationship with the Post model
  public function post()
  {
    return $this->belongsTo('Post');
  }



 public function children()
    {
        return $this->hasMany('Comment', 'parent_id', 'id');
    }



}
