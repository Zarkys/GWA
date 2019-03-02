<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\Http\Models\Repositories\ProductRepo;
    use App\Http\Models\Repositories\TypeProductRepo;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;
    
    class ProductController extends BaseController {
        
        private $ProductRepo;
        private $TypeProductRepo;
        
        public function __construct(ProductRepo $ProductRepo,  TypeProductRepo $TypeProductRepo) {
            
            $this->ProductRepo = $ProductRepo;
            $this->TypeProductRepo        = $TypeProductRepo;
        }
        
        public function index() {
            
            try {
                $product = $this->ProductRepo->all();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $product,
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
                $product = $this->ProductRepo->filteractive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $product,
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
        public function getProductWithAttributes($idproduct) {
            
            try {
                $product = $this->ProductRepo->getProductWithAttributes($idproduct);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $product,
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
        public function getProductsWithAttributes() {
            
            try {
                $product = $this->ProductRepo->getProductsWithAttributes();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $product,
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
                $product = $this->ProductRepo->filterinactive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $product,
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
                $product = $this->ProductRepo->filterdeleted();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $product,
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
                $product = $this->ProductRepo->filterby($item, $id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $product,
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
                $product = $this->ProductRepo->findbyid($id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $product,
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
                $product = $this->ProductRepo->findbyunique($item,$string);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $product,
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
                'name' => 'required',
                'id_type_product' => 'required',
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
                    'name' => $request->get('name'),
                    'id_type_product' => $request->get('id_type_product'),
                    'active'     => 1,
                ];
              $itemfirst = 'name';
              $stringfirst = $data['name'];
              $itemsecond = 'id_type_product';
              $stringsecond = $data['id_type_product'];
              $ProductDuple = $this->ProductRepo->checkduplicate($itemfirst,$stringfirst,$itemsecond,$stringsecond);
             

           if ($ProductDuple==0) { 
                
                
                $product = $this->ProductRepo->store($data);
                $response       = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El producto ha sido registrado correctamente'),
                    'data'    => $product,
                ];
                
                return response()->json($response, 200);

                    }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('El producto fue registrado anteriormente') . '.',
        
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
            $product = $this->ProductRepo->findbyid($id);
            
            
            if ($request->has('name')) {
                $data['name'] = $request->get('name');
            }
            if ($request->has('id_type_product')) {
                $data['id_type_product'] = $request->get('id_type_product');
            }
            
            if ($request->has('active')) {
                $data['active'] = $request->get('active');
            }
            
            try {
              $itemfirst = 'name';
              $stringfirst = $data['name'];
              $itemsecond = 'id_type_product';
              $stringsecond = $data['id_type_product'];
              $ProductDuple = $this->ProductRepo->checkduplicate($itemfirst,$stringfirst,$itemsecond,$stringsecond);
             

            if ($ProductDuple==0) {
                $product = $this->ProductRepo->update($product, $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El producto fue modificado correctamente '),
                    'data'    => $product,
                ];
                
                return response()->json($response, 200);
                  }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('El producto fue registrado  anteriormente') . '.',
        
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
      

        public function changue($id, Request $request) {
            
            
            try {
                
                $product = $this->ProductRepo->findbyid($id);

                if($product->active === 0)
                {
                    $product = $this->ProductRepo->update($product, ['active' => 1]);
                }
                else
                {
                    $product = $this->ProductRepo->update($product, ['active' => 0]);
                }
                
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El producto fue cambiado correctamente '),
                    'data'    => $product,
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
                
                $product = $this->ProductRepo->findbyid($id);
                $product = $this->ProductRepo->delete($product, ['active' => 2]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El producto fue eliminado correctamente'),
                    'data'    => $product,
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
                'name.required' => __('El nombre es requerido'),
                'id_type_product.required' => __('El tipo de producto es requerido'),
            ];
        }
        
    }
