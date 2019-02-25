<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\Http\Models\Repositories\TypeProductAttributeRepo;
    use App\Http\Models\Repositories\TypeProductRepo;
    use App\Http\Models\Repositories\AttributeRepo;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;
    
    class TypeProductAttributeController extends BaseController {
        
        private $TypeProductAttributeRepo;
        private $TypeProductRepo;
        private $AttributeRepo;
        
        public function __construct(TypeProductAttributeRepo $TypeProductAttributeRepo,  TypeProductRepo $TypeProductRepo,  AttributeRepo $AttributeRepo) {
            
            $this->TypeProductAttributeRepo = $TypeProductAttributeRepo;
            $this->TypeProductRepo        = $TypeProductRepo;
            $this->AttributeRepo        = $AttributeRepo;
        }
        
        public function index() {
            
            try {
                $typeproductattribute = $this->TypeProductAttributeRepo->all();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $typeproductattribute,
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
                $typeproductattribute = $this->TypeProductAttributeRepo->filteractive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $typeproductattribute,
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
                $typeproductattribute = $this->TypeProductAttributeRepo->filterinactive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $typeproductattribute,
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
                $typeproductattribute = $this->TypeProductAttributeRepo->filterdeleted();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $typeproductattribute,
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
                $typeproductattribute = $this->TypeProductAttributeRepo->filterby($item, $id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $typeproductattribute,
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
                $typeproductattribute = $this->TypeProductAttributeRepo->findbyid($id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $typeproductattribute,
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
                $typeproductattribute = $this->TypeProductAttributeRepo->findbyunique($item,$string);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $typeproductattribute,
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
                'id_type_product' => 'required',
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
                    'id_type_product' => $request->get('id_type_product'),
                    'id_attribute' => $request->get('id_attribute'),
                    'active'     => 1,
                ];
              $itemfirst = 'id_type_product';
              $stringfirst = $data['id_type_product'];
              $itemsecond = 'id_attribute';
              $stringsecond = $data['id_attribute'];
              $TypeProductAttributeDuple = $this->TypeProductAttributeRepo->checkduplicate($itemfirst,$stringfirst,$itemsecond,$stringsecond);
             

           if ($TypeProductAttributeDuple==0) { 
                
                
                $typeproductattribute = $this->TypeProductAttributeRepo->store($data);
                $response       = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El atributo ha sido asignado a un tipo producto correctamente'),
                    'data'    => $typeproductattribute,
                ];
                
                return response()->json($response, 200);

                    }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('El atributo habia sido asignado a un tipo de producto anteriormente') . '.',
        
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
            $typeproductattribute = $this->TypeProductAttributeRepo->findbyid($id);
            
            
            if ($request->has('id_type_product')) {
                $data['id_type_product'] = $request->get('id_type_product');
            }
            if ($request->has('id_attribute')) {
                $data['id_attribute'] = $request->get('id_attribute');
            }
            
            if ($request->has('active')) {
                $data['active'] = $request->get('active');
            }
            
            try {
              $itemfirst = 'id_type_product';
              $stringfirst = $data['id_type_product'];
              $itemsecond = 'id_attribute';
              $stringsecond = $data['id_attribute'];
              $TypeProductAttributeDuple = $this->TypeProductAttributeRepo->checkduplicate($itemfirst,$stringfirst,$itemsecond,$stringsecond);
             

            if ($TypeProductAttributeDuple==0) {
                $typeproductattribute = $this->TypeProductAttributeRepo->update($typeproductattribute, $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El atributo  fue modificado correctamente para el tipo de producto'),
                    'data'    => $typeproductattribute,
                ];
                
                return response()->json($response, 200);
                  }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('El atributo habia sido registrado anterioremente para ese tipo de producto') . '.',
        
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
                
                $typeproductattribute = $this->TypeProductAttributeRepo->findbyid($id);
                $typeproductattribute = $this->TypeProductAttributeRepo->activate($typeproductattribute, ['active' => 1]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El atributo fue activado correctamente para el tipo de producto'),
                    'data'    => $typeproductattribute,
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
                
                $typeproductattribute = $this->TypeProductAttributeRepo->findbyid($id);
                $typeproductattribute = $this->TypeProductAttributeRepo->inactivate($typeproductattribute, ['active' => 0]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El atributo fue inactivado correctamente para el tipo de producto '),
                    'data'    => $typeproductattribute,
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
                
                $typeproductattribute = $this->TypeProductAttributeRepo->findbyid($id);
                $typeproductattribute = $this->TypeProductAttributeRepo->delete($typeproductattribute, ['active' => 2]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El atributo fue eliminado correctamente para el tipo de producto'),
                    'data'    => $typeproductattribute,
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
                'id_type_producto.required' => __('El tipo de producto es requerido'),
                'id_attribute.required' => __('El atributo es requerido'),
            ];
        }
        
    }
