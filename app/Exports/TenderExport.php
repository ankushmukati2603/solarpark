<?php
  
namespace App\Exports;
  
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
  
class TenderExport implements FromCollection, WithHeadings
{
    protected $data;
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function collection()
    {
        return collect($this->data);
    }
  
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                /** @var Sheet $sheet */
                $tahun = $this->tahun == "null" ? "" : ($this->tahun == "all"  ? "" : $this->tahun);
                $sheet = $event->sheet;

                $sheet->mergeCells("A1:E1");
                $sheet->setCellValue("A1", "Kode");
                $sheet->setCellValue("A2", "Urusan");
                $sheet->setCellValue("B2", "Bidang Urusan");
                $sheet->setCellValue("C2", "Program");
                $sheet->setCellValue("D2", "Kegiatan");
                $sheet->setCellValue("E2", "Sub Kegiatan");

                $sheet->mergeCells("F1:F2");
                $sheet->setCellValue(
                    "F1",
                    "Urusan/ Bidang Urusan Pemerintahan Daerah dan Program Kegiatan"
                );

                $sheet->mergeCells("G1:G2");
                $sheet->setCellValue(
                    "G1",
                    "Indikator Kinerja Program/ Kegiatan"
                );

                $sheet->mergeCells("H1:K1");
                $sheet->setCellValue("H1", "Rencana Tahun " . $tahun);
                $sheet->setCellValue("H2", "LOKASI");
                $sheet->setCellValue("I2", "TARGET KINERJA");
                $sheet->setCellValue("J2", "ANGGARAN");
                $sheet->setCellValue("K2", "SUMBER DANA");

                $styleArray = [
                    "borders" => [
                        "allBorders" => [
                            "borderStyle" =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            "color" => ["argb" => "000000"],
                        ],
                    ],
                ];

                $cellRange = "A1:K" . $sheet->getHighestRow(); // All headers
                $event->sheet
                    ->getDelegate()
                    ->getStyle($cellRange)
                    ->applyFromArray($styleArray);
                $event->sheet
                    ->getStyle("A1:K2")
                    ->getAlignment()
                    ->setVertical(StyleAlignment::VERTICAL_TOP)
                    ->setHorizontal(StyleAlignment::VERTICAL_CENTER)
                    ->setWrapText(true);
            },
        ];
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings() :array
    {
        return [
            'ID',
            'Name',
            'Email',
        ];
    }
}