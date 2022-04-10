<?php

namespace App\Jobs;

use App\Http\Controllers\ActivityLogController;
use App\Models\Data\Whatsapp;
use App\Models\Data\WhatsappGroup;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class AppWaNotifJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = $this->message;
        $whatsapp = Whatsapp::first();
        $group = WhatsappGroup::first();
        Http::post($whatsapp->server . '/group/send?id=' . $whatsapp->phone, [
            'receiver' => $group->code,
            'message' => $message,
        ]);
        $activity = new ActivityLogController;
        $log = [
            'log_type' => 'Notifikasi',
            'log_category' => 'App',
            'log_desc' => 'Notifikasi Whatsapp',
            'status' => 'Success',
        ];
        $activity->store($log);
    }
}
