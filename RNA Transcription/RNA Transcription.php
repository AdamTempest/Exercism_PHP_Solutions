<?php

function toRna(string $dna): string
{
	$len = strlen($dna);
	$rna = "";
	for ($i=0;$i<$len;$i++){
		switch ($dna[$i]){
			case "G":
				$rna .= "C";
				break;
			case "C":
				$rna .= "G";
				break;
			case "T":
				$rna .= "A";
				break;
			case "A":
				$rna .= "U";
				break;
			default:
				break;
		}
	}
	return $rna;
}

echo "C: ",toRna("C"), "\n";
echo "G: ",toRna("G"), "\n";
echo "T: ",toRna("T"), "\n";
echo "A: ",toRna("A"), "\n";
echo "ACGTGGTCTTAA: ",toRna("ACGTGGTCTTAA"), "\n";

?>