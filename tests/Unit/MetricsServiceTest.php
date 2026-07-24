<?php

namespace Tests\Unit;

use App\Models\Contact;
use App\Services\Metrics\MetricsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MetricsServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_metrics_are_generated_correctly(): void
    {
        Contact::factory()->count(2)->create([
            'sentiment' => 'positive',
            'category' => 'sales',
        ]);

        Contact::factory()->create([
            'sentiment' => 'negative',
            'category' => 'support',
        ]);

        $metrics = app(MetricsService::class)->get();

        $this->assertEquals(3, $metrics['total_contacts']);

        $this->assertEquals(2, $metrics['positive']);

        $this->assertEquals(1, $metrics['negative']);

        $this->assertArrayHasKey('categories', $metrics);

        $this->assertEquals(2, $metrics['categories']['sales']);

        $this->assertEquals(1, $metrics['categories']['support']);
    }
}
