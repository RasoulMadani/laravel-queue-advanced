<?php

namespace App\Jobs;

use App\Mail\SendVerificationEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendVerificationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // تعداد دفعاتی که جاب اگر شکست خورد دوباره باید اجرا شود
    public $tries = 3;

    // در اینجا می گوییم اگر جاب شکست خورد ۶۰ ثانیه صبر کند و بعد دوباره تلاش کند
    // public $backoff = 60;

    // اگر به صورت آرایه ای این عدد را بدهیم برای هر بار اجرای بعدی
    // یکی از جایگاههای آرایه را می گیرد
    // مثلا در اینجا اجرای بعدی ۱ دقیقه بعد و اجرای بعدی 
    // ۱۰ دقیقه بعد 
    // و اجرای بعدی یک ساعت بعد خواهد بود 
    // این مقادیر روی 
    // available_at تاثیر می گذارد
    public $backoff = [60, 60 * 10, 60 * 60];

    /**
     * Create a new job instance.
     */
    public function __construct(public User $user)
    {
        $this->onQueue('sending-notification');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user)->send(new SendVerificationEmail($this->user));
    }
}
