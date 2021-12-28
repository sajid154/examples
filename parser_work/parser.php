<?php


$val = getopt(null, ['file:', 'unique_combination:']);

// echo $val['unique_combination'];

$fp = fopen('./results/'.$val['unique_combination'], 'w');

$data = file('./'.$val['file']);
$myHeader = $data[0];
$header = str_getcsv($myHeader);
array_push($header, 'count');

unset($data[0]);

$data2 = array_unique($data);

fputcsv($fp, $header, ",", " ");
// // $results = [];
// // $results[] = $header;


// // var_dump($results);

foreach ($data2 as $record) {

	$count=0;
	
	$the_record = str_getcsv($record);


		foreach($data as $repeatRecord){

			if(!array_diff($the_record, str_getcsv($repeatRecord))){
				$count++;
			}

		}	

	array_push($the_record, $count);

	// // $results[] = $the_record;

	fputcsv($fp, $the_record, ",", " ");

	var_dump($the_record);

	
}


fclose($fp);
// var_dump($results);

// if (array_diff(explode(',', $data[1]), explode(',', $data[2]))) {
// 	echo "it works";
// }

?>