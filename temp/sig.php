<?php


/**
 * Skills Example
 * -----------------------
 * This example features 2 classes I reacently made.
 * 
 * The first is for the Youtube API. This class is designed
 * to allow any developer to use every single part of
 * the Youtube API easily. The class also supports both
 * youtube error and internal error handing.
 * 
 * The second class is a redo of PHP's print_r() function.
 * This class however is diffent from PHP's print_r()
 * because it allows for you to label indiviual inputs,
 * which can be used later to replace or remove specific
 * inputs. Additionally, this also out puts in-context
 * rather than at the top of the page. Also, this can print
 * multiple inputs using the add() fucntion. Lastly, this
 * class print in a different style. It instead uses a 
 * style closer to how I preffer to write PHP.
 * 
 * NOTES:
 * 1) These are just 2 classes that I have crated in the
 * past few days so both are not finished, and contain
 * place-holders for future functions.
 * 2) Only the "destroy" are not finished in the strprint_r
 * class. The rest work perfectly.
 */



class youtube_api {
  public function __construct($function=NULL,$id=NULL,$vars=NULL) {
    // easy access to main functions.
    switch ($type){
      case NULL:
        return;
      case "user_uploads":
        return self::user_uploads($id,$vars);
      case "user_favorites":
        return self::user_favorites($id,$vars);
      case "user_playlists":
        return self::user_playlists($id,$vars);
      case "user_comments":
        return self::user_comments($id,$vars);
      case "user_watch_later":
        return self::user_watch_later($id,$vars);
      case "user_watch_history":
        return self::user_watch_history($id,$vars);
      case "user_video_recommendations":
        return self::user_video_recommendations($id,$vars);
      case "user_channel_recommendations":
        return self::user_channel_recommendations($id,$vars);
      case "user_subscriptions":
        return self::user_subscriptions($id,$vars);
      case "user_live_feeds":
        return self::user_live_feeds($id,$vars);
      case "user_subscribed_channels":
        return self::user_subscribed_channels($id,$vars);
      case "user_activity_feed":
        return self::user_activity_feed($id,$vars);
      case "user_inbox":
        return self::user_inbox($id,$vars);
      case "user_contacts":
        return self::user_contacts($id,$vars);
      case "video_related":
        return self::user_related($id,$vars);
      case "playlist":
        return self::playlist($id,$vars);
      case "search":
        return self::search($id,$vars);
      case "channel_search":
        return self::channel_search($id,$vars);
      case "playlist_search":
        return self::playlist_search($id,$vars);
      case "live_events":
        return self::live_events($id,$vars);
      case "movies":
        return self::movies($id,$vars);
      case "movie_trailers":
        return self::movie_trailers($id,$vars);
      case "standard_top_rated":
        return self::standard_top_rated($id,$vars);
      case "standard_top_favorites":
        return self::standard_top_favorites($id,$vars);
      case "standard_most_popular":
        return self::standard_most_popular($id,$vars);
      case "standard_most_recent":
        return self::standard_most_recent($id,$vars);
      case "standard_most_discussed":
        return self::standard_most_discussed($id,$vars);
      case "standard_most_responded":
        return self::standard_most_responded($id,$vars);
      case "standard_recently_featured":
        return self::standard_recently_featured($id,$vars);
      case "catch_error":
        return self::catch_error();
      
      default:
        self::log_silent_error(array(
          'function'=>__FUNCTION__,
          'error' => 'invalid input for variable $function in __construct()'
        ));
        return FALSE;
    }
  }
  
  // ERROR HANDLING
  protected function log_error($error=NULL){
    static $return;
    if(isset($error)){
      $return[] = $error;
    }
    else{
      return $return;
    }
  }
  protected function log_silent_error($error=NULL){
    static $return;
    if(isset($error)){
      $return[] = $error;
    }
    else{
      return $return;
    }
  }
  public function catch_error($return_silent=NULL){
    $return = FALSE;
    if($return_silent==TRUE){
      if(self::log_silent_error()){
        $return['silent'] = self::log_silent_error();
      }
    }
    if(self::log_error()){
      $return['normal'] = self::log_error();
    }
    return $return;
  }
  
  public function fetch_gdata($url){
    // given cURL is available this should work
    // on any server.
    $ch = curl_init();    
    curl_setopt($ch,CURLOPT_URL,$url);  
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,3); 
    $feed = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    // checks for errors
    if($http_status!=200&&$http_status < 400&&$http_status>0){
      self::log_silent_error(array(
        'function'=>__FUNCTION__,
        'error' => 'HTTP_STATUS: '.$http_status
      ));
    }
    if($http_status > 399){
      @$validxml = simplexml_load_string($feed);
      if($validxml===FALSE){
        self::log_error(array(
          'function'=>__FUNCTION__,
          'http_status'=>$http_status,
          'error'=>$feed
        ));
        return FALSE;
      }
      else{
        self::log_error(array(
          'function'=>__FUNCTION__,
          'http_status'=>$http_status,
          'error'=>$validxml
        ));
        return FALSE;
      }
    }
    else{
      // no errors, return data
      return $feed;
    }
  }
  protected function check_vars_array($vars,$__FUNCTION__){
    if(!(isset($vars)&&is_array($vars))){
      if(isset($vars)){
        self::log_silent_error(array(
          'function' => $__FUNCTION__,
          'error' => 'Supplied argument $vars invalid (argument changed to NULL)'
        ));
      }
      $vars = NULL;
    }
    return $vars;
  }
  public function gdata($type,$id,$vars=NULL){
    $vars=self::check_vars_array($vars,__FUNCTION__);
    $url = self::gdata_url($type,$id,$vars);
    if($url===FALSE){
      return FALSE;
    }
    return self::fetch_gdata($url);
  }
  public function fetch_userid($id){
    $gdata = self::fetch_gdata("https://gdata.youtube.com/feeds/api/users/".$id."/uploads?v=2&alt=json&max-results=1");
    if($gdata===FALSE){
      return FALSE;
    }
    $feed = json_decode($gdata)->feed;
    $author = $feed->author[0]->{'yt$userId'}->{'$t'};
    if(strlen($author)==0){
      $author = $id;
    }
    return $author;
  }
  private function video_data_sort ($source){
    if(is_array($source)){
      $count = 0;
      foreach($source as $video){
        $vid_pub = $video->published->{'$t'};
        $vid_pub = 
          $vid_pub[0].$vid_pub[1].$vid_pub[2].$vid_pub[3].$vid_pub[4].
          $vid_pub[5].$vid_pub[6].$vid_pub[7].$vid_pub[8].$vid_pub[9]
        ;
        foreach($video->category as $key => $tag){
          if($key>1){
            $vid_tags[] = $tag->term;
          }
        }
        
        $vid_id = $video->{'media$group'}->{'yt$videoid'}->{'$t'};
      
        $vids_array[$count]['title'] = $video->title->{'$t'};
        $vids_array[$count]['description'] = $video->{'media$group'}->{'media$description'}->{'$t'};
        $vids_array[$count]['link'] = 'http://www.youtube.com/watch?v='.$vid_id;
        $vids_array[$count]['duration'] = $video->{'media$group'}->{'yt$duration'}->seconds;
        $vids_array[$count]['stats']['rating'] = $video->{'gd$rating'}->average;
        $vids_array[$count]['stats']['raters'] = $video->{'gd$rating'}->numRaters;
        $vids_array[$count]['stats']['views'] = $video->{'yt$statistics'}->viewCount;
        $vids_array[$count]['stats']['favorited'] = $video->{'yt$statistics'}->favoriteCount;
        $vids_array[$count]['stats']['raters'] = $video->{'gd$rating'}->numRaters;
        $vids_array[$count]['stats']['likes'] = $video->{'yt$rating'}->numLikes;
        $vids_array[$count]['stats']['dislikes'] = $video->{'yt$rating'}->numDislikes;
        $vids_array[$count]['vid_id'] = $vid_id;
        $vids_array[$count]['comment_rss'] = $video->{'gd$comments'}->{'gd$feedLink'}->{'href'};
        $vids_array[$count]['uploader_id'] = $video->{'media$group'}->{'yt$uploaderId'}->{'$t'};
        $vids_array[$count]['uploader_username'] = $video->{'media$group'}->{'media$credit'}[0]->{'yt$display'};
        $vids_array[$count]['uploader_type'] = $video->{'media$group'}->{'media$credit'}[0]->{'yt$type'};
        $vids_array[$count]['published'] = $vid_pub;
        $vids_array[$count]['category'] = $video->category[1]->label;
        $vids_array[$count]['tags'] = $vid_tags;
        $vids_array[$count]['license_link'] = $video->{'media$group'}->{'media$license'}->href;
        $vids_array[$count]['aspect_ratio'] = $video->{'media$group'}->{'yt$aspectRatio'}->{'$t'};
        $vids_array[$count]['embed'][0] = 'http://www.youtube.com/embed/'.$vid_id.'?rel=0';
        $vids_array[$count]['embed']['small'] = '<iframe width="200" height="113" src="http://www.youtube.com/embed/'.$vid_id.'?rel=0" frameborder="0" allowfullscreen></iframe>';
        $vids_array[$count]['embed']['medium'] = '<iframe width="400" height="225" src="http://www.youtube.com/embed/'.$vid_id.'?rel=0" frameborder="0" allowfullscreen></iframe>';
        $vids_array[$count]['embed']['large'] = '<iframe width="843" height="480" src="http://www.youtube.com/embed/'.$vid_id.'?rel=0" frameborder="0" allowfullscreen></iframe>';
        $vids_array[$count]['thumb']['default'] = 'http://img.youtube.com/vi/'.$vid_id.'/default.jpg';
        $vids_array[$count]['thumb']['start'] = 'http://img.youtube.com/vi/'.$vid_id.'/1.jpg';
        $vids_array[$count]['thumb']['middle'] = 'http://img.youtube.com/vi/'.$vid_id.'/2.jpg';
        $vids_array[$count]['thumb']['end'] = 'http://img.youtube.com/vi/'.$vid_id.'/3.jpg';
        $vids_array[$count]['image'] = 'http://img.youtube.com/vi/'.$vid_id.'/maxresdefault.jpg';
        
        $list_videos[$count]=$vids_array[$count];
        $count++;
        // prevents overlapping vars
        unset($vids_array,$vid_id,$vid_tags,$tag,$vid_pub,$key);
      }
    }
    else{
      self::log_error(array(
       'fucntion'=>__FUNCTION__,
       'error'=>'Invalid input type (not an array)'
      ));
      return FALSE;
    }
    return $list_videos;
  }

  public function gdata_url($type,$id,$vars=NULL){
    $vars=self::check_vars_array($vars,__FUNCTION__);
    if(isset($vars)&&is_array($vars)){
      $var_list = array(
          "alt","author","callback","fields","fields-language",
          "max-results","prettyprint","start-index","strict","v",
          "3d","caption","catagory","duration","format",
          "hd","license","location","location-radius","lr",
          "orderby","q","safeSearch","time","uploader",
          "restriction","fmt","lang","inline","hl",
          "movie-genre","paid-content","region","course","ends-after",
          "ends-before","inline","starts-after","starts-before","status",
          "hint"
      );
      $used_vars = array();
      $total = count($var_list);
      $count = 1;
      foreach($vars as $var => $content){
        foreach($var_list as $check){
          if(strtolower($check)==strtolower($var)){
            $used_vars[$check] = $content;
            $count=1;
            break;
          }
          else{
            if($count==$total){
              self::log_silent_error(array(
                'function'=>__FUNCTION__,
                'error'=>'Ignored invalid var: ['.$var.'] => '.$content
              ));
            }
          }
          $count++;
        }
      }
      $count = 0;
      foreach($used_vars as $var => $content){
        if($count==0){
          $query = "?".$var."=".$content;
        }
        else{
          $query .= "&".$var."=".$content;
        }
        $count++;
      }
    }
    $type = strtolower($type);
    switch ($type){
      case "user_uploads":
        $url = "https://gdata.youtube.com/feeds/api/users/".$id."/uploads";
        break;
      case "user_favorites":
        $id = self::fetch_userid($id);
        $url = "https://gdata.youtube.com/feeds/api/users/".$id."/favorites";
        break;
      case "user_playlists":
        $id = self::fetch_userid($id);
        $url = "https://gdata.youtube.com/feeds/api/users/".$id."/uploads";
        break;
      case "user_comments":
        $id = self::fetch_userid($id);
        $url = "https://gdata.youtube.com/feeds/api/users/".$id."/uploads";
        break;
      case "user_watch_later":
        $id = self::fetch_userid($id);
        $url = "https://gdata.youtube.com/feeds/api/users/".$id."/uploads";
        break;
      case "user_watch_history":
        $id = self::fetch_userid($id);
        $url = "https://gdata.youtube.com/feeds/api/users/".$id."/uploads";
        break;
      case "user_video_recommendations":
        $id = self::fetch_userid($id);
        $url = "https://gdata.youtube.com/feeds/api/users/".$id."/uploads";
        break;
      case "user_channel_recommendations":
        $id = self::fetch_userid($id);
        $url = "https://gdata.youtube.com/feeds/api/users/".$id."/uploads";
        break;
      case "user_subscriptions":
        $id = self::fetch_userid($id);
        $url = "https://gdata.youtube.com/feeds/api/users/".$id."/uploads";
        break;
      case "user_live_feeds":
        $id = self::fetch_userid($id);
        $url = "https://gdata.youtube.com/feeds/api/users/".$id."/uploads";
        break;
      case "user_subscribed_channels":
        $id = self::fetch_userid($id);
        $url = "https://gdata.youtube.com/feeds/api/users/".$id."/uploads";
        break;
      case "user_activity_feed":
        $id = self::fetch_userid($id);
        $url = "https://gdata.youtube.com/feeds/api/users/".$id."/uploads";
        break;
      case "user_inbox":
        $id = self::fetch_userid($id);
        $url = "https://gdata.youtube.com/feeds/api/users/".$id."/uploads";
        break;
      case "user_contacts":
        $id = self::fetch_userid($id);
        $url = "https://gdata.youtube.com/feeds/api/users/".$id."/uploads";
        break;
      case "video_related":
        break;
      case "playlist":
        $url = 'gdata.youtube.com/feeds/api/playlists/'.$id;
        break;
      case "search":
        break;
      case "channel_search":
        break;
      case "playlist_search":
        break;
      case "live_events":
        break;
      case "movies":
        break;
      case "movie_trailers":
        break;
      case "standard_top_rated":
        break;
      case "standard_top_favorites":
        break;
      case "standard_most_popular":
        break;
      case "standard_most_recent":
        break;
      case "standard_most_discussed":
        break;
      case "standard_most_responded":
        break;
      case "standard_recently_featured":
        break;
      
      default:
        self::log_error(array(
          'function' => __FUNCTION__,
          'error' => 'Invalid $type supplied'
        ));
        return FALSE;
    }
    return $url.$query;
  }
  public function real_playlist_id($id){
    // stuff
  }
  public function playlist($id,$vars=NULL){
    $vars=self::check_vars_array($vars,__FUNCTION__);
    $vars['alt']='json';
    $vars['v']='2';
    $gdata = self::gdata('playlist',$id,$vars);
    if($gdata===FALSE){
      return FALSE;
    }
    $feed = json_decode($gdata)->feed;
    
    $temp = strstr($feed->author[0]->uri->{'$t'},'users/');
    $temp[0]="";$temp[1]="";$temp[2]="";
    $temp[3]="";$temp[4]="";$temp[5]="";
    $playlist_author_username = $temp;
    
    $mediagroup = $feed->{'media$group'};
    
    $return['youtube_logo']=$feed->logo->{'$t'};
    $return['list_title']=$feed->title->{'$t'};
    $return['list_desc']=$feed->subtitle->{'$t'};
    $return['list_link']=$feed->link[0]->href;
    $return['list_rss']=$feed->link[1]->href;
    $return['list_thumbs']=array(
        'default'=>$mediagroup->{'media$thumbnail'}[0]->url,
        'mqdefault'=>$mediagroup->{'media$thumbnail'}[1]->url,
        'hqdefault'=>$mediagroup->{'media$thumbnail'}[2]->url
    );
    $return['list_author_name']=$feed->author[0]->name->{'$t'};
    $return['list_author_username']=$playlist_author_username;
    $return['list_author_link']="http://www.youtube.com/user/".$playlist_author_username;
    $return['list_author_rss']=$feed->author[0]->uri->{'$t'};
    $return['list_author_id']=$feed->author[0]->{'yt$userId'}->{'$t'};
    $return['api_name']=$feed->generator->{'$t'};
    $return['api_version']=$feed->generator->{'version'};
    $return['results_total']=$feed->{'openSearch$totalResults'}->{'$t'};
    $return['results_offset']=$feed->{'openSearch$startIndex'}->{'$t'};
    $return['results_per_page']=$feed->{'openSearch$itemsPerPage'}->{'$t'};
    if(is_array($feed->entry)){
      $return['list_videos']=self::video_data_sort($feed->entry);
    }
    
    
    return $return;
  }
  public function user_uploads($id,$vars=NULL){
    $vars=self::check_vars_array($vars,__FUNCTION__);
    $vars['alt']='json';
    $vars['v']='2';
    $gdata = self::gdata('user_uploads',$id,$vars);
    if($gdata===FALSE){
      return FALSE;
    }
    $feed = json_decode($gdata)->feed;
    
    $temp = strstr($feed->author[0]->uri->{'$t'},'users/');
    $temp[0]="";$temp[1]="";$temp[2]="";
    $temp[3]="";$temp[4]="";$temp[5]="";
    $list_author_username = $temp;
    
    $mediagroup = $feed->{'media$group'};
    
    $return['youtube_logo']=$feed->logo->{'$t'};
    $return['list_title']=$feed->title->{'$t'};
    $return['list_desc']='Showing '.$feed->{'openSearch$itemsPerPage'}->{'$t'}.' of '.$feed->{'openSearch$totalResults'}->{'$t'}.' results.';
    $return['list_link']='http://www.youtube.com/user/'.$list_author_username.'/videos';
    $return['list_rss']=self::gdata_url('user_uploads',$id).'?v=2';
    $return['list_author_name']=$feed->author[0]->name->{'$t'};
    $return['list_author_username']=$list_author_username;
    $return['list_author_link']="http://www.youtube.com/user/".$list_author_username;
    $return['list_author_rss']=$feed->author[0]->uri->{'$t'};
    $return['list_author_id']=$feed->author[0]->{'yt$userId'}->{'$t'};
    $return['api_name']=$feed->generator->{'$t'};
    $return['api_version']=$feed->generator->{'version'};
    $return['results_total']=$feed->{'openSearch$totalResults'}->{'$t'};
    $return['results_offset']=$feed->{'openSearch$startIndex'}->{'$t'};
    $return['results_per_page']=$feed->{'openSearch$itemsPerPage'}->{'$t'};
    if(is_array($feed->entry)){
      $return['list_videos']=self::video_data_sort($feed->entry);
    }
    
    return $return;
  }
}



class strprint_r{
  public function __construct() {
    if(isset($input)){
      self::add($input,$id);
    }
  }
  
  protected function input($input=NULL,$clear=FALSE,$id=NULL){
    static $return;
    if(isset($input)){
      $return[] = $input;
      return TRUE;
    }
    elseif($clear==TRUE&&isset($id)){
      if(isset($return[$id])){
        unset($return[$id]);
        return TRUE;
      }
      return FALSE;
    }
    elseif($clear==TRUE){
      unset($return);
      return TRUE;
    }
    else{
      return $return;
    }
  }

  public function add($input,$id=NULL){
    return self::input($input);
  }
  public function subtract($id){
    return self::input(NULL,TRUE,$id);
  }
  public function clear(){
    return self::input(NULL,TRUE);
  }
  
  // All destroy functions are not finished.
  public function strdestroy($needle=NULL,$reverse=FALSE){
    if((!isset($resource))&&isset($needle)){
      $resource = self::input();
      foreach($resource as $key=>$value){
        if(is_array($value)){
          static $resource;
          $resource = $value;
          self::strdestroy(NULL,$value);
        }
        elseif(is_object($value)||is_resource($value)){
          // Do nothing
        }
        elseif(is_bool($value)){
          if(!$value===$needle&&$reverse===TRUE){
            unset($resource[$key]);
          }
          elseif($value===$needle){
            unset($resource[$key]);
          }
        }
        else{
          if(!strpos($value,$needle)&&$reverse===TRUE){
            unset($resource[$key]);
          }
          elseif(strpos($value,$needle)){
            unset($resource[$key]);
          }
        }
      }
    }
    elseif((!isset($needle))&&isset($resource)){
      foreach($resource as $key=>$value){
        if(is_array($value)){
          static $resource;
          $resource = $value;
          self::strdestroy(NULL,$value);
        }
        elseif(is_object($value)||is_resource($value)){
          // Do nothing
        }
        elseif(is_bool($value)){
          if(!$value===$needle&&$reverse===TRUE){
            unset($resource[$key]);
          }
          elseif($value===$needle){
            unset($resource[$key]);
          }
        }
        else{
          if(!strpos($value,$needle)&&$reverse===TRUE){
            unset($resource[$key]);
          }
          elseif(strpos($value,$needle)){
            unset($resource[$key]);
          }
        }
      }
    }
    else{
      return FALSE;
    }
    unset($resource);
    return TRUE;
  }

  public function stridestroy($needle,$reverse=FALSE){
    if((!isset($resource))&&isset($needle)){
      $resource = self::input();
      foreach($resource as $key=>$value){
        if(is_array($value)){
          static $resource;
          $resource = $value;
          self::stridestroy(NULL,$value);
        }
        elseif(is_object($value)||is_resource($value)){
          // Do nothing
        }
        elseif(is_bool($value)){
          if(!$value===$needle&&$reverse===TRUE){
            unset($resource[$key]);
          }
          elseif($value===$needle){
            unset($resource[$key]);
          }
        }
        else{
          if(!stripos($value,$needle)&&$reverse===TRUE){
            unset($resource[$key]);
          }
          elseif(stripos($value,$needle)){
            unset($resource[$key]);
          }
        }
      }
    }
    elseif((!isset($needle))&&isset($resource)){
      foreach($resource as $key=>$value){
        if(is_array($value)){
          static $resource;
          $resource = $value;
          self::stridestroy(NULL,$value);
        }
        elseif(is_object($value)||is_resource($value)){
          // Do nothing
        }
        elseif(is_bool($value)){
          if(!$value===$needle&&$reverse===TRUE){
            unset($resource[$key]);
          }
          elseif($value===$needle){
            unset($resource[$key]);
          }
        }
        else{
          if(!stripos($value,$needle)&&$reverse===TRUE){
            unset($resource[$key]);
          }
          elseif(stripos($value,$needle)){
            unset($resource[$key]);
          }
        }
      }
    }
    else{
      return FALSE;
    }
    unset($resource);
    return TRUE;
  }
  public function keydestroy($needle,$reverse=FALSE){
    // case-sensitive only
    if((!isset($resource))&&isset($needle)){
      $resource = self::input();
      foreach($resource as $key=>$value){
        if(is_array($value)){
          static $resource;
          $resource = $value;
          self::keydestroy(NULL,$value);
        }
        elseif(is_object($value)||is_resource($value)){
          // Do nothing
        }
        else{
          if(!strpos($key,$needle)&&$reverse===TRUE){
            unset($resource[$key]);
          }
          elseif(strpos($key,$needle)){
            unset($resource[$key]);
          }
        }
      }
    }
    elseif((!isset($needle))&&isset($resource)){
      foreach($resource as $key=>$value){
        if(is_array($value)){
          static $resource;
          $resource = $value;
          self::keydestroy(NULL,$value);
        }
        elseif(is_object($value)||is_resource($value)){
          // Do nothing
        }
        else{
          if(!strpos($key,$needle)&&$reverse===TRUE){
            unset($resource[$key]);
          }
          elseif(strpos($key,$needle)){
            unset($resource[$key]);
          }
        }
      }
    }
    else{
      return FALSE;
    }
    unset($resource);
    return TRUE;
  }
  
  protected function indentnum($num=0){
    static $indent;
    $indent = ($indent+($num));
    return $indent;
  }
  protected function helper($clear=FALSE){
    static $count;
    if($clear===TRUE){
      $count = 0;
      return $count;
    }
    else{
      return $count++;
    } 
  }
  public function output_spacing($spacing=NULL){
    static $count;
    if(!isset($count)){
      $count = 2;
    }
    if(is_int($spacing)){
      $count=$spacing;
    }
    else{
      return str_repeat(" ", $count);
    }
  }
  public function stroutput($source=NULL,$clear_on_print=FALSE){
    $spacing = self::output_spacing();
    static $recursive;
    if($recursive===TRUE){
      $PHP_EOL = PHP_EOL;
    }
    else{
      $PHP_EOL = "";
    }
    if(isset($source)){
      $echo = $source;
    }
    else{
      $echo = self::input();
    }
    if(is_array($echo)){
      foreach($echo as $key => $value){
        $valindent = str_repeat($spacing,self::indentnum()+1);
        $indent = str_repeat($spacing,self::indentnum());
        if(!self::helper()==0){
          $addme = PHP_EOL;
          if(!$recursive===TRUE){
            self::helper(TRUE);
          }
        }
        if(!self::helper()==0){
          $addme = PHP_EOL.$indent."[".$key."] => ";
        }
        if(is_array($value)){
          $return .= $PHP_EOL.$indent.$addme."Array {".PHP_EOL;
          foreach($value as $subkey => $subvalue){
            if(is_array($subvalue)){
              $type = "Array";
              $line = PHP_EOL;
            }
            elseif(is_bool($subvalue)){
              $type = "Boolean";
              if($subvalue===TRUE){
                $subvalue = "TRUE";
              }
              else{
                $subvalue = "FALSE";
              }
            }
            elseif(is_object($subvalue)||is_resource($subvalue)){
              if(is_object($subvalue)){
                $subvalue = get_class($subvalue);
                $type = "Class";
              }
              else{
                $type = "Resource";
              }
            }
            else{
              $type = gettype($subvalue);
              $type[0] = strtoupper($type[0]);
            }
            $return .= $valindent."[".$subkey."] => ".$type;
            if(!is_null($subvalue)){
              $return .= " { ";
              self::indentnum(2);
              $recursive = TRUE;
              $r_test = self::stroutput($subvalue);
              if(strlen($r_test)>((self::indentnum()*strlen($spacing))+1)){
                $return .= $r_test;
              }
              $recursive = FALSE;
              self::indentnum(-2);
              $return .= PHP_EOL.$valindent."}";
            }
            $return .= PHP_EOL;
          }
          $return .= $indent."}";
        }
        elseif(is_bool($value)){
          if($value===TRUE){
            $value = "TRUE";
          }
          else{
            $value = "FALSE";
          }
          $return .= $PHP_EOL.$indent.$addme."Boolean {".PHP_EOL.$valindent.$value.PHP_EOL.$indent."}";
        }
        elseif(is_null($value)){
          $thistype = gettype($value);
          $thistype[0] = strtoupper($thistype[0]);
          $return .= $PHP_EOL.$indent.$addme.$thistype;
        }
        elseif(is_object($value)||is_resource($value)){
          if(is_object($value)){
            $value = get_class($value);
            $thistype = "Class";
          }
          elseif(is_resource($value)){
            $thistype = "Resource";
          }
          $return .= $PHP_EOL.$indent.$addme.$thistype." {".PHP_EOL.$valindent.$value.PHP_EOL.$indent."}";
        }
        else{
          $thistype = gettype($value);
          $thistype[0] = strtoupper($thistype[0]);
          $return .= $PHP_EOL.$indent.$addme.$thistype." {".PHP_EOL.$valindent.$value.PHP_EOL.$indent."}";
        }
      }
      self::helper(TRUE);
    }
    else{
      $valindent = str_repeat($spacing,self::indentnum()+1);
      $indent = str_repeat($spacing,self::indentnum());
      $return .= PHP_EOL.$indent.$echo;
    }
    if($clear_on_print==TRUE){
      return self::input(NULL,TRUE);
    }
    return $return;
  }
  public function output($source=NULL,$clear_on_print=FALSE){
    $spacing = self::output_spacing();
    static $recursive;
    if($recursive===TRUE){
      $PHP_EOL = PHP_EOL;
    }
    else{
      $PHP_EOL = "";
    }
    if(isset($source)){
      $echo = $source;
    }
    else{
      $echo = self::input();
    }
    if(is_array($echo)){
      foreach($echo as $key => $value){
        $valindent = str_repeat($spacing,self::indentnum()+1);
        $indent = str_repeat($spacing,self::indentnum());
        if(!self::helper()==0){
          $addme = PHP_EOL;
          if(!$recursive===TRUE){
            self::helper(TRUE);
          }
        }
        if(!$recursive===TRUE){
          self::helper(TRUE);
        }
        if(!self::helper()==0){
          $addme = "[".$key."] => ";
        }
        if(is_array($value)){
          echo $PHP_EOL.$indent.$addme."Array {".PHP_EOL;
          foreach($value as $subkey => $subvalue){
            if(is_array($subvalue)){
              $type = "Array";
              $line = PHP_EOL;
            }
            elseif(is_bool($subvalue)){
              $type = "Boolean";
              if($subvalue===TRUE){
                $subvalue = "TRUE";
              }
              else{
                $subvalue = "FALSE";
              }
            }
            elseif(is_object($subvalue)||is_resource($subvalue)){
              if(is_object($subvalue)){
                $subvalue = get_class($subvalue);
                $type = "Class";
              }
              else{
                $type = "Resource";
              }
            }
            else{
              $type = gettype($subvalue);
              $type[0] = strtoupper($type[0]);
            }
            echo $valindent."[".$subkey."] => ".$type;
            if(!is_null($subvalue)){
              echo " { ";
              self::indentnum(2);
              $recursive = TRUE;
              $r_test = self::stroutput($subvalue);
              if(strlen($r_test)>((self::indentnum()*strlen($spacing))+1)){
                echo $PHP_EOL.self::stroutput($subvalue);
              }
              $recursive = FALSE;
              self::indentnum(-2);
              echo PHP_EOL.$valindent."}";
            }
            echo PHP_EOL;
          }
          echo $indent."}";
        }
        elseif(is_bool($value)){
          if($value===TRUE){
            $value = "TRUE";
          }
          else{
            $value = "FALSE";
          }
          echo $PHP_EOL.$indent.$addme."Boolean {".PHP_EOL.$valindent.$value.PHP_EOL.$indent."}";
        }
        elseif(is_null($value)){
          $thistype = gettype($value);
          $thistype[0] = strtoupper($thistype[0]);
          echo $PHP_EOL.$indent.$addme.$thistype;
        }
        elseif(is_object($value)||is_resource($value)){
          if(is_object($value)){
            $value = get_class($value);
            $thistype = "Class";
          }
          elseif(is_resource($value)){
            $thistype = "Resource";
          }
          echo $PHP_EOL.$indent.$addme.$thistype." {".PHP_EOL.$valindent.$value.PHP_EOL.$indent."}";
        }
        else{
          $thistype = gettype($value);
          $thistype[0] = strtoupper($thistype[0]);
          echo $PHP_EOL.$indent.$addme.$thistype." {".PHP_EOL.$valindent.$value.PHP_EOL.$indent."}";
        }
      }
      self::helper(TRUE);
    }
    else{
      $valindent = str_repeat($spacing,self::indentnum()+1);
      $indent = str_repeat($spacing,self::indentnum());
      echo PHP_EOL.$indent.$echo;
    }
    if($clear_on_print==TRUE){
      return self::input(NULL,TRUE);
    }
  }
}


// Now test it all

// works with all API queries.
$vars = array(
  'max-results'=>1
);
$vars2 = array(
  'max-results'=>1,
  'fakeQuery'=>'fakeValue'
);

$youtube = new youtube_api;
$print_r = new strprint_r;
$test1 = $youtube->user_uploads('tobygames',$vars);
// simulate error: invalid query (silent internal error)
// $test1 = $youtube->user_uploads('tobygames',$vars2);

$print_r->output_spacing(4);
/*
if($youtube->catch_error(true)){
  echo "There has been an error!\nPrinting...\n\n";
  $print_r->add($youtube->catch_error(true));
}
else{
  $print_r->add($test1);
}
*/

$print_r->add("apple");
$print_r->add($test1);

$print_r->output();


?>


