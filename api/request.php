<?php

// Get the folder lists
function getFolderList() {
	$auth_token = "9weMfq3Dv9AAAAAAAAAAJw89UgSFuy94SbT75zEe-Cjhi9bzmK5yH2D-IWLMUq99";

	$ch = curl_init();

	$fields = array(
		"path"=> "/Users_folder",
		"recursive"=> false,
		"include_media_info"=> false,
		"include_deleted"=> false,
		"include_has_explicit_shared_members"=> false,
		"include_mounted_folders"=> true
	);

	$curl_fields = http_build_query($fields);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $auth_token, 'Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_URL, 'https://api.dropboxapi.com/2/files/list_folder');
	curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($fields));

	try{
	$result = curl_exec($ch);
	} catch (Exception $e) {
	echo 'Exception : ', $e->getMessage(), "\n";
	}
	var_dump($result);

	curl_close($ch);
}

// Get the folder link
function getFolderLink($folder_name) {
	$auth_token = "9weMfq3Dv9AAAAAAAAAAJw89UgSFuy94SbT75zEe-Cjhi9bzmK5yH2D-IWLMUq99";

	$ch = curl_init();

	$fields = array(
		"path"=> "/Users_folder/".$folder_name,
		"direct_only" => true
	);

	$curl_fields = http_build_query($fields);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $auth_token, 'Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_URL, 'https://api.dropboxapi.com/2/sharing/list_shared_links');
	curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($fields));

	try{
	$result = curl_exec($ch);
	} catch (Exception $e) {
	echo 'Exception : ', $e->getMessage(), "\n";
	}

	$get_url = json_decode($result);

	echo '<br>';

	$responsing = $get_url->links[0]->url;

	return $responsing;

	var_dump($responsing);

	curl_close($ch);
}

// Make folder 
function makeFolder($user_name_folder) {
	// var_dump($user_name_folder);
	$auth_token = "9weMfq3Dv9AAAAAAAAAAJw89UgSFuy94SbT75zEe-Cjhi9bzmK5yH2D-IWLMUq99";

	$ch = curl_init();

	$fields = array(
		"path"=> "/Users_folder/".$user_name_folder,
		"autorename" => false
	);

	$curl_fields = http_build_query($fields);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $auth_token, 'Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_URL, 'https://api.dropboxapi.com/2/files/create_folder_v2');
	curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($fields));

	try{
	$result = curl_exec($ch);
	if($result){
		// var_dump(json_decode($result));
		$result_obj=json_decode($result);
		// var_dump($result_obj->metadata->path_display);
		$folder_path = $result_obj->metadata->path_display;

		makeFolderShareLink($folder_path);
	}

	} catch (Exception $e) {
	echo 'Exception : ', $e->getMessage(), "\n";
	}

	curl_close($ch);
}

// Make Shareable Link
function makeFolderShareLink($folder_path) {

	$auth_token = "9weMfq3Dv9AAAAAAAAAAJw89UgSFuy94SbT75zEe-Cjhi9bzmK5yH2D-IWLMUq99";

	$ch = curl_init();

	$fields = array(
		"path" => $folder_path,
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

	// var_dump($result);

	} catch (Exception $e) {
	echo 'Exception : ', $e->getMessage(), "\n";
	}

	curl_close($ch);
}