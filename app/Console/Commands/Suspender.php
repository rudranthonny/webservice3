<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class Suspender extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'suspender:usuario';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $users = User::all();
        foreach ($users as $user) {
            if(strtotime($user->fecha_vencimiento) < strtotime(date('Y-m-d'))){
                $user->estado = 1;
                $user->save();
                User::suspender($user);
            }
        }
    }
}
