<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:make-expired-payments')]
#[Description('Command description')]
class MakeExpiredPayments extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
