<!-- decode json -->

$json_str = '{"name":"John", "age":30, "city":"New York"}';
$person = json_decode($json_str);
echo $person->name; // Output: John
echo $person->age; // Output: 30

<!-- encode json -->

$person = array("name"=>"John", "age"=>30, "city"=>"New York");
$json_str = json_encode($person);
echo $json_str; // Output: {"name":"John","age":30,"city":"New York"}

<!-- read json file -->

$json_str = file_get_contents('data.json');
$data = json_decode($json_str);
print_r($data);

<!-- write json file -->

$person = array("name"=>"John", "age"=>30, "city"=>"New York");
$json_str = json_encode($person);
file_put_contents('data.json', $json_str);
