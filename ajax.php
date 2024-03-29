<?php

/**
 * 
 * Dispacher for ajax requests.
 * Receive the post and analyze it
 * 
 * @author Luke
 */

include("common.php");

// Ajax requests dispacher
if(isset($_POST) && !empty($_POST))
{
    switch($_POST['action'])
    {
        case 'twitterUpdate':
                $twitter = new twitter();
                $res = $twitter->userTimeline("Lukefx");
                $status['text'] = trim($res->status[0]->text);
                $status['created_at'] = trim($res->status[0]->created_at);
                header('X-JSON:('.json_encode($status).')');
                echo "/*-secure-\n".json_encode($status)."\n*/";
                break;        
        default:
                break;
    }
}
else
{
    // return nothing
    $status['null'] = null;
    header('X-JSON:('.json_encode($status).')');
    echo json_encode($status);
}

?>