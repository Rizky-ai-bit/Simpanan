<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Simpanan - Laporan PDF</title>
    <style>
        @media print {
            body {
                margin: 0;
            }

            .no-print {
                display: none;
            }
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            background: white;
            line-height: 1.4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .logo {
            width: 50px;
            height: 50px;
            background: #007bff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }

        .info-left,
        .info-right {
            width: 48%;
        }

        .info-row {
            display: flex;
            margin-bottom: 8px;
        }

        .info-label {
            width: 140px;
            font-weight: bold;
            color: #555;
        }

        .info-value {
            flex: 1;
            border-bottom: 1px dotted #999;
            padding-bottom: 2px;
        }

        .table-container {
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px 8px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            font-size: 11px;
        }

        td {
            font-size: 11px;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .total-section {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: right;
        }

        .total-amount {
            font-size: 16px;
            font-weight: bold;
            color: #28a745;
        }

        .summary-info {
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-left: 4px solid #007bff;
        }

        .print-btn {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .print-btn:hover {
            background: #0056b3;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        .no-data {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 30px;
        }

        .stripe-row:nth-child(even) {
            background-color: #f8f9fa;
        }

        .amount {
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="container">
        <div class="header">
            <div class="logo-section">
                <div>
                    <div class="title">Daftar Simpanan</div>
                </div>
            </div>
        </div>

        <div class="info-section">
            <div class="info-left">
                <div class="info-row">
                    <span class="info-label">No Anggota</span>
                    <span class="info-value">{{ $simpanan->nomor_anggota }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nama Anggota</span>
                    <span class="info-value">{{ $simpanan->nama }}</span>
                </div>
            </div>

            <div class="info-right">
                <div class="info-row">
                    <span class="info-label">Unit Kerja</span>
                    <span class="info-value">{{ $simpanan->unit }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">No HP</span>
                    <span class="info-value">{{ $simpanan->no_hp }}</span>
                </div>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 8%;">No Simpanan</th>
                        <th style="width: 25%;">Jenis Simpanan</th>
                        <th style="width: 20%;">Jumlah Setoran</th>
                        <th style="width: 15%;">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($simpanan->transaksi as $transaksi)
                        <tr class="stripe-row">
                            <td>{{ sprintf('%06d', $loop->iteration) }}</td>
                            <td class="text-left">{{ $transaksi->jenis_simpanan }}</td>
                            <td class="text-right amount">{{ 'Rp. ' . number_format($transaksi->setoran, 0, ',', '.') }}
                            </td>
                            <td>{{ $transaksi->tgl }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data simpanan</td>
                        </tr>
                    @endforelse
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="total-section">
            <div class="total-amount">
                Saldo Simpanan: <span class="amount">{{ 'Rp. ' . number_format($totalSimpanan, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="footer">
            <p><strong>Koperasi Karyawan JMB</strong></p>
            <p>Jl. Raya Cirebon Kuningan KM. 8, Ciperna, Talun, Ciperna, Kec. Talun, Kabupaten Cirebon, Jawa Barat 45171
            </p>
            <p>Dicetak pada: <span id="footer-date"></span>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        </div>
    </div>

    <script>
        // Auto-fill current date
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            const dateString = today.toLocaleDateString('id-ID', options);
            const shortDate = today.toLocaleDateString('id-ID');

            document.getElementById('print-date').textContent = shortDate;
            document.getElementById('footer-date').textContent = dateString;
        });

        // Format currency function (could be used for dynamic data)
        function formatCurrency(amount) {
            return 'Rp. ' + amount.toLocaleString('id-ID');
        }

        // Function to calculate total (for dynamic implementation)
        function calculateTotal() {
            const amounts = document.querySelectorAll('.amount');
            let total = 0;
            amounts.forEach(amount => {
                const value = amount.textContent.replace(/[^\d]/g, '');
                total += parseInt(value);
            });
            return total;
        }
    </script>
</body>

</html>
