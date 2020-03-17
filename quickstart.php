<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require __DIR__ . '/vendor/autoload.php';
	/*
	 * We need to get a Google_Client object first to handle auth and api calls, etc.
	 */
	$client = new \Google_Client();
    $client->setApplicationName('Google Sheets API PHP Quickstart');
    $client->setScopes(\Google_Service_Sheets::SPREADSHEETS);
    $client->setAuthConfig(__DIR__.'/PHP GoogleSheet-24cdb3b5905a.json');
    $client->setAccessType('offline');
    // $client->setPrompt('select_account consent');

    $service = new \Google_Service_Sheets($client);

    $spreadsheetId = "1qaPR7dsaq2t0rSCEnwbl91k6aBAs7XDjKMGpCf_NIvE";

    updateData($spreadsheetId,$service);


    function getData($spreadsheetId,$service)
    {
    	// GET DATA
	    // $range = 'A2:B1000000';
	    $range = 'congress!D2:F1000000';
		$response = $service->spreadsheets_values->get($spreadsheetId, $range);
		$values = $response->getValues();

		if(empty($values)){
			print "No Data Found.\n";
		}else{
			// print "xxxxxxx";
			// $mask = "%10s %-10s %s\n";
			foreach ($values as $row) {
				echo $row[0]."<br/>";
				// echo $mask;
				// echo sprintf($mask, $row[2], $row[1], $row[0]);
				# code...
			}
		}
    }

    function insertData($spreadsheetId,$service)
    {
    	// $range = 'congress!D2:F1000000';
	    //INSERT DATA
	    $range = 'a2:b2';
	    $values = [
	    	["Chalida","Bumrungjit"],
	    ];
	    $body = new Google_Service_Sheets_ValueRange([
	    	'values' => $values
	    ]);
	    $params = [
	    	'valueInputOption' => 'RAW'
	    ];
	    $insert = [
	    	'insertDataOption' => 'INSERT_ROWS'
	    ];
	    $result = $service->spreadsheets_values->append(
	    	$spreadsheetId,
	    	$range,
	    	$body,
	    	$params,
	    	$insert
	    );
    }

    function updateData($spreadsheetId,$service)
    {
    	$range = 'a2:b2';
    	$values = [
	    	["Pawat","Tana"],
	    ];
	    $body = new Google_Service_Sheets_ValueRange([
	    	'values' => $values
	    ]);
    	$params = [
	    	'valueInputOption' => 'RAW'
	    ];
	    $result = $service->spreadsheets_values->update(
	    	$spreadsheetId,
	    	$range,
	    	$body,
	    	$params
	    );
    }

    
    


	

