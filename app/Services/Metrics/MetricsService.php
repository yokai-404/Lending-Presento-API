<?php

namespace App\Services\Metrics;

use App\Models\Contact;

class MetricsService
{
    public function get(): array
    {
        return [
            'total_contacts' => Contact::count(),

            'today_contacts' => Contact::query()
                ->whereDate('created_at', today())
                ->count(),

            'positive' => Contact::query()
                ->where('sentiment', 'positive')
                ->count(),

            'neutral' => Contact::query()
                ->where('sentiment', 'neutral')
                ->count(),

            'negative' => Contact::query()
                ->where('sentiment', 'negative')
                ->count(),

            'categories' => Contact::query()
                ->selectRaw('category, COUNT(*) as total')
                ->whereNotNull('category')
                ->groupBy('category')
                ->pluck('total', 'category')
                ->toArray(),
        ];
    }
}
