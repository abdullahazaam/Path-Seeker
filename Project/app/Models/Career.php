<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = [
        'title',
        'description',
        'domain',
        'required_skills',
        'expected_salary',
    ];

    protected $appends = ['market_metrics'];

    /**
     * Generate dynamic realistic 2026 market statistics & 10-year growth trajectory.
     */
    public function getMarketMetricsAttribute(): array
    {
        $t = strtolower($this->title);
        $d = strtolower($this->domain);

        // Baseline demand & 5-year growth rates based on 2026 tech trends
        if (str_contains($t, 'ai') || str_contains($t, 'machine learning') || str_contains($d, 'artificial intelligence')) {
            $demand = 98;
            $growth = 45;
            $sentiment = 'Explosive Generative AI & Autonomous Agent Demand';
            $hiringIndex = 'Critical Shortage — Maximum Global Hiring Priority';
            $base2021 = 52;
        } elseif (str_contains($t, 'cloud') || str_contains($t, 'devops') || str_contains($t, 'site reliability') || str_contains($d, 'cloud')) {
            $demand = 96;
            $growth = 38;
            $sentiment = 'High Velocity Multi-Cloud & SRE Expansion';
            $hiringIndex = 'Very High — Enterprise Infrastructure Modernization';
            $base2021 = 58;
        } elseif (str_contains($t, 'cybersecurity') || str_contains($t, 'penetration') || str_contains($t, 'soc') || str_contains($d, 'cybersecurity')) {
            $demand = 95;
            $growth = 35;
            $sentiment = 'Urgent Zero-Trust & Cloud Security Need';
            $hiringIndex = 'Critical Shortage — High Enterprise Urgency';
            $base2021 = 56;
        } elseif (str_contains($t, 'backend') || str_contains($t, 'distributed') || str_contains($t, 'systems architect')) {
            $demand = 94;
            $growth = 30;
            $sentiment = 'Robust Low-Latency Core Systems Expansion';
            $hiringIndex = 'Very High — High-Throughput Scalability Priority';
            $base2021 = 60;
        } elseif (str_contains($t, 'big data') || str_contains($t, 'lakehouse') || str_contains($t, 'data scientist') || str_contains($d, 'data')) {
            $demand = 92;
            $growth = 31;
            $sentiment = 'Continuous Lakehouse & Real-Time Analytics Surge';
            $hiringIndex = 'Strong Hiring — Data Intelligence Modernization';
            $base2021 = 57;
        } elseif (str_contains($t, 'full-stack') || str_contains($t, 'full stack') || str_contains($d, 'software')) {
            $demand = 88;
            $growth = 22;
            $sentiment = 'Consistent Global Product Development Demand';
            $hiringIndex = 'Strong Hiring — Ubiquitous Web Platform Modernization';
            $base2021 = 65;
        } elseif (str_contains($t, 'ui/ux') || str_contains($t, 'designer') || str_contains($d, 'design')) {
            $demand = 86;
            $growth = 21;
            $sentiment = 'Elevated AI-Integrated Product Experience Focus';
            $hiringIndex = 'Solid Demand — Human-Centered Design Priority';
            $base2021 = 63;
        } elseif (str_contains($t, 'mobile') || str_contains($t, 'ios') || str_contains($t, 'android') || str_contains($d, 'mobile')) {
            $demand = 84;
            $growth = 19;
            $sentiment = 'Mature Edge Device & Cross-Platform Evolution';
            $hiringIndex = 'Steady Expansion — Mobile-First Ecosystems';
            $base2021 = 64;
        } elseif (str_contains($t, 'blockchain') || str_contains($t, 'smart contract') || str_contains($d, 'blockchain')) {
            $demand = 78;
            $growth = 25;
            $sentiment = 'Institutional DeFi & Cryptographic Infrastructure';
            $hiringIndex = 'Specialized Focus — High-Value Protocol Engineering';
            $base2021 = 48;
        } elseif (str_contains($t, 'game') || str_contains($t, 'graphics') || str_contains($t, 'artist') || str_contains($d, 'game')) {
            $demand = 80;
            $growth = 18;
            $sentiment = 'Spatial Computing & Real-Time 3D Convergence';
            $hiringIndex = 'Targeted Demand — AAA & Interactive Simulation';
            $base2021 = 59;
        } else {
            $demand = 85;
            $growth = 20;
            $sentiment = 'Steady Tech Sector Trajectory';
            $hiringIndex = 'Steady Growth — Core Engineering Expansion';
            $base2021 = 60;
        }

        // Dynamically compute 10 data points:
        // 5 Historical years (2021 to 2025), 1 Current year (2026), 4 Projected future years (2027 to 2030)
        $historyStep = ($demand - $base2021) / 5;
        $projGrowthFactor = (1 + ($growth / 100));
        $futureAnnualGrowth = pow($projGrowthFactor, 0.25) - 1; // 4-year projected compound rate

        $trajectoryData = [
            round($base2021, 1),
            round($base2021 + ($historyStep * 1) + (rand(-10, 10) / 10), 1),
            round($base2021 + ($historyStep * 2) + (rand(-10, 10) / 10), 1),
            round($base2021 + ($historyStep * 3) + (rand(-10, 10) / 10), 1),
            round($base2021 + ($historyStep * 4) + (rand(-10, 10) / 10), 1),
            round($demand, 1), // 2026 current
            round($demand * (1 + $futureAnnualGrowth * 1), 1),
            round($demand * (1 + $futureAnnualGrowth * 2), 1),
            round($demand * (1 + $futureAnnualGrowth * 3), 1),
            round($demand * (1 + $futureAnnualGrowth * 4), 1),
        ];

        return [
            'demand_score' => $demand,
            'growth_rate' => '+' . $growth . '%',
            'growth_value' => $growth,
            'sentiment' => $sentiment,
            'hiring_index' => $hiringIndex,
            'trajectory_labels' => ['2021', '2022', '2023', '2024', '2025', '2026 (Now)', '2027 (Proj)', '2028 (Proj)', '2029 (Proj)', '2030 (Proj)'],
            'trajectory_data' => $trajectoryData,
            'historical_points' => array_slice($trajectoryData, 0, 6),
            'projected_points' => array_slice($trajectoryData, 5),
        ];
    }
}
