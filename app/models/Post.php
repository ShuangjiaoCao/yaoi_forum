<?php

class Post extends Eloquent {
 use SoftDeletingTrait;
 use Conner\Tagging\TaggableTrait;




 protected $fillable = ['title', 'content', 'circle'];


   // one-to-many relationship with the Comment model
  public function comments()
  {
    return $this->hasMany('Comment');
  }

    public function updates()
  {
    return $this->hasMany('Update');
  }

 public function tags()
    {
        return $this->belongsToMany('Tag');
    }

 public function users()
    {
        return $this->belongsToMany('User');
    }



     public function circle()
    {
        return $this->belongsTo('Circle');
    }

    public function charakters()
    {
        return $this->belongsToMany('Charakter');
    }

    public function cps()
    {
        return $this->belongsToMany('Cp');
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
