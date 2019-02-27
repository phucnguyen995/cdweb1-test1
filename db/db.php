<?php
	require "config.php";
	class db
	{
		public static $conn;
		public function __construct(){
		self::$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		self::$conn->set_charset('utf8');
		}

		public function checkEmail($email){
		$sql="SELECT * FROM `user` WHERE `email` = '$email'";
		$result = self::$conn->query($sql);
		return $result->num_rows;

		}

		public function countAttempt($num, $id){
			$sql="UPDATE `user` SET `attempt`= $num WHERE `id` = $id";
			$result = self::$conn->query($sql);
			return $result;
		}
		
		public function lastAccess($email){
			$sql="UPDATE `user` SET `last_access`= NOW() WHERE `email` = '$email'";
			$result = self::$conn->query($sql);
			return $result;
		}


		public function insertUser($name, $pass, $email, $phone){
			$sql="INSERT INTO `user`(`name`, `email`, `password`, `phone`) VALUES ('$name' ,'$email', '$pass', '$phone')";
			$result = self::$conn->query($sql);
			return $result;
		}

		public function getUser($email){
			$sql="SELECT * FROM `user` WHERE `email` = '$email'";
			$result = self::$conn->query($sql);
			$arr = $result->fetch_assoc();
			return $arr;
		}

		public function getUserById($id){
			$sql="SELECT * FROM `user` WHERE `id` = '$id'";
			$result = self::$conn->query($sql);
			$arr = $result->fetch_assoc();
			return $arr;
		}

		public function reset_login($email){
			$sql="UPDATE `user` SET `attempt`= 0 WHERE `email`= '$email'";
			$result = self::$conn->query($sql);
			return $result;
		}

		public function updateUser($id, $name, $pass, $phone, $gender, $birthdate, $address){
			if ($password == "")
			{
				$sql="UPDATE `user` SET `name`= '$name',`phone`='$phone',`gender`=$gender,`birthdate`='$birthdate',`address`= '$address' WHERE `id`= $id";
			}
			else {
				$sql="UPDATE `user` SET `name`= '$name',`password`= '$password',`phone`='$phone',`gender`=$gender,`birthdate`='$birthdate',`address`= '$address' WHERE `id`= $id";
			}
			
			$result = self::$conn->query($sql);
			return $result;
		}

		public function login($txtEmail, $txtPassword, $email, $password){
			$hash = password_hash($password,PASSWORD_DEFAULT);
			if ($txtEmail == $email && password_verify($txtPassword, $hash))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function getCity($string){
			$sql="SELECT * FROM `$string`";
			$result = self::$conn->query($sql);
			$arr = array();
			while($row = $result->fetch_assoc()){
				$arr[] = $row;
			}
			return $arr;
		}

		public function getCityById($string, $id){
			$sql="SELECT * FROM `$string` WHERE id = $id";
			$result = self::$conn->query($sql);
			$arr = $result->fetch_assoc();
			return $arr;
		}

		public function searchFlight($cityFrom, $cityTo){
			$sql="SELECT * FROM `flight`, `plane` WHERE flight.id = plane.id AND `id_cityFrom` = $cityFrom AND `id_cityTo` = $cityTo";
			$result = self::$conn->query($sql);
			$arr = array();
			while($row = $result->fetch_assoc()){
				$arr[] = $row;
			}
			return $arr;
		}

		public function airportById($id){
			$sql="SELECT * FROM `airport` WHERE id = $id";
			$result = self::$conn->query($sql);
			$arr = $result->fetch_assoc();
			return $arr;
		}

		public function detailFlight($id){
			$sql="SELECT * FROM `flight`, `airport` WHERE flight.id = airport.id AND flight.id = $id";
			$result = self::$conn->query($sql);
			$arr = $result->fetch_assoc();
			return $arr;
		}

		public function plane($cityFrom, $cityTo){
			$sql="SELECT * FROM `plane` WHERE `id_cityFrom` = $cityFrom AND `id_cityTo` = $cityTo";
			$result = self::$conn->query($sql);
			$arr = array();
			while($row = $result->fetch_assoc()){
				$arr[] = $row;
			}
			return $arr;
		}
	}
?>