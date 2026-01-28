<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Pendaftaran KKN International</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 9px;
            color: #333;
            padding: 15px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 3px solid #1e3a8a;
        }
        
        .header h1 {
            font-size: 18px;
            color: #1e3a8a;
            margin-bottom: 3px;
            font-weight: bold;
        }
        
        .header h2 {
            font-size: 14px;
            color: #F9B234;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .header p {
            font-size: 9px;
            color: #666;
        }
        
        .filter-info {
            background: #f8f9fa;
            padding: 8px 10px;
            margin-bottom: 12px;
            border-radius: 4px;
            border-left: 3px solid #1e3a8a;
        }
        
        .filter-info h3 {
            font-size: 10px;
            color: #1e3a8a;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .filter-row {
            display: table;
            width: 100%;
            margin-bottom: 3px;
        }
        
        .filter-label {
            display: table-cell;
            width: 100px;
            font-weight: bold;
            color: #495057;
            font-size: 8px;
        }
        
        .filter-value {
            display: table-cell;
            color: #1e3a8a;
            font-weight: bold;
            font-size: 8px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        
        thead {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            color: white;
        }
        
        thead th {
            padding: 8px 5px;
            text-align: left;
            font-size: 8px;
            font-weight: bold;
            border: 1px solid #1e3a8a;
            text-transform: uppercase;
        }
        
        tbody td {
            padding: 6px 5px;
            border: 1px solid #dee2e6;
            font-size: 8px;
            vertical-align: top;
        }
        
        tbody tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        tbody tr:hover {
            background: #e9ecef;
        }
        
        .text-center {
            text-align: center;
        }
        
        .badge {
            display: inline-block;
            padding: 3px 6px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 7px;
            text-transform: uppercase;
            color: white;
        }
        
        .badge-warning {
            background: #f59e0b;
        }
        
        .badge-info {
            background: #0ea5e9;
        }
        
        .badge-success {
            background: #10b981;
        }
        
        .badge-danger {
            background: #ef4444;
        }
        
        .footer {
            margin-top: 15px;
            padding-top: 8px;
            border-top: 2px solid #e9ecef;
            text-align: right;
            font-size: 7px;
            color: #6c757d;
        }
        
        .footer strong {
            color: #1e3a8a;
        }
        
        .stats-box {
            background: #f0f9ff;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #0ea5e9;
        }
        
        .stats-box p {
            font-size: 9px;
            color: #1e3a8a;
            font-weight: bold;
            margin: 0;
        }
        
        .no-data {
            text-align: center;
            padding: 30px;
            color: #6c757d;
            font-style: italic;
            font-size: 10px;
        }
        
        /* Page break handling */
        .page-break {
            page-break-after: always;
        }
        
        @page {
            margin: 15px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>UNIVERSITAS LAMPUNG</h1>
        <h2>DATA PENDAFTARAN KKN INTERNATIONAL</h2>
        <p>Dicetak pada: {{ date('d/m/Y H:i:s') }} WIB</p>
    </div>

    <!-- Filter Information -->
    <div class="filter-info">
        <h3>📋 INFORMASI FILTER</h3>
        <div class="filter-row">
            <div class="filter-label">Status:</div>
            <div class="filter-value">{{ ucfirst($filterInfo['status']) }}</div>
        </div>
        <div class="filter-row">
            <div class="filter-label">Periode:</div>
            <div class="filter-value">{{ $filterInfo['periode'] }}</div>
        </div>
        <div class="filter-row">
            <div class="filter-label">Negara Tujuan:</div>
            <div class="filter-value">{{ $filterInfo['negara'] }}</div>
        </div>
        <div class="filter-row">
            <div class="filter-label">Pencarian:</div>
            <div class="filter-value">{{ $filterInfo['search'] }}</div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="stats-box">
        <p>📊 Total Data yang Diekspor: {{ $filterInfo['total'] }} pendaftaran</p>
    </div>

    <!-- Data Table -->
    @if($pendaftaran->count() > 0)
        <table>
            <thead>
                <tr>
                    <th width="3%" class="text-center">No</th>
                    <th width="8%">Tanggal</th>
                    <th width="10%">NIM</th>
                    <th width="18%">Nama Lengkap</th>
                    <th width="15%">Program Studi</th>
                    <th width="10%">Periode</th>
                    <th width="12%">Negara Tujuan</th>
                    <th width="8%">Status</th>
                    <th width="16%">Catatan Admin</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendaftaran as $index => $item)
                    @if($item->mahasiswa)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td><strong>{{ $item->mahasiswa->nim }}</strong></td>
                            <td>{{ $item->mahasiswa->nama }}</td>
                            <td>{{ $item->mahasiswa->program_studi ?? '-' }}</td>
                            <td>{{ $item->periode }}</td>
                            <td>{{ $item->negara_tujuan }}</td>
                            <td>
                                @if($item->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($item->status == 'diproses')
                                    <span class="badge badge-info">Diproses</span>
                                @elseif($item->status == 'diterima')
                                    <span class="badge badge-success">Diterima</span>
                                @elseif($item->status == 'ditolak')
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>{{ $item->catatan_admin ?? '-' }}</td>
                        </tr>
                    @else
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td colspan="7" style="color: #ef4444;">
                                ⚠️ Data mahasiswa tidak ditemukan (ID: {{ $item->id }})
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            <p>📭 Tidak ada data yang sesuai dengan filter yang dipilih</p>
        </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <p>
            <strong>Dokumen ini digenerate otomatis oleh sistem</strong><br>
            © {{ date('Y') }} Universitas Lampung - Sistem Pendaftaran KKN International
        </p>
    </div>
</body>
</html>