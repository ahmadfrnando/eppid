<div>
    <div wire:ignore>
        <canvas id="userChart"></canvas>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            var userData = JSON.parse(`<?php echo $userData; ?>`);
            console.log(userData);
            const ctxUser = document.getElementById('userChart').getContext('2d');
            var data = [userData.Januari, userData.Februari, userData.Maret, userData.April, userData
                .Mei, userData.Juni, userData.Juli, userData.Agustus, userData.September,
                userData.Oktober, userData.November, userData.Desember
            ];
            const myChart = new Chart(ctxUser, {
                type: 'line',
                data: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ],
                    datasets: [{
                        label: 'Laporan Bulanan Masyarakat Terdaftar ' + userData.year,
                        data: data,
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    skipNull: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endpush
</div>
