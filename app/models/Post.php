<?php

class Post extends Eloquent {
 use SoftDeletingTrait;
 use Conner\Tagging\TaggableTrait;




 protected $fillable = ['title', 'content'];


   // one-to-many relationship with the Comment model
  public function comments()
  {
    return $this->hasMany('Comment');
  }

 public function tags()
    {
        return $this->belongsToMany('Tag');
    }


public function user()
    {
        return $this->belongsTo('User');
    }


  // helper function to get the URL of a post
  public function getURL()
  {
    return URL::action('viewPost', array('id' => $this->id));
  }

  // helper function to get a string of the number of comments
  public function getNumCommentsStr()
  {
    $num = $this->comments()->count();

    return $num . ' 评论';
  }
}
