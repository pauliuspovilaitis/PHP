function foo(&$var)
{
    $var++;
}

$a=5;
foo($a);


echo $a;
//6
