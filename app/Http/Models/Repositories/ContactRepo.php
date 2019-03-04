<?php

namespace App\Http\Models\Repositories;

use App\Http\Models\Entities\Contact;

class ContactRepo
{
    public function all()
    {

        $contact = Contact::whereIn('active', [0, 1])->get();
        return $contact;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
            $contact = Contact::whereIn('active', [1])->get();

            return $contact;

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
            $contact = Contact::whereIn('active', [0])->get();

            return $contact;

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
            $contact = Contact::whereIn('active', [2])->get();

            return $contact;

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

        $contact = Contact::find($id);

        return $contact;
    }

    public function findbyunique($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='name'){

                        $contact = Contact::where('name', $string)->whereIn('active', [0, 1])->get();
                    } 
                    return $contact;

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

        $contact = new Contact();
        $contact->fill($data);
        $contact->save();

        return $contact;
    }

    public function update($contact, $data)
    {

        $contact->fill($data);
        $contact->save();

        return $contact;
    }

    public function activate($contact, $data)
    {

        $contact->fill($data);
        $contact->save();

        return $contact;
    }

    public function inactivate($contact, $data)
    {

        $contact->fill($data);
        $contact->save();

        return $contact;
    }

    public function delete($contact, $data)
    {

        $contact->fill($data);
        $contact->save();

        return $contact;
    }

     public function checkduplicate($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='name')
                    {

                        $contact = Contact::where('name_client', $string)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    } 
                    return $contact;

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
