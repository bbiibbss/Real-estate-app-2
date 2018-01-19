<?php

	require_once'../vendor/autoload.php';
	include'../vendor/simplehtmldom/simple_html_dom.php';


Class FileCSVPDF{
	private $pdf;

	public function createCSVFile($content, $fileName){
		$html = str_get_html(utf8_decode($content));
		$name = $fileName . date('d-m-Y') . ".csv";

		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$name);

		$fp = fopen("php://output", "w");
		fwrite($fp, "sep=\t" . "\r\n");

		foreach($html->find('tr') as $element) {
		  $td = array();
		  foreach( $element->find('th') as $row) {
		    if (strpos(trim($row->class), 'actions') === false && strpos(trim($row->class), 'checker') === false) {
		      $td [] = $row->plaintext;
		    }
		  }
		  if (!empty($td)) {
		    fputcsv($fp, $td, "\t");
		  }

		  $td = array();
		  foreach( $element->find('td') as $row) {
		    if (strpos(trim($row->class), 'actions') === false && strpos(trim($row->class), 'checker') === false) {
		      $td [] = $row->plaintext;
		    }
		  }
		  if (!empty($td)) {
		    fputcsv($fp, $td, "\t");
		  }
		}

		fclose($fp);
		exit;
	}

	public function createPDFFile($content, $title, $fileName){
		$pdf = new \Mpdf\Mpdf();
		$stylesheet = file_get_contents('../css/pdfStylesheet.css');
		$pdf->WriteHTML($stylesheet,1);
		$html_header=('<table><tr><td style="width:40%;"><h3><span style="background-color: #000; color: #fff;"><b>AZ</b></span> <span>REAL ESTATE</span></h3></td><td></td><td style="width:40%; text-align:right;"><b>AZ</b> REAL ESTATE<br>Rua da Tecnologia, Epsilon 1k,<br>Tecnoparque da Lagoa, Lagoa, Açores<br>+135 565 567 756<br>info@azrealestate.com</td></tr></table><hr>');
		$pdf->setAutoTopMargin='stretch';
		$pdf->setHTMLHeader($html_header);
		$pdf->SetFooter('Pág. {PAGENO}');
		$pdf->WriteHTML('<h2>'.$title.'</h2><br>');
		$pdf->WriteHTML($content);
		$filename = $fileName.date('d-m-Y').".pdf";
		$content = $pdf->Output($filename,'D');
		return true;
	}
}
?>