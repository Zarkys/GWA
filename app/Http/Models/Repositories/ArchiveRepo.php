<?php

namespace App\Http\Models\Repositories;

use App\Http\Models\Entities\Archive;

class ArchiveRepo
{
    public function all()
    {

        $archive = Archive::whereIn('active', [0, 1])->get();
        return $archive;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
            $archive = Archive::whereIn('active', [1])->get();

            return $archive;

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status'  => 'FAILED',
                'code'    => 500,
                'message' => _('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }
    public function find($id)
    {

        $archive = Archive::find($id);

        return $archive;
    }

    public function store($data)
    {

        $archive = new Archive();
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

    public function delete($archive, $data)
    {

        $archive->fill($data);
        $archive->save();

        return $archive;
    }
}
