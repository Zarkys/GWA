<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Modules\Blog\Models\Enums\ActiveCategory;
use Modules\Blog\Models\Enums\StatusCommentBlog;
use Modules\Blog\Models\Repositories\CategoryBlogRepo;
use Modules\Blog\Models\Repositories\CommentRepo;

class CommentController extends BaseController
{

    private $CommentRepo;

    public function __construct(CommentRepo $CommentRepo)
    {

        $this->CommentRepo = $CommentRepo;
    }

//    TODO VIEWS COMMENTS
    public function list()
    {

        return view('blog::comments.list');

    }

    public function create()
    {

        return view('blog::comments.create');

    }

    public function edit()
    {

        return view('blog::comments.edit');

    }

//    TODO CRUD COMMENTS
    public function listAll()
    {

        try {

            $category = $this->CommentRepo->allStatus(StatusCommentBlog::$revision);

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $category,
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

    public function changeStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required',
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

            $comment = $this->CommentRepo->find($request->get('id'));

            if (isset($comment->id)) {

                $status = $request->get('status') ? StatusCommentBlog::$published : StatusCommentBlog::$censored;

                $this->CommentRepo->update($comment, ['status' => $status]);
                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                ];

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

}
