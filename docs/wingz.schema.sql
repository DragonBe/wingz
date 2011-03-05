CREATE TABLE `twitter` (
    `twitter_id` TEXT PRIMARY KEY,
    `screen_name` TEXT,
    `access_token` TEXT
);

CREATE TABLE `facebook` (
    `fb_id` TEXT PRIMARY KEY,
    `fb_name` TEXT,
    `fb_access_token` TEXT
)