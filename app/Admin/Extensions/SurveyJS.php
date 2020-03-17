<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class SurveyJS extends Field
{
    protected $view = 'admin.surveyjs';
    protected $answers = false;
    protected $fillable_data = false;

    protected static $css = [
        'https://unpkg.com/survey-jquery/survey.min.css',
    ];

    protected static $js = [
        'https://unpkg.com/survey-jquery',
    ];

    public function answers($json) { $this->answers = $json; return $this; }
    public function fillable_data($fillable_data) { $this->fillable_data = $fillable_data; return $this; }

    public function render()
    {
        $this->script = <<<EOT
                // var defaultThemeColors = Survey
                // .StylesManager
                // .ThemeColors["default"];
                // defaultThemeColors["\$main-color"] = "#7ff07f";
                // defaultThemeColors["\$main-hover-color"] = "#6fe06f";
                // defaultThemeColors["\$text-color"] = "#4a4a4a";
                // defaultThemeColors["\$header-color"] = "#7ff07f";
                
                // defaultThemeColors["\$header-background-color"] = "#ffffff";
                // defaultThemeColors["\$body-container-background-color"] = "#ffffff";
                Survey.StylesManager.applyTheme();
        
                var surveyJSON = {$this->answers};
                
                function sendDataToServer(survey) {
                    $("[name='{$this->id}_value']").val(JSON.stringify(survey.data));
                    console.log(survey.data);
                }
                
                var survey = new Survey.Model(surveyJSON);
                
                survey.locale = 'ru';

                var {$this->id}_form = $("#{$this->id}").Survey({
                    model: survey,
                    onComplete: sendDataToServer
                });
                
                $('#{$this->id}_form').unbind();
                $('#{$this->id}_form').click(function(e) {
                    e.preventDefault();
                    if(!survey.hasErrors()) {
                        survey.doComplete();
                        // $(this).unbind('click').click();
                    }
                });
EOT;

        return parent::render();

    }
}