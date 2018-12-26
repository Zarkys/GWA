<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\Http\Models\Repositories\PostCategoryRepo;
    use App\Http\Models\Repositories\PostRepo;
    use App\Http\Models\Repositories\CategoryRepo;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;
    
    class PostCategoryController extends BaseController {
        
        private $PostCategoryRepo;
        private $CategoryRepo;
        private $PostRepo;
        
        public function __construct(PostCategoryRepo $PostCategoryRepo, CategoryRepo $CategoryRepo, PostRepo $PostRepo) {
            
            $this->PostCategoryRepo = $PostCategoryRepo;
            $this->CategoryRepo        = $CategoryRepo;
            $this->PostRepo        = $PostRepo;
        }
        
        public function index() {
            
            try {
                $postcategory = $this->PostCategoryRepo->all();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $postcategory,
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
        
        public function indexactive() {
            
            try {
                $postcategory = $this->PostCategoryRepo->filteractive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $postcategory,
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
                $postcategory = $this->PostCategoryRepo->filterby($item, $id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $postcategory,
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
        
        public function find($id) {
            
            try {
                $postcategory = $this->PostCategoryRepo->find($id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $postcategory,
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
                'id_category' => 'required',
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
                    'id_category' => $request->get('id_category'),
                    'id_post' => $request->get('id_post'),
                    'active'     => 1,
                ];
                
                $postcategory = $this->PostCategoryRepo->store($data);
                $response       = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria ha sido asignado a un post  correctamente'),
                    'data'    => $postcategory,
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
        
        public function update(Request $request, $id) {
            
            Log::debug($request);
            $postcategory = $this->PostCategoryRepo->find($id);
            
            
            if ($request->has('id_category')) {
                $data['id_category'] = $request->get('id_category');
            }
            if ($request->has('id_post')) {
                $data['id_post'] = $request->get('id_post');
            }
            
            if ($request->has('active')) {
                $data['active'] = $request->get('active');
            }
            
            try {
                
                $postcategory = $this->PostCategoryRepo->update($postcategory, $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria ha sido modificada para un post  correctamente '),
                    'data'    => $postcategory,
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
                
                $postcategory = $this->PostCategoryRepo->find($id);
                $postcategory = $this->PostCategoryRepo->delete($postcategory, ['active' => 0]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria ha sido eliminada correctamente del post'),
                    'data'    => $postcategory,
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
                'id_category.required' => __('La categoria es requerida'),
                'id_post.required' => __('El post es requerido'),
            ];
        }
        
    }
