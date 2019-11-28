<?php

namespace Modules\Website\Models\Repositories;

use Modules\Website\Models\Entities\Image;
use Modules\Records\Models\Entities\Records;
use Modules\Website\Models\Enums\ActiveImage;
use Illuminate\Support\Facades\Log;

class ImageRepo
{
    public function all()
    {
        $image = Image::with([
            'Section',
            'SiteRecords',
        ])->Orderby('id', 'desc')->get();

        return $image;
    }

    public function allWhere($section)
    {
        $image = Image::with([
            'Section',
            'SiteRecords',
        ])->where(['id_section' => $section])->Orderby('id', 'desc')->get();

        return $image;
    }

    public function filteractive()
    {
        //Find By parameters (Item)
        try {

            $image = Image::with(['Section', 'SiteRecords',
            ])->whereIn('active', [1])->get();


            return $image;

        } catch (\Exception $ex) {

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function filterinactive()
    {
        //Find By parameters (Item)
        try {

            $image = Image::with(['Section',
            ])->whereIn('active', [0])->get();


            return $image;

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function filterdeleted()
    {
        //Find By parameters (Item)
        try {

            $image = Image::with(['Section',
            ])->whereIn('active', [2])->get();


            return $image;

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function filterby($id)
    {

        try {

            $strings_images = [];
            $image = Image::with([
                'Section', 'SiteRecords',
            ])->where('id_section', $id)->whereIn('active', [0, 1])->get();

            foreach ($image as $i) {

                $urlsite_records = '';
                if (isset($i->SiteRecords->url)) {
                    $urlsite_records = env('URL_DOMAIN') . $i->SiteRecords->url;
                }

                $strings_images[$i->name] = $urlsite_records;
            }


            $object = new \stdClass();
            $object->image_url = $strings_images;

            return $object;

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }


    }

    public function find($id)
    {

        $image = Image::with([
            'SiteRecords',
        ])->find($id);

        return $image;
    }

    public function findbyid($id)
    {

        $image = Image::with([
            'Section',
            'SiteRecords',
        ])->where('id', $id)->first();

        return $image;
    }

    public function findbyunique($item, $string)
    {
        //Find By parameters (Item)
        try {
            if ($item === 'image') {

                $image = Image::where('image', $string)->whereIn('active', [0, 1])->get();
            }
            return $image;

        } catch (\Exception $ex) {

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error internor') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function store($data)
    {

        $image = new Image();
        $image->fill($data);
        $image->save();

        return $image;
    }

    public function update($image, $data)
    {

        $image->fill($data);
        $image->save();

        return $image;
    }

    public function activate($image, $data)
    {

        $image->fill($data);
        $image->save();

        return $image;
    }

    public function inactivate($image, $data)
    {

        $image->fill($data);
        $image->save();

        return $image;
    }

    public function delete($id)
    {

        $image = Image::destroy($id);

        return $image;
    }

    public function checkduplicate($itemfirst, $stringfirst, $itemsecond, $stringsecond)
    {
        //Find By parameters (Item)
        try {
            if ($itemfirst === 'image' && $itemsecond === 'id_section') {

                $image = Image::where('image', $stringfirst)
                    ->where('id_section', $stringsecond)
                    ->whereIn('active', [0, 1])
                    ->exists();

            }
            return $image;

        } catch (\Exception $ex) {

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error internor') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function checkduplicateUpdate($itemfirst, $stringfirst, $itemsecond, $stringsecond, $idelement)
    {
        //Find By parameters (Item)
        try {
            if ($itemfirst === 'image' && $itemsecond === 'id_section') {

                $image = Image::where('image', $stringfirst)
                    ->where('id', '!=', $idelement)
                    ->whereIn('active', [0, 1])
                    ->exists();

            }
            return $image;

        } catch (\Exception $ex) {

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error internor') . '.',
            ];

            return response()->json($response, 500);
        }
    }
}
