<?php
$data = [
    [

        'fullname' => 'Nome',
        'cpf' => 'CPF',
        'email' => 'Email',
        'celular' => 'Telefone',
        'created_at' => 'Data de cadastro'
    ],
    [

        'fullname' => 'Luis',
        'cpf' => 19111450703,
        'email' => 'luisfelipebsj@gmail.com',
        'celula' => '21965762671',
        'created_at' => '2021-09-01 00:00:00'
    ]
];
function make_pdf($data)
{
    if (empty($data)) {
        echo '<script>jsToastMessage("Não é possível gerar um pdf de uma lista vazia.","error")</script>';
    } else {
        try {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/jogodobicho/functions/fpdf186/fpdf.php';
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            foreach ($data as $row) {
                foreach ($row as $key => $value) {
                    $pdf->Cell(w: 0, txt: $key);
                }
                $pdf->Ln();
            }
            $pdf->Cell(w: 0, txt: 'puff diddy in jail');

            $pdf->Output(dest: 'I', name: 'Lista de usuários', isUTF8: true);

        } catch (\Throwable $e) {
            '<script>jsToastMessage("Erro ao gerar o pdf","error")</script>';
            echo $e->getMessage();
        }
    }
}

if (isset($_GET['gerar-pdf'])) {
    make_pdf($data);
}