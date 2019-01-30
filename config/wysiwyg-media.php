<?php

return [

    /*
   |--------------------------------------------------------------------------
   | Maximum Image Width
   |--------------------------------------------------------------------------
   |
   | This value determines the maximum width to which the uploaded image will be resized to.
   | It is particularly useful, so that users won't upload huge images straight from
   | the camera to wysiwyg editor and so increase the page load significantly
   |
   */

    'maximum_image_width' => env('WYSIWYG_MAXIMUM_IMAGE_WIDTH', 1000),

    /*
    |--------------------------------------------------------------------------
    | Media folder
    |--------------------------------------------------------------------------
    |
    | This value determines the folder in which the
    | wysiwyg media should be saved. Folder must
    | be inside "public" folder.
    |
    */

    'media_folder' => env('WYSIWYG_MEDIA_FOLDER', 'uploads'),

];