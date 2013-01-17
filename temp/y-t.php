<?php
class youtube {
  public function __construct() {
    
  }
  public function fetch_gdata($url){
    $ch = curl_init();    
    curl_setopt($ch,CURLOPT_URL,$url);  
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,3);  
    $feed = curl_exec($ch);  
    curl_close($ch);
    
    // needs to detect youtube errors
    
    return $feed;
  }
  public function playlist_gdata($id,$vars=NULL){
    if(!(isset($vars)&&is_array($vars))){
      $vars = NULL;
    }
    $url = self::gdata_url("playlist",$id,$vars);
    return self::fetch_gdata($url);
  }
  public function fetch_userid($id){
    // use given id to return userId
    return $id;
  }
  public function gdata_url($type,$id,$vars=NULL){
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
      foreach($vars as $var => $content){
        foreach($var_list as $check){
          if(strtolower($check)==strtolower($var)){
            $used_vars[$check] = $content;
            break;
          }
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
        $id = self::fetch_userid($id);
        $url = "https://gdata.youtube.com/feeds/api/users/".$id."/uploads";
        break;
      case "user_favorites":
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
        break;
    }
    $url = $url.$query;
    return $url;
  }
  public function playlist_data($gdata){
    $count = 0;
    foreach($gdata->entry as $entry){
      $count2 = 0;
      // fetch video id
      while($count2<5){
        $link_url = parse_url($entry->link[$count2]["href"]);
        parse_str($link_url['query'],$link_q);
        $vid_id = $link_q['v'];
        if(strlen($vid_id)>2){
          break;
        }
        $count2++;
      }
      
      $return[$count]['title']= $entry->title;
      $return[$count]['link']= 'http://www.youtube.com/watch?v='.$vid_id;
      $return[$count]['vid_id']= $vid_id;
      $return[$count]['thumb']= 'http://img.youtube.com/vi/'.$vid_id.'/default.jpg';
      $return[$count]['img']= 'http://img.youtube.com/vi/'.$vid_id.'/maxresdefault.jpg';
      $return[$count]['mq_img']= 'http://img.youtube.com/vi/'.$vid_id.'/mqdefault.jpg';
      $return[$count]['hq_img']= 'http://img.youtube.com/vi/'.$vid_id.'/hqdefault.jpg';
      $return[$count]['capture1']= 'http://img.youtube.com/vi/'.$vid_id.'/0.jpg';
      $return[$count]['capture2']= 'http://img.youtube.com/vi/'.$vid_id.'/1.jpg';
      $return[$count]['capture3']= 'http://img.youtube.com/vi/'.$vid_id.'/2.jpg';
      $return[$count]['capture4']= 'http://img.youtube.com/vi/'.$vid_id.'/3.jpg';
      $return[$count]['embed']= '<iframe width="400" height="225" src="http://www.youtube.com/embed/'.$vid_id.'?rel=0" frameborder="0" allowfullscreen></iframe>';
      $return[$count]['embed_med']= '<iframe width="400" height="225" src="http://www.youtube.com/embed/'.$vid_id.'?rel=0" frameborder="0" allowfullscreen></iframe>';
      $return[$count]['embed_sm']= '<iframe width="200" height="113" src="http://www.youtube.com/embed/'.$vid_id.'?rel=0" frameborder="0" allowfullscreen></iframe>';
      $return[$count]['embed_lg']= '<iframe width="843" height="480" src="http://www.youtube.com/embed/'.$vid_id.'?rel=0" frameborder="0" allowfullscreen></iframe>';
      ++$count;
    }
    return $return;
  }
  public function new_playlist($id,$vars=NULL){
    if(!(isset($vars)&&is_array($vars))){
      $vars = NULL;
    }
    $vars['alt']='json';
    $vars['v']='2';
    $gdata = self::playlist_gdata($id,$vars);
    $feed = json_decode($gdata)->feed->entry[1];
    
    $return['playlist_title']=$feed->title->{'$t'};
    
    
    return $feed;
  }
}


$test = new youtube;
print_r($test->new_playlist('E492A941D16B98D8'));


?>


