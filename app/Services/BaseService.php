<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService
{
    /**
     * @var Builder|Model
     */
    public $model;

    /**
     * BaseService constructor.
     */
    public function __construct()
    {
        $this->model = app($this->model());
    }

    /**
     * @param array $columns
     * @return Collection|Model[]
     */
    public function all($columns = ['*'])
    {
        return $this->model->all(is_array($columns) ? $columns : func_get_args());
    }

    /**
     * @param string $value
     * @param string $key
     * @return \Illuminate\Support\Collection
     */
    public function allForDropDown($value = 'name', $key = 'id')
    {
        return $this->all()->pluck($value, $key);
    }

    /**
     * @param string $value
     * @param string $key
     * @return \Illuminate\Support\Collection
     */
    public function allForVueDropDown($columns = '*', $where = [])
    {
        return $this->model->select($columns)->get();
    }

    /**
     * Return all the models
     * @param  bool  $dataTable
     * @param  array  $columns
     * @return Builder|Builder[]|Collection|Model|Model[]
     */
    public function getAll($dataTable = false, $columns = ['*'])
    {
        if ($dataTable) {
            return $this->model->select($columns);
        }

        return $this->model->all($columns);
    }

    /**
     * @param $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $id
     * @return Collection|Model|null
     */
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return Model|mixed
     */
    public function firstOrNew(array $attributes, array $values = [])
    {
        return $this->model->firstOrNew($attributes, $values);
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return Model|mixed
     */
    public function firstOrCreate(array $attributes, array $values = [])
    {
        return $this->model->firstOrCreate($attributes, $values);
    }

    /**
     * @param $insertData
     * @return Collection|Model|null
     */
    public function create($insertData)
    {
        return $this->model->create($insertData);
    }

    /**
     * @param $where array|integer|Model
     * @param $data
     * @return bool|int
     */
    public function update($where, $data)
    {
        if ($where instanceof Model) {
            return $where->update($data);
        }

        if (is_array($where)) {
            return $this->model->where($where)->update($data);
        }

        return $this->model->findOrFail($where)->update($data);

    }

    /**
     * Update Or Create
     *
     * @param $where
     * @param $data
     * @return Model
     */
    public function updateOrCreate($where, $data)
    {
        return $this->model->updateOrCreate($where, $data);
    }

    /**
     * @param $ids array|int
     * @return bool|int
     */
    public function destroy($ids)
    {
        return $this->model->destroy($ids);
    }

    /**
     * Delete all
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function truncate()
    {
        return $this->model->truncate();
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return $this->model->query();
    }

    /**
     * @param $data
     * @return bool
     */
    public function insert($data)
    {
        return $this->model->insert($data);
    }

    /**
     * @param array $where
     * @param $columns
     * @return Builder|Builder[]|Collection
     */
    public function getWhere(array $where, $columns = ['*'])
    {
        return $this->model->where($where)->get($columns);
    }

    /**
     * @param $column
     * @param  array  $where
     * @param  string[]  $columns
     * @return Builder|Builder[]|Collection
     */
    public function getWhereIn($column, array $where, $columns = ['*'])
    {
        return $this->model->whereIn($column, $where)->get($columns);
    }

    /**
     * @param array $whereNull
     * @param array $columns
     * @return Builder[]|Collection
     */
    public function whereNull(array $whereNull, $columns = ['*'])
    {
        return $this->model->whereNull($whereNull)->get($columns);
    }

    /**
     * Find By columns
     *
     * @param $array
     * @return Builder|Model
     */
    public function findBy($array)
    {
        return $this->model->where($array)->firstOrFail();
    }

    /**
     * @return string
     */
    abstract public function model(): string;
}
