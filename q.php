<?php
    //      require("***");
                function to10( $num, $b=62)
                {
                $base='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $limit = strlen($num);
                $res=strpos($base,$num[0]);
                        for($i=1;$i<$limit;$i++) {
                                $res = $b * $res + strpos($base,$num[$i]);
                        }
                        return $res;
        }
if(!empty($_GET))
    {
        if (empty($_GET['u']) )
                        {
                        $response["success"] = 0;
                        $response["message"] = "Please Enter Url";
                        die(json_encode($response));
            }
                if(!empty($_GET['u']))
            {
                        //      $var = to10($_GET['u']);
                        $query = "SELECT url  FROM  `URLS`  WHERE id = :var LIMIT 1";
                        $query_params = array(':var' => to10($_GET['u']));
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
                                        if ($rows) {   $response["success"] = 1;
                                                        $response["posts"]   = array();
                                                        foreach ($rows as $row) {
                                                                $post             = array();
                                                                $post["url"]      =         $row["url"];
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
?>
