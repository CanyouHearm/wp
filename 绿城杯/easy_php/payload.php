pages/1234','567') === false or system("cat pages/flag.php") or strpos('123.php


$page_file = "pages/" . $link_page . ".php";

$safe_check1 = "strpos('pages/1234','567') === false or system("cat pages/flag.php") or strpos('123.php', '..') === false";
assert($safe_check1) or die("no no no!");

// safe!
$safe_check2 = "file_exists('pages/1234','567') === false or system("cat pages/flag.php") or strpos('123.php')";
assert($safe_check2) or die("no this file!");