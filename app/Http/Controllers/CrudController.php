<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommandRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Command;
use LaravelLocalization;

class CrudController extends Controller
{
    public function __construct()
    {

    }
    public function getOffers(){

        return  Command::select('name','price')->get();

    }


    public function store(CommandRequest $req){
        //validation data avant linsertion ==> Request
            // $rules=[
            //     'name'=> 'required|max:10|unique:commands,name',
            //     'price'=> 'required|numeric',
            //     'details'=> 'required',
            // ];
            // $message = $re->getmessage();
            // $validate = Validator::make($req->all(),$rules,$msgerror);
            // if($validate->fails()){
            //     return redirect()->back()->withErrors($validate)->withInputs($req->all());
            // }

        //l'insertion 
        Command::create([
            'name_en'=> $req->name_en,
            'name_ar'=> $req->name_ar,
            'price'=> $req->price,
            'details_en'=> $req->details_en,
            'details_ar'=> $req->details_ar
            ]);
        return redirect()->back()->with(['success' => 'dakchi 5/5 amolay thami']);

    }
    public function getall(){
        $commands = Command::select('id',
        'name_'.LaravelLocalization::getCurrentLocale().' as name',
        'price',
        'details_'.LaravelLocalization::getCurrentLocale().' as details')->get();
        return view('command.index',compact('commands'));
    }

    public function create(){
        return view('command.create');
    }
    
    


}
