<?php
class CsvParser


{
	public function parse($csv)
	{
		if (($handle = fopen($csv, "r")) !== FALSE) {
		    while (($data = fgetcsv($handle, 0, ';', '"')) !== FALSE) {
		        $num = count($data);
		        echo "<p> $num fields in line $row: <br /></p>\n";

		        $transaction = new Transaction();
		        $transaction->setReferte($data[0])
		        			->setUitvoeringsdatum($data[0])
		        			->setValutadatum($data[0])
		        			->setBedrag($data[6])
		        			->setMunt('EUR')
		        			->setTegenpartij($data[3])
		        			->setDetail($data[8])
		        			->setRekening($data[2]);

		        $transactions[] = $transaction;
		        unset($transaction);
		    }
		    array_shift($transactions); // We don't need the first row, as it contains the column headers
		    fclose($handle);

		    return $transactions;
		} else {
			return false;
		}
	}
}
