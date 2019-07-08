<?php

namespace App\Http\Models\Repositories;

use App\Http\Models\Entities\ConfigWeb;
use App\Http\Models\Entities\Post;
use App\Http\Models\Entities\Contact;
use App\Http\Models\Entities\Text;
use App\Http\Models\Entities\Coment;

class ConfigWebRepo
{
    public function all()
    {

        $configweb = ConfigWeb::whereIn('active', [0, 1])->get();
        return $configweb;
    }
    public function imagelogo()
    {

        $imagelogo = ConfigWeb::whereIn('active', [0, 1])->
        where('name_config','url_logo_company')->first();
        return $imagelogo;
    }
    public function counters()
    {

//        $posts = Post::whereIn('active', [0, 1])->count();
        $contacts = Contact::whereIn('active', [0, 1])->count();
        $texts = Text::whereIn('active', [0, 1])->count();
//        $comments = Coment::whereIn('active', [0, 1])->count();

        $counters = new \stdClass;
        $counters->posts= 0;
        $counters->contacts= $contacts;
        $counters->texts= $texts;
        $counters->comments= 0;

        return $counters;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
            $configweb = ConfigWeb::whereIn('active', [1])->get();

            return $configweb;

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
    public function filterinactive()
    {
        //Find By parameters (Item)
        try {
            $configweb = ConfigWeb::whereIn('active', [0])->get();

            return $configweb;

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
    public function filterdeleted()
    {
        //Find By parameters (Item)
        try {
            $configweb = ConfigWeb::whereIn('active', [2])->get();

            return $configweb;

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
    public function findbyid($id)
    {

        $configweb = ConfigWeb::find($id);

        return $configweb;
    }

    public function findbyunique($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='name'){

                        $configweb = ConfigWeb::where('name', $string)->whereIn('active', [0, 1])->get();
                    } 
                    return $configweb;

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

        $configweb = new ConfigWeb();
        $configweb->fill($data);
        $configweb->save();

        return $configweb;
    }

    public function update($configweb, $data)
    {

        $configweb->fill($data);
        $configweb->save();

        return $configweb;
    }

    public function activate($configweb, $data)
    {

        $configweb->fill($data);
        $configweb->save();

        return $configweb;
    }

    public function inactivate($configweb, $data)
    {

        $configweb->fill($data);
        $configweb->save();

        return $configweb;
    }

    public function delete($configweb, $data)
    {

        $configweb->fill($data);
        $configweb->save();

        return $configweb;
    }

     public function checkduplicate($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='name')
                    {

                        $configweb = ConfigWeb::where('name', $string)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    } 
                    return $configweb;

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
