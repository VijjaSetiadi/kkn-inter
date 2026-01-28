<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PendaftaranKkn;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ExportController extends Controller
{
    public function index()
    {
        $periods = PendaftaranKkn::select('periode')
            ->distinct()
            ->whereNotNull('periode')
            ->orderBy('periode', 'desc')
            ->pluck('periode');
        
        $destinations = PendaftaranKkn::select('negara_tujuan')
            ->distinct()
            ->whereNotNull('negara_tujuan')
            ->orderBy('negara_tujuan', 'asc')
            ->pluck('negara_tujuan');
        
        return view('admin.export', compact('periods', 'destinations'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'export_format' => 'required|in:excel,pdf,csv',
            'columns' => 'required|array|min:1',
        ], [
            'columns.required' => 'Pilih minimal 1 kolom untuk di-export',
            'columns.min' => 'Pilih minimal 1 kolom untuk di-export',
        ]);

        $query = PendaftaranKkn::with('mahasiswa');

        // Apply filters
        if ($request->filter_status) {
            $query->where('status', $request->filter_status);
        }

        if ($request->filter_period) {
            $query->where('periode', $request->filter_period);
        }

        if ($request->filter_destination) {
            $query->where('negara_tujuan', $request->filter_destination);
        }

        if ($request->filter_date_from) {
            $query->whereDate('created_at', '>=', $request->filter_date_from);
        }

        if ($request->filter_date_to) {
            $query->whereDate('created_at', '<=', $request->filter_date_to);
        }

        $data = $query->orderBy('created_at', 'desc')->get();
        $columns = $request->columns;

        switch ($request->export_format) {
            case 'excel':
                return $this->exportToExcel($data, $columns);
            case 'pdf':
                return $this->exportToPdf($data, $columns);
            case 'csv':
                return $this->exportToCsv($data, $columns);
            default:
                return back()->with('error', 'Format export tidak valid');
        }
    }

    private function exportToExcel($data, $columns)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'DATA PENDAFTARAN KKN INTERNATIONAL');
        $sheet->mergeCells('A1:' . $this->getColumnLetter(count($columns)) . '1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A2', 'Tanggal Export: ' . date('d/m/Y H:i:s'));
        $sheet->mergeCells('A2:' . $this->getColumnLetter(count($columns)) . '2');
        $sheet->getStyle('A2')->getFont()->setSize(10);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Header
        $row = 4;
        $col = 1;
        foreach ($columns as $column) {
            $columnLetter = $this->getColumnLetter($col);
            $sheet->setCellValue($columnLetter . $row, $this->getColumnName($column));
            
            $sheet->getStyle($columnLetter . $row)->applyFromArray([
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '1e3a8a']
                ],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN]
                ]
            ]);
            
            $col++;
        }

        // Data
        $row = 5;
        $no = 1;
        foreach ($data as $item) {
            $col = 1;
            foreach ($columns as $column) {
                $value = $this->getColumnValue($item, $column, $no);
                $sheet->setCellValue($this->getColumnLetter($col) . $row, $value);
                
                $sheet->getStyle($this->getColumnLetter($col) . $row)->applyFromArray([
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CCCCCC']]
                    ]
                ]);
                
                $col++;
            }
            $row++;
            $no++;
        }

        // Auto size
        foreach (range(1, count($columns)) as $col) {
            $sheet->getColumnDimension($this->getColumnLetter($col))->setAutoSize(true);
        }

        $sheet->getRowDimension(1)->setRowHeight(30);
        $sheet->getRowDimension(4)->setRowHeight(25);

        $filename = 'Data_KKN_' . date('Y-m-d_His') . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    private function exportToPdf($data, $columns)
    {
        $pdf = Pdf::loadView('admin.export-pdf', [
            'data' => $data,
            'columns' => $columns,
            'export_date' => date('d/m/Y H:i:s')
        ]);

        $pdf->setPaper('a4', 'landscape');
        
        $filename = 'Data_KKN_' . date('Y-m-d_His') . '.pdf';
        return $pdf->download($filename);
    }

    private function exportToCsv($data, $columns)
    {
        $filename = 'Data_KKN_' . date('Y-m-d_His') . '.csv';
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        
        // Header
        $headers = [];
        foreach ($columns as $column) {
            $headers[] = $this->getColumnName($column);
        }
        fputcsv($output, $headers);
        
        // Data
        $no = 1;
        foreach ($data as $item) {
            $row = [];
            foreach ($columns as $column) {
                $row[] = $this->getColumnValue($item, $column, $no);
            }
            fputcsv($output, $row);
            $no++;
        }
        
        fclose($output);
        exit;
    }

    private function getColumnLetter($number)
    {
        $letter = '';
        while ($number > 0) {
            $temp = ($number - 1) % 26;
            $letter = chr($temp + 65) . $letter;
            $number = ($number - $temp - 1) / 26;
        }
        return $letter;
    }

    private function getColumnName($column)
    {
        $names = [
            'no' => 'No',
            'nim' => 'NIM',
            'nama' => 'Nama',
            'email' => 'Email',
            'no_telepon' => 'No. Telepon',
            'program_studi' => 'Program Studi',
            'fakultas' => 'Fakultas',
            'semester' => 'Semester',
            'ipk' => 'IPK',
            'periode' => 'Periode',
            'negara_tujuan' => 'Negara Tujuan',
            'motivasi' => 'Motivasi',
            'status' => 'Status',
            'tanggal_daftar' => 'Tanggal Daftar',
        ];

        return $names[$column] ?? $column;
    }

    private function getColumnValue($item, $column, $no)
    {
        switch ($column) {
            case 'no':
                return $no;
            case 'nim':
                return $item->mahasiswa->nim ?? '-';
            case 'nama':
                return $item->mahasiswa->nama ?? '-';
            case 'email':
                return $item->mahasiswa->email ?? '-';
            case 'no_telepon':
                return $item->mahasiswa->no_telepon ?? '-';
            case 'program_studi':
                return $item->mahasiswa->program_studi ?? '-';
            case 'fakultas':
                return $item->mahasiswa->fakultas ?? '-';
            case 'semester':
                return $item->mahasiswa->semester ?? '-';
            case 'ipk':
                return $item->mahasiswa->ipk ?? '-';
            case 'periode':
                return $item->periode ?? '-';
            case 'negara_tujuan':
                return $item->negara_tujuan ?? '-';
            case 'motivasi':
                return $item->motivasi ? substr(strip_tags($item->motivasi), 0, 150) : '-';
            case 'status':
                return ucfirst($item->status);
            case 'tanggal_daftar':
                return $item->tanggal_daftar ? $item->tanggal_daftar->format('d/m/Y') : '-';
            default:
                return '-';
        }
    }
}