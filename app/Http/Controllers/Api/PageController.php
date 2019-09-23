<?php

namespace App\Http\Controllers\Api;


use App\Http\Models\Repositories\PageRepo;
use App\Http\Models\Repositories\UserRepo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PageController extends BaseController
{

    private $PageRepo;
    private $UserRepo;

    public function __construct(PageRepo $PageRepo, UserRepo $UserRepo)
    {

        $this->PageRepo = $PageRepo;
        $this->UserRepo = $UserRepo;
    }

    public function index()
    {

        try {
            $page = $this->PageRepo->all();

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $page,
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

    public function filteractive()
    {

        try {
            $page = $this->PageRepo->filteractive();

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $page,
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

    public function filterinactive()
    {

        try {
            $page = $this->PageRepo->filterinactive();

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $page,
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

    public function filterdeleted()
    {

        try {
            $page = $this->PageRepo->filterdeleted();

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $page,
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

    public function findbyid($id)
    {

        try {
            $page = $this->PageRepo->findbyid($id);

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $page,
            ];

            return response()->json($response, 200);

        } catch (\Exception $ex) {
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => _('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }

    }

    public function filterby($item, $id)
    {

        try {
            $page = $this->PageRepo->filterby($item, $id);

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $page,
            ];

            return response()->json($response, 200);

        } catch (\Exception $ex) {
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
            $page = $this->PageRepo->findbyunique($item, $string);

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $page,
            ];

            return response()->json($response, 200);

        } catch (\Exception $ex) {
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => _('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }

    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            //   'content' => 'required',
            //  'id_featured_image' => 'required',
            'visibility' => 'required',
            'status_page' => 'required',
            //'id_user' => 'required',
            'permanent_link' => 'required',
            // 'creation_date' => 'required',
            // 'publication_date' => 'required',
            // 'modification_date' => 'required',
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
                'content' => $request->get('content'),
                'image' => $request->get('image'),
                'visibility' => $request->get('visibility'),
                'status_page' => $request->get('status_page'),
                'id_user' => Auth::id(),
                'permanent_link' => $request->get('permanent_link'),
                'creation_date' => Carbon::now(),
                'publication_date' => $request->get('publication_date'),
                'modification_date' => Carbon::now(),
                'active' => 1,
            ];

            $item = 'title';
            $string = $data['title'];
            $PageDupletitle = $this->PageRepo->checkduplicate($item, $string);
            $item = 'permanent_link';
            $string = $data['permanent_link'];
            $PageDuplelink = $this->PageRepo->checkduplicate($item, $string);


            if ($PageDupletitle == 0 && $PageDuplelink == 0) {

                $page = $this->PageRepo->store($data);
                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('La pagina ha sido registrado correctamente'),
                    'data' => $page,
                ];

                return response()->json($response, 200);

            } else {
                $response = [
                    'status' => 'FAILED',
                    'code' => 409,
                    'message' => _('La pagina fue registrada anteriormente') . '.',

                ];

                return response()->json($response, 409);
            }
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

    public function update(Request $request, $id)
    {

        Log::debug($request);
        $page = $this->PageRepo->findbyid($id);


        if ($request->has('title')) {
            $data['title'] = $request->get('title');
        }
        if ($request->has('content')) {
            $data['content'] = $request->get('content');
        }
        if ($request->has('image')) {
            $data['image'] = $request->get('image');
        }
        if ($request->has('visibility')) {
            $data['visibility'] = $request->get('visibility');
        }
        if ($request->has('status_page')) {
            $data['status_page'] = $request->get('status_page');
        }
        /*if ($request->has('id_user')) {
            $data['id_user'] = $request->get('id_user');
        }*/
        if ($request->has('permanent_link')) {
            $data['permanent_link'] = $request->get('permanent_link');
        }
        /* if ($request->has('creation_date')) {
             $data['creation_date'] = $request->get('creation_date');
         }*/
        if ($request->has('publication_date')) {
            $data['publication_date'] = $request->get('publication_date');
        }
        /* if ($request->has('modification_date')) {
             $data['modification_date'] = $request->get('modification_date');
         }*/
        if ($request->has('active')) {
            $data['active'] = $request->get('active');
        }
        $data['modification_date'] = Carbon::now();

        try {

            $item = 'title';
            $string = $data['title'];
            $PageDupletitle = $this->PageRepo->checkduplicate($item, $string);
            $item = 'permanent_link';
            $string = $data['permanent_link'];
            $PageDuplelink = $this->PageRepo->checkduplicate($item, $string);


            if ($PageDupletitle == 0 && $PageDuplelink == 0) {

                $page = $this->PageRepo->update($page, $data);

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('El Page ha sido modificado correctamente '),
                    'data' => $page,
                ];

                return response()->json($response, 200);

            } else {
                $response = [
                    'status' => 'FAILED',
                    'code' => 409,
                    'message' => _('La pagina fue registrada anteriormente') . '.',

                ];

                return response()->json($response, 409);
            }
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

    public function activate($id, Request $request)
    {


        try {

            $page = $this->PageRepo->findbyid($id);
            $page = $this->PageRepo->activate($page, ['active' => 1]);

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('La pagina ha sido activada correctamente '),
                'data' => $page,
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

    public function inactivate($id, Request $request)
    {


        try {

            $page = $this->PageRepo->findbyid($id);
            $page = $this->PageRepo->inactivate($page, ['active' => 0]);

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('La pagina ha sido inactivada correctamente '),
                'data' => $page,
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

    public function delete($id, Request $request)
    {


        try {

            $page = $this->PageRepo->findbyid($id);
            $page = $this->PageRepo->delete($page, ['active' => 2]);

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('La pagina ha sido eliminada correctamente '),
                'data' => $page,
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


    public function custom_message()
    {
        return [
            'title.required' => __('El titulo es requerido'),
            // 'content.required' => __('El contenido es requerido'),
            // 'id_featured_image.required' => __('La imagen destacada es requerida'),
            'visibility.required' => __('La visibilidad es requerida'),
            'status_page.required' => __('El estatus de la pagina es requerido'),
            // 'id_user.required' => __('El usuario es requerido'),
            'permanent_link.required' => __('El link permanente es requerido'),
            //'creation_date.required' => __('La fecha de creacion es requerida'),
            // 'publication_date.required' => __('La fecha de publicacion es requerida'),
            // 'modification_date.required' => __('La fecha de modificacion es requerida'),
        ];
    }

}
