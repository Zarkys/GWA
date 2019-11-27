<?php

namespace Modules\Doctors\Models\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

 class Specialty extends Authenticatable {
        use Notifiable;
        protected $table      = 'doct_specialties';
        protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'name',          
            'description', 
            'active',
            'created_at',
            'updated_at',
        ];       
            

        public function Doctor() {
            return $this->hasOne(Doctor::class, 'id_specialty');
        }
       
        
    }