<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class UploadFile extends Command
{
    protected $signature = 'app:upload-file';

    protected $description = 'Command description';

    public function handle()
    {
        Cache::put('file_upload_status', 'Uploading file...', now()->addMinutes(10));
    }
}
