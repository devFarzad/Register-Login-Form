<?php
// require_once './../service/errors.php';



require_once './../bootstrap.php';

use App\Model\User;
use App\Helper\CutomeError;

function requestData($value)
{
    return isset($_POST[$value]) && $_POST[$value] != "" ? trim($_POST[$value]) : null;
}
$err = new CutomeError();
$errors = [];
// $validate = false;
function has_error($value)
{
    global $errors;
    return isset($errors[$value]);
}
function get_error($value)
{
    global $errors;
    return has_error($value) ? $errors[$value] : false;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = requestData('name');
    $user_name = requestData('user_name');
    $email = requestData('email');
    $password = requestData('password');

    if (is_null($name)) {
        // $err->setError('name', 'Please Enter name'); // $errors['name'] = 'Please Enter Name';
        $err->name = 'Please Enter name'; // $errors['name'] = 'Please Enter Name';
        // $validate = false;

        // exit;
    }
    if (is_null($email)) {
        $err->email = 'Please Enter email'; // $errors['name'] = 'Please Enter Name';

        // $err->setError('email', 'Please Enter email'); // $errors['name'] = 'Please Enter Name';
        // $validate = false;

        // exit;
    }
    if (is_null($password)) {
        $err->password = 'Please Enter password'; // $errors['name'] = 'Please Enter Name';

        // $err->setError('password', 'Please Enter password'); // $errors['password'] = 'Please Enter Password !';
        // $validate = false;

        // exit;
    }
    if (strLen($password) < 6) {
        $err->password = 'The password should be 6 charecter more...'; // $errors['name'] = 'Please Enter Name';

        // $err->setError('password', 'The password should be 6 charecter more...'); //$errors['password'] = 'The password should be 6 charecter more...';
        // $validate = false;

        // exit;
    }
    if (is_null($user_name)) {
        $err->user_name = 'Please Enter username'; // $errors['name'] = 'Please Enter Name';

        // $err->setError('user_name', 'Please Enter username'); // $errors['username'] = 'Please Enter User name !';
        // $validate = true;

    }     // exit;

    if ($err->count() <= 0) {
        // echo 'Validate Success';

        $user = new User();
        $result = $user->create(compact('name', 'user_name', 'email', 'password'));
        if ($result) {
            header("Location:/auth/login.php");

            return;
        }
        header("Location:/auth/register.php");

        // $host = 'localhost';
        // $usernameDB = 'root';
        // $passwordDB = '';
        // $conn = new PDO("mysql:host=$host;dbname=oop", $usernameDB, $passwordDB);
        // // $conn = new PDO("mysql:host='localhost';dbname='oop'", 'root', '');
        // $statment = $conn->prepare("INSERT INTO users (name,user_name,email,password) values (:name,:username,:email,:password)");
        // $statment->execute([
        //     'name' => $name,
        //     'username' => $username,
        //     'email' => $email,'
        //     'password' => $password
        // ]);
        // if ($statment->rowCount() > 0) {
        //     header("Location:/auth/login.php");
        //     exit;
        // } else {
        //     header("Location:/auth/register.php");
        //     exit;
        // }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class=" bg-gray-700">
    <div class="container mx-auto space-y-4">
        <div class="sm:mx-auto sm:w-full sm:max-w-md mt-10">
            <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                alt="Workflow">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
                Register your account
            </h2>
        </div>
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-6" action="#" method="POST" novalidate>
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Name
                        </label>
                        <div class="mt-1">
                            <input id="name" name="name" type="text" autocomplete="name" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <span><?php if ($err->name) { ?>
                            <small>
                                <?= $err->name ?>
                            </small>
                            <?php } ?>
                        </span>
                    </div>
                    <div>
                        <label for="user_name" class="block text-sm font-medium text-gray-700">
                            Username
                        </label>
                        <div class="mt-1">
                            <input id="user_name" name="user_name" type="text" autocomplete="user_name" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <span><?php if ($err->user_name) { ?>
                            <small>
                                <?= $err->user_name ?>
                            </small>
                            <?php } ?>
                        </span>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email address
                        </label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <span><?php if ($err->email) { ?>
                            <small>
                                <?= $err->email ?>
                            </small>
                            <?php } ?>
                        </span>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <span><?php if ($err->password) { ?>
                            <small>
                                <?= $err->password ?>

                            </small>
                            <?php } ?>
                        </span>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Register
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</body>

</html>