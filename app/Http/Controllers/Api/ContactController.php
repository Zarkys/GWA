<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\Http\Models\Repositories\ContactRepo;
    use App\Http\Models\Entities\ConfigWeb;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;
     use Illuminate\Support\Facades\Mail;
    class ContactController extends BaseController {
        
        private $ContactRepo;
        
        public function __construct(ContactRepo $ContactRepo) {
            
            $this->ContactRepo = $ContactRepo;
        }
        
        public function index() {
            
            try {
                $contact = $this->ContactRepo->all();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $contact,
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
                $contact = $this->ContactRepo->filteractive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $contact,
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
                $contact = $this->ContactRepo->filterinactive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $contact,
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
                $contact = $this->ContactRepo->filterdeleted();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $contact,
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
                $contact = $this->ContactRepo->filterby($item,$id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $contact,
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
                $contact = $this->ContactRepo->findbyid($id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $contact,
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
                $contact = $this->ContactRepo->findbyunique($item,$string);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $contact,
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
                'name_client'    => 'required',
                'email_client'    => 'required',
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
                    'name_client'    => $request->get('name_client'),
                    'phone_client'    => $request->get('phone_client'),
                    'email_client'    => $request->get('email_client'),
                    'message_client'    => $request->get('message_client'),                    
                    'active' => 1,
                ];

              
                $contact     = $this->ContactRepo->store($data);
                $this->sendEmail($contact);
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El contacto se  ha realizado exitosamente'),
                    'data'    => $contact,
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
            $contact = $this->ContactRepo->findbyid($id);

            
            if($request->has('name')){
                $data['name'] = $request->get('name');
            }
            if($request->has('description')){
                $data['description'] = $request->get('description');
            }
    
            try {

              $item = 'name';
              $string = $data['name'];
              $ContactDuplename = $this->ContactRepo->checkduplicate($item,$string);
             

            if ($ContactDuplename==0 ) { 
               
                $contact = $this->ContactRepo->update($contact, $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El attributo ha sido modificado correctamente '),
                    'data'    => $contact,
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

        public function change($id, Request $request) {
            
            
            try {
                
                $contact = $this->ContactRepo->findbyid($id);

                if($contact->active === 0)
                {
                    $contact = $this->ContactRepo->update($contact, ['active' => 1]);
                }
                else
                {
                    $contact = $this->ContactRepo->update($contact, ['active' => 0]);
                }
                
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El producto fue cambiado correctamente '),
                    'data'    => $contact,
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
                
                $contact = $this->ContactRepo->findbyid($id);
                $contact = $this->ContactRepo->delete($contact, ['active' => 2]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El attributo ha sido eliminado correctamente'),
                    'data'    => $contact,
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

         public function sendEmail($contact)
        {

                $email_receive = ConfigWeb::where('name_config','email_receive')->first();
                $email_sender = ConfigWeb::where('name_config','email_sender')->first();
                $url_logo_company = ConfigWeb::where('name_config','url_logo_company')->first();

                Log::debug('CARGANDO IMAGEN'.$url_logo_company->value);

                //EMAIL TO CLIENT
                $data = [
                    //Client Data
                    'from' => $contact->name_client,
                    'comment' => $contact->message_client,
                    'cellphone' => $contact->phone_client,
                    'contactmail' => $contact->email_client,
                    //Email Configuration
                    'email' => $email_sender->value,
                    'url_logo_company' => env('APP_URL').'/'.$url_logo_company->value,
                    'title' => __('Pronto te contactaremos'),
                    'text' => __('Pronto nos comunicaremos'),
                ];
                Log::debug('EMAIL IMAGEN: '.env('APP_URL').'/'.$url_logo_company->value);

                Mail::send("auth.contact_client",$data, function ($message) use ($data) {
                    $message->to($data['contactmail'])->subject($data['title']);
                });

               
                
                $data2 = [
                    //Client Data
                    'from' => $contact->name_client,
                    'comment' => $contact->message_client,
                    'cellphone' => $contact->phone_client,
                    'contactmail' => $contact->email_client,
                    //Email Configuration
                    'email_sender' => $email_sender->value,
                    'email_receive' => $email_receive->value,
                    'url_logo_company' => env('APP_URL').'/'.$url_logo_company->value,
                    'title' => __('Solicitud de contacto'),
                    'text' => __('Mensaje de solicitud de contacto'),
                ];

                Mail::send("auth.contact",$data2, function ($message) use ($data2) {
                    $message->to($data2['email_receive'])->subject($data2['title']);
                });

                return true;
        }
        
        
    
        public function custom_message() {
            return [
                'name.required'  => __('El nombre es requerido'),
                'description.required'  => __('La descripcion es requerida'),
            ];
        }

    }
