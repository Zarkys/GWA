<?php

namespace App\Http\Models\Repositories;

use App\Http\Models\Entities\ConfigModule;
use App\Http\Models\Entities\Post;
use App\Http\Models\Entities\Contact;
use App\Http\Models\Entities\Text;
use App\Http\Models\Entities\Coment;

class ConfigModuleRepo
{
    public function all()
    {

        $configmodule = ConfigModule::whereIn('active', [0, 1])->get();
        return $configmodule;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
            $configmodule = ConfigModule::whereIn('active', [1])->get();

            return $configmodule;

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
            $configmodule = ConfigModule::whereIn('active', [0])->get();

            return $configmodule;

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
            $configmodule = ConfigModule::whereIn('active', [2])->get();

            return $configmodule;

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

        $configmodule = ConfigModule::find($id);

        return $configmodule;
    }

    public function findbyunique($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='name_module'){

                        $configmodule = ConfigModule::where('name_module', $string)->whereIn('active', [0, 1])->get();
                    } 
                    return $configmodule;

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

        $configmodule = new ConfigModule();
        $configmodule->fill($data);
        $configmodule->save();

        return $configmodule;
    }

    public function update($configmodule, $data)
    {

        $configmodule->fill($data);
        $configmodule->save();

        return $configmodule;
    }

    public function activate($configmodule, $data)
    {

        $configmodule->fill($data);
        $configmodule->save();

        return $configmodule;
    }

    public function inactivate($configmodule, $data)
    {

        $configmodule->fill($data);
        $configmodule->save();

        return $configmodule;
    }

    public function delete($configmodule, $data)
    {

        $configmodule->fill($data);
        $configmodule->save();

        return $configmodule;
    }

     public function checkduplicate($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='name_module')
                    {

                        $configmodule = ConfigModule::where('name_module', $string)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    } 
                    return $configmodule;

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
