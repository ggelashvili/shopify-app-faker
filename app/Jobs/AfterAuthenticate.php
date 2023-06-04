<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Contracts\ShopModel;

class AfterAuthenticate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly User|ShopModel $shop)
    {
        //
    }

    public function handle(): void
    {
        if ($this->shop->force_scope_update) {
            $this->shop->force_scope_update = false;

            $this->shop->save();
        }
    }
}
