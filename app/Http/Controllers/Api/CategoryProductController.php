<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\Http\Models\Repositories\CategoryProductRepo;
    use App\Http\Models\Repositories\CategoryForProductRepo;
    use App\Http\Models\Repositories\ProductRepo;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;
    class CategoryProductController extends BaseController {
        
        private $CategoryProductRepo;
        private $CategoryForProductRepo;
        private $ProductRepo;
        
        public function __construct(CategoryProductRepo $CategoryProductRepo, CategoryForProductRepo $CategoryForProductRepo, ProductRepo $ProductRepo) {
            
            $this->CategoryProductRepo = $CategoryProductRepo;
            $this->CategoryForProductRepo = $CategoryForProductRepo;
            $this->ProductRepo = $ProductRepo;
        }
        
        public function index() {
            
            try {
                $categoryproduct = $this->CategoryProductRepo->all();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $categoryproduct,
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
                $categoryproduct = $this->CategoryProductRepo->filteractive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $categoryproduct,
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
                $categoryproduct = $this->CategoryProductRepo->filterinactive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $categoryproduct,
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
                $categoryproduct = $this->CategoryProductRepo->filterdeleted();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $categoryproduct,
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
                $categoryproduct = $this->CategoryProductRepo->filterby($item,$id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $categoryproduct,
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
                $categoryproduct = $this->CategoryProductRepo->findbyid($id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $categoryproduct,
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

       /* public function findbyunique($item, $string) {
            
            try {
                $categoryproduct = $this->categoryproductRepo->findbyunique($item,$string);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $categoryproduct,
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
            
        }*/
        
        public function save(Request $request) {
            $validator = Validator::make($request->all(), [
                'id_product' => 'required',
                'id_category_for_product' => 'required',
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
                    'id_product' => $request->get('id_product'),
                    'id_category_for_product' => $request->get('id_category_for_product'),
                    'active' => 1,
                ];

              $itemfirst = 'id_product';
              $stringfirst = $data['id_product'];
              $itemsecond = 'id_category_for_product';
              $stringsecond = $data['id_category_for_product'];
              $CategoryProductDuple = $this->CategoryProductRepo->checkduplicate($itemfirst,$stringfirst,$itemsecond,$stringsecond);
             

           if ($CategoryProductDuple==0) {
        
                $categoryproduct     = $this->CategoryProductRepo->store($data);
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria ha sido asignada  correctamente al producto'),
                    'data'    => $categoryproduct,
                ];
        
                return response()->json($response, 200);
            }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('La categoria fue asignada anteriormente al producto') . '.',
        
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
            $categoryproduct = $this->CategoryProductRepo->findbyid($id);

            
            if($request->has('id_product')){
                $data['id_product'] = $request->get('id_product');
            }
            if($request->has('id_category_for_product')){
                $data['id_category_for_product'] = $request->get('id_category_for_product');
            }
            if ($request->has('active')) {
                $data['active'] = $request->get('active');
            }
    
            try {

              $itemfirst = 'id_product';
              $stringfirst = $data['id_product'];
              $itemsecond = 'id_category_for_product';
              $stringsecond = $data['id_category_for_product'];
              $CategoryProductDuple = $this->CategoryProductRepo->checkduplicate($itemfirst,$stringfirst,$itemsecond,$stringsecond);
             

           if ($CategoryProductDuple==0) {
               
                $categoryproduct = $this->CategoryProductRepo->update($categoryproduct, $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La asignación de la categoria al producto ha sido modificada correctamente '),
                    'data'    => $categoryproduct,
                ];
                
                return response()->json($response, 200);
                }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('La categoria fue asignada al producto anteriormente') . '.',
        
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
                
                $categoryproduct = $this->CategoryProductRepo->findbyid($id);
                $categoryproduct = $this->CategoryProductRepo->activate($categoryproduct, ['active' => 1]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria asignada al producto ha sido activada correctamente'),
                    'data'    => $categoryproduct,
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
                
                $categoryproduct = $this->CategoryProductRepo->findbyid($id);
                $categoryproduct = $this->CategoryProductRepo->inactivate($categoryproduct, ['active' => 0]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria asignada al producto ha sido inactivada correctamente'),
                    'data'    => $categoryproduct,
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
                
                $categoryproduct = $this->CategoryProductRepo->findbyid($id);
                $categoryproduct = $this->CategoryProductRepo->delete($categoryproduct, ['active' => 2]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La categoria asignada al producto ha sido eliminada correctamente'),
                    'data'    => $categoryproduct,
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
               'id_product.required' => __('El producto es requerido'),
               'id_category_for_product.required' => __('La categoria de producto es requerida'),
            ];
        }

    }
