<?php
        
	$wsdl = "http://www.restfulwebservices.net/wcf/StockQuoteService.svc?wsdl";
        $client = new SoapClient($wsdl);
        $values = $client->GetStockQuote(array("request"=>"teo"));
        $xml = $values->GetStockQuoteResult;
	
	print "Company: <b> $xml->Name </b><br>"; 
	print 'Last update: ' . date('Y-m-d', strtotime($xml->Date)) .'&nbsp;'. $xml->Time .  '<br>';
        print "Value: $xml->Last <br>";
	print "Percentage Change: $xml->PercentageChange";

?>
