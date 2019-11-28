<?php

namespace Modules\Records\Models\Repositories;

use Modules\Records\Models\Entities\Records;

class RecordsRepo
{
    public function all()
    {

        $records = Records::all();
        return $records;

    }

    public function allWhere($array)
    {
        $records = Records::where($array)->get();

        return $records;
    }

    public function lastId()
    {
        $record = Records::all()->last();

        return isset($record->id)?$record->id:1;
    }


    public function allActive($active)
    {
        $records = Records::where(['active' => $active])->get();

        return $records;
    }

    public function find($id)
    {

        $archive = Records::find($id);

        return $archive;
    }

    public function store($data)
    {

        $archive = new Records();
        $archive->fill($data);
        $archive->save();

        return $archive;
    }

    public function update($archive, $data)
    {

        $archive->fill($data);
        $archive->save();

        return $archive;
    }

    public function delete($id)
    {

        $archive = Records::destroy($id);

        return $archive;
    }

}
