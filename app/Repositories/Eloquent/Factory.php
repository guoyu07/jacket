<?php
/**
 * Created by PhpStorm.
 * User: caohui
 * Date: 2017/7/16
 * Time: 23:05
 */

namespace App\Repositories\Eloquent;


use App\Models\Article;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Factory implements RepositoryInterface
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model->newQuery();
    }

    public function paginate($pages, $order, Array $where, $columns = ['*'])
    {
        $articles = $this->model->where($where)
            ->orderBy('created_at', $order)
            ->select($columns)
            ->paginate($pages);

        return $articles;
    }

    public function create(Array $data)
    {
        $article = $this->model->create($data);
        return $article;
    }

    public function update($id, Array $data)
    {
        $this->model->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        $this->model->where('id', $id)->delete();
    }

    public function find($id, $columns = ['*'])
    {
        $this->model->select($columns)->find($id);
    }


}

