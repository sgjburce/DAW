<?php

session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($connection);
$id_elev = (int)$user_data['id_elev'];

require __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$query = "SELECT d.nume AS materie, p.email AS email_profesor, n.valoare AS nota
FROM NOTA n
JOIN DISCIPLINA d ON d.id_disciplina = n.id_disciplina
JOIN PROFESOR p   ON p.id_profesor   = n.id_profesor
WHERE n.id_elev = $id_elev
ORDER BY d.nume, n.data DESC
";

$result = mysqli_query($connection, $query);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Raport Note Personal');

$sheet->setCellValue('A1', 'Materie');
$sheet->setCellValue('B1', 'Profesor');
$sheet->setCellValue('C1', 'Nota');

$rowNumber = 2;
while ($row = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('A' . $rowNumber, $row['materie']);
    $sheet->setCellValue('B' . $rowNumber, $row['email_profesor']);
    $sheet->setCellValue('C' . $rowNumber, $row['nota']);
    $rowNumber++;
}

$filename = 'raport_note.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');