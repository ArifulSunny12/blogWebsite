<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primarykey = 'id';
    public $incrementing = true;
    protected $keytype = 'int';
    public $timestamps = true; // enable all behavior
    
  // public $timestamps = [ "created_at", "updated_at" ]; // same as true, enable all behavior

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'image_path'
    ];
    public function user(){
      return $this->belongsTo(User::class);
  }
  public function comment()
    {
        return $this->hasMany(comment::class,'post_id','id');
    }
}
