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
use Modules\Website\Models\Enums\ActiveText;
use Modules\Website\Models\Repositories\ComponentsRepo;
use Modules\Website\Models\Repositories\TextRepo;
use Modules\Website\Models\Repositories\SectionRepo;

class TextController extends BaseController
{

    private $TextRepo;
    private $SectionRepo;
    private $UserRepo;
    private $ComponentsRepo;

    public function __construct(TextRepo $TextRepo,SectionRepo $SectionRepo, UserRepo $UserRepo, ComponentsRepo $ComponentsRepo)
    {

        $this->TextRepo = $TextRepo;
        $this->SectionRepo = $SectionRepo;
        $this->UserRepo = $UserRepo;
        $this->ComponentsRepo = $ComponentsRepo;
    }

    //TODO VIEWS POST
    public function list()
    {

        return view('website::texts.list');

    }

    public function create()
    {

        return view('website::texts.create');

    }

    public function edit()
    {

        return view('website::texts.edit');

    }

    //TODO CRUD POST
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'value_es' => 'required',
//            'image' => 'required',
           // 'value_en' => 'required',
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
                'name' => $request->get('name'),
                'value_es' => $request->get('value_es'),
//                'image' => $request->get('image'),
                'value_en' => $request->get('value_en'),
                'id_section' => $request->get('id_section'),
                'active' => ActiveSection::$activated,
            ];

            $text = $this->TextRepo->store($data);

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Registrado Correctamente'),
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

    public function listAll(Request $request)
    {

//        try {

            $text = $this->TextRepo->all();
//            foreach (){
//
//            }
//        $post->totalComments = count($post->Comments);
            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $text,
            ];

            return response()->json($response, 200);

//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }

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

            $text = $this->TextRepo->find($request->get('id'));

            if (isset($text->id)) {

                $active = $text->active === ActiveText::$activated ? ActiveText::$disabled: ActiveText::$activated;

                $this->TextRepo->update($text, ['active' => $active]);

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

            $text = $this->TextRepo->find($request->get('id'));

            if (isset($text->id)) {
                $sections = $this->SectionRepo->allActive();
                $active = $text->active;

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                ];

                if ($active === ActiveText::$disabled) {

                    $text = $this->TextRepo->delete($text->id);

                } elseif ($active === ActiveText::$activated ) {
                    $text = $this->TextRepo->delete($text->id);

                } else {
                    $response = [
                        'status' => 'OK',
                        'code' => 201,
                        'message' => __('Debes mantener un item activo') . '.',
                        'active' => $text->active
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

   /* public function delete(Request $request)
    {

//        try {

        $text = $this->TextRepo->find($request->get('id'));

        if (isset($text->id)) {

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Modificados Correctamente') . '.',
            ];

            if ($text->active === ActiveSection::$disabled) {

                $this->TextRepo->delete($text->id);

            } else {
                $response = [
                    'status' => 'OK',
                    'code' => 201,
                    'message' => __('No puedes eliminar el texto publicado') . '.',
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

//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }

    }*/

    public function consult(Request $request)
    {

        try {
            $text = $this->TextRepo->findbyid($request->get('id'));

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $text,
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
            'value_es' => 'required',
           // 'value_en' => 'required',
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
            $text = $this->TextRepo->find($request->get('id'));
            if (isset($text->id)) {

                $data = [
                    'name' => $request->get('name'),
                    'value_es' => $request->get('value_es'),
                    'value_en' => $request->get('value_en'),
                    'id_section' => $request->get('id_section'),
                ];

               /* $validator = Validator::make($request->all(), [
                    'slug' => 'unique:posts',
                ]);
                if (!$validator->fails()) {
                    $data['slug'] = $request->get('slug');
                }*/

                $text = $this->TextRepo->update($text, $data);


            }


            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Registrado Correctamente'),
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

//
////    TODO OLD
//    public function index()
//    {
//
//        try {
//            $post = $this->PostRepo->all();
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('Datos Obtenidos Correctamente'),
//                'data' => $post,
//            ];
//
//            return response()->json($response, 200);
//
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//    public function filteractive()
//    {
//
//        try {
//            $post = $this->PostRepo->filteractive();
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('Datos Obtenidos Correctamente'),
//                'data' => $post,
//            ];
//
//            return response()->json($response, 200);
//
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//    public function filterinactive()
//    {
//
//        try {
//            $post = $this->PostRepo->filterinactive();
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('Datos Obtenidos Correctamente'),
//                'data' => $post,
//            ];
//
//            return response()->json($response, 200);
//
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//    public function filterdeleted()
//    {
//
//        try {
//            $post = $this->PostRepo->filterdeleted();
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('Datos Obtenidos Correctamente'),
//                'data' => $post,
//            ];
//
//            return response()->json($response, 200);
//
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//    public function findbyid($id)
//    {
//
//        try {
//            $post = $this->PostRepo->findbyid($id);
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('Datos Obtenidos Correctamente'),
//                'data' => $post,
//            ];
//
//            return response()->json($response, 200);
//
//        } catch (\Exception $ex) {
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//    public function filterby($item, $id)
//    {
//
//        try {
//            $Post = $this->PostRepo->filterby($item, $id);
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('Datos Obtenidos Correctamente'),
//                'data' => $Post,
//            ];
//
//            return response()->json($response, 200);
//
//        } catch (\Exception $ex) {
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//    public function findbyunique($item, $string)
//    {
//
//        try {
//            $Post = $this->PostRepo->findbyunique($item, $string);
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('Datos Obtenidos Correctamente'),
//                'data' => $Post,
//            ];
//
//            return response()->json($response, 200);
//
//        } catch (\Exception $ex) {
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//    public function update(Request $request, $id)
//    {
//
//        Log::debug($request);
//        $post = $this->PostRepo->findbyid($id);
//
//
//        if ($request->has('title')) {
//            $data['title'] = $request->get('title');
//        }
//        if ($request->has('content')) {
//            $data['content'] = $request->get('content');
//        }
//        if ($request->has('image')) {
//            $data['image'] = $request->get('image');
//        }
//        if ($request->has('visibility')) {
//            $data['visibility'] = $request->get('visibility');
//        }
//        if ($request->has('status_post')) {
//            $data['status_post'] = $request->get('status_post');
//        }
//        if ($request->has('id_user')) {
//            $data['id_user'] = $request->get('id_user');
//        }
//        if ($request->has('permanent_link')) {
//            $data['permanent_link'] = $request->get('permanent_link');
//        }
//        if ($request->has('creation_date')) {
//            $data['creation_date'] = $request->get('creation_date');
//        }
//        if ($request->has('publication_date')) {
//            $data['publication_date'] = $request->get('publication_date');
//        }
//        if ($request->has('active')) {
//            $data['active'] = $request->get('active');
//        }
//        $data['modification_date'] = Carbon::now();
//
//        try {
//
//            $item = 'title';
//            $string = $data['title'];
//            $PostDupletitle = $this->PostRepo->checkduplicate($item, $string);
//            $item = 'permanent_link';
//            $string = $data['permanent_link'];
//            $PostDuplelink = $this->PostRepo->checkduplicate($item, $string);
//
//
//            if ($PostDupletitle == 0 && $PostDuplelink == 0) {
//
//                $post = $this->PostRepo->update($post, $data);
//
//                $response = [
//                    'status' => 'OK',
//                    'code' => 200,
//                    'message' => __('El post ha sido modificado correctamente '),
//                    'data' => $post,
//                ];
//
//                return response()->json($response, 200);
//
//            } else {
//                $response = [
//                    'status' => 'FAILED',
//                    'code' => 409,
//                    'message' => __('El post fue registrada anteriormente') . '.',
//
//                ];
//
//                return response()->json($response, 409);
//            }
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//    }
//
//    public function activate($id, Request $request)
//    {
//
//
//        try {
//
//            $post = $this->PostRepo->findbyid($id);
//            $post = $this->PostRepo->activate($post, ['active' => 1]);
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('El post ha sido activado correctamente '),
//                'data' => $post,
//            ];
//
//            return response()->json($response, 200);
//
//
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//    public function inactivate($id, Request $request)
//    {
//
//
//        try {
//
//            $post = $this->PostRepo->findbyid($id);
//            $post = $this->PostRepo->inactivate($post, ['active' => 0]);
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('El post ha sido inactivado correctamente '),
//                'data' => $post,
//            ];
//
//            return response()->json($response, 200);
//
//
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error internoc') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//    public function delete($id, Request $request)
//    {
//
//
//        try {
//
//            $post = $this->PostRepo->findbyid($id);
//            $post = $this->PostRepo->delete($post, ['active' => 2]);
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('El post ha sido eliminado correctamente '),
//                'data' => $post,
//            ];
//
//            return response()->json($response, 200);
//
//
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//

    public function custom_message()
    {
        return [
            'title.required' => __('El titulo es requerido'),
            // 'content.required' => __('El contenido es requerido'),
            // 'id_featured_image.required' => __('La imagen destacada es requerida'),
            //  'visibility.required' => __('La visibilidad es requerida'),
            // 'status_post.required' => __('El estatus del post es requerido'),
            // 'id_user.required' => __('El usuario es requerido'),
            // 'permanent_link.required' => __('El link permanente es requerido'),
            // 'creation_date.required' => __('La fecha de creacion es requerida'),
            //   'publication_date.required' => __('La fecha de publicacion es requerida'),
            // 'modification_date.required' => __('La fecha de modificacion es requerida'),
        ];
    }

}
