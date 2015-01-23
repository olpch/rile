<?php

require('fpdf.php');

class PDF_EAN13 extends FPDF {

	function EAN13($x, $y, $barcode, $h=16, $w=.35,$name = 'Producto sin nombre', $cost = '$ 0.00'){
		$this->Barcode($x,$y,$barcode,$h,$w,13, $name, $cost);
	}

	function UPC_A($x, $y, $barcode, $h=16, $w=.35){
		$this->Barcode($x,$y,$barcode,$h,$w,12, $name = 'Sucursal Cartagena omar lee paba ching el mas la verga en programacion', $cost = 'Bolsos & Accesorios');
	}

	function GetCheckDigit($barcode){
		//Compute the check digit
		$sum=0;
		for($i=1;$i<=11;$i+=2) $sum+=3*$barcode[$i];

		for($i=0;$i<=10;$i+=2) $sum+=$barcode[$i];

		$r=$sum%10;

		if($r>0) $r=10-$r;

		return $r;
	}

	function TestCheckDigit($barcode){
		//Test validity of check digit
		$sum=0;
		for($i=1;$i<=11;$i+=2)
			$sum+=3*$barcode[$i];
		for($i=0;$i<=10;$i+=2)
			$sum+=$barcode[$i];
		return ($sum+$barcode[12])%10==0;
	}

	function Barcode($ox, $oy, $barcode, $h, $w, $len, $name, $cost){
		$x = $ox + 4;
		$y = $oy + 10;
		//Padding
		$barcode=str_pad($barcode,$len-1,'0',STR_PAD_LEFT);
		if($len==12)
			$barcode='0'.$barcode;
		//Add or control the check digit
		if(strlen($barcode)==12)
			$barcode.=$this->GetCheckDigit($barcode);
		elseif(!$this->TestCheckDigit($barcode))
			$this->Error('Incorrect check digit');
		//Convert digits to bars
		$codes=array(
			'A'=>array(
				'0'=>'0001101','1'=>'0011001','2'=>'0010011','3'=>'0111101','4'=>'0100011',
				'5'=>'0110001','6'=>'0101111','7'=>'0111011','8'=>'0110111','9'=>'0001011'),
			'B'=>array(
				'0'=>'0100111','1'=>'0110011','2'=>'0011011','3'=>'0100001','4'=>'0011101',
				'5'=>'0111001','6'=>'0000101','7'=>'0010001','8'=>'0001001','9'=>'0010111'),
			'C'=>array(
				'0'=>'1110010','1'=>'1100110','2'=>'1101100','3'=>'1000010','4'=>'1011100',
				'5'=>'1001110','6'=>'1010000','7'=>'1000100','8'=>'1001000','9'=>'1110100')
			);
		$parities=array(
			'0'=>array('A','A','A','A','A','A'),
			'1'=>array('A','A','B','A','B','B'),
			'2'=>array('A','A','B','B','A','B'),
			'3'=>array('A','A','B','B','B','A'),
			'4'=>array('A','B','A','A','B','B'),
			'5'=>array('A','B','B','A','A','B'),
			'6'=>array('A','B','B','B','A','A'),
			'7'=>array('A','B','A','B','A','B'),
			'8'=>array('A','B','A','B','B','A'),
			'9'=>array('A','B','B','A','B','A')
			);
		$code='101';
		$p=$parities[$barcode[0]];
		for($i=1;$i<=6;$i++)
			$code.=$codes[$p[$i-1]][$barcode[$i]];
		$code.='01010';
		for($i=7;$i<=12;$i++)
			$code.=$codes['C'][$barcode[$i]];
		$code.='101';

		//Draw bars
		$this->SetFillColor(0,0,0);
		for($i=0;$i<strlen($code);$i++)
		{
			if($code[$i]=='1')
				$this->Rect($x+$i*$w,$y,$w,$h,'F');
		}
		
		//Print text uder barcode
		$this->Image('http://localhost/okieoky/assets/img/pdflogo.jpg', $ox+33, $oy+1, 6, 6);
		$this->SetFont('Arial','B', 9);
		$this->Text($ox+2, $oy+4, $this->setname('Omar lee paba ching', 28));
		$this->SetFont('Arial','', 6);
		$this->Text($ox+2, $oy+7, $this->setname($cost, 28));
		$this->Text($ox+2, $oy+9, $this->setname($name));
		
		$this->Rect($ox, $oy, 40, 28, $h,'F');
		$this->SetFillColor(255,255,255);
		//texto del codigo del barras
		$this->SetXY($x-2.3, $y+$h-7/$this->k);
		$this->cell(1.3, 2.8, $barcode[0], 0, 1, 'C', true);
		$this->SetXY($x+1.5, $y+$h-7/$this->k);
		$this->cell(14.3, 2.8, substr($barcode,1,6), 0, 1, 'C', true);
		$this->SetXY($x+17.4, $y+$h-7/$this->k);
		$this->cell(14.3, 2.8, substr($barcode,7), 0, 1, 'C', true);

	}

	function setname($name, $max = 35){
		$res = $name;
		$tam = strlen($res);
		$tsize = $this->GetStringWidth($name);
		$i = $tam;
		while ($tsize > $max) {
			$res = substr($res, 0, $i--);
			$tsize = $this->GetStringWidth($res);
		}
		$res = ($i < $tam) ? $res.'...' : $res; 
		return $res;		
	}
	
}
?>