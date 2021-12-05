<?php 

	//action.php
	
	if(isset($_POST["action"]))
	{
	 if($_POST["action"] == 'insert')
	 {
	  $form_data = array(
	   'first_name' => $_POST['first_name'],
	   'last_name'  => $_POST['last_name']
	  );
	  $api_url = "http://localhost/Rest_API_CRUD/api/test_api.php?action=insert";
	  $client = curl_init($api_url);  //This function will initialize curl session
	  curl_setopt($client, CURLOPT_POST, true);
	  curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
	  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
	  $response = curl_exec($client);
	  curl_close($client);
	  $result = json_decode($response, true);
	  foreach($result as $keys => $values)
	  {
	   if($result[$keys]['success'] == '1')
	   {
	    echo 'insert';
	   }
	   else
	   {
	    echo 'error';
	   }
	  }
	 }

	 
	}
?>