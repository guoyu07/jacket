<?php
/**
 * Created by PhpStorm.
 * User: caohui
 * Date: 2017/7/16
 * Time: 22:42
 */

namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    public function paginate($pages, $order, Array $where, $columns = ['*']);

    public function create(Array $data);

    public function update($id, Array $data);

    public function delete($id);

    public function find($id, $columns = ['*']);
}