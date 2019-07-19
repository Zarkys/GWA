<?php

namespace Modules\Records\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Modules\Records\Models\Repositories\RecordsRepo;

class LibraryController extends BaseController
{

    private $RecordsRepo;

    public function __construct(RecordsRepo $RecordsRepo)
    {

        $this->RecordsRepo = $RecordsRepo;
    }

//    TODO VIEWS LIBRARY
    public function list()
    {

        return view('records::library.list');

    }

//    TODO CRUD LIBRARY
    public function listAll()
    {
        try {

            $records = $this->RecordsRepo->all();

            $data['image'] = [
                'total' => 0,
                'size' => 0,
            ];
            $data['video'] = [
                'total' => 0,
                'size' => 0,
            ];
            $data['audio'] = [
                'total' => 0,
                'size' => 0,
            ];
            $data['office'] = [
                'total' => 0,
                'size' => 0,
            ];
            foreach ($records as $item => $value) {
                $data[$value->type]['total'] = $data[$value->type]['total'] + 1;
                $data[$value->type]['size'] = $data[$value->type]['size'] + $value->size;

            }
            foreach ($data as $index => $valor) {
                $size = $data[$index]['size'];

                $units = array('B', 'KB', 'MB', 'GB');

                $size = max($size, 0);
                $pow = floor(($size ? log($size) : 0) / log(1024));
                $pow = min($pow, count($units) - 1);

                $size /= pow(1024, $pow);
//             $bytes /= (1 << (10 * $pow));

                $data[$index]['size'] = number_format($size, 2) . ' ' . $units[$pow];

            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $data,
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

    public function loadItem(Request $request)
    {

        try {

            $records = $this->RecordsRepo->allWhere(['type' => $request->get('item')]);

            foreach ($records as $item => $value) {
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
                if ($value->type === 'office') {
                    $value->typeExtension = explode('.', $value->name)[1];

                    if ($value->typeExtension === 'pdf' || $value->typeExtension === 'docx') {
                        $value->urlTemp = 'http://docs.google.com/gview?url=http://www.posgrado.unam.mx/filosofiadelaciencia/media/uploaded_files/2012/04/guia_digit_conacyt.pdf&embedded=true';
                    } else {
                        $value->typeView = false;
                        $value->urlTemp = 'http://docs.google.com/gview?url=http://www.picssel.com/demos/downloads/Fancybox.doc&embedded=true';
                    }
                }
                $value->typeExtension = is_null($value->typeExtension) ? '' : '(' . $value->typeExtension . ')';


            }

//            while (true) {
//                sleep(10);
//            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $records,
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

    public function itemDelete(Request $request)
    {

        try {

            $archive = $this->RecordsRepo->find($request->get('id'));
            if (isset($archive->id)) {

                $urlTmp = storage_path('../public/upload/records/' . $archive->type . '/' . $archive->name);
                ComponentController::deleteFile($urlTmp);

                $this->RecordsRepo->delete($archive->id);

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Eliminado Correctamente')
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
}
