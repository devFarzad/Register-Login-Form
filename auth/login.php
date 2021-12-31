<?php
require_once './../bootstrap.php';

$errors = [];
$validate = false;

function has_error($value)
{

    global $errors;
    return isset($errors[$value]);
}
function get_error($value)
{
    global $errors;
    return isset($errors[$value]) ? $errors[$value] : false;
}
function requestData($value)
{

    return isset($_POST[$value]) && $_POST[$value] != "" ? trim($_POST[$value]) : null;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = requestData('email');
    $password = requestData('password');

    if (is_null('email')) {

        $errors['email'] = 'Please Enter Email';
        $validate = false;
    } elseif (is_null('password')) {
        $errors['password'] = 'Please Enter Password';
        $validate = false;
    } elseif (strLen('password') < 6) {
        $errors['password'] = 'The Password should be 6 charecter more ...';
        $validate = false;
    } else {
        $validate = true;
    }
    if ($validate) {
        $host = 'localhost';
        $usernameDB = 'root';
        $passwordDB = '';
        $conn = new PDO("mysql:host=$host;dbname=oop", $usernameDB, $passwordDB);
        // $statementAccess = $conn->prepare("select * from users where ")
        $statement = $conn->prepare("select * from users where email=:email and password=:password");
        $statement->execute([
            'email' => $email,
            'password' => $password
        ]);

        $user = $statement->fetchAll(PDO::FETCH_OBJ);
        if ($statement->rowCount() > 0) {
            // var_dump($user);
            $user = array_shift($user);
            // $user = shift_array($user);
            echo "hi " . $user->email;
        } else {
            echo 'user not found !';
        }
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
    <title>Login</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class=" bg-gray-700">
    <div class="container mx-auto space-y-4">
        <div class="sm:mx-auto sm:w-full sm:max-w-md mt-10">
            <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                alt="Workflow">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
                Sign in to your account
            </h2>
        </div>
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-6" action="#" method="POST">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email address
                        </label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <span><?php if (has_error('email')) { ?>
                            <small>
                                <?= get_error('email') ?>
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
                        <span><?php if (has_error('password')) { ?>
                            <small>
                                <?= get_error('password') ?>
                            </small>
                            <?php } ?>
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember_me" type="checkbox"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                Remember me
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Forgot your password?
                            </a>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Login
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</body>

</html>