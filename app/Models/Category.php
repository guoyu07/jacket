<?php
/**
 * Created by PhpStorm.
 * User: caohui
 * Date: 2017/7/16
 * Time: 22:54
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $guarded = [];

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id');
    }

}