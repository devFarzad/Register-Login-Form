<?php


require_once 'bootstrap.php';
$user = new App\Model\User();
var_dump($user);
// namespace App;

// class  DB

// {
// }

























// class Task
// {
//     protected $tasks = [];

//     public function getTasks()
//     {
//         return $this->tasks;
//     }
//     public function taskOne()
//     {
//         echo 'Task 1';
//         $this->tasks[] = 'Task 1';
//         return $this;
//     }
//     public function taskTwo()
//     {
//         echo 'Task 2';
//         $this->tasks[] = 'Task 2';

//         return $this;
//     }
//     public function taskThree()
//     {
//         echo 'Task 3';
//         $this->tasks[] = 'Task 3';

//         return $this;
//     }
// }

// $task = new Task();

// $task->taskThree()->taskOne()->taskTwo();
// var_dump($task->getTasks());
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// class Task
// {
//     protected static $tasks = [];
//     public static function getTasks()
//     {
//         return  static::$tasks;
//     }
//     public static function taskOne()
//     {
//         echo 'Task 1';
//         static::$tasks[] = 'Task 1';
//         return (new static);
//     }
//     public static function taskTwo()
//     {
//         echo 'Task 2';
//         static::$tasks[] = 'Task 2';

//         return (new static);
//     }
//     public static function taskThree()
//     {
//         echo 'Task 3';
//         static::$tasks[] = 'Task 3';

//         return (new static);
//     }
// }
// Task::taskOne()
//     ->taskTwo()
//     ->taskThree();

// var_dump(Task::getTasks());




///////////////////////////////////
///////////////////////////////
/////////////////////////////
//////////////////////////////////

// class Collection
// {
//     // protected $colected = [];
//     protected array $items = [];

//     public  function addItems($items)
//     {
//         $this->items[] = $items;
//         return $this;
//     }
//     public function __construct($items = [])
//     {
//         $this->items = $items;
//     }
//     public function filtter($callback)
//     {

//         return new static(array_filter($this->items, $callback));
//     }
//     public function all()
//     {
//         return $this->items;
//     }
//     public function map($callback)
//     {
//         return new static(array_map($callback, $this->items));
//     }
//     public function merg($array)
//     {

//         return new static(array_merge($this->items, $array));
//     }
// }

// class Collect
// {


//     public static function __callStatic($method,   $args)
//     {
//         return (new Collection)->$method(...$args);
//     }
// }
// $collect = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]);


// $items3 = $collect->filtter(fn ($item) => $item % 2 == 0)
//     ->map(fn ($item) => $item * 2)
//     ->merg([26, 28, 30, 32])
//     ->all();
// var_dump($items3);

// $items1 = Collect::addItems([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12])
//     ->filtter(fn ($item) => $item % 2 == 0)
//     ->map(fn ($item) => $item * 2)
//     ->merg([26, 28, 30, 32])
//     ->all();
// var_dump($items3);
// var_dump($items1);