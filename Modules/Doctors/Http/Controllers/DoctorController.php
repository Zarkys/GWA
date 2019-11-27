<?php

namespace Modules\Doctors\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Modules\Doctors\Models\Enums\ActiveDoctor;
use Modules\Doctors\Models\Repositories\DoctorRepo;

class DoctorController extends BaseController
{
    private $DoctorRepo;

    public function __construct(DoctorRepo $DoctorRepo)
    {

        $this->DoctorRepo = $DoctorRepo;
    }

    //    TODO VIEWS TAG
    public function list()
    {

        return view('doctors::doctors.list');

    }

    public function create()
    {

        return view('doctors::doctors.create');

    }

    public function edit()
    {

        return view('doctors::doctors.edit');

    }

    public function listAll()
    {

        try {
            $doctor = $this->DoctorRepo->all();

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $doctor,
            ];

            return response()->json($response, 200);

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => _('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function findbyunique($item, $string)
    {
         try {
             log::Debug('entrando al filtrado');
             $doctor = $this->DoctorRepo->findbyunique($item,$string);
             log::Debug('salida del repositorio filtrado'.$doctor);
             $response = [
                 'status'  => 'OK',
                 'code'    => 200,
                 'message' => __('Datos Obtenidos Correctamente'),
                 'data'    => $doctor,
             ];

             return response()->json($response, 200);

         } catch (\Exception $ex) {
             $response = [
                 'status'  => 'FAILEDc',
                 'code'    => 500,
                 'message' => __('Ocurrio un error interno') . '.',
             ];

             return response()->json($response, 500);
         }

    }

    /* public function listActive() {

        try {
            $specialty = $this->SpecialtyRepo->filteractive();

            $response = [
                'status'  => 'OK',
                'code'    => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data'    => $specialty,
            ];

            return response()->json($response, 200);

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status'  => 'FAILED',
                'code'    => 500,
                'message' => _('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }

    }     */

    public function changeStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => 'FAILED',
                'code' => 400,
                'message' => __('Parametros incorrectos'),
                'data' => $validator->errors()->getMessages(),
            ];

            return response()->json($response);
        }
        try {

            $doctor = $this->DoctorRepo->find($request->get('id'));

            if (isset($doctor->id)) {
                $doctors = $this->DoctorRepo->allActive();

                $active = $doctor->active === ActiveDoctor::$activated ? ActiveDoctor::$disabled : ActiveDoctor::$activated;

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                    'active' => $active
                ];

                if ($active === ActiveDoctor::$activated) {
                    $doctor = $this->DoctorRepo->update($doctor, ['active' => $active]);
                } elseif (count($doctors) > 1) {
                    $doctor = $this->DoctorRepo->update($doctor, ['active' => $active]);
                } else {
                    $response = [
                        'status' => 'OK',
                        'code' => 201,
                        'message' => __('Debes mantener un item activo') . '.',
                        'active' => $doctor->active
                    ];

                    return response()->json($response, 201);
                }

                return response()->json($response, 200);

            }

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.'
            ];

            return response()->json($response, 500);

        } catch (\Exception $ex) {
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',

            ];

            return response()->json($response, 500);
        }
    }

    public function delete(Request $request)
    {

        try {

            $doctor = $this->DoctorRepo->find($request->get('id'));

            if (isset($doctor->id)) {
                $doctors = $this->DoctorRepo->allActive();
                $active = $doctor->active;

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                ];

                if ($active === ActiveDoctor::$disabled) {

                    $doctor = $this->DoctorRepo->delete($doctor->id);

                } elseif ($active === ActiveDoctor::$activated && count($doctors) > 1) {
                    $doctor = $this->DoctorRepo->delete($doctor->id);

                } else {
                    $response = [
                        'status' => 'OK',
                        'code' => 201,
                        'message' => __('Debes mantener un item activo') . '.',
                        'active' => $doctor->active
                    ];

                    return response()->json($response, 201);
                }

                return response()->json($response, 200);

            }

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.'
            ];

            return response()->json($response, 500);

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'id_specialty' => 'required',
        ], $this->custom_message());

        if ($validator->fails()) {
            $response = [
                'status' => 'FAILED',
                'code' => 400,
                'message' => __('Parametros incorrectos'),
                'data' => $validator->errors()->getMessages(),
            ];

            return response()->json($response);
        }

        try {

            $data = [
                'name' => $request->get('name'),
                'consulting_room' => 'Sin Consultorio',
                'phone' =>  'Sin Teléfono',
                'id_specialty' => $request->get('id_specialty'),
                'active' => ActiveDoctor::$activated,
            ];
            if($request->get('consulting_room')){
                $data['consulting_room']=$request->get('consulting_room');
            }

            if($request->get('phone')){
                $data['phone']=$request->get('phone');
            }

            $this->DoctorRepo->store($data);

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Registrado  Correctamente'),
            ];

            return response()->json($response, 200);


        } catch (\Exception $ex) {

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',

            ];

            return response()->json($response, 500);
        }
    }

    public function consult(Request $request)
    {

        try {
            $doctor = $this->DoctorRepo->findbyid($request->get('id'));

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $doctor,
            ];

            return response()->json($response, 200);

        } catch (\Exception $ex) {
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }

    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'id_specialty' => 'required',
        ], $this->custom_message());

        if ($validator->fails()) {

            $response = [
                'status' => 'FAILED',
                'code' => 400,
                'message' => __('Parametros incorrectos'),
                'data' => $validator->errors()->getMessages(),
            ];

            return response()->json($response);
        }

        try {

            $doctor = $this->DoctorRepo->find($request->get('id'));

            if (isset($doctor->id)) {

                $data = [
                    'name' => $request->get('name'),
                    'consulting_room' => 'Sin Consultorio',
                    'phone' =>  'Sin Teléfono',
                    'id_specialty' => $request->get('id_specialty'),
                ];
                if($request->get('consulting_room')){
                    $data['consulting_room']=$request->get('consulting_room');
                }

                if($request->get('phone')){
                    $data['phone']=$request->get('phone');
                }

                $this->DoctorRepo->update($doctor, $data);

            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Actualizado Correctamente'),
            ];

            return response()->json($response, 200);

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

    public function custom_message()
    {
        return [
            'name.required' => __('El nombre es requerido'),
            'id_specialty.required' => __('La especialidad es requerido'),
            /*  'slug.required'      => __('El slug es requerido'),
              'description.required'  => __('La descripcion es requerida'),
              'parent_category.required'  => __('La categoria padre es requerida'),*/
        ];
    }


}