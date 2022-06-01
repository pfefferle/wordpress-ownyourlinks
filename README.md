# #OwnYourLinks

> Own your links is the concept of creating links on your own website that redirect to other properties you own, for instance social media accounts or content you have created on other websites.

-- https://indieweb.org/own_your_links

## Dependencies

This plugin is based on the awesome Hum Plugin, THE personal URL shortener for WordPress: https://github.com/willnorris/wordpress-hum

## Configuration

Define the Code Hosting (CVS) or Microblogging Service by defining the constants for example in your `wp-config.php`

```php
define( 'OWNYOURLINKS_CODE_URL', 'https://example.com/username/' );
define( 'OWNYOURLINKS_MICROBLOGGING_URL', 'https://example.org/username/' );
```

more to come.

## Usage

After you configured the constants correctly...

here is my example:

```php
define( 'OWNYOURLINKS_CODE_URL', 'https://github.com/pfefferle/' );
define( 'OWNYOURLINKS_MICROBLOGGING_URL', 'https://twitter.com/pfefferle/' );
```

...you can use the following URLs:

* GitHub Repo: https://notiz.blog/c/wordpress-webmention
* GitHub Profile: https://notiz.blog/c/
* Tweet: https://notiz.blog/t/1530981048145813506
* Twitter Profile: https://notiz.blog/t/
* Local Microblogpost: https://notiz.blog/t/5FB