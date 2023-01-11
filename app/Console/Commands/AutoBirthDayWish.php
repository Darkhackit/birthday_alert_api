<?php

namespace App\Console\Commands;

use App\Mail\BirthDayMail;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Command\Command as CommandAlias;

class AutoBirthDayWish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:birthdays';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically send birthday wishes to employees';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        // $employees = Employee::whereMonth('dob',Carbon::now()->format('m'))
        //     ->whereDay('dob', Carbon::now()->format('d'))->get();
        $employees = Employee::all();
        if($employees->count() > 0) {
            foreach ($employees as $employee) {
                Mail::to($employee->email)->send(new BirthDayMail($employee));
            }
        }
        return 0;
    }
}
