<?php
session_start();

if(isset($_POST['user']) && isset($_POST['channel']) && isset($_POST['user_id']))
{
    like($_POST['user'], $_POST['user_id'], $_POST['channel']);
}

function like($user, $id, $channel)
{
    try
    {
        $conn = new MongoClient();
        $db = $conn->test;
        $collection = $db->users;
        $testquery = array('user_name' => $user);
        $cursor = $collection->find($testquery);
        if($cursor->count() == 0)
        {
            $info = array('user_name' => $user,
                        '_id' => $id,
                        'likes' => 1);
            $collection->insert($info);
            echo "liked";
        }
        else
        {
            $collection->update(array('user_name' => $user), array('$inc' => array('likes' => 1)));
            $collection->update(array('user_name' => $user), array('$addToSet' => array('liked_channels' => $channel)));
            //$collection->update(array('user_name' => $user), array('$addToSet' => array('liked_channels' => $channel), '$setOnInsert' => array('$inc' => array('likes' => 1))), array('upsert' => true));
            echo "liked";
        }
        $conn->close();
    }
    catch(MongoConnectionException $e){ echo 'Error connecting to MongoDB server'; }
	catch(MongoException $e){ echo 'Error somewhere else with mongo';}//die('Error: ' . $e->getMessage()); }
    exit;
}
?>
