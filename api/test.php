<!DOCTYPE html>
<html>
<body>

<?php
$date1=date_create("2019-01-21");
$date2=date_create("2019-05-21");
$diff=date_diff($date1,$date2);
echo $diff->format("%a");
?>

</body>
</html>