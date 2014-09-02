<?php
require_once('../config.php');
$email = @$argv[1];
$password = @$argv[2];
$type = @$argv[3];
$role_id = @$argv[4];
$classroom_name = @$argv[5];

if (empty($email)) {
	$email = get_input('Email');
}

if (empty($password)) {
	$password = get_input('Password');
}

if (empty($type)) {
	$type = get_input('Type (1 = Admin, 2 = User)');
}

if (empty($role_id)) {
	$role_id = get_input('Role (1 = Admin, 2 = Teacher, 3 = Student)');
}

if (empty($classroom_name) && $role_id > 1) {
	$classroom_name = get_input('Classroom Name (optional)');
}

if (!empty($role_id) && !empty($classroom_name)) {
	$classroom = Classroom::retrieveByName($classroom_name);

	if (!$classroom instanceof Classroom) {
		throw new RuntimeException('Error: Classroom with name "' . $classroom_name . '" not found.');
	}
}

$conn = User::getConnection();
$conn->beginTransaction();

try {
	$session = create_system_session();
	$salt = User::generateSalt();

	$user = new User;
	$user->setEmail($email);
	$user->setSalt($salt);
	$user->setPassword(User::encryptPassword($password, $salt));
	$user->setType($type);
	$user->setSession($session);
	$user->save();

	if (!empty($role_id)) {
		$user_role = new UserRole;
		$user_role->setUser($user);
		$user_role->setRoleId($role_id);
		$user_role->setSession($session);

		if (!empty($classroom)) {
			$user_role->setClassroom($classroom);
		}

		$user_role->save();
	}

	$session->setEnded(time());
	$session->save();
	$conn->commit();
	echo PHP_EOL . 'User Created!' . PHP_EOL . PHP_EOL;

}catch(Exception $e) {
	$conn->rollBack();
	throw $e;
}