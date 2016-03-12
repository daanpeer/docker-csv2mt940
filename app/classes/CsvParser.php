<?php
class CsvParser

# "Datum","Naam / Omschrijving","Rekening","Tegenrekening","Code","Af Bij","Bedrag (EUR)","MutatieSoort","Mededelingen"
# "YYYYMMDD", Naam,"NL87INGB0006473786","NL85INGB0654416265"
# "20160308","Transip B.V.","NL87INGB0006473786","NL85INGB0654416265","IC","Af","10,88","Incasso","Europese Incasso, doorlopend IBAN: NL85INGB0654416265 BIC: INGBNL2A Naam: Transip B.V. ID begunstigde: NL39ZZZ243458990000 SEPA ID machtiging: MANDATE-NL-21572-1 Kenmerk: E2E-ID-NL-200402179 Omschrijving: FACTUUR F0000.2016.0013.9964"

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
