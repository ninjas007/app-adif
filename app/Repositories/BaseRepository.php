<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $record = $this->find($id);
        $attributes = $this->handleRequestPassword($attributes);

        if ($record) {
            $record->update($attributes);
            return $record;
        }
        return false;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function delete($id)
    {
        $record = $this->find($id);
        if ($record) {
            return $record->delete();
        }
        return false;
    }

    public function handleRequestPassword(array $data)
    {
        if (isset($data['password']) || empty($data['password'])) {
            if ($data['password'] == '') {
                unset($data['password']);
            } else {
                $data['password'] = Hash::make($data['password2']);
            }
        } else if (!isset($data['password']) && !empty($data['password2'])) {
            $data['password'] = Hash::make($data['password2']);
        }

        return $data;
    }
}
