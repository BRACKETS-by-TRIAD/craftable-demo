<?php

return [

    /*
     * Language lines will be fetched by these loaders. You can put any class here that implements
     * the Brackets\AdminTranslations\TranslationLoaders\TranslationLoader-interface.
     */
    'translation_loaders' => [
        Brackets\AdminTranslations\TranslationLoaders\Db::class,
    ],

    /*
     * This is the model used by the Db Translation loader. You can put any model here
     * that extends Brackets\AdminTranslations\Translation.
     */
    'model' => Brackets\AdminTranslations\Translation::class,

    /*
     * This is the translation manager which overrides the default Laravel `translation.loader`
     */
    'translation_manager' => Brackets\AdminTranslations\TranslationLoaderManager::class,

    /*
     * This option controls if package routes are used or not
     */
    'use_routes' => true,

    'scanned_directories' => [
        app_path(),
        resource_path('views'),
        // here you can add your own directories
        // base_path('routes'), // uncomment if you have translations in your routes i.e. you have localized URLs
        base_path('vendor/brackets/admin-auth/src'),
        base_path('vendor/brackets/admin-auth/resources'),
    ],

];
