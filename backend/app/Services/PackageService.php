<?php

namespace App\Services;

use App\Models\Package;

class PackageService
{
    protected Package $package;

    public function __construct()
    {
        $this->package=new Package();
    }

    public function all()
    {
        return $this->package->all();
    }

    public function create($data)
    {
        return $this->package->create(
            $data
        );
    }

    public function update($id,$data)
    {
        return $this->package->update(
            $id,
            $data
        );
    }

    public function delete($id)
    {
        return $this->package->delete(
            $id
        );
    }
}
