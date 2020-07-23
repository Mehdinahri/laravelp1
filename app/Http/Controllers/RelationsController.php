<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Hopital;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Service;

class RelationsController extends Controller
{
    public function hasOne(){
        $user = \App\User::with([
            'phone'=> function($q){
                $q -> select('code', 'phone', 'user_id');
            }

        ]) -> find(5);

        //$phone = $user ->phone;
        return $user ->phone ->code;
        return response() ->json ($user);
    }
    public function Reverse(){
        //$phone = Phone::with('user')->find(1);
        // make some attributes visible
        $phone = Phone::with([
            'user'=> function($q){
                $q -> select('id', 'name', 'email');
            }
        ]) -> find(1);
        //$phone -> makeVisible(['user_id']); 
        //$phone -> makeHidden(['code']); 

        //return $phone -> user; return infos without phone

        //return phone and user
        return $phone;
        
    }
    public function hasPhone(){
        
        //$user = \App\User::whereHas('phone')->get();

        $user = \App\User::whereHas('phone',function($q){
            $q -> where('code','+12');
        })->get();

        return $user;
        
    }
    public function nothasPhone(){
        $user = \App\User::whereDoesntHave('phone')->get();

        return $user;
        
    }

    //one to many
    
    public function getD(){
        //$hos = Hopital::find(1); //where('id', 1)

        //return $hos->doctors;
        
        $hos = Hopital::with('doctors')->find(1);
        //return $hos;
        $doctors = $hos->doctors;
        foreach($doctors as $doc){
            echo $doc->name.'<br>';
        }

        $doc = Doctor::find(2);
        return $doc;
    }
    
    public function getHopitals(){
        $hopital =Hopital::select('id','name','Adresse')->get();
        return view('doctors.hopital',compact('hopital'));
    }
    
    public function getDoctors($hopital_id){
        $hopital = Hopital::find($hopital_id);
        $doctors = $hopital->doctors;
        return view('doctors.doctors',compact('doctors'));
    }
    


    public function Hopitalshasdoctors(){
        $hos = Hopital::whereHas('doctors')->get();
        return $hos;
    }
    public function Hopitalshasdoctorsmale(){
        $hos = Hopital::with('doctors')->whereHas('doctors',function($q){
            $q -> where('sexe',1);
        })->get();
        return $hos;
    }
    public function Hopitalsnotdoctors(){
        return $hos = Hopital::whereDoesntHave('doctors')->get();
    }
    
    public function deletehos($hopital_id){
       $hos = Hopital::find($hopital_id);
       if(!$hos){
           return abort('404');
       }else{
           $hos ->doctors() ->delete();
           $hos ->delete();
           return redirect() -> route('all.hopitals');
       }

    }
    public function doctorservices(){
        return $doc = Doctor::with('services')->find(2);
        // return $doc = Doctor::with('services')->whereHas('services',function($q){
        //     $q -> where('nom','dentist 2 ');
        // })->get();
        //return $doc ->services;
        //return $doc ->name;

    }
    public function doctorwhereservices(){
        // return $doc = Doctor::with('services')->whereHas('services',function($q){
        //     $q -> where('nom','dentist 2 ');
        // })->get();
        //return $doc = Service::with(['doctors'])->get();
        return $doc = Service::with(['doctors'=> function($q){
            $q -> select('doctors.id','name','title');
        }])->find(1);
        
    }
    public function docservices($doctor_id){
        
        $doctor = Doctor::find($doctor_id);
        $services = $doctor->services;
        $doctors = Doctor::select('id','name')->get();
        $service = Service::select('id','nom')->get();

        return view ('doctors.services',compact('services','doctors','service'));
 
     }
     
     public function saveservicetodoctor(Request $req){
        
        $doc=Doctor::find($req->doctorid);
        //$doc->services() -> attach($req->servicesid); //add with double
        //$doc->services() -> sync($req->servicesid); //delete old values and add new values
        $doc->services() -> syncWithoutDetaching($req->servicesid); // add values if not exist

        return 'ssucces';
 
     }
     
     public function getpetiendoctor(){
        
        $patient=Patient::find(2);
        return $patient->doctor;
     }
}
