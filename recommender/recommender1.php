<html>
<body>

<?php

$itemID=3;
$userID=5;
$db_name="project";
$connection= mysql_connect("localhost:3306","root","") or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");
$sql = "SELECT DISTINCT r.itemID, r2.ratingValue - r.ratingValue
            as rating_difference
            FROM rating r, rating r2
            WHERE r.userID=$userID AND
                    r2.itemID=$itemID AND
                    r2.userID=$userID;";
//dis is item 2 item relation

$db_result = mysql_query($sql, $connection);

$num_rows = mysql_num_rows($db_result);
while ($row = mysql_fetch_assoc($db_result)) {
    $other_itemID = $row["itemID"];
    $rating_difference = $row["rating_difference"];

    if (mysql_num_rows(mysql_query("SELECT itemID1
    FROM dev WHERE itemID1=$itemID AND itemID2=$other_itemID",
    $connection)) > 0)  {
        $sql = "UPDATE dev SET count=count+1,
	sum=sum+$rating_difference WHERE itemID1=$itemID
	AND itemID2=$other_itemID";
        mysql_query($sql, $connection);

        if ($itemID != $other_itemID) {
            $sql = "UPDATE dev SET count=count+1,
	    sum=sum-$rating_difference
	    WHERE (itemID1=$other_itemID AND itemID2=$itemID)";
            mysql_query($sql, $connection);
        }
    }
    else {
        $sql = "INSERT INTO dev VALUES ($itemID, $other_itemID,
        1, $rating_difference)";
        mysql_query($sql, $connection);

        if ($itemID != $other_itemID) {
            $sql = "INSERT INTO dev VALUES ($other_itemID,
	    $itemID, 1, -$rating_difference)";
            mysql_query($sql, $connection);
        }
    }
}

for($x=1;$x<=3;$x++)
{
$value=predict(1,$x);
$threshold=5;

echo "the predicted rating for the item is";
echo $value."<br />";


if($threshold<$value)
       echo "recommend item <br /> ";
else
      echo "do not recommend  <br />";
}

function predict($userID, $itemID) {
    global $connection;
    $denom = 0.0;
    $numer = 0.0;
    $k = $itemID;
    $sql = "SELECT r.itemID, r.ratingValue
    FROM rating r WHERE r.userID=$userID AND r.itemID <> $itemID";
    $db_result = mysql_query($sql, $connection);

    while ($row = mysql_fetch_assoc($db_result))  {
        $j = $row["itemID"];
        $ratingValue = $row["ratingValue"];

        $sql2 = "SELECT d.count, d.sum FROM dev d WHERE itemID1=$k AND itemID2=$j";
        $count_result = mysql_query($sql2, $connection);

        if(mysql_num_rows($count_result) > 0)  {
            $count = mysql_result($count_result, 0, "count");
            $sum = mysql_result($count_result, 0, "sum");

            $average = $sum / $count;

            $denom += $count;

            $numer += $count * ($average + $ratingValue);
        }
    }
    if ($denom == 0)
        return 0;
    else
        return ($numer / $denom);
}

?>
</body>
</html>
