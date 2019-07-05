<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Models\Repositories\UserRepo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Modules\Blog\Models\Enums\ActiveCategory;
use Modules\Blog\Models\Enums\StatusPostBlog;
use Modules\Blog\Models\Repositories\ComponentsRepo;
use Modules\Blog\Models\Repositories\PostRepo;

class PostController extends BaseController
{

    private $PostRepo;
    private $UserRepo;
    private $ComponentsRepo;

    public function __construct(PostRepo $PostRepo, UserRepo $UserRepo, ComponentsRepo $ComponentsRepo)
    {

        $this->PostRepo = $PostRepo;
        $this->UserRepo = $UserRepo;
        $this->ComponentsRepo = $ComponentsRepo;
    }

    //TODO VIEWS POST
    public function list()
    {

        return view('blog::posts.list');

    }

    public function create()
    {

        return view('blog::posts.create');

    }

    public function edit()
    {

        return view('blog::posts.edit');

    }

    //TODO CRUD POST
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'content' => 'required',
//            'image' => 'required',
            'id_category' => 'required',
            'status_post' => 'required',
            'publication_date' => 'required',
            'tags' => 'required'
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
                'title' => $request->get('title'),
                'slug' => $request->get('slug'),
                'content' => $request->get('content'),
//                'image' => $request->get('image'),
                'id_category' => $request->get('id_category'),
                'status_post' => $request->get('status_post'),
                'publication_date' => date('Y-m-d H:i:00', strtotime($request->get('publication_date'))),
                'id_user' => Auth::id(),
                'active' => ActiveCategory::$activated,
            ];

            $post = $this->PostRepo->store($data);

            $post->tags()->attach($request->get('tags'));

//            $post->tags()->sync($request->get('tags'));

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

            $post = $this->PostRepo->all();
//            foreach (){
//
//            }
//        $post->totalComments = count($post->Comments);
            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $post,
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

            $post = $this->PostRepo->find($request->get('id'));

            if (isset($post->id)) {

                $active = $post->status_post === StatusPostBlog::$draft ? StatusPostBlog::$published : StatusPostBlog::$draft;

                $this->PostRepo->update($post, ['status_post' => $active]);

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

//        try {

        $post = $this->PostRepo->find($request->get('id'));

        if (isset($post->id)) {

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Modificados Correctamente') . '.',
            ];

            if ($post->status_post === StatusPostBlog::$draft) {

                $this->PostRepo->delete($post->id);

            } else {
                $response = [
                    'status' => 'OK',
                    'code' => 201,
                    'message' => __('No puedes eliminar una entrada publicada') . '.',
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

    }

    public function consult(Request $request)
    {

        try {
            $post = $this->PostRepo->findbyid($request->get('id'));
            $status = $this->ComponentsRepo->allStatus();
            foreach ($status as $item => $value) {
                if ($value['id'] === $post->status_post) {
                    $post->status = $value;
                }
            }
            $tags = [];
            foreach ($post->tags as $item => $value) {
                $tags[] = $value->id;
            }
            $post->tagArray = $tags;

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $post,
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
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
//            'image' => 'required',
            'id_category' => 'required',
            'status_post' => 'required',
            'publication_date' => 'required',
            'tags' => 'required'
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
            $post = $this->PostRepo->find($request->get('id'));
            if (isset($post->id)) {

                $data = [
                    'title' => $request->get('title'),
                    'content' => $request->get('content'),
                    'id_category' => $request->get('id_category'),
                    'status_post' => $request->get('status_post'),
                    'publication_date' => date('Y-m-d H:i:00', strtotime($request->get('publication_date'))),
                ];

                $validator = Validator::make($request->all(), [
                    'slug' => 'unique:posts',
                ]);
                if (!$validator->fails()) {
                    $data['slug'] = $request->get('slug');
                }

                $post = $this->PostRepo->update($post, $data);

                $post->tags()->sync($request->get('tags'));

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
