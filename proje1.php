<?php


	$dosya = "D:/wamp64/www/proje/input/input.txt";
	$metin = fopen($dosya,"r");
	$row = 1;	

	$xml = new DomDocument('1.0', 'UTF-8');
	$xml->formatOutput   = true; 

	$order = $xml->createElement('order');
	$order = $xml->appendChild($order);

	$container = $xml->createElement('row');

	$header = $xml->createElement('header');
	$order->appendChild($header);


	while (!feof($metin))
	{
		$satirlar = fgets($metin);
		$data = explode(';', $satirlar);
        $num = count($data);
        
        if($row == 1)
        {
        	$headertitle = $data;
        }

        if($row ==2)
        {
        	
        	for ($c=0; $c < $num; $c++) 
        	{
        		$a = $headertitle[$c];
        		$a = preg_replace('/[^A-Za-z0-9]/u', "", $a);
				$child = $xml->createElement($a, $data[$c]);
        	    $header->appendChild($child);	
    		}
        }
       
        $row++;	
	}


	$lines = $xml->createElement('lines');
	$order->appendChild($lines);
	

	$dosya = "D:/wamp64/www/proje/input/input.txt";
	$metin = fopen($dosya,"r");

	$row = 1;	

	while (!feof($metin))
	{
		$satirlar = fgets($metin);
		$data = explode(';', $satirlar);
        $num = count($data);

	$line = $xml->createElement('line');

        if($row == 3)
        {
        	$detailtitle = $data;
        }

        if($row > 3)
        {
	    	for ($c=0; $c < $num; $c++) 
	    	{
	    		if($data[1] == null)
	    		{
	    			unset($data);
	    		}
	    		else
	    		{
	    			$b = $detailtitle[$c];
        			$b = preg_replace('/[^A-Za-z0-9]/u', "", $b);
					$child = $xml->createElement($b, $data[$c]);
        	    	$line->appendChild($child);
	    			echo $detailtitle[$c]."<br/>";	    			    			
	    		}
	    	}
	    	
	    	$lines->appendChild($line);
    	}   

        $row++;					
	}

	$xml->save('output/output.xml');

	fclose($metin);  

	
