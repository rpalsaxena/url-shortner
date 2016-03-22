<?php
/*      function base62($num) 
        {
                $index = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $res = '';
                        do {
                                $res = $index[$num % 62] . $res;
                                $num = intval($num / 62);
                                } while ($num);
                return $res;
         }       
*/
      //  require("***.php");
        if(!empty($_POST))
    {
        $x =    $_POST['url'];
//      $x =   urlencode($x);
//      $x = mysql_real_escape_string($x);
        if (empty($_POST['url']) )
        {
                        $response["success"] = 0;
                        $response["message"] = "Please Enter Url";
                        die(json_encode($response));
        }
                //      $u = mysql_real_escape_string( urlencode($_POST['url']));    
        $query = "INSERT INTO URLS ( url ) VALUES ( :url ) ";
                $query_params = array(':url' => $x );
           try {
                                $stmt   = $db->prepare($query);
                                $result = $stmt->execute($query_params);
                }
                        catch (PDOException $ex) {
                                $response["success"] = 0;
                                $response["message"] = "Database Error2. Please Try Again!";
                                die(json_encode($response));
                                                                }
                        $response["success"] = 1;
                        $response["message"] = "Link Successfully Added!";
                if($response["success"] == 1)
                {
                        $query = "SELECT id,url
            FROM  `URLS` 
            WHERE url = :url  
            LIMIT 1";
                        $query_params = array(':url' => $_POST['url']);
                        try {
                                $stmt   = $db->prepare($query);
                                $result = $stmt->execute($query_params);
                                }
                        catch (PDOException $ex) {
                                $response["success"] = 0;
                                $response["message"] = "Database Error!";
                                die(json_encode($response));
                                }
// Finally, we can retrieve all of the found rows into an array using fetchAll 
                        $rows = $stmt->fetchAll();
        if ($rows) {
                $response["success2"] = 1;
                $response["message2"] = "Post Available!";
                $response["posts"]   = array();
        function base62($num)
        {
                $index = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $res = '';
                        do {                                $num = intval($num / 62);
                                } while ($num);
        return $res;
        }
                foreach ($rows as $row) {
                        $post             = array();
                        $post["id"]               = $row["id"];
                        $post["url"]      =         $row["url"];
                        $post["short"]    =          base62($row["id"]);
                                //$post["message"]  = $row["message"];
                                //update our repsonse JSON data
                        array_push($response["posts"], $post);
                                                                }
                echo json_encode($response);
       }
    else {
                        $response["success"] = 0;
                        $response["message"] = "No Link  Available!";
                        die(json_encode($response));
        }
        }
}
else
        {
        ?>
<h1>URL SHORTNER </h1>
<form action="url.php" method="post">
    Enter Url :<br />
    <input type="text" name="url" value="" />
    <br /><br />
    <input type="submit" value="Shorten Url" />
</form>
<?php
}
?>
