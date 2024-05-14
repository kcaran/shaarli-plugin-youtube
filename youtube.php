<?php

/**
 * Plugin youtube
 *
 * Get youtube metadata
 */

use Shaarli\Config\ConfigManager;
use Shaarli\Plugin\PluginManager;
use Shaarli\Bookmark\LinkUtils;
use Shaarli\Render\TemplatePage;

function youtube_url($url)
{
    $pattern = '/^https:\/\/(www|m)\.youtube\.com\/watch\?v=(?<video_id>[^&]+)/i';
    if (preg_match($pattern, $url, $match)) {
        return $match['video_id'];
    }

    $pattern = '/^https:\/\/youtu\.be\/(?<video_id>[^?]+)/i';
    if (preg_match($pattern, $url, $match)) {
        return $match['video_id'];
    }

    return '';
}

function hook_youtube_render_editlink($data, $conf)
{
    if (!$data['link_is_new']) {
        return $data;
    }

    $video_id = youtube_url($data['link']['url']);
    if (!$video_id) {
        return $data;
    }

    $api_key = $conf->get('plugins.YOUTUBE_API_KEY');
    if (empty($api_key)) {
        $url = 'https://www.youtube.com/oembed?url=' . $data['link']['url'] . '&format=json';
    } else {
        $url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&id=' . $video_id . '&key=' . $api_key;
    }

    list($headers, $content) = get_http_response($url);
    $metadata = json_decode($content, true);
    if ($metadata['items']) {
        $metadata = $metadata['items'][0]['snippet'];
    }
    $data['link']['title'] = $metadata['title'];
    $data['link']['description'] = $metadata['description'];

  // Make sure there is at least one tag (youtube)
    $metadata['tags'][] = 'youtube';
    $data['link']['tags'] = tags_array2str(array_map(function ($tag) {
        return str_replace(' ', '-', $tag);
    }, $metadata['tags']), ' ');

    return $data;
}

function hook_youtube_render_linklist($data)
{
    return $data;
}

function hook_youtube_render_includes($data)
{

    return $data;
}

/**
 * This function is never called, but contains translation calls for GNU gettext extraction.
 */
function youtube_dummy_translation()
{
    // meta
    t('Adds youtube metadata content.');
}
