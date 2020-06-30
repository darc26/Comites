<?php
 include('../../../data/conexion.php');
 $id = $_GET['id']; 
error_reporting(0);
require_once('../../../vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require_once  '../../../vendor/phpoffice/phpspreadsheet/src/Bootstrap.php';
$query=mysqli_query($conectar,"SELECT p.ped_clave_int, 
    usu.usu_nombre, 
    usu.usu_apellido,
	usu.usu_correo,
    p.ped_fecha, 
    pd.pde_clave_int,
    pr.pro_nombre,
    pd.pde_cantidad,
    pd.pde_precio
    FROM tbl_pedido p 
    JOIN tbl_usuarios usu ON usu.usu_clave_int = p.usu_clave_int 
    JOIN tbl_pedidodetalle pd ON pd.ped_clave_int= p.ped_clave_int
    JOIN tbl_productos pr ON pr.pro_clave_int = pd.pro_clave_int
    WHERE p.ped_clave_int = '".$id."'"); 


$spreadsheet = new Spreadsheet();
$styleArray = [
    'borders' => [
        'outline' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            'color' => ['argb' => 'FFFF0000'],
        ],
    ],
];


$spreadsheet->getDefaultStyle()->getFont()->setName('Bahnschrift Light Condensed');
$spreadsheet->getDefaultStyle()->getFont()->setSize(20);


$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Pedido N°');
$sheet->setCellValue('B1', 'Nombre');
$sheet->setCellValue('C1', 'Apellido');
$sheet->setCellValue('D1', 'Correo');
$sheet->setCellValue('E1', 'Fecha');
$sheet->setCellValue('F1', 'Producto');
$sheet->setCellValue('G1', 'Cantidad');
$sheet->setCellValue('H1', 'Precio');
$sheet->setCellValue('I1', 'Total');
$sheet->getStyle('A1:I1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF0000');

$col=2;



while($data= mysqli_fetch_array($query)){
    $sheet->setCellValue('A'.$col, $data['ped_clave_int']);
    $sheet->setCellValue('B'.$col, $data['usu_nombre']);
    $sheet->setCellValue('C'.$col, $data['usu_apellido']);
    $sheet->setCellValue('D'.$col, $data['usu_correo']);
    $sheet->setCellValue('E'.$col, $data['ped_fecha']);
    $sheet->setCellValue('F'.$col, $data['pro_nombre']);
    $sheet->setCellValue('G'.$col, $data['pde_cantidad']);
    $sheet->setCellValue('H'.$col, $data['pde_precio']);
    $sheet->setCellValue('I'.$col,'= G'.$col.'* H'.$col);
    $col++;
}
$col=$col-1;
$sheet->getStyle('A1:I'.$col)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);



//Redirigir la salida al navegador web de un cliente (Xls)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="INFORMEPRODUCTOS.xls"');
header('Cache-Control: max-age=0');
// Si está sirviendo en IE 9, entonces puede ser necesario lo siguiente
header('Cache-Control: max-age=1');

//Si está sirviendo a IE a través de SSL, entonces puede ser necesario lo siguiente
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Fecha en el pasado
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // siempre modificado
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');


        