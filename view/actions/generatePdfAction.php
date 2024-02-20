<?php
session_start();
require_once "../tcpdf/tcpdf/tcpdf.php";

class PDFGenerator
{
    private $pdf;
    private $jsonData, $userDetailsIndex, $totalAmountIndex;

    public function __construct($jsonData)
    {
        $this->jsonData = $jsonData;
        $this->pdf = new TCPDF();
        $this->totalAmountIndex = count($jsonData) - 1;
        $this->userDetailsIndex = count($jsonData) - 2;
    }

    private function displayTable($header, $data, $title)
    {
        $this->pdf->SetFont('times', 'B', 12);
        $this->pdf->Write(10, $title);
        $this->pdf->Ln();

        foreach ($header as $col) {
            $this->pdf->Cell(45, 10, $col, 1);
        }
        $this->pdf->Ln();

        foreach ($data as $row) {
            foreach ($row as $col) {
                $colAsString = is_array($col) ? implode(', ', $col) : $col;
                $this->pdf->Cell(45, 10, $colAsString, 1);
            }
            $this->pdf->Ln();
        }

        $this->pdf->Ln(10);
    }

    public function generatePDF()
    {
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('Your Name');
        $this->pdf->SetTitle('Generated PDF');
        $this->pdf->SetSubject('Generated PDF');
        $this->pdf->SetKeywords('PDF, TCPDF, example, test, guide');

        $this->pdf->AddPage();
        $this->pdf->SetFont('times', 'N', 12);

        // Display product details if available
        if (!empty($this->jsonData) && isset($this->jsonData[0]['product_details'])) {
            $header = ['Product Name', 'Product Model', 'Product Price', 'Product Quantity'];
            $data = [];

            foreach ($this->jsonData as $item) {
                if (isset($item['product_details'])) {
                    $productDetails = $item['product_details'];
                    $data[] = [
                        $productDetails['product_name'],
                        $productDetails['product_model'],
                        $productDetails['product_price'] . ' TK',
                        $productDetails['product_quantity'],
                    ];
                }
            }

            $this->displayTable($header, $data, 'Product Details');
        }

        // Display user details if available
// Display user details if available
        if (!empty($this->jsonData) && isset($this->jsonData[$this->userDetailsIndex]['user_details'])) {
            $userHeader = ['Name', 'Email', 'Mobile', 'Payment ID', 'Address'];
            $userDetails = json_decode($this->jsonData[$this->userDetailsIndex]['user_details'], true);

            // Check if user details are valid
            if ($userDetails) {
                $userData = [
                    $userDetails['user_name'],
                    $userDetails['user_email'],
                    $userDetails['user_mobile'],
                    $userDetails['user_payment_id'],
                    $userDetails['user_address'],
                ];

                $this->displayTable($userHeader, [$userData], 'User Details');
            }
        }


        // Display total amount if available
        if (!empty($this->jsonData) && isset($this->jsonData[$this->totalAmountIndex]['total_amount'])) {
            $this->pdf->Ln();
            $this->pdf->SetFont('times', 'B', 12);
            $this->pdf->Write(10, 'Total Amount');
            $this->pdf->Ln();
            $this->pdf->SetFont('times', 'N', 12);
            $this->pdf->Cell(0, 10, 'Total: ' . $this->jsonData[$this->totalAmountIndex]['total_amount'] . ' TK', 0, 1);
        }

        return $this->pdf->Output('', 'S');
    }
}

// Check if JSON data is available in the query parameter
if (isset($_GET['jsonData'])) {
    // Decode JSON data from the query parameter
    $jsonData = json_decode(urldecode($_GET['jsonData']), true);

    $pdfGenerator = new PDFGenerator($jsonData);

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="Make_A_Try.pdf"');
    echo $pdfGenerator->generatePDF();

    // Terminate script
} else {
    echo "JSON data not found.";
}
?>