<?php

use Connection\ConnectionMariaDB;
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/fpdf/fpdf.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/connection/config.php';


class PDF extends fpdf
{
    // Simple table
    function BasicTable($header, $data)
    {
        $this->SetMargins(1.5, 3, 1.5);
        // Header
        foreach ($header as $col)
            $this->Cell(40, 8, $col, 1);
        $this->Ln();
        // Data
        foreach ($data as $row) {
            foreach ($row as $col)
                $this->Cell(40, 6, $col, 1);
            $this->Ln();
        }
    }
    // Better table
    function ImprovedTable($header, $data)
    {
        // Column widths
        $w = array(65, 25, 50, 30, 35);
        // Header
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        $this->Ln();
        // Data
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR');
            $this->Cell($w[1], 6, $row[1], 'LR');
            $this->Cell($w[2], 6, $row[2], 'LR', 0, 'R');
            $this->Cell($w[3], 6, $row[3], 'LR', 0, 'R');
            $this->Cell($w[4], 6, $row[4], 'LR', 0, 'R');

            $this->Ln();
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    // Colored table
    function FancyTable($header, $data)
    {
        $this->SetMargins(1.5, 3, 1.5);
        $this->Ln();
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(65, 25, 50, 30, 35);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row[2], 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, $row[3], 'LR', 0, 'R', $fill);
            $this->Cell($w[4], 6, $row[4], 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['gerar-pdf'])) {
    $conn = (new ConnectionMariaDB())->connect();
    $query = $_GET['gerar-pdf'];
    if ($query == 'all') {
        $sql = 'SELECT fullname, cpf, email, celular, created_at FROM users';
        $result = $conn->execute_query(query: $sql);
    } else {
        $sql = 'SELECT fullname, cpf, email, celular, created_at FROM users WHERE fullname LIKE ?';
        $result = $conn->execute_query(query: $sql, params: [$query]);
    }



    if ($result->num_rows <= 0) {
        http_response_code(404);
        header(header: 'Location: /pages/private/consulta_usuarios.php?error=emptylist');
        die();
    }
    // Column headings
    $header = array('Nome', 'CPF', 'Email', 'Celular', 'Data de Criacao');
    // Data loading
    $data = $result->fetch_all();

    $pdf = new PDF();
    $pdf->SetFont('Arial', '', 10);
    // $pdf->AddPage();
    // $pdf->BasicTable($header, $data);
    // $pdf->AddPage();
    // $pdf->ImprovedTable($header, $data);
    $pdf->AddPage();
    $pdf->FancyTable($header, $data);
    try {
        //code...
        $pdf->Output(dest: "D", name: 'Lista de usuarios.pdf');
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }
}

?>