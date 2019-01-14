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
        
        public function filteractive() {
            
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

         public function filterinactive() {
            
            try {
                $postcategory = $this->PostCategoryRepo->filterinactive();
                
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
         public function filterdeleted() {
            
            try {
                $postcategory = $this->PostCategoryRepo->filterdeleted();
                
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
        
        public function findbyid($id) {
            
            try {
                $postcategory = $this->PostCategoryRepo->findbyid($id);
                
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

              $item = 'id_category';
              $string = $data['id_category'];
              $PostCategorycategoryDuple = $this->PostCategoryRepo->checkduplicate($item,$string);
              $item = 'id_post';
              $string = $data['id_post'];
              $PostCategorypostDuple = $this->PostCategoryRepo->checkduplicate($item,$string);
             

            if ($PostCategoryDuple==0) { 
                
                $postcategory = $this->PostCategoryRepo->store($data);
                $response       = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria ha sido asignado a un post  correctamente'),
                    'data'    => $postcategory,
                ];
                
                return response()->json($response, 200);

                
                }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('La categoria fue registrada anteriormente para un post') . '.',
        
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
            $postcategory = $this->PostCategoryRepo->findbyid($id);
            
            
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
                

                $item = 'id_category';
              $string = $data['id_category'];
              $PostCategorycategoryDuple = $this->PostCategoryRepo->checkduplicate($item,$string);
              $item = 'id_post';
              $string = $data['id_post'];
              $PostCategorypostDuple = $this->PostCategoryRepo->checkduplicate($item,$string);
             

            if ($PostCategoryDuple==0) {
                $postcategory = $this->PostCategoryRepo->update($postcategory, $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria ha sido modificada para un post  correctamente '),
                    'data'    => $postcategory,
                ];
                
                return response()->json($response, 200);

                }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('La categoria fue registrada anteriormente para un post') . '.',
        
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
                
                $postcategory = $this->PostCategoryRepo->findbyid($id);
                $postcategory = $this->PostCategoryRepo->activate($postcategory, ['active' => 1]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria ha sido activada correctamente del post'),
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

         public function inactivate($id, Request $request) {
            
            
            try {
                
                $postcategory = $this->PostCategoryRepo->findbyid($id);
                $postcategory = $this->PostCategoryRepo->inactivate($postcategory, ['active' => 0]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria ha sido inactivada correctamente del post'),
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
                
                $postcategory = $this->PostCategoryRepo->findbyid($id);
                $postcategory = $this->PostCategoryRepo->delete($postcategory, ['active' => 2]);
                
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
