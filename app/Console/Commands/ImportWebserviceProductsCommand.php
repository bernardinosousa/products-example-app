<?php

namespace App\Console\Commands;

use App\Jobs\ImportProductWebserviceJob;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportWebserviceProductsCommand extends Command
{
    private $timeStart;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:ws:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import webservice products from json file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->timeStart = now();

        $webserviceUrl = 'https://gist.githubusercontent.com/bernardinosousa/6dcc6301c643a6d0546dd5831b4840d3/raw/5099e8d37b2a358e93b9ae266c3ec13d08c99fcc/10k-products.json';

        $productsWebservice = Http::get($webserviceUrl)->json();

        if (! $productsWebservice) {
            $this->info("No products found on this url: $webserviceUrl");
            $this->displayExecutionTime(
                $seconds = $this->calculateExecutionTimeInSeconds()
            );

            return;
        }

        $countProductsWebservice = count($productsWebservice);

        $this->info("Processing $countProductsWebservice products...");

        $products = Product::get(['id', 'name']);

        foreach ($productsWebservice as $productWebservice) {
            $this->info('Product name: '.$productWebservice['name']);
            dispatch((new ImportProductWebserviceJob($productWebservice, $products)));
        }

        $this->displayExecutionTime(
            $seconds = $this->calculateExecutionTimeInSeconds()
        );
    }

    private function displayExecutionTime($seconds)
    {
        $this->info("Processed in $seconds seconds.");
    }

    private function calculateExecutionTimeInSeconds()
    {
        return $this->timeStart->diffInSeconds(now());
    }
}
