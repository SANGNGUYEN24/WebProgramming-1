<?php
require '../../vendor/autoload.php';
$client = new MongoDB\Client(
  'mongodb+srv://sangnd:A2LCgZecgEmsRd2A@nhattan.7vquo.mongodb.net/myFirstDatabase?retryWrites=true&w=majority'
);

// Connect to the "data" database
if ($data = $client->data){
  // echo "Connected";
}else{
  echo "Error: " . $data->error;
}
