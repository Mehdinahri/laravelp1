<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\CommandRequest;
use App\Traits\CommadTrait;
use LaravelLocalization;

use App\Models\Command;


class CommandController extends Controller
{
    public function create(){
        //Vue pour ajouter des commandes
        
        return view('AjaxCommand.create');
    }

    use CommadTrait;

    public function store(CommandRequest $req){
        //enregistrer commande dans la base de donnee avec ajax
        $image = $this->saveImage($req -> image, 'images/command');

        //l'insertion 
        $cmd = Command::create([
            'image'=> $image,
            'name_en'=> $req->name_en,
            'name_ar'=> $req->name_ar,
            'price'=> $req->price,
            'details_en'=> $req->details_en,
            'details_ar'=> $req->details_ar
            ]);
            if($cmd)
                {
                    return response() -> json([
                    'status'=>true,
                    'message'=>'dakchi dzad akhouya 5/5',
                ]);
            }
            else{
                return response() -> json([
                    'status'=>false,
                    'message'=>'error 5/5',
                ]);
            }
    }
    public function getall(){
        $commands = Command::select('id',
        'name_'.LaravelLocalization::getCurrentLocale().' as name',
        'price',
        'details_'.LaravelLocalization::getCurrentLocale().' as details',
        'image')->get();
        return view('AjaxCommand.index',compact('commands'));
    }

    public function deletecmd(Request $req){

        //test si la commande exist pour la suprimer
        $cmd = Command::find($req->id);//Command::where('id','=','$cmd_id')->first();
        $cmd->delete();
        

        return response() -> json([
            'status'=>true,
            'message'=>'dakchi dzad akhouya 5/5',
            'cmdid'=>$req->id
        ]);
    }

    //edit ajax

    public function editcmd(Request $req){
        $cmd = Command::find($req->cmd_id);
        if(!$cmd){
            return response() -> json([
                'status'=>false,
                'message'=>'command not found',
                'res'=>$req
            ]);
        }
        $cmd = Command::select('id',
        'name_ar',
        'name_en',
        'price',
        'details_ar',
        'details_en')->find($req->cmd_id);
        return view('AjaxCommand.edit',compact('cmd'));
    }

    //update 

    public function updatecmd(Request $req){
        //validation par commandRequest
        //update data
            //test si la commande exist dans le data
        $cmd = Command::find($req->id);
        if(!$cmd){
            return $req;
        }
            //update
        $cmd->update($req->all());
        
        return response() -> json([
            'status'=>true,
            'message'=>'modefication passe bien'
        ]);

    }
}
