<?php 
    /*
    $array1 = ['john', 'alice', 'jack'];
    //var_dump($array1);
    var_dump($array1[1]);
    
    $array2 = ['name' => 'alice',
               'age' => 23,
               'famale'
    ];
    var_dump($array2);
    //the index of 'famale' will be zero
    
    $array3 = [4 => 'aaa', 2 => 'bbb', 'ccc', 'ddd', 'eee', 'fff'];
    var_dump($array3);
    //the index of the 'bbb' will be 5, not 3
    */
    $user_list = [
        ['name' => 'john', 'age' => 23],
        ['name' => 'alice', 'age' => 14],
        ['name' => 'mike', 'age' => 20]
    ];
    //var_dump($user_list[2]['name']);
    foreach ($user_list as $i => $user) {
        echo "$user[name] is $user[age] years old. The index of this user is $i<br />";
    }
?>