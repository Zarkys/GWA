<?php

namespace Modules\Website\Http\Controllers;

use App\Http\Models\Repositories\UserRepo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Modules\Website\Models\Enums\ActiveSection;
use Modules\Website\Models\Enums\ActiveImage;
use Modules\Website\Models\Repositories\ComponentsRepo;
use Modules\Website\Models\Repositories\ImageRepo;
use Modules\Website\Models\Repositories\SectionRepo;
use Modules\Records\Models\Repositories\RecordsRepo;
use Modules\Records\Models\Enums\ActiveArchive;

class ImageController extends BaseController
{

    private $ImageRepo;
    private $SectionRepo;
    private $UserRepo;
    private $RecordsRepo;
    private $ComponentsRepo;

    public function __construct(ImageRepo $ImageRepo, SectionRepo $SectionRepo, UserRepo $UserRepo, RecordsRepo $RecordsRepo, ComponentsRepo $ComponentsRepo)
    {

        $this->ImageRepo = $ImageRepo;
        $this->SectionRepo = $SectionRepo;
        $this->UserRepo = $UserRepo;
        $this->RecordsRepo = $RecordsRepo;
        $this->ComponentsRepo = $ComponentsRepo;
    }

    //TODO VIEWS POST
    public function list()
    {

        return view('website::images.list');

    }

    public function create()
    {

        return view('website::images.create');

    }

    public function edit()
    {

        return view('website::images.edit');

    }

    //TODO CRUD POST
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'name' => 'required',
            'id_section' => 'required'
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
                'id_archive' => $request->get('image'),
                'name' => $request->get('name'),
                'id_section' => $request->get('id_section'),
                'active' => ActiveSection::$activated,
            ];

            $image = $this->ImageRepo->store($data);

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Registrado Correctamente'),
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

    public function listAll(Request $request)
    {

        $image = $this->ImageRepo->all();
        foreach ($image as $value) {
            if (isset($value->SiteRecords->url)) {
                $value->image = $value->SiteRecords->url;
            }

        }
        $response = [
            'status' => 'OK',
            'code' => 200,
            'message' => __('Datos Obtenidos Correctamente'),
            'data' => $image,
        ];

        return response()->json($response, 200);

    }

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

            $image = $this->ImageRepo->find($request->get('id'));

            if (isset($image->id)) {

                $active = $image->active === ActiveImage::$activated ? ActiveImage::$disabled : ActiveImage::$activated;

                $this->ImageRepo->update($image, ['active' => $active]);

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                    'status_post' => $active
                ];

                return response()->json($response, 200);
            }

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',

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

            $image = $this->ImageRepo->find($request->get('id'));

            if (isset($image->id)) {
                $sections = $this->SectionRepo->allActive();
                $active = $image->active;

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                ];

                if ($active === ActiveImage::$disabled) {

                    $image = $this->ImageRepo->delete($image->id);

                } elseif (count($sections) > 1) {
                    $image = $this->ImageRepo->delete($image->id);

                } else {
                    $response = [
                        'status' => 'OK',
                        'code' => 201,
                        'message' => __('Debes mantener un item activo') . '.',
                        'active' => $image->active
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

    public function consult(Request $request)
    {

        try {

            $image = $this->ImageRepo->findbyid($request->get('id'));

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $image,
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
            'image' => 'required',
            'id_section' => 'required',
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

            $image = $this->ImageRepo->find($request->get('id'));

            if (isset($image->id)) {

                $data = [
                    'name' => $request->get('name'),
                    'id_archive' => $request->get('image'),
                    'id_section' => $request->get('id_section'),
                ];

                $this->ImageRepo->update($image, $data);

            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Registrado Correctamente'),
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

    //TODO CONSULT
    public function resourcesActive()
    {

        try {
            $images = $this->RecordsRepo->allWhere(['type' => 'image', 'active' => ActiveArchive::$activated]);
            $sections = $this->SectionRepo->allActive();

            foreach ($images as $item => $value) {
                $size = $value->size;

                $units = array('B', 'KB', 'MB', 'GB');

                $size = max($size, 0);
                $pow = floor(($size ? log($size) : 0) / log(1024));
                $pow = min($pow, count($units) - 1);

                $size /= pow(1024, $pow);
//             $bytes /= (1 << (10 * $pow));

                $value->size = number_format($size, 2) . ' ' . $units[$pow];
                $value->dimension = $value->dimension . 'px';
                $value->remove = false;
                $value->typeExtension = null;
                $value->typeView = true;

                $value->typeExtension = is_null($value->typeExtension) ? '' : '(' . $value->typeExtension . ')';


            }
            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'sections' => $sections,
                'images' => $images,
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
            'image.required' => __('La imagen es requerida'),
            'id_section.required' => __('La sección es requerida'),
        ];
    }

}
