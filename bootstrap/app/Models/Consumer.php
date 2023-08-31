<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;
class Consumer extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
                    'name',
                    'consumer_id',
                    'installer_id',
                    'email',
                    'phone',
                    'aadhar_no',
                    'house_no',
                    'village',
                    'post',
                    'panchayat',
                    'block',
                    'ward_no',
                    'sub_district_id',
                    'state_id',
                    'district_id',
                    'toilet_linked',
                    'existing_biogas_plant',
                    'subsidy_availed',
                    'number_of_cattle',
                    'comment',
                    'date_of_reg',
                    'category'
                ];

    public static function getAll($state = null, $status = null, $priority = null)
    {
        $query = self::select('consumers.*', 'states.name as state', 'installers.name as installer', 'installations.priority', 'installations.id as installationId')
                        ->join('states', 'states.code', 'consumers.state_id')            
                        ->leftjoin('installers', 'installers.id', 'consumers.installer_id')
                        ->leftjoin('installations', 'installations.consumer_id', 'consumers.id');
            //  dd($query);
        switch($status){
            case 'approved': $query->where('consumers.is_approved', 1); break;
            case 'rejected': $query->where('consumers.is_approved', 0); break;
            case 'pending': $query->whereNull('consumers.is_approved'); break;
        }
        

        if($priority)
            $query->where('installations.priority', $priority);

        if($state !== null)
            $query->where('consumers.state_id', $state);


        $query->orderby('consumers.updated_at', 'DESC');

        return $query->get();
        
    }

    public static function getById($state = null, $status = null, $id)
    {
        $query = self::select(
                        'consumers.*',
                        'sub_districts.name as sub_district',
                        'districts.name as district',
                        'states.name as state',
                        'blocks.name as block',
                        'villages.name as village',
                        'localbodies.localbody_name as panchayat',
                        'wards.ward_name as ward',
                        'installers.name as installer',
                        'installations.installer_id as installerId',
                        'installations.priority',
                        'installations.id as installationId'
                    )
                    ->join('sub_districts', 'sub_districts.code', 'consumers.sub_district_id')
                    ->join('districts', 'districts.code', 'consumers.district_id')
                    ->join('states', 'states.code', 'consumers.state_id')
                    ->join('blocks', 'blocks.code', 'consumers.block')
                    ->join('villages', 'villages.code', 'consumers.village')
                    ->join('localbodies', 'localbodies.code', 'consumers.panchayat')
                    ->join('wards','wards.code','consumers.ward_no')
                    ->leftjoin('installers', 'installers.id', 'consumers.installer_id')
                    ->leftjoin('installations', 'installations.consumer_id', 'consumers.id')
                    ->where('consumers.id', $id);
        if($status == 'approved'){
            $query->where('consumers.is_approved', 1);
        }

        if($state !== null){
            $query->where('consumers.state_id', $state);
        }

        return $query->first();
    }
    static function getSmallBiogasData($state = null, $status = null, $customer_type = null){
       
        $query = self::select('consumers.*','states.name as state_name')
                    ->join('states','states.code','consumers.state_id');
        switch($status){
            case '1': $query->where('consumers.status', 1); break;
            case '2': $query->where('consumers.status', 2); break;
            case '3': $query->where('consumers.status', 3); break;
            case '4': $query->where('consumers.status', 4); break;
            case '0': $query->where('consumers.status', 0); break;
        }
        if($customer_type)
        {
            $query->where('consumers.customer_type', $customer_type);
        }
        if($state != '')
            { 
            $query->where('consumers.state_id', $state);
        }
        $query->orderby('consumers.updated_at', 'DESC');
        return  $query->get();    
    }
    public static function smallgetById($id){
        
        $data=self::select('consumers.*','states.name as state_name','districts.name as district_name','sub_districts.name as sub_districts_name','blocks.name as blocks_name','villages.name as village_name'
        ,'localbodies.localbody_name as localbody_name','wards.ward_name')
        ->leftjoin('states','states.code','consumers.state_id')
        ->leftjoin('districts','districts.code','consumers.district_id')
        ->leftjoin('sub_districts','sub_districts.code','consumers.sub_district_id')
        ->leftjoin('blocks','blocks.code','consumers.block')
        ->leftjoin('villages','villages.code','consumers.village')
        ->leftjoin('localbodies','localbodies.code','consumers.panchayat')
        ->leftjoin('wards','wards.code','consumers.ward_no')
        ->where('consumers.id',$id);
        return $data->first();
        
    }
}