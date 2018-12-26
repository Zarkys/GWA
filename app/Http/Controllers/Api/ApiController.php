<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\Http\Controllers\Controller;
    use App\Http\Models\Entities\User;
    use App\Http\Models\Enums\Roles;
    use App\Http\Models\Repositories\DeviceEventRepo;
    use App\Http\Models\Repositories\DeviceRepo;
    use App\Http\Models\Repositories\EventRepo;
    use App\Http\Models\Repositories\UserRepo;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Hash;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Validator;
    
    class ApiController extends Controller {
        
        private $DeviceRepo;
        private $EventRepo;
        private $DeviceEventRepo;
        
        public function __construct(DeviceRepo $DeviceRepo, EventRepo $EventRepo, DeviceEventRepo $DeviceEventRepo) {
            
            $this->DeviceRepo      = $DeviceRepo;
            $this->EventRepo       = $EventRepo;
            $this->DeviceEventRepo = $DeviceEventRepo;
        }
        
        public function device(Request $request) {
            
            $validator = Validator::make($request->all(), [
                'name'            => 'required',
                'model'           => 'required',
                'code'            => 'required',
                'softwareversion' => 'required',
            ], $this->custom_message());
            
            if ($validator->fails()) {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 400,
                    'message' => __('Parametros incorrectos'),
                    'data'    => $validator->errors()->getMessages(),
                ];
                
                return response()->json($response, 400);
            }
            try {
                
                $exist_device = $this->DeviceRepo->find_code($request->get('code'));
                
                if (isset($exist_device->id) && $exist_device->active === 0) {
                    $data = [
                        'name'            => $request->get('name'),
                        'model'           => $request->get('model'),
                        'softwareversion' => $request->get('softwareversion'),
                    
                    ];
                    if ($request->has('mac')) {
                        $data = array_merge($data, ['mac' => $request->get('mac')]);
                    }
                    if ($request->has('serial')) {
                        $data = array_merge($data, ['serial' => $request->get('serial')]);
                    }
                    
                    $this->DeviceRepo->update($exist_device, $data);
                    
                    $response = [
                        'status'  => 'DEVICE_UNAUTHORIZED',
                        'code'    => 401,
                        'message' => _('El se encuentra desactivado') . '.',
                    
                    ];
                    
                    return response()->json($response, 401);
                } elseif (isset($exist_device->id) && is_null($exist_device->EventRelation)) {
                    $data = [
                        'name'            => $request->get('name'),
                        'model'           => $request->get('model'),
                        'softwareversion' => $request->get('softwareversion'),
                    
                    ];
                    if ($request->has('mac')) {
                        $data = array_merge($data, ['mac' => $request->get('mac')]);
                    }
                    if ($request->has('serial')) {
                        $data = array_merge($data, ['serial' => $request->get('serial')]);
                    }
                    
                    $this->DeviceRepo->update($exist_device, $data);
                    
                    $response = [
                        'status'  => 'EVENT_DEVICE_NOT_ASSOCIATE',
                        'code'    => 200,
                        'message' => __('El Dispositivo existe, pero no esta asociado a ningun evento'),
                        'data'    => $exist_device,
                    ];
                    
                    return response()->json($response, 200);
                } elseif (isset($exist_device->id) && !is_null($exist_device->EventRelation)) {
                    $exist_device = $this->DeviceRepo->find($exist_device->id);
                    $response = [
                        'status'  => 'EVENT_DEVICE_ASSOCIATE',
                        'code'    => 200,
                        'message' => __('El Dispositivo existe, y esta asociado a un evento'),
                        'data'    => $exist_device,
                    ];
                    
                    return response()->json($response, 200);
                }
                
                
                $data = [
                    'name'            => $request->get('name'),
                    'code'            => $request->get('code'),
                    'model'           => $request->get('model'),
                    'softwareversion' => $request->get('softwareversion'),
                    'active'          => 0,
                ];
                if ($request->has('mac')) {
                    $data = array_merge($data, ['mac' => $request->get('mac')]);
                }
                if ($request->has('serial')) {
                    $data = array_merge($data, ['serial' => $request->get('serial')]);
                }
                
                $device   = $this->DeviceRepo->store($data);
                $response = [
                    'status'  => 'DEVICE_UNAUTHORIZED',
                    'code'    => 200,
                    'message' => __('El Dispositivo ha sido registrado, debes esperar que sea autorizado'),
                    'data'    => $device,
                ];
                
                return response()->json($response, 200);
                
            } catch (\Exception $ex) {
                return $ex;
                Log::error($ex);
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                
                ];
                
                return response()->json($response, 500);
            }
        }
        
        public function event(Request $request) {
            $validator = Validator::make($request->all(), [
                'code_event'  => 'required',
                'code_device' => 'required',
                //                'password'    => 'required',
            ], $this->custom_message());
            
            if ($validator->fails()) {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 400,
                    'message' => __('Parametros incorrectos'),
                    'data'    => $validator->errors()->getMessages(),
                ];
                
                return response()->json($response, 400);
            }
            
            try {
                
                $event = $this->EventRepo->find_code($request->get('code_event'));
                
                if (!isset($event->id)) {
                    $response = [
                        'status'  => 'FAILED',
                        'code'    => 500,
                        'message' => _('El evento no existe') . '.',
                    
                    ];
                    
                    return response()->json($response, 500);
                } elseif (isset($event->id) && $event->active === 0) {
                    $response = [
                        'status'  => 'EVENT_UNAUTHORIZED',
                        'code'    => 401,
                        'message' => _('El evento encuentra desactivado') . '.',
                    
                    ];
                    
                    return response()->json($response, 401);
                } elseif ($request->has('password') && !Hash::check($request->get('password'), $event->password)) {
                    
                    $response = [
                        'status'  => 'EVENT_UNAUTHORIZED',
                        'code'    => 401,
                        'message' => _('Contraseña incorrecta') . '.',
                        'data'    => [],
                    
                    ];
                    
                    return response()->json($response, 401);
                }
                
                
                $exist_device = $this->DeviceRepo->find_code($request->get('code_device'));
                
                if (isset($exist_device->id) && $exist_device->active === 0) {
                    $response = [
                        'status'  => 'DEVICE_UNAUTHORIZED',
                        'code'    => 401,
                        'message' => _('El diposiitivo se encuentra desactivado') . '.',
                    
                    ];
                    
                    return response()->json($response, 401);
                } elseif (isset($exist_device->id) && is_null($exist_device->EventRelation)) {
                    //                    $response = [
                    //                        'status'  => 'EVENT_DEVICE_NOT_ASSOCIATE',
                    //                        'code'    => 200,
                    //                        'message' => __('El Dispositivo existe, pero no esta asociado a ningun evento'),
                    //                        'data'    => $exist_device,
                    //                    ];
                    //
                    //                    return response()->json($response, 200);
                    
                    $data = [
                        'id_device' => $exist_device->id,
                        'id_event'  => $event->id,
                        'active'    => $request->has('password') ? 1 : 0,
                    ];
                    
                    $this->DeviceEventRepo->store($data);
                    if ($request->has('password')) {
                        $exist_device = $this->DeviceRepo->find_code($request->get('code_device'));
                        $response     = [
                            'status'  => 'EVENT_DEVICE_ASSOCIATE',
                            'code'    => 200,
                            'message' => __('El Dispositivo y el evento han sido asociados correctamente'),
                            'data'    => $exist_device,
                        ];
                        
                        return response()->json($response, 200);
                    } else {
                        $response = [
                            'status'  => 'EVENT_DEVICE_ASSOCIATE',
                            'code'    => 200,
                            'message' => __('El Dispositivo y el evento han sido asociados correctamente pero debe ser autirzado'),
                            'data'    => $exist_device,
                        ];
                        
                        return response()->json($response, 200);
                    }
                    
                    
                } elseif (isset($exist_device->id) && !is_null($exist_device->EventRelation) && $exist_device->EventRelation->id_event !== $event->id) {
                    $response = [
                        'status'  => 'EVENT_DEVICE_NOT_ASSOCIATE',
                        'code'    => 200,
                        'message' => __('El Dispositivo existe, pero no esta asociado al evento enviado'),
                        'data'    => [],
                    ];
                    
                    return response()->json($response, 200);
                } elseif (isset($exist_device->id) && !is_null($exist_device->EventRelation) && $exist_device->EventRelation->id_event === $event->id) {
                    $response = [
                        'status'  => 'EVENT_DEVICE_ASSOCIATE',
                        'code'    => 200,
                        'message' => __('El Dispositivo existe, y ya esta asociado al evento'),
                        'data'    => $exist_device,
                    ];
                    
                    return response()->json($response, 200);
                }
                
                
                $data = [
                    'name'            => $request->get('name'),
                    'code'            => $request->get('code'),
                    'model'           => $request->get('model'),
                    'softwareversion' => $request->get('softwareversion'),
                    'active'          => 1,
                ];
                if ($request->has('mac')) {
                    $data = array_merge($data, ['mac' => $request->get('mac')]);
                }
                if ($request->has('serial')) {
                    $data = array_merge($data, ['serial' => $request->get('serial')]);
                }
                
                $device   = $this->DeviceRepo->store($data);
                $response = [
                    'status'  => 'DEVICE_UNAUTHORIZED',
                    'code'    => 200,
                    'message' => __('El Dispositivo ha sido registrado, debes esperar que sea autorizado'),
                    'data'    => $device,
                ];
                
                return response()->json($response, 200);
                
            } catch (\Exception $ex) {
                return $ex;
                Log::error($ex);
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                
                ];
                
                return response()->json($response, 500);
            }
            
        }
        
        public function associate_event_device(Request $request) {
            $validator = Validator::make($request->all(), [
                'code_event'  => 'required',
                'code_device' => 'required',
            ], $this->custom_message());
            
            if ($validator->fails()) {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 400,
                    'message' => __('Parametros incorrectos'),
                    'data'    => $validator->errors()->getMessages(),
                ];
                
                return response()->json($response, 400);
            }
            
            try {
                
                $event = $this->EventRepo->find_code($request->get('code_event'));
                
                if (!isset($event->id)) {
                    $response = [
                        'status'  => 'FAILED',
                        'code'    => 500,
                        'message' => _('El evento no existe') . '.',
                    
                    ];
                    
                    return response()->json($response, 500);
                } elseif (isset($event->id) && $event->active === 0) {
                    $response = [
                        'status'  => 'EVENT_UNAUTHORIZED',
                        'code'    => 401,
                        'message' => _('El evento encuentra desactivado') . '.',
                    
                    ];
                    
                    return response()->json($response, 401);
                }
                
                
                $exist_device = $this->DeviceRepo->find_code($request->get('code_device'));
                
                if (!isset($exist_device->id)) {
                    $response = [
                        'status'  => 'FAILED',
                        'code'    => 500,
                        'message' => _('El Dispositivo no existe') . '.',
                    
                    ];
                    
                    return response()->json($response, 500);
                }
                
                
                if (isset($exist_device->id) && $exist_device->active === 0) {
                    $response = [
                        'status'  => 'DEVICE_UNAUTHORIZED',
                        'code'    => 401,
                        'message' => _('El Dispositivo se encuentra desactivado') . '.',
                    
                    ];
                    
                    return response()->json($response, 401);
                } elseif (isset($exist_device->id) && !is_null($exist_device->EventRelation) && $exist_device->EventRelation->id_event === $event->id) {
                    $response = [
                        'status'  => 'EVENT_DEVICE_ASSOCIATE',
                        'code'    => 200,
                        'message' => __('El dispositivo y el evento ya se encuentran asociados'),
                        'data'    => $exist_device,
                    ];
                    
                    return response()->json($response, 200);
                }
                
                $data = [
                    'id_device' => $exist_device->id,
                    'id_event'  => $event->id,
                    'active'    => 1,
                ];
                
                $this->DeviceEventRepo->store($data);
                
                $exist_device = $this->DeviceRepo->find_code($request->get('code_device'));
                
                $response = [
                    'status'  => 'EVENT_DEVICE_ASSOCIATE',
                    'code'    => 200,
                    'message' => __('El Dispositivo y el evento han sido asociados correctamente'),
                    'data'    => $exist_device,
                ];
                
                return response()->json($response, 200);
                
                
            } catch (\Exception $ex) {
                return $ex;
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
                'name.required'            => __('El Nombre es requerido'),
                'mac.required'             => __('El Mac es requerido'),
                'serial.required'          => __('El Serial es requerido'),
                'model.required'           => __('El Modelo es requerido'),
                'code.required'            => __('El Codigo es requerido'),
                'code.unique'              => __('El codigo ya existe en la base de datos'),
                'softwareversion.required' => __('La Version del software es requerida'),
                'code_event.required'      => __('El codigo del evento es requerido'),
                'code_device.required'     => __('El codigo del dispositivo es requerdio'),
                'password.required'        => __('La contraseña es requerida'),
            ];
        }
    }
