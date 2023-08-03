<?php


$arr = [
    ["country" => "PK", "city"=>"Islamabad", "code"=>1],
    ["country" => "PK", "city"=>"Faisalabad", "code"=>2],
    ["country" => "IN", "city"=>"Islamabad", "code"=>3],
    ["country" => "China", "city"=>"Islamabad", "code"=>4],
];

// s($arr);
$arr2 = [];

foreach($arr as $a){
    $country = $a["country"];
    $city = $a['city'];
    // if( !isset($arr2[$country])){
    //     $arr2[$country]=[];
    // }
    // if( !isset($arr2[$country][$city])){
    //     $arr2[$country][$city]=[];
    // }
    $arr2[$country][$city]['code'] = $a['code'];
}
d($arr2);
// 


$arr3=[];


foreach($arr2 as $countries => $cities){
    foreach($cities as $city=>$data){
        $code=$data['code'];
        $arr3[]=['country'=>$countries,'city'=>$city,'code'=>$code];
    }
}
d($arr3);




















exit;
// foreach($arr as $a)
// {
//     $country = $a["country"];
//     $city = $a["city"];
 
//     // if(!isset($arr2[$country]))
//     // {
//     //     $arr2[$country] = [];
//     // }

//     // if(!isset($arr2[$country][$city]))
//     // {
//     //     $arr2[$country][$city] = [];
//     // }

//     $arr2[$country][$city]['code'] = $a['code'];

// }
// s($arr2);

// $arr3 = [];

// foreach($arr2 as $country=>$cities)
// {
//     foreach($cities as $city=>$data)
//     {
//         $code = $data['code'];
//         $arr3[] = ['country'=>$country, 'city'=>$city, 'code'=>$code];
//     }
// }

// s($arr3);




