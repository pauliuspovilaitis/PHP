function SUM($b) 
{ 
  static $a = 0;
  $a = $a + $b;
  return $a; 

}

SUM('1');
SUM('1');

echo SUM('1');

//echoes 3...
