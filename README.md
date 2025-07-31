## Laravel Lazy Collections vs Generators Benchmark

This small Laravel benchmarking tool compares the **performance and memory usage** of three different iteration techniques:

- Laravel **Eager Collections**
- Laravel **Lazy Collections**
- Native **PHP Generators**

> ⚡ Discover which method performs best in your Laravel applications when handling large datasets.

---

### 📊 Benchmark Purpose

This command measures:
- ⏱ **Time Taken**
- 💾 **Memory Used (MB & KB)**

Useful for developers aiming to optimize loops, data processing, or large ETL pipelines in Laravel.

---

### 🛠 Installation

1. Clone the repository or add the command to your Laravel project.
2. Register the command inside your `App\Console\Kernel.php`:

```php
protected $commands = [
    \App\Console\Commands\BenchmarkCollections::class,
];
```

3. Run the benchmark:

```bash
php artisan benchmark:collections
```

### 📋 Sample Output
```yaml
Starting benchmarks...

🧪 Eager Collection
Memory Used: 92.02 MB (94224 KB)
Time Taken: 0.124 sec

🧪 Lazy Collection
Memory Used: 0 MB (0 KB)
Time Taken: 0.276 sec

🧪 PHP Generator
Memory Used: 0 MB (0 KB)
Time Taken: 0.191 sec

✅ Done!
```

### 📌 Summary
Insight: PHP Generators often provide the lowest memory footprint. Lazy Collections are more readable within Laravel but slightly slower. Eager Collections are fastest, but consume more memory.

### 📦 Use Case
This tool is ideal for:
- Laravel performance comparison
- Teaching lazy evaluation
- Evaluating data processing trade-offs

### 🧑‍💻 Author<br />
Khaled Alam<br />
Senior PHP Engineer | Dubai 🇦🇪<br />
[Portfolio](https://khaledalam.net/) | [LinkedIn](https://www.linkedin.com/in/khaledalam)

### 🪄 License
MIT
