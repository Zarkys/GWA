<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\Http\Models\Repositories\CategoryForProductRepo;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;
    class CategoryForProductController extends BaseController {
        
        private $CategoryForProductRepo;
        
        public function __construct(CategoryForProductRepo $CategoryForProductRepo) {
            
            $this->CategoryForProductRepo = $CategoryForProductRepo;
        }
        
        public function index() {
            
            try {
                $categoryforproduct = $this->CategoryForProductRepo->all();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $categoryforproduct,
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
                $categoryforproduct = $this->CategoryForProductRepo->filteractive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $categoryforproduct,
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
                $categoryforproduct = $this->CategoryForProductRepo->filterinactive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $categoryforproduct,
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
                $categoryforproduct = $this->CategoryForProductRepo->filterdeleted();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $categoryforproduct,
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
        /*public function filterby($item,$id) {
            
            try {
                $categoryforproduct = $this->CategoryForProductRepo->filterby($item,$id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $categoryforproduct,
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
            
        }*/
        public function findbyid($id) {
            
            try {
                $categoryforproduct = $this->CategoryForProductRepo->findbyid($id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $categoryforproduct,
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

        public function findbyunique($item, $string) {
            
            try {
                $categoryforproduct = $this->CategoryForProductRepo->findbyunique($item,$string);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $categoryforproduct,
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
               // 'slug'    => 'required',
               // 'description'    => 'required',
               // 'parent_categoryforproduct'    => 'required',
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
                    'description'    => $request->get('description'),
                    'active' => 1,
                ];

                $item = 'name';
                $string = $data['name'];
                $categoryforproductDuplename = $this->CategoryForProductRepo->checkduplicate($item,$string);
             

            if ($categoryforproductDuplename==0) {
        
                $categoryforproduct     = $this->CategoryForProductRepo->store($data);
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria del producto ha sido registrada  correctamente'),
                    'data'    => $categoryforproduct,
                ];
        
                return response()->json($response, 200);
            }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('La categoria del producto fue registrada anteriormente') . '.',
        
                ];
        
                return response()->json($response, 409); 
            }
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
            $categoryforproduct = $this->CategoryForProductRepo->findbyid($id);

            
            if($request->has('name')){
                $data['name'] = $request->get('name');
            }
            if($request->has('description')){
                $data['description'] = $request->get('description');
            }
    
            try {

                $item = 'name';
                $string = $data['name'];
                $categoryforproductDuplename = $this->CategoryForProductRepo->checkduplicate($item,$string);
             

            if ($categoryforproductDuplename==0) {
               
                $categoryforproduct = $this->CategoryForProductRepo->update($categoryforproduct, $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria del producto ha sido modificada correctamente '),
                    'data'    => $categoryforproduct,
                ];
                
                return response()->json($response, 200);
                }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('La categoria del producto fue registrada anteriormente') . '.',
        
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
                
                $categoryforproduct = $this->CategoryForProductRepo->findbyid($id);
                $categoryforproduct = $this->CategoryForProductRepo->activate($categoryforproduct, ['active' => 1]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria del producto ha sido activada correctamente'),
                    'data'    => $categoryforproduct,
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
                
                $categoryforproduct = $this->CategoryForProductRepo->findbyid($id);
                $categoryforproduct = $this->CategoryForProductRepo->inactivate($categoryforproduct, ['active' => 0]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria del producto ha sido inactivada correctamente'),
                    'data'    => $categoryforproduct,
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
                
                $categoryforproduct = $this->CategoryForProductRepo->findbyid($id);
                $categoryforproduct = $this->CategoryForProductRepo->delete($categoryforproduct, ['active' => 2]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria del producto ha sido eliminada correctamente'),
                    'data'    => $categoryforproduct,
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
              /*  'slug.required'      => __('El slug es requerido'),
                'description.required'  => __('La descripcion es requerida'),
                'parent_categoryforproduct.required'  => __('La categoria padre es requerida'),*/
            ];
        }

    }
