<?php

/*
 * $ cd /var/www/shaarli
 * $ vendor/bin/phpunit --bootstrap tests/bootstrap.php plugins/youtube/PluginYoutubeTest.php
 */
namespace Shaarli\Plugin\Youtube;

use Shaarli\Plugin\PluginManager;
use Shaarli\Render\TemplatePage;

require_once 'plugins/youtube/youtube.php';

/**
 * Unit test for the Addlink toolbar plugin
 */
class PluginYoutubeTest extends \Shaarli\TestCase
{
    /**
     * Reset plugin path.
     */
    protected function setUp(): void
    {
        PluginManager::$PLUGINS_PATH = 'plugins';
    }

    /**
     * Test render_header hook while logged in.
     */
    public function testYoutubeURL()
    {
        $video_id = 'clKQhawfADs';
        $youtube_url = 'https://www.youtube.com/watch?v=' . $video_id;
        $rtn_val = youtube_url($youtube_url);
        $this->assertEquals($rtn_val, $video_id);

        $youtube_url = 'https://www.youtube.com/watch?v=' . $video_id . '&t=130s';
        $rtn_val = youtube_url($youtube_url);
        $this->assertEquals($rtn_val, $video_id);

        $youtube_url = 'https://www.youtube.com/watch?app=desktop&v=' . $video_id . '&t=130s';
        $rtn_val = youtube_url($youtube_url);
        $this->assertEquals($rtn_val, $video_id);

        $youtube_url = 'https://youtu.be/' . $video_id;
        $rtn_val = youtube_url($youtube_url);
        $this->assertEquals($rtn_val, $video_id);

        $youtube_url = 'https://youtu.be/' . $video_id . '?t=130';
        $rtn_val = youtube_url($youtube_url);
        $this->assertEquals($rtn_val, $video_id);
    }
}
