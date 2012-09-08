<?php
    session_start();
	$free_days =array_fill(0,7,0);
   $link = mysql_connect('localhost', 'takeijok_ayana', 'root123'); //changet the configuration in required
	if (!$link) {
    die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('takeijok_Ayana');
    $fbid = $_SESSION['fbid'];
    $result = mysql_query("select date from users where fbid ='$fbid'");
	//echo $fbid;
    $days = mysql_fetch_row($result);
        
	//print_r($days);
	
    $days = explode(",",$days[0]);
    foreach($days as $day)
	{
	//echo substr($day,0,3)."    ";
        switch(substr($day,0,3))
        {
            case "mon":
                $free_days[0]++;
                break;
            case "tue":
                $free_days[1]++;
                break;
                case "wed":
                $free_days[2]++;
                break;
                case "thu":
                $free_days[3]++;
                break;
                case "fri":
                $free_days[4]++;
                break;
                case "sat":
                $free_days[5]++;
                break;
                case "sun":
                $free_days[6]++;
                break;


        }
}
       // print_r($free_days);


         $result = mysql_query("select friends from users where fbid ='$fbid'");
	echo $fbid;

    while($days = mysql_fetch_row($result))
    {        
	//print_r($days);
	
    $days = explode(",",$days[0]);
    foreach($days as $fid)
	{
	    $result = mysql_query("select date from users where fbid='$fid'");
        $days = mysql_fetch_row($result);
        
	//print_r($days);
	
    $day = explode(",",$days[0]);
		foreach($day as $day1)
		{
			//echo substr($day1,0,3);
        switch(substr($day1,0,3))
        {
            case "mon":
                $free_days[0]++;
                break;
            case "tue":
                $free_days[1]++;
                break;
                case "wed":
                $free_days[2]++;
                break;
                case "thu":
                $free_days[3]++;
                break;
                case "fri":
                $free_days[4]++;
                break;
                case "sat":
                $free_days[5]++;
                break;
                case "sun":
                $free_days[6]++;
                break;


        }
}}
       // print_r($free_days);
}


//fetch max time

$index = array_search(max($free_days),$free_days);
switch($index)
{
    case 0:
        $day_time = "mon";
        break;
            case 1:
        $day_time = "tue";
        break;
            case 2:
        $day_time = "wed";
        break;
            case 3:
        $day_time = "thu";
        break;
            case 4:
        $day_time = "fri";
        break;
            case 5:
        $day_time = "sat";
        break;
            case 6:
        $day_time = "sun";
        break;
}

        

    $time_array = Array(7);
    $result = mysql_query("select friends from users where fbid ='$fbid'");
	//echo $fbid;

    while($days = mysql_fetch_row($result))
    {        
	//print_r($days);
	
    $days = explode(",",$days[0]);
    foreach($days as $fid)
	{
	    $result = mysql_query("select date from users where fbid='$fid'");
        $days = mysql_fetch_row($result);
        $days = explode(",",$days[0]);
        foreach($days as $a)
        {
            if(substr($a,0,3)==$day_time)
                $time_array[] = substr($a,4);
        }
    }
    }
		echo "Day is ".$day_time;
		$time = max($time_array);
    echo "max time is ".$time;
	
	$result = mysql_query("select friends from users where fbid = '$fbid'");
	while($row = mysql_fetch_array($result))
	{
		$fbids = explode(",",$row['fbid']);
		foreach($fbids as $fbid)
		{
			$result = mysql_query("select * from users where fbid='$fbid'");
			$result = mysql_fetch_array($result);
			$to = $result['email'];		
			$name = $result['name'];
			echo $to."   ".$name;
			$email = mail($to,"Let's Meet Up", "$name wants to meet up on $day_time at $time PM.\n Follow the link to find out the details.\n <a href=\"final2.php\">Click here</a>");
			if($email)
			{
				echo "Email sent successfully";
			}
			else
			{
				echo "fail";
			}
			
		}
	}

?>