<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommandRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Command;
use App\Models\Video;
use LaravelLocalization;
use App\Traits\CommadTrait;
use App\Events\VideoViewer;

class CrudController extends Controller
{
    public function __construct()
    {

    }
    //Use trait CommadTrait.php for sive images
    
    use CommadTrait;

    public function getOffers(){

        return  Command::select('name','price')->get();

    }
    
    public function store(CommandRequest $req){
        //validation data avant linsertion ==> Request
            
        //save image in folder

        $image = $this->saveImage($req -> image, 'images/command');

        //l'insertion 
        Command::create([
            'image'=> $image,
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
    
    public function editcmd($cmd_id){
        $cmd = Command::find($cmd_id);
        if(!$cmd){
            return redirect()->back()->with(['success' => 'command not found']);
        }
        $cmd = Command::select('id',
        'name_ar',
        'name_en',
        'price',
        'details_ar',
        'details_en')->find($cmd_id);
        return view('command.edit',compact('cmd'));
    }

    public function updatecmd(CommandRequest $req,$cmd_id){
        //validation par commandRequest
        //update data
            //test si la commande exist dans le data
        $cmd = Command::find($cmd_id);
        if(!$cmd){
            return redirect()->back()->with(['success' => 'command not found']);
        }
            //update
        $cmd->update($req->all());
        
        return redirect()->back()->with(['success' => 'Modification passe bien']);

    }
    public function getvideo(){
        $video = Video::first();

        event(new VideoViewer($video));

        return view('youtube')->with('video',$video);
    }

    public function deletecmd($cmd_id){

        //test si la commande exist pour la suprimer
        $cmd = Command::find($cmd_id);//Command::where('id','=','$cmd_id')->first();
        if(!$cmd){
            return redirect()->back()->with(['error' => 'command not found']);
        }

        $cmd->delete();
        
        return redirect()->route('command.index')->with(['success' => 'command deleted succesfly !!!']);

    }


}
