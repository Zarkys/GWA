<?php

namespace Modules\Sliders\Models\Repositories;

use Modules\Sliders\Models\Entities\Sliders;

class SlidersRepo
{

    public function all()
    {
        $sli = Sliders::all();
        return $sli;

    }

    public function allWhere($array)
    {
        $sli = Sliders::where($array)->get();

        return $sli;
    }

    public function lastId()
    {
        $record = Sliders::all()->last();

        return $record->id;
    }

    public function find($id)
    {

        $sli = Sliders::find($id);

        return $sli;
    }

    public function store($data)
    {

        $sli = new Sliders();
        $sli->fill($data);
        $sli->save();

        return $sli;
    }

    public function update($sli, $data)
    {

        $sli->fill($data);
        $sli->save();

        return $sli;
    }

    public function delete($id)
    {

        $sli = Sliders::destroy($id);

        return $sli;
    }

}
