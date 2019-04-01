<?php

	// $auth_token = "9weMfq3Dv9AAAAAAAAAAJw89UgSFuy94SbT75zEe-Cjhi9bzmK5yH2D-IWLMUq99";
	// $folder_name = "cccc";

	// $ch = curl_init();

	// $fields = array(
	// 	"path"=> "/Users_folder/".$folder_name,
	// 	"direct_only" => true
	// );

	// $curl_fields = http_build_query($fields);

	// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $auth_token, 'Content-Type: application/json'));
	// curl_setopt($ch, CURLOPT_URL, 'https://api.dropboxapi.com/2/sharing/list_shared_links');
	// curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($fields));

	// try{
	// $result = curl_exec($ch);
	// } catch (Exception $e) {
	// echo 'Exception : ', $e->getMessage(), "\n";
	// }

	// $get_url = json_decode($result);

	// echo '<br>';

	// $responsing = $get_url->links[0]->url;

	// // return $responsing;

	// var_dump($responsing);

	// curl_close($ch);



	$user_folder_name = "abc";

	$auth_token = "9weMfq3Dv9AAAAAAAAAAJw89UgSFuy94SbT75zEe-Cjhi9bzmK5yH2D-IWLMUq99";

	$ch = curl_init();

	$fields = array(
		"path" => "/Users_folder/".$user_folder_name,
		"short_url" => false
	);

	$curl_fields = http_build_query($fields);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $auth_token, 'Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_URL, 'https://api.dropboxapi.com/2/sharing/create_shared_link');
	curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($fields));

	try{
	$result = curl_exec($ch);

	var_dump($result);

	} catch (Exception $e) {
	echo 'Exception : ', $e->getMessage(), "\n";
	}

	curl_close($ch);