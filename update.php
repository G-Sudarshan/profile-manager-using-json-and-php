<?php
require __DIR__.'/users/users.php';
include 'partials/header.php';

if(!isset($_GET['id']))
{
	include 'partials/not_found.php';
	exit;
}
$userId = $_GET['id'];

$user = getUserById($userId);

if(!$user)
{
	include 'partials/not_found.php';
	exit;
}

$errors = [

			'name' => '',
			'username' => '',
			'phone' => '',
			'email' => '',
			'website' => ''

];

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$user = array_merge($user,$_POST);

	$isValid = validateUser($user,$errors);
	
	if($isValid)
	{
		$user = updateUser($_POST,$userId);

		uploadImage($_FILES['picture'],$user);
			
		header("location: index.php");
	}
}

?>

<?php include '_form.php' ?>
