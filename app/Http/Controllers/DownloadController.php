<?php

namespace App\Http\Controllers;

//require 'vendor/autoload.php';

use App\Models\ActivityCkp;
use App\Models\Ckp;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\Month;
use App\Models\Year;
use Auth;
use Illuminate\Http\Request;

class DownloadController extends Controller
{

    public function download(Request $request)
    {

        $ckp = Ckp::where(['year_id' => $request->year, 'month_id' => $request->month, 'user_id' => Auth::user()->id,])->get()->first();
        $activities = ActivityCkp::where(['ckp_id' => $ckp->id])->get();
        $year = Year::find($request->year);
        $month = Month::find($request->month);

        if (count($activities) > 0) {

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $thinborderall = [
                'borders' => [
                    'top' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'left' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'right' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];

            $sheet->getStyle('A2')
                ->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A2')->getFont()->setSize(14)->setBold(true);

            $sheet->setCellValue('A2', 'Capaian Kinerja Pegawai (CKP) Tahun ' . $year->name);
            $sheet->mergeCells('A2:J2');
            $sheet->setCellValue('J1', 'CKP-R');
            $sheet->getStyle('J1')
                ->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('J1')->getFont()->setBold(true);
            $sheet->getStyle('J1')
                ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
            $sheet->getStyle('J1')
                ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
            $sheet->getStyle('J1')
                ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
            $sheet->getStyle('J1')
                ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

            $sheet->getColumnDimension('A')->setWidth(5);
            $sheet->getColumnDimension('B')->setWidth(22);
            $sheet->getColumnDimension('C')->setWidth(80);
            $sheet->getColumnDimension('D')->setWidth(15);
            $sheet->getColumnDimension('E')->setWidth(15);
            $sheet->getColumnDimension('F')->setWidth(15);
            $sheet->getColumnDimension('G')->setWidth(15);
            $sheet->getColumnDimension('H')->setWidth(15);
            $sheet->getColumnDimension('I')->setWidth(15);
            $sheet->getColumnDimension('J')->setWidth(20);

            $sheet->setCellValue('B4', 'Satuan Organisasi');
            $sheet->setCellValue('B5', 'Nama');
            $sheet->setCellValue('B6', 'Jabatan');
            $sheet->setCellValue('B7', 'Periode');

            $sheet->setCellValue('A9', 'No.');
            $sheet->mergeCells('A9:A10');
            $sheet->setCellValue('B9', 'Uraian Kegiatan');
            $sheet->mergeCells('B9:C10');
            $sheet->setCellValue('D9', 'Satuan');
            $sheet->mergeCells('D9:D10');
            $sheet->setCellValue('E9', 'Kuantitas');
            $sheet->mergeCells('E9:G9');
            $sheet->setCellValue('E10', 'Target');
            $sheet->setCellValue('F10', 'Realisasi');
            $sheet->setCellValue('G10', 'Persentase');
            $sheet->setCellValue('H9', 'Tingkat Kualitas');
            $sheet->mergeCells('H9:H10');
            $sheet->setCellValue('I9', 'Capaian Angka Kredit');
            $sheet->mergeCells('I9:I10');
            $sheet->setCellValue('J9', 'Keterangan');
            $sheet->mergeCells('J9:J10');
            $sheet->getStyle('A9:J10')
                ->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                ->setWrapText(true);
            $sheet->getStyle('A9:J10')->getFont()->setBold(true);
            $sheet->getStyle('A9:J10')->applyFromArray($thinborderall);

            $sheet->setCellValue('A11', '(1)');
            $sheet->setCellValue('B11', '(2)');
            $sheet->mergeCells('B11:C11');
            $sheet->setCellValue('D11', '(3)');
            $sheet->setCellValue('E11', '(4)');
            $sheet->setCellValue('F11', '(5)');
            $sheet->setCellValue('G11', '(6)');
            $sheet->setCellValue('H11', '(7)');
            $sheet->setCellValue('I11', '(8)');
            $sheet->setCellValue('J11', '(9)');
            $sheet->getStyle('A11:J11')
                ->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                ->setWrapText(true);
            $sheet->getStyle('A11:J11')->getFont()->setSize(8);
            $sheet->getStyle('A11:J11')->applyFromArray($thinborderall);

            $sheet->setCellValue('C4', ': ' . Auth::user()->department->name);
            $sheet->setCellValue('C5', ': ' . Auth::user()->name);
            $sheet->setCellValue('C6', ': ' . Auth::user()->department->name);
            $sheet->setCellValue('C7', ': ' . $month->name . ' ' . $year->name);

            $sheet->mergeCells('B12:J12');
            $sheet->setCellValue('B12', 'UTAMA');
            $sheet->getStyle('A12:J12')->getFont()->setBold(true);
            $sheet->getStyle('A12:J12')->applyFromArray($thinborderall);

            //Kegiatan Utama
            $num = 1;
            $row = 13;
            for ($i = 0; $i < count($activities); $i++) {
                if ($activities[$i]->type == 'main') {
                    $sheet->setCellValue('A' . $row, $num);
                    $sheet->setCellValue('B' . $row, $activities[$i]->name);
                    $sheet->mergeCells('B' . $row . ':C' . $row);
                    $sheet->setCellValue('D' . $row, $activities[$i]->unit);
                    $sheet->setCellValue('E' . $row, $activities[$i]->target);
                    $sheet->setCellValue('F' . $row, $activities[$i]->real);
                    $sheet->setCellValue('G' . $row, '');
                    $sheet->setCellValue('H' . $row, $activities[$i]->quality);
                    $sheet->setCellValue('I' . $row, '');
                    $sheet->setCellValue('J' . $row, $activities[$i]->note);
                    $sheet->getStyle('A' . $row . ':J' . $row)->applyFromArray($thinborderall);
                    $num++;
                    $row++;
                }
            }


            $sheet->mergeCells('B' . $row . ':J' . $row);
            $sheet->setCellValue('B' . $row, 'TAMBAHAN');
            $sheet->getStyle('A' . $row . ':J' . $row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $row . ':J' . $row)->applyFromArray($thinborderall);
            $row++;

            $num = 1;
            for ($i = 0; $i < count($activities); $i++) {
                if ($activities[$i]->type == 'additional') {
                    $sheet->setCellValue('A' . $row, $num);
                    $sheet->setCellValue('B' . $row, $activities[$i]->name);
                    $sheet->mergeCells('B' . $row . ':C' . $row);
                    $sheet->setCellValue('D' . $row, $activities[$i]->unit);
                    $sheet->setCellValue('E' . $row, $activities[$i]->target);
                    $sheet->setCellValue('F' . $row, $activities[$i]->real);
                    $sheet->setCellValue('G' . $row, '');
                    $sheet->setCellValue('H' . $row, $activities[$i]->quality);
                    $sheet->setCellValue('I' . $row, '');
                    $sheet->setCellValue('J' . $row, $activities[$i]->note);
                    $sheet->getStyle('A' . $row . ':J' . $row)->applyFromArray($thinborderall);
                    $num++;
                    $row++;
                }
            }

            $writer = new Xlsx($spreadsheet);
            $writer->save('hello world.xlsx');

            return redirect('/download')->with('success-download', 'CKP telah didownload');
        } else {
            return redirect('/download')->with('error-download', 'Tidak ada Kegiatan di CKP ' . $month->name . ' ' . $year->name);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $months = Month::all();
        $years = Year::all();
        return view('download.index', compact(['months', 'years']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
