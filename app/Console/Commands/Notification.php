<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyEmail;



class Notification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email notify for all users avery day !!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //$users = User::select('email')->get();

        $emails = User::pluck('email')->toArray();
        $data=['title'=> 'Programming', 'body'=>'php'];
        foreach($emails as $email){
            //how to sent email in laravel

            Mail::To($email)->send(new NotifyEmail($data));

        }

    }
}
