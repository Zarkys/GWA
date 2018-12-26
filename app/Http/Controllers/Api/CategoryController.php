<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\Http\Models\Repositories\CategoryRepo;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;
    class CategoryController extends BaseController {
        
        private $CategoryRepo;
        
        public function __construct(CategoryRepo $CategoryRepo) {
            
            $this->CategoryRepo = $CategoryRepo;
        }
        
        public function index() {
            
            try {
                $category = $this->CategoryRepo->all();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $category,
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
                $category = $this->CategoryRepo->filteractive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $category,
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
                $category = $this->CategoryRepo->filterby($item,$id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $category,
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
                $category = $this->CategoryRepo->find($id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $category,
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
                'name'    => 'required',
                'slug'    => 'required',
                'description'    => 'required',
                'parent_category'    => 'required',
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
                    'name'    => $request->get('name'),
                    'slug' => $request->get('slug'),
                    'description'    => $request->get('description'),
                    'parent_category'    => $request->get('parent_category'),
                    'active' => 1,
                ];
        
                $category     = $this->CategoryRepo->store($data);
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria ha sido registrada  correctamente'),
                    'data'    => $category,
                ];
        
                return response()->json($response, 200);
            } catch (\Exception $ex) {
                Log::error($ex);
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno1') . '.',
        
                ];
        
                return response()->json($response, 500);
            }
        }
        
        public function update(Request $request,$id) {
            
            Log::debug($request);
            $category = $this->CategoryRepo->find($id);

            
            if($request->has('name')){
                $data['name'] = $request->get('name');
            }
            if($request->has('slug')){
                $data['slug'] = $request->get('slug');
            }
            if($request->has('description')){
                $data['description'] = $request->get('description');
            }
            if($request->has('parent_category')){
                $data['parent_category'] = $request->get('parent_category');
            }
    
            try {
               
                $category = $this->CategoryRepo->update($category, $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria ha sido modificada correctamente '),
                    'data'    => $category,
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
                
                $category = $this->CategoryRepo->find($id);
                $category = $this->CategoryRepo->delete($category, ['active' => 0]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria ha sido eliminada correctamente'),
                    'data'    => $category,
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
                'name.required'  => __('El nombre es requerido'),
                'slug.required'      => __('El slug es requerido'),
                'description.required'  => __('La descripcion es requerida'),
                'parent_category.required'  => __('La categoria padre es requerida'),
            ];
        }

    }
