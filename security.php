$a = "C:/dir/file.php";
basename($a);
//outpu: file.php
//escapes dir to avoid injection. 

htmlspecialchars ($string);  
// convert &,”,’,<,> into HTML entities e.g. &quot


htmlentities ($string,FLAGS);  
// converts all applicable to HTML entities 
// (European accents, etc.), only necessary if your pages use encodings such as ASCII or LATIN-1 instead of UTF-8.

strip_tags ($string,$allowable_tags);   
// remove all tags [opening&closing] (except $allowable_tags) from the string
