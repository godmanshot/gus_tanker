<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

// Encore\Admin\Form::forget(['map', 'editor']);
\Encore\Admin\Form::extend('editor', Encore\Admin\Form\Field\Editor::class);

\Encore\Admin\Form::extend('surveyjs', \App\Admin\Extensions\SurveyJS::class);

\Encore\Admin\Show::extend('work', \App\Admin\Extensions\WorkShowField::class);

\Encore\Admin\Show::extend('changeStatus', \App\Admin\Extensions\WorkChangeStatusField::class);

\Encore\Admin\Facades\Admin::js('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js');
\Encore\Admin\Facades\Admin::css('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css');

\Encore\Admin\Facades\Admin::style("
.content_work::-webkit-scrollbar {
    width: 5px;
}
  
.content_work::-webkit-scrollbar-track {
    background: #f1f1f1; 
}

.content_work::-webkit-scrollbar-thumb {
    background: #888; 
}

.content_work::-webkit-scrollbar-thumb:hover {
    background: #555; 
}
");

