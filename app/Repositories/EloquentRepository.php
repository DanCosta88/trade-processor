<?php

namespace App\Repositories;

use App\Repositories\Exceptions\InvalidModelValidationException;
use App\Repositories\Exceptions\InvalidRelationshipException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class EloquentRepository
{
    /**
     * Returns all models.
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all($columns = array('*'))
    {
        return $this->model->all($columns);
    }

    /**
     * Returns model attribute.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Returns an object with related relationships.
     *
     * @param int      $id
     * @param string[] $with
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function with($id, array $with = [])
    {
        return $this->model->with($with)->findOrFail($id);
    }

    /**
     * Sets the model to query against a user id.
     *
     * @param int    $id
     * @param string $column
     *
     * @return $this
     */
    public function withAuth($id, $column = 'user_id')
    {
        $this->model = $this->model->where($column, $id);

        return $this;
    }

    /**
     * Finds a model by ID.
     *
     * @param int $id
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id, $columns = array('*'))
    {
        return $this->model->find($id, $columns);
    }


    /**
     * Finds a model by id.
     *
     * @param int $id
     * @param array $columns
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrFail($id, $columns = array('*'))
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * Finds a model by type.
     *
     * @param string $key
     * @param string $value
     * @param array  $columns
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findByOrFail($key, $value, $columns = ['*'])
    {
        $model = $this->model->where($key, $value)->first($columns);

        if ($model === null) {
            throw new ModelNotFoundException();
        }

        return $model;
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 0, $columns = array('*'))
    {
        $perPage = $perPage ?: 10;
        return $this->model->paginate($perPage, $columns);
    }


    /**
     * Counts the number of rows returned.
     *
     * @param string|null $key
     * @param string|null $value
     *
     * @return int
     */
    public function count($key = null, $value = null)
    {
        if ($key === null || $value === null) {
            return $this->model->count();
        }

        return $this->model->where($key, $value)->count();
    }

    /**
     * Deletes a model by id.
     *
     * @param int $id
     *
     * @return void
     */
    public function destroy($id)
    {
        $this->model->delete($id);
    }

    /**
     * Validate whether a model has a correct relationship.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string                              $relationship
     *
     * @throws \App\Repositories\Exceptions\InvalidRelationshipException
     *
     * @return $this
     */
    public function hasRelationship(Model $model, $relationship)
    {
        if ($model->$relationship === null) {
            throw new InvalidRelationshipException('The relationship was not valid.');
        }

        return $this;
    }
}