<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\Http\Models\Repositories\ComentRepo;
    use App\Http\Models\Repositories\PostRepo;
    use App\Http\Models\Repositories\UserRepo;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;
    class ComentController extends BaseController {
        
        private $ComentRepo;
        private $PostRepo;
        private $UserRepo;
        
        public function __construct(ComentRepo $ComentRepo, PostRepo $PostRepo, UserRepo $UserRepo) {
            
            $this->ComentRepo = $ComentRepo;
            $this->PostRepo = $PostRepo;
            $this->UserRepo = $UserRepo;
        }
        
        public function index() {
            
            try {
                $coment = $this->ComentRepo->all();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $coment,
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
                $coment = $this->ComentRepo->filteractive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $coment,
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
                $coment = $this->ComentRepo->filterinactive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $coment,
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
                $coment = $this->ComentRepo->filterdeleted();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $coment,
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
        public function filterby($item,$id) {
            
            try {
                $coment = $this->ComentRepo->filterby($item,$id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $coment,
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
                $coment = $this->ComentRepo->findbyid($id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $coment,
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
                'coment'    => 'required',
               // 'id_answer_to'    => 'required',
                'id_post'    => 'required',
                'status_coment'    => 'required',
                'publication_date'    => 'required',
                'id_user'    => 'required',
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
                    'coment'    => $request->get('coment'),
                    'id_answer_to' => $request->get('id_answer_to'),
                    'id_post'    => $request->get('id_post'),
                    'status_coment'    => $request->get('status_coment'),
                    'publication_date'    => $request->get('publication_date'),
                    'id_user' => $request->get('id_user'),
                    'active' => 1,
                ];
        
                $coment     = $this->ComentRepo->store($data);
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El comentario ha sido registrado  correctamente'),
                    'data'    => $coment,
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
        
        public function update(Request $request,$id) {
            
            Log::debug($request);
            $coment = $this->ComentRepo->findbyid($id);


            if($request->has('coment')){
                $data['coment'] = $request->get('coment');
            }
            if($request->has('id_answer_to')){
                $data['id_answer_to'] = $request->get('id_answer_to');
            }
            if($request->has('id_post')){
                $data['id_post'] = $request->get('id_post');
            }
            if($request->has('status_coment')){
                $data['status_coment'] = $request->get('status_coment');
            }
            if($request->has('publication_date')){
                $data['publication_date'] = $request->get('publication_date');
            }
            if($request->has('id_user')){
                $data['id_user'] = $request->get('id_user');
            }

    
            try {
               
                $coment = $this->ComentRepo->update($coment, $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El comentario ha sido modificado correctamente '),
                    'data'    => $coment,
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

         public function activate($id, Request $request) {
          
         
            
            try {
                
                $coment = $this->ComentRepo->findbyid($id);
                $coment = $this->ComentRepo->activate($coment, ['active' => 1]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El archivo ha sido eliminado correctamente'),
                    'data'    => $coment,
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
                
                $coment = $this->ComentRepo->findbyid($id);
                $coment = $this->ComentRepo->inactivate($coment, ['active' => 0]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El archivo ha sido eliminado correctamente'),
                    'data'    => $coment,
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
                
                $coment = $this->ComentRepo->findbyid($id);
                $coment = $this->ComentRepo->delete($coment, ['active' => 2]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El archivo ha sido eliminado correctamente'),
                    'data'    => $coment,
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
                'coment.required'  => __('El comentario es requerido'),
               // 'id_answer_to.required'      => __('El destinatario es requerido'),
                'id_post.required'  => __('El post es requerido'),
                'status_coment.required'  => __('El estatus del comentario es requerido'),
                'publication_date.required'  => __('La fecha de publicacion es requerida'),
                'id_user.required'  => __('El usuario es requerido'),

            ];
        }

    }
