<?php
return [
    'base_route'      => 'admin/filemanager',
    'middleware'      => ['web', 'auth:admin'],
    'allow_format'    => 'jpeg,jpg,png,gif,webp,mp4',
    'max_size'        => 5000000000000,
    'max_image_width' => 10000024,
    'image_quality'   => 80,
];
