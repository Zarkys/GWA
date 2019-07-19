<?php

namespace Modules\Website\Models\Repositories;

use Modules\Website\Models\Entities\Text;
use Modules\Website\Models\Enums\ActiveText;


class TextRepo
{
    public function all()
    {
        $text = Text::with([
            'Section',
        ])->Orderby('id','desc')->get();

        return $text;
    }

    public function filteractive()
    {
        //Find By parameters (Item)
        try {

            $text = Text::with(['Section',
            ])->whereIn('active', [1])->get();


            return $text;

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

    public function filterinactive()
    {
        //Find By parameters (Item)
        try {

            $text = Text::with(['Text',
            ])->whereIn('active', [0])->get();


            return $text;

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

            $text = Text::with(['Section',
            ])->whereIn('active', [2])->get();


            return $text;

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

        $text = Text::find($id);

        return $text;
    }

    public function findbyid($id)
    {

        $text = Text::with([
            'Section',
        ])->where('id', $id)->first();

        return $text;
    }

     public function filterby($item,$id) {
            //Find By parameters (Item)
            try {
                $strings_es = [];
                $strings_en = [];
                    if($item==='id_section'){
                        //$textstation = TextStation::where('id_text', $id)->get();

                        $text = Text::with([
                            'Section',
                        ])->where('id_section', $id)->whereIn('active', [0, 1])->get();
                      
                        foreach($text as $t)
                        {
                            $strings_es[$t->name] = $t->value_es;
                            $strings_en[$t->name] = $t->value_en;
                        }
                        
                       
                    }                 
                    $object = new \stdClass();
                    $object->es = $strings_es;
                    $object->en = $strings_en;
               
                    return $object;

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

 public function findbyunique($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='title'){

                        $text = Text::where('title', $string)->whereIn('active', [0, 1])->get();
                    } 
                    return $text;

            } catch (\Exception $ex) {
                
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error internor') . '.',
                ];
                
                return response()->json($response, 500);
            } 
        } 

    public function store($data)
    {

        $text = new Text();
        $text->fill($data);
        $text->save();

        return $text;
    }

    public function update($text, $data)
    {

        $text->fill($data);
        $text->save();

        return $text;
    }
        public function activate($text, $data)
    {

        $text->fill($data);
        $text->save();

        return $text;
    }
        public function inactivate($text, $data)
    {

        $text->fill($data);
        $text->save();

        return $text;
    }

   public function delete($id)
    {

        $section = Text::destroy($id);

        return $section;
    }

           public function checkduplicate($itemfirst,$stringfirst,$itemsecond,$stringsecond) {
            //Find By parameters (Item)
            try {
                    if($itemfirst==='name' && $itemsecond==='id_section')
                    {

                        $text = Text::where('name', $stringfirst)
                        ->where('id_section', $stringsecond)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    } 
                    return $text;

            } catch (\Exception $ex) {
                
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error internor') . '.',
                ];
                
                return response()->json($response, 500);
            } 
        } 
        public function checkduplicateUpdate($itemfirst,$stringfirst,$itemsecond,$stringsecond,$idelement) {
            //Find By parameters (Item)
            try {
                    if($itemfirst==='name' && $itemsecond==='id_section')
                    {

                        $text = Text::where('name', $stringfirst)
                        ->where('id','!=',$idelement)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    } 
                    return $text;

            } catch (\Exception $ex) {
                
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error internor') . '.',
                ];
                
                return response()->json($response, 500);
            } 
        }
}