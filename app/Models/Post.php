<?php

/**
 * Posts
 *
 * Due to its nature, Posts model are managed dynamically by UI, via PostTypes
 *
 * @author Jetmir Haxhisefa <jetmir.haxhisefa@Accio.com>
 * @author Faton Sopa <faton.sopa@Accio.com>
 * @version 1.0
 */
namespace App\Models;

use Accio\App\Models\PostModel;

class Post extends PostModel {

    /**
     * Get id, thumbnail and source of video.
     * Currently works only with YouTube, Vimeo and dailymotion
     * @param $url
     * @param string $imageType
     * @param boolean $autoPlay
     * @return array
     */
    public function parseVideoURL($url, $imageType = "default", $autoPlay = false) {
        if($url) {
            $parse_url = parse_url($url);

            $videoID = null;

            $videoData = [
              'id' => null,
              'siteName' => null,
              'imageURL' => null,
              'sourceURL' => null,
            ];

            //You Tube
            if (strstr($parse_url["host"], "youtube") || strstr($parse_url["path"], "youtube") || (isset($parse_url["query"]) && strstr($parse_url["query"], "youtube"))) {
                $videoData["siteName"] = 'youtube';
                $explodeV = explode("v=", $url);
                $explodeAnd = explode("&", $explodeV[1]);
                $videoID = $explodeAnd[0];
                $videoData["imageURL"] = "//i1.ytimg.com/vi/" . $videoID . "/" . $imageType . ".jpg";
                $videoData["sourceURL"] = "//www.youtube.com/embed/$videoID".($autoPlay ? '?autoplay=1' : '');
            } ////You Tube Short Url
            else if (strstr($parse_url["host"], "youtu.be") || strstr($parse_url["path"], "youtu.be")) {
                $videoData["siteName"] = 'youtube';
                $explodeV = explode("/", $url);
                $videoID = $explodeV[3];
                $videoData["imageURL"] = "https://i1.ytimg.com/vi/" . $videoID . "/" . $imageType . ".jpg";
                $videoData["sourceURL"] = "//www.youtube.com/embed/$videoID".($autoPlay ? '?autoplay=1' : '');
            } //Vimeo
            elseif ($parse_url["host"] == "www.vimeo.com") {
                $videoData["siteName"] = 'vimeo';
                if (preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $url, $match)) {
                    $videoID = $match[1];
                    $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$videoID.php"));
                    $videoData["imageURL"] = $hash[0]['thumbnail_medium'];
                    $videoData["sourceURL"] = "https://player.vimeo.com/video/$videoID?title=0&amp;byline=0&amp;portrait=0".($autoPlay ? '&amp;autoplay=1' : '');;
                }
            } //DailyMotion
            elseif ($parse_url["host"] == "www.dailymotion.com") {
                $videoData["siteName"] = 'dailymotion';
                $videoID = strtok(basename($url), '_');
                $videoData["imageURL"] = "https://www.dailymotion.com/thumbnail/160x120/video/$videoID";
                $videoData["sourceURL"] = "https://www.dailymotion.com/embed/video/$videoID".($autoPlay ? '?autoplay=1' : '');;
            }
            $videoData["id"] = $videoID;
            return $videoData;
        }
    }

}
