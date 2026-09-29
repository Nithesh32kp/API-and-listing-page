<?php

namespace App\Console\Commands;

use App\Models\HiringUser;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

#[Signature('hiring:remind-unresponded')]
#[Description('Remind admin about applications with no response after 24 hours')]
class RemindUnrespondedApplications extends Command
{
    public function handle()
    {
        $pending = HiringUser::whereNull('responded_at')
            ->whereNull('reminder_sent_at')
            ->where('created_at', '<', now()->subHours(24))
            ->get();

        if ($pending->isEmpty()) {
            $this->info('No pending reminders.');
            return Command::SUCCESS;
        }

        foreach ($pending as $applicant) {
            try {
                Mail::raw(
                    "Reminder: {$applicant->name} ({$applicant->email}, {$applicant->phone}) applied on {$applicant->created_at->format('d M Y, h:i A')} and hasn't received a response yet.",
                    fn($m) => $m->to(config('services.hiring.notify_email'))->subject('Reminder: unresponded application')
                );
            } catch (\Throwable $e) {
                Log::error('Reminder failed: ' . $e->getMessage());
                $this->error($e->getMessage());
                return Command::FAILURE;
            }

            $applicant->update(['reminder_sent_at' => now()]);
            $this->info("Reminder sent for applicant #{$applicant->id}");
        }

        $this->info("{$pending->count()} reminders sent.");
        return Command::SUCCESS;
    }
}