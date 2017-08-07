<?php
/**
 * Created by PhpStorm.
 * User: caohui
 * Date: 2017/7/16
 * Time: 22:54
 */

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

}