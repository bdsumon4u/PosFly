<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Stancl\Tenancy\Contracts\TenantWithDatabase;

class InstallTenant implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var TenantWithDatabase */
    protected $tenant;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(TenantWithDatabase $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('max_execution_time', 600); //600 seconds = 10 minutes

        try {
            $this->tenant->run(function () {
                File::ensureDirectoryExists(storage_path());
                File::ensureDirectoryExists(storage_path('/app/public/backup'));
                foreach (['oauth-private.key', 'oauth-public.key'] as $file) {
                    File::copy(storage_path('../' . $file), storage_path($file));
                }

                $prefix = 'images' . DIRECTORY_SEPARATOR .config('tenancy.filesystem.suffix_base') . $this->tenant->getTenantKey();
                foreach (['logo', 'avatar', 'brands', 'products'] as $dir) {
                    File::ensureDirectoryExists(public_path($prefix . DIRECTORY_SEPARATOR . $dir), 0777, true);
                }
                Storage::disk('public')->put('installed', 'Contents');
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
