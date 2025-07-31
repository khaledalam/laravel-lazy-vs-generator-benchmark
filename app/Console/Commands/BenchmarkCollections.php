<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;

class BenchmarkCollections extends Command
{
    protected $signature = 'benchmark:collections';
    protected $description = 'Benchmark Eager, Lazy, and Generator memory usage';

    public function handle()
    {
        $this->info("Starting benchmarks...\n");

        $this->runBenchmark('Eager Collection', function () {
            $data = collect(range(1, 2000000))
                ->filter(fn($x) => $x % 2 === 0)
                ->take(-100)
                ->toArray();
        });

        $this->runBenchmark('Lazy Collection', function () {
            $data = LazyCollection::make(range(1, 2000000))
                ->filter(fn($x) => $x % 2 === 0)
                ->take(-100)
                ->toArray();
        });

        $this->runBenchmark('PHP Generator', function () {
            $data = collect($this->generate())
                ->filter(fn($x) => $x % 2 === 0)
                ->take(-100)
                ->toArray();
        });

        $this->info("✅ Done!");
    }

    private function runBenchmark(string $name, callable $callback)
    {
        $this->info("🧪 $name");

        gc_collect_cycles();
        gc_mem_caches();

        $startTime = microtime(true);
        $startPeakMemory = memory_get_peak_usage(true);

        $callback();

        $endTime = microtime(true);
        $endPeakMemory = memory_get_peak_usage(true);

        $memoryUsed = ($endPeakMemory - $startPeakMemory) / (1024 * 1024);
        $timeTaken = $endTime - $startTime;

        $this->line("Memory Used: " . round($memoryUsed, 2) . " MB (" . round($memoryUsed * 1024, 2) . " KB)");
        $this->line("Time Taken: " . round($timeTaken, 3) . " sec\n");
    }


    private function generate()
    {
        for ($i = 1; $i <= 2000000; $i++) {
            yield $i;
        }
    }
}
