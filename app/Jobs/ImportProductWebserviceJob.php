<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportProductWebserviceJob implements ShouldQueue
{
    private $productWebservice;

    private $products;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(array $productWebservice, Collection $products)
    {
        $this->productWebservice = $productWebservice;
        $this->products = $products;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $productWebservice = $this->productWebservice;

        $product = $this->products->first(function (Product $product, int $key) use($productWebservice) {
            return $product->name == $productWebservice['name'];
        });

        if($product) {
            return;
        }

        $product = Product::create([
            'name' => $this->productWebservice['name'],
            'quantity' => $this->productWebservice['quantity'],
            'price' => $this->productWebservice['price'],
            'description' => $this->productWebservice['description'],
        ]);
    }
}
