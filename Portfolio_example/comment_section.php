<form action="add_comment.php" method="POST">
    <ul style="width:100%;">
    <h2>Comments</h2>
<li>
<textarea
    readonly
    name="comments"
    id="comments"
    cols="30"
    rows="10"
  >
<?php
if ($connection->connect_errno!=0)
{
    echo "Error: ".$connection->connect_errno;
}
else
{
    $mysql_query = "Select * from comments where project_id='$project_id'";

    if ($result = @$connection->query($mysql_query) )
    {
        $comment_num = $result->num_rows; 
        if ($comment_num > 0)
        {
            while ($row = $result->fetch_assoc() )
            {
                $name = $row['commenter_name'];
                $surname = $row['commenter_surname'];
                $text = $row['comment_text'];
                echo "  $name $surname: \n";
                echo "      $text \n\n";
            }
            
        }
    }
    else 
    {
        echo "Sorry, comment section is broken!";
    }
}

?>
</textarea>
</li>
    <?php
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)
    {
echo<<<END
<li>
<textarea
name="new_comment"
class="new_comment"
cols="30"
rows="5"
></textarea>
</li>
<li>
<input type="hidden" name="project_id" value="$project_id"/></p>
<div class="form_buttons">
<input type="reset" value="clear" />
<input type="submit" value="comment" />
</div>
</li>
END;
    }

    ?>
    </ul>
</form>

