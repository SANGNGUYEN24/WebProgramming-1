<?php
    include './vendor/autoload.php';


    $connect = new MongoDB\Client(
        'mongodb+srv://hoainambrvt2001:tMIxYDVcInK2mCkN@nhattan.7vquo.mongodb.net/myFirstDatabase?retryWrites=true&w=majority'
    );
    
    $db = $connect->data;
?>