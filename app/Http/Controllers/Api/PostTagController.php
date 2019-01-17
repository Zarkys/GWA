<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\Http\Models\Repositories\PostTagRepo;
    use App\Http\Models\Repositories\PostRepo;
    use App\Http\Models\Repositories\TagRepo;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;
    
    class PostTagController extends BaseController {
        
        private $PostTagRepo;
        private $TagRepo;
        private $PostRepo;
        
        public function __construct(PostTagRepo $PostTagRepo, TagRepo $TagRepo, PostRepo $PostRepo) {
            
            $this->PostTagRepo = $PostTagRepo;
            $this->TagRepo        = $TagRepo;
            $this->PostRepo        = $PostRepo;
        }
        
        public function index() {
            
            try {
                $posttag = $this->PostTagRepo->all();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $posttag,
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
            
        }
        
        public function filteractive() {
            
            try {
                $posttag = $this->PostTagRepo->filteractive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $posttag,
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
            
        }
        public function filterinactive() {
            
            try {
                $posttag = $this->PostTagRepo->filterinactive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $posttag,
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
            
        }
        public function filterdeleted() {
            
            try {
                $posttag = $this->PostTagRepo->filterdeleted();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $posttag,
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
            
        }
        
        public function filterby($item, $id) {
            
            try {
                $posttag = $this->PostTagRepo->filterby($item, $id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $posttag,
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
            
        }
        
        public function findbyid($id) {
            
            try {
                $posttag = $this->PostTagRepo->findbyid($id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $posttag,
                ];
                
                return response()->json($response, 200);
                
            } catch (\Exception $ex) {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                ];
                
                return response()->json($response, 500);
            }
            
        }
        
        public function save(Request $request) {
            $validator = Validator::make($request->all(), [
                'id_tag' => 'required',
                'id_post' => 'required',
            ], $this->custom_message());
            
            if ($validator->fails()) {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 400,
                    'message' => __('Parametros incorrectos'),
                    'data'    => $validator->errors()->getMessages(),
                ];
                
           

                return response()->json($response);
            }
            try {
                
                $data = [
                    'id_tag' => $request->get('id_tag'),
                    'id_post' => $request->get('id_post'),
                    'active'     => 1,
                ];
              $itemfirst = 'id_post';
              $stringfirst = $data['id_post'];
              $itemsecond = 'id_tag';
              $stringsecond = $data['id_tag'];
              $PostTagDuple = $this->PostTagRepo->checkduplicate($itemfirst,$stringfirst,$itemsecond,$stringsecond);
             

           if ($PostTagDuple==0) { 
                
                
                $posttag = $this->PostTagRepo->store($data);
                $response       = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La etiqueta ha sido asignado a un post  correctamente'),
                    'data'    => $posttag,
                ];
                
                return response()->json($response, 200);

                    }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('La categoria fue registrada para este post anteriormente') . '.',
        
                ];
        
                return response()->json($response, 409); 
            }
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
        
        public function update(Request $request, $id) {
            
            Log::debug($request);
            $posttag = $this->PostTagRepo->findbyid($id);
            
            
            if ($request->has('id_tag')) {
                $data['id_tag'] = $request->get('id_tag');
            }
            if ($request->has('id_post')) {
                $data['id_post'] = $request->get('id_post');
            }
            
            if ($request->has('active')) {
                $data['active'] = $request->get('active');
            }
            
            try {
                $itemfirst = 'id_post';
              $stringfirst = $data['id_post'];
              $itemsecond = 'id_tag';
              $stringsecond = $data['id_tag'];
              $PostTagDuple = $this->PostTagRepo->checkduplicate($itemfirst,$stringfirst,$itemsecond,$stringsecond);
             

            if ($PostTagDuple==0) {
                $posttag = $this->PostTagRepo->update($posttag, $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La etiqueta ha sido modificada para un post  correctamente '),
                    'data'    => $posttag,
                ];
                
                return response()->json($response, 200);
                  }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('La categoria fue registrada para este post anteriormente') . '.',
        
                ];
        
                return response()->json($response, 409); 
            }
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
        public function activate($id, Request $request) {
            
            
            try {
                
                $posttag = $this->PostTagRepo->findbyid($id);
                $posttag = $this->PostTagRepo->activate($posttag, ['active' => 1]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La etiqueta ha sido eliminada correctamente del post'),
                    'data'    => $posttag,
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
            
        }

        public function inactivate($id, Request $request) {
            
            
            try {
                
                $posttag = $this->PostTagRepo->findbyid($id);
                $posttag = $this->PostTagRepo->inactivate($posttag, ['active' => 0]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La etiqueta ha sido eliminada correctamente del post'),
                    'data'    => $posttag,
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
            
        }
        
        public function delete($id, Request $request) {
            
            
            try {
                
                $posttag = $this->PostTagRepo->findbyid($id);
                $posttag = $this->PostTagRepo->delete($posttag, ['active' => 2]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La etiqueta ha sido eliminada correctamente del post'),
                    'data'    => $posttag,
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
            
        }


        
        
        public function custom_message() {
            return [
                'id_tag.required' => __('La etiqueta es requerida'),
                'id_post.required' => __('El post es requerido'),
            ];
        }
        
    }
