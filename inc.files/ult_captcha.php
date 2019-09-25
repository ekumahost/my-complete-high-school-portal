<?php
$var1 = mt_rand(1, 9);
$var2 = rand(2, 9);

$answer = $var1 * $var2;
print '<input type="hidden" name="captcha_answer_raw" value="'.$answer.'"/>';
print $var1 .' X '. $var2 .': <input type="text" required="required" name="captcha_answer" placeholder="Answer?"/>';

?>