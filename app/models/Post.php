<?php

class Post extends Eloquent {
 use SoftDeletingTrait;




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

    $num_child =0;
    foreach ($this->comments as $comment) {
     $num_child += $comment->getNumChildrenStr();
     
      //echo( $num_child );
      //$num = $this->comments()->count() + $comment->children()->count();
    }
    $num = $this->comments()->count() + $num_child;
    //$num = strval (intval($this->comments()->count()) +  intval($num_child)); 
  //var_dump( $num );
    //var_dump( $num );

    return $num;
  }
}
