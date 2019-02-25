<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\Http\Models\Repositories\AttributeRepo;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;
    class AttributeController extends BaseController {
        
        private $AttributeRepo;
        
        public function __construct(AttributeRepo $AttributeRepo) {
            
            $this->AttributeRepo = $AttributeRepo;
        }
        
        public function index() {
            
            try {
                $attribute = $this->AttributeRepo->all();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $attribute,
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
                $attribute = $this->AttributeRepo->filteractive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $attribute,
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
                $attribute = $this->AttributeRepo->filterinactive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $attribute,
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
                $attribute = $this->AttributeRepo->filterdeleted();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $attribute,
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
                $attribute = $this->AttributeRepo->filterby($item,$id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $attribute,
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
                $attribute = $this->AttributeRepo->findbyid($id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $attribute,
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
                $attribute = $this->AttributeRepo->findbyunique($item,$string);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $attribute,
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
                'description'    => 'required',
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
              $AttributeDuplename = $this->AttributeRepo->checkduplicate($item,$string);
             

            if ($AttributeDuplename==0 ) { 
        
                $attribute     = $this->AttributeRepo->store($data);
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El atributo ha sido registrado  correctamente'),
                    'data'    => $attribute,
                ];
        
                return response()->json($response, 200);
                }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('El attributo fue registrado anteriormente') . '.',
        
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
            $attribute = $this->AttributeRepo->findbyid($id);

            
            if($request->has('name')){
                $data['name'] = $request->get('name');
            }
            if($request->has('description')){
                $data['description'] = $request->get('description');
            }
    
            try {

              $item = 'name';
              $string = $data['name'];
              $AttributeDuplename = $this->AttributeRepo->checkduplicate($item,$string);
             

            if ($AttributeDuplename==0 ) { 
               
                $attribute = $this->AttributeRepo->update($attribute, $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El attributo ha sido modificado correctamente '),
                    'data'    => $attribute,
                ];
                
                return response()->json($response, 200);

                 }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('El tipo de producto fue registrado anteriormente') . '.',
        
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
                
                $attribute = $this->AttributeRepo->findbyid($id);
                $attribute = $this->AttributeRepo->activate($attribute, ['active' => 1]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El attributo ha sido activado correctamente'),
                    'data'    => $attribute,
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
                
                $attribute = $this->AttributeRepo->findbyid($id);
                $attribute = $this->AttributeRepo->inactivate($attribute, ['active' => 0]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El attributo ha sido inactivado correctamente'),
                    'data'    => $attribute,
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
                
                $attribute = $this->AttributeRepo->findbyid($id);
                $attribute = $this->AttributeRepo->delete($attribute, ['active' => 2]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El attributo ha sido eliminado correctamente'),
                    'data'    => $attribute,
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
                'description.required'  => __('La descripcion es requerida'),
            ];
        }

    }
