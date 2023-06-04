<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateProducts implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly int $count, private readonly User $shop)
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
        $products = [];

        for ($i = 0; $i < $this->count; $i++) {
            $productResource = [
                'body_html' => 'Product Description ' . $i,
                'title'     => 'Product Title ' . $i,
            ];

            $response = $this->shop->api()->rest('POST', '/admin/api/products.json', ['product' => $productResource]);

            if (! empty($response['errors'])) {
                throw $response['exception'];
            }

            $products[] = ['shopify_id' => $response['body']['product']['id']];
        }

        $this->shop->fakeProducts()->createMany($products);
    }
}
