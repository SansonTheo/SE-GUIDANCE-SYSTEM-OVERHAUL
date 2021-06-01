<?php 
include "server.php";
$arrayTrait = [];
for($i = 1; $i <= 30; $i++){
		$traitName = 'trait'.$i;
        $traitExists = mysqli_real_escape_string($link,$_POST[$traitName]);
		if($traitExists != null){
			$traitNum = mysqli_real_escape_string($link,$_POST[$traitName]);
			array_push($arrayTrait, $traitNum);
		}
}
$arrayStr = implode(",",$arrayTrait);
print_r($arrayStr);
echo 'done'; 

?>