<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\Http\Models\Repositories\ArchiveAssignmentRepo;
    use App\Http\Models\Repositories\PostRepo;
    use App\Http\Models\Repositories\PageRepo;
    use App\Http\Models\Repositories\ArchiveRepo;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;
    
    class ArchiveAssignmentController extends BaseController {
        
        private $ArchiveAssignmentRepo;
        private $PageRepo;
        private $PostRepo;
        private $ArchiveRepo;
        
        public function __construct(ArchiveAssignmentRepo $ArchiveAssignmentRepo, PageRepo $PageRepo, PostRepo $PostRepo, ArchiveRepo $ArchiveRepo) {
            
            $this->ArchiveAssignmentRepo = $ArchiveAssignmentRepo;
            $this->PageRepo        = $PageRepo;
            $this->PostRepo        = $PostRepo;
            $this->ArchiveRepo        = $ArchiveRepo;
        }
        
        public function index() {
            
            try {
                $archiveassignment = $this->ArchiveAssignmentRepo->all();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $archiveassignment,
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
                $archiveassignment = $this->ArchiveAssignmentRepo->filteractive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $archiveassignment,
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
                $archiveassignment = $this->ArchiveAssignmentRepo->filterinactive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $archiveassignment,
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
                $archiveassignment = $this->ArchiveAssignmentRepo->filterdeleted();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $archiveassignment,
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
                $archiveassignment = $this->ArchiveAssignmentRepo->filterby($item, $id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $archiveassignment,
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
                $archiveassignment = $this->ArchiveAssignmentRepo->findbyid($id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $archiveassignment,
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
               // 'id_page' => 'required',
               // 'id_post' => 'required',
                'id_archive' => 'required',
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
                    'id_page' => $request->get('id_page'),
                    'id_post' => $request->get('id_post'),
                    'id_archive' => $request->get('id_archive'),
                    'active'     => 1,
                ];

                $item = 'id_post';
                $string = $data['id_post'];
                $ArchiveAssignmentDuplepost = $this->ArchiveAssignmentRepo->checkduplicate($item,$string);
                $item = 'id_page';
                $string = $data['id_page'];
                $ArchiveAssignmentDuplepage = $this->ArchiveAssignmentRepo->checkduplicate($item,$string);
                $item = 'id_archive';
                $string = $data['id_archive'];
                $ArchiveAssignmentDuplearchive = $this->ArchiveAssignmentRepo->checkduplicate($item,$string);
             

            if ($ArchiveAssignmentDuple==0) { 
                
                $archiveassignment = $this->ArchiveAssignmentRepo->store($data);
                $response       = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El archivo ha sido asignado a un post o pagina correctamente'),
                    'data'    => $archiveassignment,
                ];
                
                return response()->json($response, 200);
            }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('Estos datos fueron registrados anteriormente') . '.',
        
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
            $archiveassignment = $this->ArchiveAssignmentRepo->findbyid($id);
            
            
            if ($request->has('id_page')) {
                $data['id_page'] = $request->get('id_page');
            }
            if ($request->has('id_post')) {
                $data['id_post'] = $request->get('id_post');
            }
            if ($request->has('id_archive')) {
                $data['id_archive'] = $request->get('id_archive');
            }
            if ($request->has('active')) {
                $data['active'] = $request->get('active');
            }
            
            try {

             $item = 'id_post';
                $string = $data['id_post'];
                $ArchiveAssignmentDuplepost = $this->ArchiveAssignmentRepo->checkduplicate($item,$string);
                $item = 'id_page';
                $string = $data['id_page'];
                $ArchiveAssignmentDuplepage = $this->ArchiveAssignmentRepo->checkduplicate($item,$string);
                $item = 'id_archive';
                $string = $data['id_archive'];
                $ArchiveAssignmentDuplearchive = $this->ArchiveAssignmentRepo->checkduplicate($item,$string);
             

            if ($ArchiveAssignmentDuple==0) {  
                
                $archiveassignment = $this->ArchiveAssignmentRepo->update($archiveassignment, $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El archivo ha sido modificado para un post o pagina correctamente '),
                    'data'    => $archiveassignment,
                ];
                
                return response()->json($response, 200);
            }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('Estos datos fueron registrados anteriormente') . '.',
        
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
                
                $archiveassignment = $this->ArchiveAssignmentRepo->findbyid($id);
                $archiveassignment = $this->ArchiveAssignmentRepo->activate($archiveassignment, ['active' => 1]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El archivo ha sido activado correctamente del post o pagina'),
                    'data'    => $archiveassignment,
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
                
                $archiveassignment = $this->ArchiveAssignmentRepo->findbyid($id);
                $archiveassignment = $this->ArchiveAssignmentRepo->inactivate($archiveassignment, ['active' => 0]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El archivo ha sido inactivado correctamente del post o pagina'),
                    'data'    => $archiveassignment,
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
                
                $archiveassignment = $this->ArchiveAssignmentRepo->findbyid($id);
                $archiveassignment = $this->ArchiveAssignmentRepo->delete($archiveassignment, ['active' => 2]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El archivo ha sido eliminado correctamente del post o pagina'),
                    'data'    => $archiveassignment,
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
               // 'id_page.required' => __('La pagina es requerida'),
               // 'id_post.required' => __('El post es requerido'),
                'id_archive.required' => __('El archivo es requerido'),
            ];
        }
        
    }
