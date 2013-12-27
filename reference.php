function foo(&$var)
{
    $var++;
}

$a=5;
foo($a);

echo $a;
//6



//or
foo($b=2);

//fatal error:
foo(3);



