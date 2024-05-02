<div class="">
    <div>
        <canvas id="perminfoChart"></canvas>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            var jenisData = JSON.parse(`<?php echo $jenisData; ?>`)

            const kategoriData = {
                labels: [
                    'Data Perkara', 'Data Kepegawaian', 'Data Aset/keuangan', 'Data Umum/lainnya'
                ],
                datasets: [{
                    type: 'bar',
                    label: 'Permohonan Informasi ' + jenisData.year,
                    data: jenisData.perminfo,
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)'
                }, {
                    type: 'bar',
                    label: 'Pengajuan Keberatan ' + jenisData.year,
                    data: jenisData.pengkeber,
                    fill: false,
                    borderColor: 'rgb(54, 162, 235)'
                }]
            };

            const config = {
                type: 'bar',
                data: kategoriData,
                options: {
                    elements: {
                        line: {
                            borderWidth: 3
                        }
                    }
                },
            };

            const ctxData = document.getElementById('perminfoChart');

            new Chart(ctxData, config);
        </script>
    @endpush
</div>
