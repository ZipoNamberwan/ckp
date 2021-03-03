<?php

namespace App\Http\Controllers;

//require 'vendor/autoload.php';

use App\Models\ActivityCkpR;
use App\Models\Ckp;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use App\Models\Month;
use App\Models\User;
use App\Models\Year;
use Auth;
use Illuminate\Http\Request;

class DownloadController extends Controller
{

    public function download(Request $request)
    {
        $ckp =Ckp::where(['year_id' => $request->year, 'month_id' => $request->month, 'user_id' => Auth::user()->id,])->get()->first();
        $year = Year::find($request->year);
        $month = Month::find($request->month);

        if ($ckp) {
            $assessor = User::where('department_id', $ckp->user->department->parent->id)->first();
            $user = Auth::user();
            $activities = ActivityCkpR::where(['ckp_id' => $ckp->id])->get();

            if (count($activities) > 0) {

                $spreadsheet = new Spreadsheet();

                $sheetT = $spreadsheet->getActiveSheet();
                $sheetT->setTitle('CKP-T');

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

                $sheetT->getStyle('A2')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheetT->getStyle('A2')->getFont()->setSize(14)->setBold(true);

                $sheetT->setCellValue('A2', 'Target Kinerja Pegawai Tahun ' . $year->name);
                $sheetT->mergeCells('A2:G2');
                $sheetT->setCellValue('G1', 'CKP-T');
                $sheetT->getStyle('G1')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheetT->getStyle('G1')->getFont()->setBold(true);
                $sheetT->getStyle('G1')
                    ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $sheetT->getStyle('G1')
                    ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $sheetT->getStyle('G1')
                    ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $sheetT->getStyle('G1')
                    ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

                $sheetT->getColumnDimension('A')->setWidth(5);
                $sheetT->getColumnDimension('B')->setWidth(22);
                $sheetT->getColumnDimension('C')->setWidth(65);
                $sheetT->getColumnDimension('D')->setWidth(15);
                $sheetT->getColumnDimension('E')->setWidth(15);
                $sheetT->getColumnDimension('F')->setWidth(15);
                $sheetT->getColumnDimension('G')->setWidth(20);

                $sheetT->setCellValue('B4', 'Satuan Organisasi');
                $sheetT->setCellValue('B5', 'Nama');
                $sheetT->setCellValue('B6', 'Jabatan');
                $sheetT->setCellValue('B7', 'Periode');

                $sheetT->setCellValue('A9', 'No.');
                $sheetT->mergeCells('A9:A10');
                $sheetT->setCellValue('B9', 'Uraian Kegiatan');
                $sheetT->mergeCells('B9:C10');
                $sheetT->setCellValue('D9', 'Satuan');
                $sheetT->mergeCells('D9:D10');
                $sheetT->setCellValue('E9', 'Target Kuantitas');
                $sheetT->mergeCells('E9:E10');
                $sheetT->setCellValue('F9', 'Capaian Angka Kredit');
                $sheetT->mergeCells('F9:F10');
                $sheetT->setCellValue('G9', 'Keterangan');
                $sheetT->mergeCells('G9:G10');
                $sheetT->getStyle('A9:G10')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                    ->setWrapText(true);
                $sheetT->getStyle('A9:G10')->getFont()->setBold(true);
                $sheetT->getStyle('A9:G10')->applyFromArray($thinborderall);

                $sheetT->setCellValue('A11', '(1)');
                $sheetT->setCellValue('B11', '(2)');
                $sheetT->mergeCells('B11:C11');
                $sheetT->setCellValue('D11', '(3)');
                $sheetT->setCellValue('E11', '(4)');
                $sheetT->setCellValue('F11', '(5)');
                $sheetT->setCellValue('G11', '(6)');
                $sheetT->getStyle('A11:G11')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                    ->setWrapText(true);
                $sheetT->getStyle('A11:G11')->getFont()->setSize(8);
                $sheetT->getStyle('A11:G11')->applyFromArray($thinborderall);

                $sheetT->setCellValue('C4', ': ' . Auth::user()->department->name);
                $sheetT->setCellValue('C5', ': ' . Auth::user()->name);
                $sheetT->setCellValue('C6', ': ' . Auth::user()->department->name);
                $sheetT->setCellValue('C7', ': ' . $month->name . ' ' . $year->name);

                $sheetT->mergeCells('B12:G12');
                $sheetT->setCellValue('B12', 'UTAMA');
                $sheetT->getStyle('A12:G12')->getFont()->setBold(true);
                $sheetT->getStyle('A12:G12')->applyFromArray($thinborderall);

                //Kegiatan Utama
                $num = 1;
                $row = 13;
                for ($i = 0; $i < count($activities); $i++) {
                    if ($activities[$i]->type == 'main') {
                        $sheetT->setCellValue('A' . $row, $num);
                        $sheetT->setCellValue('B' . $row, $activities[$i]->name);
                        $sheetT->mergeCells('B' . $row . ':C' . $row);
                        $sheetT->setCellValue('D' . $row, $activities[$i]->unit);
                        $sheetT->setCellValue('E' . $row, $activities[$i]->real);
                        $sheetT->setCellValue('F' . $row, '');
                        $sheetT->setCellValue('G' . $row, $activities[$i]->note);
                        $sheetT->getStyle('A' . $row . ':G' . $row)->applyFromArray($thinborderall);
                        $num++;
                        $row++;
                    }
                }


                $sheetT->mergeCells('B' . $row . ':G' . $row);
                $sheetT->setCellValue('B' . $row, 'TAMBAHAN');
                $sheetT->getStyle('A' . $row . ':G' . $row)->getFont()->setBold(true);
                $sheetT->getStyle('A' . $row . ':G' . $row)->applyFromArray($thinborderall);
                $row++;

                $num = 1;
                for ($i = 0; $i < count($activities); $i++) {
                    if ($activities[$i]->type == 'additional') {
                        $sheetT->setCellValue('A' . $row, $num);
                        $sheetT->setCellValue('B' . $row, $activities[$i]->name);
                        $sheetT->mergeCells('B' . $row . ':C' . $row);
                        $sheetT->setCellValue('D' . $row, $activities[$i]->unit);
                        $sheetT->setCellValue('E' . $row, $activities[$i]->real);
                        $sheetT->setCellValue('F' . $row, '');
                        $sheetT->setCellValue('G' . $row, $activities[$i]->note);
                        $sheetT->getStyle('A' . $row . ':G' . $row)->applyFromArray($thinborderall);
                        $num++;
                        $row++;
                    }
                }

                $row = $row + 2;
                $sheetT->getStyle('B' . $row . ':G' . ($row + 6))
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                    ->setWrapText(true);
                $sheetT->mergeCells('B' . $row . ':C' . $row);
                $sheetT->mergeCells('F' . $row . ':G' . $row);
                $sheetT->setCellValue('B' . $row, 'Pegawai yang Dinilai');
                $sheetT->setCellValue('F' . $row, 'Pejabat Penilai');
                $row++;
                for ($i = 0; $i < 4; $i++) {
                    $sheetT->mergeCells('B' . $row . ':C' . $row);
                    $sheetT->mergeCells('F' . $row . ':G' . $row);
                    $row++;
                }

                $sheetT->mergeCells('B' . $row . ':C' . $row);
                $sheetT->mergeCells('F' . $row . ':G' . $row);
                $sheetT->setCellValue('B' . $row, $user->name);
                $sheetT->setCellValue('F' . $row, $assessor->name);
                $row++;
                $sheetT->mergeCells('B' . $row . ':C' . $row);
                $sheetT->mergeCells('F' . $row . ':G' . $row);
                $sheetT->setCellValue('B' . $row, $user->nip);
                $sheetT->setCellValue('F' . $row, $assessor->nip);
                $sheetT->getStyle('B' . $row . ':C' . $row)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                    ->setWrapText(true);

                $sheetR = $spreadsheet->createSheet();
                $sheetR = $spreadsheet->setActiveSheetIndex(1);
                $sheetR->setTitle('CKP-R');

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

                $sheetR->getStyle('A2')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheetR->getStyle('A2')->getFont()->setSize(14)->setBold(true);

                $sheetR->setCellValue('A2', 'Capaian Kinerja Pegawai (CKP) Tahun ' . $year->name);
                $sheetR->mergeCells('A2:J2');
                $sheetR->setCellValue('J1', 'CKP-R');
                $sheetR->getStyle('J1')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheetR->getStyle('J1')->getFont()->setBold(true);
                $sheetR->getStyle('J1')
                    ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $sheetR->getStyle('J1')
                    ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $sheetR->getStyle('J1')
                    ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $sheetR->getStyle('J1')
                    ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

                $sheetR->getColumnDimension('A')->setWidth(5);
                $sheetR->getColumnDimension('B')->setWidth(22);
                $sheetR->getColumnDimension('C')->setWidth(65);
                $sheetR->getColumnDimension('D')->setWidth(15);
                $sheetR->getColumnDimension('E')->setWidth(15);
                $sheetR->getColumnDimension('F')->setWidth(15);
                $sheetR->getColumnDimension('G')->setWidth(15);
                $sheetR->getColumnDimension('H')->setWidth(15);
                $sheetR->getColumnDimension('I')->setWidth(15);
                $sheetR->getColumnDimension('J')->setWidth(20);

                $sheetR->setCellValue('B4', 'Satuan Organisasi');
                $sheetR->setCellValue('B5', 'Nama');
                $sheetR->setCellValue('B6', 'Jabatan');
                $sheetR->setCellValue('B7', 'Periode');

                $sheetR->setCellValue('A9', 'No.');
                $sheetR->mergeCells('A9:A10');
                $sheetR->setCellValue('B9', 'Uraian Kegiatan');
                $sheetR->mergeCells('B9:C10');
                $sheetR->setCellValue('D9', 'Satuan');
                $sheetR->mergeCells('D9:D10');
                $sheetR->setCellValue('E9', 'Kuantitas');
                $sheetR->mergeCells('E9:G9');
                $sheetR->setCellValue('E10', 'Target');
                $sheetR->setCellValue('F10', 'Realisasi');
                $sheetR->setCellValue('G10', 'Persentase');
                $sheetR->setCellValue('H9', 'Tingkat Kualitas');
                $sheetR->mergeCells('H9:H10');
                $sheetR->setCellValue('I9', 'Capaian Angka Kredit');
                $sheetR->mergeCells('I9:I10');
                $sheetR->setCellValue('J9', 'Keterangan');
                $sheetR->mergeCells('J9:J10');
                $sheetR->getStyle('A9:J10')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                    ->setWrapText(true);
                $sheetR->getStyle('A9:J10')->getFont()->setBold(true);
                $sheetR->getStyle('A9:J10')->applyFromArray($thinborderall);

                $sheetR->setCellValue('A11', '(1)');
                $sheetR->setCellValue('B11', '(2)');
                $sheetR->mergeCells('B11:C11');
                $sheetR->setCellValue('D11', '(3)');
                $sheetR->setCellValue('E11', '(4)');
                $sheetR->setCellValue('F11', '(5)');
                $sheetR->setCellValue('G11', '(6)');
                $sheetR->setCellValue('H11', '(7)');
                $sheetR->setCellValue('I11', '(8)');
                $sheetR->setCellValue('J11', '(9)');
                $sheetR->getStyle('A11:J11')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                    ->setWrapText(true);
                $sheetR->getStyle('A11:J11')->getFont()->setSize(8);
                $sheetR->getStyle('A11:J11')->applyFromArray($thinborderall);

                $sheetR->setCellValue('C4', ': ' . Auth::user()->department->name);
                $sheetR->setCellValue('C5', ': ' . Auth::user()->name);
                $sheetR->setCellValue('C6', ': ' . Auth::user()->department->name);
                $sheetR->setCellValue('C7', ': ' . $month->name . ' ' . $year->name);

                $sheetR->mergeCells('B12:J12');
                $sheetR->setCellValue('B12', 'UTAMA');
                $sheetR->getStyle('A12:J12')->getFont()->setBold(true);
                $sheetR->getStyle('A12:J12')->applyFromArray($thinborderall);

                //Kegiatan Utama
                $num = 1;
                $row = 13;
                for ($i = 0; $i < count($activities); $i++) {
                    if ($activities[$i]->type == 'main') {
                        $sheetR->setCellValue('A' . $row, $num);
                        $sheetR->setCellValue('B' . $row, $activities[$i]->name);
                        $sheetR->mergeCells('B' . $row . ':C' . $row);
                        $sheetR->setCellValue('D' . $row, $activities[$i]->unit);
                        $sheetR->setCellValue('E' . $row, $activities[$i]->target);
                        $sheetR->setCellValue('F' . $row, $activities[$i]->real);
                        $sheetR->setCellValue('G' . $row, $activities[$i]->real / $activities[$i]->target * 100);
                        if ($ckp->status->id == '5') {
                            $sheetR->setCellValue('H' . $row, $activities[$i]->quality);
                        } else {
                            $sheetR->setCellValue('H' . $row, '');
                        }
                        $sheetR->setCellValue('I' . $row, '');
                        $sheetR->setCellValue('J' . $row, $activities[$i]->note);
                        $sheetR->getStyle('A' . $row . ':J' . $row)->applyFromArray($thinborderall);
                        $num++;
                        $row++;
                    }
                }


                $sheetR->mergeCells('B' . $row . ':J' . $row);
                $sheetR->setCellValue('B' . $row, 'TAMBAHAN');
                $sheetR->getStyle('A' . $row . ':J' . $row)->getFont()->setBold(true);
                $sheetR->getStyle('A' . $row . ':J' . $row)->applyFromArray($thinborderall);
                $row++;

                $num = 1;
                for ($i = 0; $i < count($activities); $i++) {
                    if ($activities[$i]->type == 'additional') {
                        $sheetR->setCellValue('A' . $row, $num);
                        $sheetR->setCellValue('B' . $row, $activities[$i]->name);
                        $sheetR->mergeCells('B' . $row . ':C' . $row);
                        $sheetR->setCellValue('D' . $row, $activities[$i]->unit);
                        $sheetR->setCellValue('E' . $row, $activities[$i]->target);
                        $sheetR->setCellValue('F' . $row, $activities[$i]->real);
                        $sheetR->setCellValue('G' . $row, $activities[$i]->real / $activities[$i]->target * 100);
                        if ($ckp->status->id == '5') {
                            $sheetR->setCellValue('H' . $row, $activities[$i]->quality);
                        } else {
                            $sheetR->setCellValue('H' . $row, '');
                        }
                        $sheetR->setCellValue('I' . $row, '');
                        $sheetR->setCellValue('J' . $row, $activities[$i]->note);
                        $sheetR->getStyle('A' . $row . ':J' . $row)->applyFromArray($thinborderall);
                        $num++;
                        $row++;
                    }
                }

                $row = $row + 2;
                $sheetR->getStyle('B' . $row . ':I' . ($row + 6))
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                    ->setWrapText(true);
                $sheetR->mergeCells('B' . $row . ':C' . $row);
                $sheetR->mergeCells('H' . $row . ':I' . $row);
                $sheetR->setCellValue('B' . $row, 'Pegawai yang Dinilai');
                $sheetR->setCellValue('H' . $row, 'Pejabat Penilai');
                $row++;
                for ($i = 0; $i < 4; $i++) {
                    $sheetR->mergeCells('B' . $row . ':C' . $row);
                    $sheetR->mergeCells('H' . $row . ':I' . $row);
                    $row++;
                }

                $sheetR->mergeCells('B' . $row . ':C' . $row);
                $sheetR->mergeCells('H' . $row . ':I' . $row);
                $sheetR->setCellValue('B' . $row, $user->name);
                $sheetR->setCellValue('H' . $row, $assessor->name);
                $row++;
                $sheetR->mergeCells('B' . $row . ':C' . $row);
                $sheetR->mergeCells('H' . $row . ':I' . $row);
                $sheetR->setCellValue('B' . $row, $user->nip);
                $sheetR->setCellValue('H' . $row, $assessor->nip);

                $sheetR->getStyle('B' . $row . ':C' . $row)
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                    ->setWrapText(true);

                // $writer = new Xlsx($spreadsheet);
                // $writer->save('hello world.xlsx');

                // redirect output to client browser
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="CKP ' . $user->name . ' ' . $ckp->month->name . ' ' . $ckp->year->name . ' .xls"');
                header('Cache-Control: max-age=0');

                $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
                $writer->save('php://output');

                return redirect('/download')->with('success-download', 'CKP telah didownload');
            }
        }

        return redirect('/download')->with('error-download', 'Tidak ada Kegiatan di CKP ' . $month->name . ' ' . $year->name);
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
        $currentyear = Year::firstWhere('name', date("Y"));

        if ($currentyear == null) {
            $currentyear = Year::all()->last();
        }

        return view('download.index', compact(['months', 'years', 'currentyear']));
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
