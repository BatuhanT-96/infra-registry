@extends('layouts.app')

@push('styles')
<style>
    .dashboard-page {
        --dashboard-border: #e2e8f0;
        --dashboard-muted: #64748b;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(12, minmax(0, 1fr));
        gap: 1rem;
    }

    .dashboard-stat {
        grid-column: span 3;
    }

    .dashboard-panel {
        grid-column: span 6;
        border: 1px solid var(--dashboard-border);
        border-radius: 1rem;
        background: #fff;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.06);
        padding: 1rem;
    }

    .panel-title {
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
    }

    .panel-subtitle {
        margin: 0;
        color: var(--dashboard-muted);
        font-size: 0.9rem;
    }

    .chart-wrap {
        position: relative;
        min-height: 260px;
    }

    .chart-total {
        margin-top: 0.75rem;
        color: var(--dashboard-muted);
        font-size: 0.9rem;
        text-align: right;
    }

    @media (max-width: 1199.98px) {
        .dashboard-stat {
            grid-column: span 4;
        }

        .dashboard-panel {
            grid-column: span 12;
        }
    }

    @media (max-width: 767.98px) {
        .dashboard-stat {
            grid-column: span 6;
        }
    }

    @media (max-width: 575.98px) {
        .dashboard-stat {
            grid-column: span 12;
        }
    }
</style>
@endpush

@section('content')
<div class="dashboard-page">
    <h2 class="mb-4">Dashboard</h2>

    <div class="dashboard-grid">
        <div class="dashboard-stat">
            <div class="card card-stat p-3 h-100">
                <h6>Toplam Uygulama</h6>
                <h3>{{ $applicationCount }}</h3>
            </div>
        </div>
        <div class="dashboard-stat">
            <div class="card card-stat p-3 h-100">
                <h6>Toplam Sunucu</h6>
                <h3>{{ $serverCount }}</h3>
            </div>
        </div>
        @foreach(['Test', 'Pre-Prod', 'Prod'] as $env)
            <div class="dashboard-stat">
                <div class="card card-stat p-3 h-100">
                    <h6>{{ $env }}</h6>
                    <h3>{{ $environmentCounts[$env] ?? 0 }}</h3>
                </div>
            </div>
        @endforeach

        <section class="dashboard-panel">
            <header class="d-flex justify-content-between align-items-start gap-3 mb-3">
                <div>
                    <h3 class="panel-title">Ortamlara Göre Sunucu Dağılımı</h3>
                    <p class="panel-subtitle">Test, Pre-Prod ve Prod ortamlarındaki sunucu dağılımı</p>
                </div>
            </header>
            <div class="chart-wrap">
                <canvas id="environmentPieChart" aria-label="Ortamlara göre sunucu dağılımı pasta grafiği" role="img"></canvas>
            </div>
            <p class="chart-total">Toplam: {{ $environmentCounts->sum() }} sunucu</p>
        </section>

        <section class="dashboard-panel">
            <header class="d-flex justify-content-between align-items-start gap-3 mb-3">
                <div>
                    <h3 class="panel-title">İşletim Sistemine Göre Sunucu Dağılımı</h3>
                    <p class="panel-subtitle">Veritabanındaki gerçek sunucu sayıları ile hesaplanır</p>
                </div>
            </header>
            <div class="chart-wrap">
                <canvas id="operatingSystemPieChart" aria-label="İşletim sistemlerine göre sunucu dağılımı pasta grafiği" role="img"></canvas>
            </div>
            <p class="chart-total">Toplam: {{ $operatingSystemCounts->sum() }} sunucu</p>
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
    const palette = ['#3b82f6', '#22c55e', '#f59e0b', '#8b5cf6', '#ef4444', '#14b8a6', '#f97316', '#6366f1'];

    const createPieChart = (elementId, labels, values) => {
        const canvas = document.getElementById(elementId);

        if (!canvas || !labels.length) {
            return;
        }

        new Chart(canvas, {
            type: 'pie',
            data: {
                labels,
                datasets: [{
                    data: values,
                    backgroundColor: labels.map((_, index) => palette[index % palette.length]),
                    borderColor: '#ffffff',
                    borderWidth: 2,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 10,
                            padding: 16,
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => {
                                const total = context.dataset.data.reduce((sum, value) => sum + value, 0);
                                const value = context.raw;
                                const percentage = total ? ((value / total) * 100).toFixed(1) : 0;

                                return `${context.label}: ${value} (${percentage}%)`;
                            },
                        },
                    },
                },
            },
        });
    };

    createPieChart('environmentPieChart',
        @json($environmentCounts->keys()->values()),
        @json($environmentCounts->values()->values()),
    );

    createPieChart('operatingSystemPieChart',
        @json($operatingSystemCounts->keys()->values()),
        @json($operatingSystemCounts->values()->values()),
    );
</script>
@endpush
