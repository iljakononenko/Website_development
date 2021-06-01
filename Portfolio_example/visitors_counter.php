<?php

function get_user_ip() {

    if ( !empty($_SERVER['HTTP_CLIENT_user_ip']) ) 
    {
        // user_ip from share internet
        $user_ip = $_SERVER['HTTP_CLIENT_user_ip'];
    } 
    
    else if ( !empty($_SERVER['HTTP_X_FORWARDED_FOR']) )
    {
        // user_ip pass from proxy
        $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else 
    {
        $user_ip = $_SERVER['REMOTE_ADDR'];
    }
    $user_ip = $_SERVER['REMOTE_ADDR'];
    return $user_ip;

}

$user_ip = get_user_ip(); 
//echo "User Real ip - $user_ip | ";

require_once ("connect.php");

$connection = @new mysqli($host, $db_user, $db_password, $db_name);

if ($connection->connect_errno!=0)
{
    echo "Error: ".$connection->connect_errno;
}
else 
{

    $my_query = "select * from visitors where visitor_ip='$user_ip'";

    if ($result = @$connection->query($my_query) )
    {
        $user_num = $result->num_rows; 

        //echo date('Y-m-d H:i:s');

        if ($user_num == 0) 
        {

            //echo "insert required!";
            
            $insert_query = "insert into visitors (visitor_ip) values ('$user_ip');";

            if ($connection->query($insert_query) )
            {
                //echo "insert successful!";
            }
            else
            {
                //echo "insert unsuccessful!";
            }
        

        }
        else 
        {
            $date_time_now = new DateTime();

            $row = $result->fetch_assoc();

            $date_time_last_visit = DateTime::createFromFormat('Y-m-d H:i:s', $row['visitor_time']);

            // wzor: new DateInterval('P7Y5M4DT4H3M2S') - 7 lat, 6 miesiecy, 5 dni, 4 godziny, 3 minuty, 2 sekundy
            // PT10H30S - czas 10 godzin, 30 sekund
            $date_time_last_visit->add(new DateInterval('P1D'));

            //echo $date_time_now->format('Y-m-d H:i:s')." <- teraz oraz ".$date_time_last_visit->format('Y-m-d H:i:s')." <- konczy sie wizyta ";

            if ( $date_time_now > $date_time_last_visit )
            {
                //echo "update required!";

                $update_query = "update visitors set visit_num = visit_num+1 where visitor_ip='$user_ip';";

                if ($connection->query($update_query) )
                {
                    //echo "update successful!";
                }
                else
                {
                    //echo "update unsuccessful!";
                }
            }
            else 
            {
                //echo "update is not required!";
            }
        }
    }

    $count_unique_visits = "select sum(visit_num) from visitors";

    //echo "<br>";

    if ($result = @$connection->query($count_unique_visits) )
    {
        $number_result = $result->fetch_row();
        echo "Number of visits: ".$number_result[0];
    }


    $connection->close();
}

?>