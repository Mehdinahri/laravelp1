<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Command;

class CrudController extends Controller
{
    public function __construct()
    {

    }
    public function getOffers(){

        return  Command::select('name','price')->get();

    }


    public function store(Request $req){
        //validation data avant linsertion 
        $rules=[
            'name'=> 'required|max:10|unique:commands,name',
            'price'=> 'required|numeric',
            'details'=> 'required',
        ];
        $msgerror =[
            'name.required'=>__('message.command.name'),
            'price.required'=>__('message.command.pricereq'),
            'details.required'=>"le details et obligatoire",
            'name.unique'=>"nom deja existe",
            'name.max'=>"nom contien plus que dix caractaires",

        ];
        $validate = Validator::make($req->all(),$rules,$msgerror);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInputs($req->all());
        }

        //l'insertion 
        Command::create([
            'name'=> $req->name,
            'price'=> $req->price,
            'details'=> $req->details
            ]);
        return redirect()->back()->with(['success' => 'dakchi 5/5 amolay thami']);

    }

    public function create(){
        return view('command.create');
    }



}
