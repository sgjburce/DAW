<?php

session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($connection);
$id_profesor = (int)$user_data['id_profesor'];

require __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$query = "SELECT e.id_elev, e.nume AS elev, GROUP_CONCAT(n.valoare ORDER BY n.data SEPARATOR ', ') AS note
    FROM ELEV e
    LEFT JOIN NOTA n
        ON n.id_elev = e.id_elev
       AND n.id_profesor = $id_profesor
    GROUP BY e.id_elev, e.nume
    ORDER BY e.nume
";

$result = mysqli_query($connection, $query);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Raport Note Elevi');

$sheet->setCellValue('A1', 'Elev');
$sheet->setCellValue('B1', 'Note');

$rowNumber = 2;
while ($row = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('A' . $rowNumber, $row['elev']);
    $sheet->setCellValue('B' . $rowNumber, $row['note']);
    $rowNumber++;
}

$filename = 'raport_note_elevi.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');