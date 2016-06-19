# Recursive ACF To WordPress REST API (v2)

This is a WordPress plugin which recursively appends Advanced Custom Fields Data to the WP REST API v2 for both standard objects and custom posts.

### Requirements
* [WordPress](https://wordpress.org/)
* [WP REST API Plugin](https://wordpress.org/plugins/rest-api/)
* [Advanced Custom Fields Plugin](https://www.advancedcustomfields.com/)

### Installation
* Install into the `wp-content/plugins` directory
* Activate from the `Plugins > Installed Plugins` panel in WordPress admin

### Example
* `curl http://localhost/wp-json/v2/wp/myobject/1`

##### Standard Response
```
{
  id: 1,
  date: "2016-06-05T21:33:59",
  date_gmt: "2016-06-05T21:33:59",
  guid: {...},
  modified: "2016-06-09T18:15:05",
  modified_gmt: "2016-06-09T18:15:05",
  slug: "myobject-slug",
  type: "myobject",
  link: "http://localhost/myobject/myobject-slug/",
  title: {...},
  featured_media: 0,
  _links: {...}
}
```

#####  Response With Plugin
```
{
  id: 1,
  date: "2016-06-05T21:33:59",
  date_gmt: "2016-06-05T21:33:59",
  guid: {...},
  modified: "2016-06-09T18:15:05",
  modified_gmt: "2016-06-09T18:15:05",
  slug: "myobject-slug",
  type: "myobject",
  link: "http://localhost/myobject/myobject-slug/",
  title: {...},
  featured_media: 0,
  _links: {...}
  acf: {
    technologies: [
      {
        ID: 1,
        post_author: "1",
        post_date: "2016-06-05 21:28:59",
        post_date_gmt: "2016-06-05 21:28:59",
        post_content: "",
        post_title: "PHP",
        post_excerpt: "",
        post_status: "publish",
        comment_status: "closed",
        ping_status: "closed",
        post_password: "",
        post_name: "php",
        to_ping: "",
        pinged: "",
        post_modified: "2016-06-05 21:28:59",
        post_modified_gmt: "2016-06-05 21:28:59",
        post_content_filtered: "",
        post_parent: 0,
        guid: "http://localhost/?post_type=technology&#038;p=1",
        menu_order: 0,
        post_type: "technology",
        post_mime_type: "",
        comment_count: "0",
        filter: "raw",
        acf: {
          icon: "php",
          description: "<p>Custom post with two custom fields.</p>"
        }
      }
    ],
    faqs: [
      {
        question: "What is this?",
        answer: "This is a repeater custom field for custom post myobject."
      }
    ]
  }
}
```