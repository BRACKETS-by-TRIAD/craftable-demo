<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => "ID",
            'first_name' => "First name",
            'last_name' => "Last name",
            'email' => "Email",
            'password' => "Password",
            'password_repeat' => "Password Confirmation",
            'activated' => "Activated",
            'forbidden' => "Forbidden",
            'language' => "Language",
                
            //Belongs to many relations
            'roles' => "Roles",
                
        ],
    ],

    'post' => [
        'title' => 'Posts',

        'actions' => [
            'index' => 'Posts',
            'create' => 'New Post',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'title' => "Title",
            'perex' => "Perex",
            'published_at' => "Published at",
            'enabled' => "Enabled",
            'author_id' => "Author",
        ],
    ],

    'translatable-article' => [
        'title' => 'Translatable Articles',

        'actions' => [
            'index' => 'Translatable Articles',
            'create' => 'New Translatable Article',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'title' => "Title",
            'perex' => "Perex",
            'published_at' => "Published at",
            'enabled' => "Enabled",
            
        ],
    ],

    'article' => [
        'title' => 'Articles',

        'actions' => [
            'index' => 'Articles',
            'create' => 'New Article',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'title' => "Title",
            'perex' => "Perex",
            'published_at' => "Published at",
            'enabled' => "Enabled",
            
        ],
    ],

    'export' => [
        'title' => 'Exports',

        'actions' => [
            'index' => 'Items',
            'create' => 'New Item',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => "ID",
            'title' => "Title",
            'perex' => "Perex",
            'published_at' => "Published at",
            'enabled' => "Enabled",
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];
