<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Comment extends Eloquent {
 use SoftDeletingTrait;
	protected $table = 'comments';

 protected $fillable = ['name', 'content'];

  // many-to-one relationship with the Post model
  public function post()
  {
    return $this->belongsTo('Post');
  }

  public function parent()
    {
        return $this->belongsTo('Comment','parent_id');
    }

 public function children()
    {
        return $this->hasMany('Comment', 'parent_id');
    }



 public function getNumChildrenStr()
  {
   
 $num = $this->children()->count();
    // $num = strval (intval($this->comments()->count()) +  intval($num_child)); 
    //var_dump( $num );

    return $num;
  }

    }