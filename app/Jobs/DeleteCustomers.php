<?php

namespace App\Jobs;

use App\Models\FakeCustomer;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteCustomers implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly User $shop)
    {
        //
    }

    public function uniqueId(): string
    {
        return $this->shop->id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->shop->fakeCustomers()->each(function (FakeCustomer $fakeCustomer) {
            $response = $this->shop->api()->rest('DELETE', '/admin/api/customers/' . $fakeCustomer->shopify_id . '.json');

            if (empty($response['errors']) || $response['status'] === 404) {
                $fakeCustomer->delete();
            } else {
                report($response['exception']);
            }
        });
    }
}
