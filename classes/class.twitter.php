<?php

class twitter
{
    /**#@+
     * 
     * @access private
     * @var string
     * 
     */

    var $username = '';
    var $password = '';
    var $user_agent = '';

	/**
	 * I don't know if these headers have become standards yet
	 * but I would suggest using them.
	 * 
	 */ 
    var $headers = array('X-Twitter-Client: ', 'X-Twitter-Client-Version: ', 'X-Twitter-Client-URL: ');
    
    /**
     * The response from the server
     */
    var $responseInfo = array();

    /**#@-*/

    function twitter()
    {
    	
    }

	/**
	 * Updates the authenticating user's status.
     * Requires the status parameter specified below.
     * @param string $status Required. The text of your status update. Must not be more than 160 characters and should not be more than 140 characters to ensure optimal display.
     * @return SimpleXMLElement The response from the server
	 */
    function update($status){
        $request = 'http://twitter.com/statuses/update.xml';
        $postargs['status'] = urlencode($status);
        return $this->process($request, $postargs);
    }

    /** 
     * Returns the 20 most recent statuses from non-protected users who have
     * set a custom user icon.  Does not require authentication.
     *
     * @param int sinceid (Optional) Returns only public statuses with an ID greater than (that is, more recent than) the specified ID.
     * @return SimpleXMLElement The response from the server
     */
    function publicTimeline($sinceid=false){
        $qs = '';
        if($sinceid !== false)
            $qs = '?since_id='.intval($sinceid);
        $request = 'http://twitter.com/statuses/public_timeline.xml'.$qs;
        return $this->process($request);
    }

    // Returns the 20 most recent statuses posted in the last 24 hours from the
    // authenticating user and that user's friends.  It's also possible to request
    // another user's friends_timeline via the id parameter below.
    //
    // id. (string OR int) Optional.  Specifies the ID or screen name of the user for whom
    //                                to return the friends_timeline. (set to false if you
    //                                want to use authenticated user).
    // since. (HTTP-formatted date) Optional.  Narrows the returned results to just those
    //                                         statuses created after the specified date.
    //
    function friendsTimeline($id=false,$since=false){
        $qs='';
        if($since!==false)
            $qs='?since='.urlencode($since);

        if($id===false)
            $request = 'http://twitter.com/statuses/friends_timeline.xml'.$qs;
        else
            $request = 'http://twitter.com/statuses/friends_timeline/'.urlencode($id).'.xml'.$qs;

        return $this->process($request);
    }

    // Returns the 20 most recent statuses posted in the last 24 hours from the
    // authenticating user.  It's also possible to request another user's timeline
    // via the id parameter below.
    //
    // id. (string OR int) Optional.  Specifies the ID or screen name of the user for whom
    //                                to return the user_timeline.
    // count. (int) Optional.  Specifies the number of statuses to retrieve.  May not be
    //                         greater than 20 for performance purposes.
    // since. (HTTP-formatted date) Optional.  Narrows the returned results to just those
    //                                         statuses created after the specified date.
    //
    function userTimeline($id=false,$count=20,$since=false){
        $qs='?count='.intval($count);
        if($since!==false)
            $qs .= '&since='.urlencode($since);

        if($id===false)
            $request = 'http://twitter.com/statuses/user_timeline.xml'.$qs;
        else
            $request = 'http://twitter.com/statuses/user_timeline/'.urlencode($id).'.xml'.$qs;

        return $this->process($request);
    }

    // Returns a single status, specified by the id parameter below.  The status's author
    // will be returned inline.
    //
    // id. (int) Required.  Returns status of the specified ID.
    //
    function showStatus($id){
        $request = 'http://twitter.com/statuses/show/'.intval($id).'.xml';
        return $this->process($request);
    }
    // Returns the authenticating user's friends, each with current status inline.  It's
    // also possible to request another user's friends list via the id parameter below.
    //
    // id. (string OR int) Optional.  The ID or screen name of the user for whom to request
    //                                a list of friends.
    //
    function friends($id=false){
        if($id===false)
            $request = 'http://twitter.com/statuses/friends.xml';
        else
            $request = 'http://twitter.com/statuses/friends/'.urlencode($id).'.xml';
        return $this->process($request);
    }

    // Returns the authenticating user's followers, each with current status inline.
    //
    function followers(){
        $request = 'http://twitter.com/statuses/followers.xml';
        return $this->process($request);
    }

    // Returns a list of the users currently featured on the site with their current statuses inline.
    function featured(){
        $request = 'http://twitter.com/statuses/featured.xml';
        return $this->process($request);
    }

    // Returns extended information of a given user, specified by ID or screen name as per the required
    // id parameter below.  This information includes design settings, so third party developers can theme
    // their widgets according to a given user's preferences.
    //
    // id. (string OR int) Required.  The ID or screen name of a user.
    //
    function showUser($id){
        $request = 'http://twitter.com/users/show/'.urlencode($id).'.xml';
        return $this->process($request);
    }

    // Returns a list of the direct messages sent to the authenticating user.
    //
    // since. (HTTP-formatted date) Optional.  Narrows the resulting list of direct messages to just those
    //                                         sent after the specified date.
    //
    function directMessages($since=false){
        $qs='';
        if($since!==false)
            $qs='?since='.urlencode($since);
        $request = 'http://twitter.com/direct_messages.xml'.$qs;
        return $this->process($request);
    }

    // Sends a new direct message to the specified user from the authenticating user.  Requires both the user
    // and text parameters below.
    //
    // user. (string OR int) Required.  The ID or screen name of the recipient user.
    // text. (string) Required.  The text of your direct message.  Be sure to URL encode as necessary, and keep
    //                           it under 140 characters.
    //
    function sendDirectMessage($user,$text){
        $request = 'http://twitter.com/direct_messages/new.xml';
        $postargs['user'] = urlencode($user);
        $postargs['text'] = urlencode($text);
        return $this->process($request,$postargs);
    }

    // internal function where all the juicy curl fun takes place
    // this should not be called by anything external unless you are
    // doing something else completely then knock youself out.
    private function process($url, $postargs = false){

        $snoopy = new Snoopy;

        if($this->username !== false && $this->password !== false)
        {
            $snoopy->user = $this->username;
	        $snoopy->pass = $this->password;
        }

        if($postargs !== false)
        {
            $snoopy->submit($url, $postargs);
        }
        else
        {
            $snoopy->fetch($url);
        }

        $this->responseInfo = trim($snoopy->response_code);
        $response = $snoopy->results;

        if($this->responseInfo == "HTTP/1.1 200 OK"){
            if(class_exists('SimpleXMLElement')){
                $xml = new SimpleXMLElement($response);
                return $xml;
            }
            else
            {
                return $response;
            }
        }
        else
        {
            return false;
        }
    }
}


?>