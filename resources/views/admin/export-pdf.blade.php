<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data KKN</title>
    <style>
        body { font-family: Arial; font-size: 9px; margin: 15px; }
        .header { text-align: center; margin-bottom: 15px; border-bottom: 2px solid #1e3a8a; padding-bottom: 10px; }
        .header h1 { margin: 0; color: #1e3a8a; font-size: 16px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #1e3a8a; color: white; padding: 8px; text-align: left; border: 1px solid #ddd; }
        td { padding: 6px; border: 1px solid #ddd; }
        tr:nth-child(even) { background: #f9f9f9; }
    </style>
</head>
<body>
    <div class="header">
        <h1>DATA PENDAFTARAN KKN INTERNATIONAL</h1>
        <p>{{ $export_date }}</p>
    </div>

    <table>
        <thead>
            <tr>
                @foreach($columns as $column)
                    <th>
                        @if($column == 'no') No
                        @elseif($column == 'nim') NIM
                        @elseif($column == 'nama') Nama
                        @elseif($column == 'email') Email
                        @elseif($column == 'no_telepon') No. Telp
                        @elseif($column == 'program_studi') Prodi
                        @elseif($column == 'fakultas') Fakultas
                        @elseif($column == 'semester') Sem
                        @elseif($column == 'ipk') IPK
                        @elseif($column == 'periode') Periode
                        @elseif($column == 'negara_tujuan') Negara
                        @elseif($column == 'motivasi') Motivasi
                        @elseif($column == 'status') Status
                        @elseif($column == 'tanggal_daftar') Tgl Daftar
                        @endif
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($data as $item)
                <tr>
                    @foreach($columns as $column)
                        <td>
                            @if($column == 'no') {{ $no }}
                            @elseif($column == 'nim') {{ $item->mahasiswa->nim ?? '-' }}
                            @elseif($column == 'nama') {{ $item->mahasiswa->nama ?? '-' }}
                            @elseif($column == 'email') {{ $item->mahasiswa->email ?? '-' }}
                            @elseif($column == 'no_telepon') {{ $item->mahasiswa->no_telepon ?? '-' }}
                            @elseif($column == 'program_studi') {{ $item->mahasiswa->program_studi ?? '-' }}
                            @elseif($column == 'fakultas') {{ $item->mahasiswa->fakultas ?? '-' }}
                            @elseif($column == 'semester') {{ $item->mahasiswa->semester ?? '-' }}
                            @elseif($column == 'ipk') {{ $item->mahasiswa->ipk ?? '-' }}
                            @elseif($column == 'periode') {{ $item->periode ?? '-' }}
                            @elseif($column == 'negara_tujuan') {{ $item->negara_tujuan ?? '-' }}
                            @elseif($column == 'motivasi') {{ $item->motivasi ? Str::limit(strip_tags($item->motivasi), 100) : '-' }}
                            @elseif($column == 'status') {{ ucfirst($item->status) }}
                            @elseif($column == 'tanggal_daftar') {{ $item->tanggal_daftar ? $item->tanggal_daftar->format('d/m/Y') : '-' }}
                            @endif
                        </td>
                    @endforeach
                </tr>
                @php $no++; @endphp
            @endforeach
        </tbody>
    </table>
</body>
</html>