<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\Http\Models\Repositories\ProductAttributeRepo;
    use App\Http\Models\Repositories\ProductRepo;
    use App\Http\Models\Repositories\AttributeRepo;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;
    
    
    class ProductAttributeController extends BaseController {
        
        private $ProductAttributeRepo;
        private $ProductRepo;
        private $AttributeRepo;
        
        public function __construct(ProductAttributeRepo $ProductAttributeRepo,  ProductRepo $ProductRepo,  AttributeRepo $AttributeRepo) {
            
            $this->ProductAttributeRepo = $ProductAttributeRepo;
            $this->ProductRepo        = $ProductRepo;
            $this->AttributeRepo        = $AttributeRepo;
        }
        
        public function index() {
            
            try {
                $productattribute = $this->ProductAttributeRepo->all();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $productattribute,
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
                $productattribute = $this->ProductAttributeRepo->filteractive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $productattribute,
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
                $productattribute = $this->ProductAttributeRepo->filterinactive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $productattribute,
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
                $productattribute = $this->ProductAttributeRepo->filterdeleted();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $productattribute,
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
                $productattribute = $this->ProductAttributeRepo->filterby($item, $id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $productattribute,
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
        public function getAttributesValue($idproduct) {
            
            try {
                $productattribute = $this->ProductAttributeRepo->getAttributesValue($idproduct);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $productattribute,
                ];
                
                return response()->json($response, 200);
                
            } catch (\Exception $ex) {
                Log::error($ex);
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrios un error interno') . '.',
                ];
                
                return response()->json($response, 500);
            }
            
        }
        
        public function findbyid($id) {
            
            try {
                $productattribute = $this->ProductAttributeRepo->findbyid($id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $productattribute,
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
                $productattribute = $this->ProductAttributeRepo->findbyunique($item,$string);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $productattribute,
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
                'id_product' => 'required',
                'id_attribute' => 'required',
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
                    'id_attribute' => $request->get('id_attribute'),
                    'active'     => 1,
                ];
              $itemfirst = 'id_product';
              $stringfirst = $data['id_product'];
              $itemsecond = 'id_attribute';
              $stringsecond = $data['id_attribute'];
              $ProductAttributeDuple = $this->ProductAttributeRepo->checkduplicate($itemfirst,$stringfirst,$itemsecond,$stringsecond);
             

           if ($ProductAttributeDuple==0) { 
                
                
                $productattribute = $this->ProductAttributeRepo->store($data);
                $response       = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El atributo ha sido asignado a un producto correctamente'),
                    'data'    => $productattribute,
                ];
                
                return response()->json($response, 200);

                    }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('El atributo habia sido asignado a un producto anteriormente') . '.',
        
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
        public function updateAttributes(Request $request, $id) {
            
            try {
              
                  
                  $input = $request->all();                 
                    
                 
                $productattribute = $this->ProductAttributeRepo->updateAttributes($input, $id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El atributo  fue modificado correctamente para el producto'),
                    'data'    => $productattribute,
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
            $productattribute = $this->ProductAttributeRepo->findbyid($id);
            
            
            if ($request->has('id_product')) {
                $data['id_product'] = $request->get('id_product');
            }
            if ($request->has('id_attribute')) {
                $data['id_attribute'] = $request->get('id_attribute');
            }
            
            if ($request->has('active')) {
                $data['active'] = $request->get('active');
            }
            
            try {
              $itemfirst = 'id_product';
              $stringfirst = $data['id_product'];
              $itemsecond = 'id_attribute';
              $stringsecond = $data['id_attribute'];
              $ProductAttributeDuple = $this->ProductAttributeRepo->checkduplicate($itemfirst,$stringfirst,$itemsecond,$stringsecond);
             

            if ($ProductAttributeDuple==0) {
                $productattribute = $this->ProductAttributeRepo->update($productattribute, $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El atributo  fue modificado correctamente para el producto'),
                    'data'    => $productattribute,
                ];
                
                return response()->json($response, 200);
                  }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('El atributo habia sido registrado anterioemente para ese producto') . '.',
        
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
                
                $productattribute = $this->ProductAttributeRepo->findbyid($id);
                $productattribute = $this->ProductAttributeRepo->activate($productattribute, ['active' => 1]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El atributo fue activado correctamente para el producto'),
                    'data'    => $productattribute,
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
                
                $productattribute = $this->ProductAttributeRepo->findbyid($id);
                $productattribute = $this->ProductAttributeRepo->inactivate($productattribute, ['active' => 0]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El atributo fue inactivado correctamente para el producto '),
                    'data'    => $productattribute,
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
                
                $productattribute = $this->ProductAttributeRepo->findbyid($id);
                $productattribute = $this->ProductAttributeRepo->delete($productattribute, ['active' => 2]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El atributo fue eliminado correctamente para el producto'),
                    'data'    => $productattribute,
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
                'id_producto.required' => __('El producto es requerido'),
                'id_attribute.required' => __('El atributo es requerido'),
            ];
        }
        
    }
