# Shaarli YouTube plugin

**youtube** is a plugin for [Shaarli](https://github.com/shaarli/shaarli)
that retrieves metadata for youtube videos.

## Installation
### Via Git

Run the following command from the plugins folder
of your Shaarli installation:

```sh
cd plugins
git clone https://github.com/kcaran/shaarli-plugin-youtube youtube
```

It'll create the `youtube` folder.

### Manually

Create the folder plugins/youtube in your Shaarli installation. Download the ZIP file of this repository and copy all files in the newly created folder.

## Activation
If your Shaarli installation is recent enough to have the plugin administration page, you just need to go to the plugin administration page, check `youtube` and save.

## Configuration

You will need a 'YouTube Data API v3' credentials key to get metadata such as the video description. Without a key, this plugin can only retrieve the title of the video.

https://cloud.google.com/docs/authentication/api-keys

**YOUTUBE_API_KEY**: *Youtube API Key*
Example value: KDpqSyB1NnHdgzGKabXiaIyIIIloXsXXXriUVIA

> Note: these settings can also be set in `data/config.json.php`, in the plugins section.

## Update
If you installed it through Git, run the following command from within this plugin's folder `plugins/youtube`:

```shell
git pull
```

Otherwise, download the ZIP file again from Github and override existing files with new ones.
