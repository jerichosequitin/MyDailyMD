<?php

namespace App\Console\Commands;

use App\DeleteInactive\DeleteExtraUsers;
use App\DeleteInactive\DeleteInactiveDoctor;
use App\DeleteInactive\DeleteInactivePatient;
use Illuminate\Console\Command;

class DeleteInactive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:inactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete inactive users';

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
     * @return void
     */
    public function handle()
    {
        $deleteInactivePatient = new DeleteInactivePatient();
        $deleteInactivePatient->deletePatient();

        $deleteInactiveDoctor = new DeleteInactiveDoctor();
        $deleteInactiveDoctor->deleteDoctor();
    }
}
