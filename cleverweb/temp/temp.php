<?php
$host="localhost";
    $dbuser="teamcw_system";
    $password='C4a$0cP@)STw';
    $database="teamcw_cleverweb";
  
    # Connect to the database...
    $link = mysqli_connect($host,$dbuser,$password,$database);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if ($result = mysqli_query($link,
"SELECT * 
FROM  `emailnotify` 
WHERE  `email` =  'nicholas.jordon@projectcleverweb.com'"
)) {

    /* determine number of rows result set */
    $row_cnt = mysqli_num_rows($result);

    print_r($row_cnt);

    /* close result set */
    mysqli_free_result($result);
}

/* close connection */
mysqli_close($link);