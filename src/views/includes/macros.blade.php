<?php



Form::macro('datepicker', function ($field_name, $field_id, $default_value = '', $style = '') {
    $html = "<div class='input-group' id='{$field_id}Picker' style='".$style."'>";
    $html .= Form::text($field_name, Input::get($field_name, Input::old($field_name, $default_value)), ['id' => $field_id, 'class' => 'form-control', 'data-date-format' => 'DD/MM/YYYY']);
    $html .= '<span class="input-group-addon">';
    $html .= '<span class="glyphicon glyphicon-calendar"></span>';
    $html .= '</span>';
    $html .= '</div>';

    return $html;
});

 Form::macro('calender', function () {
     return '<input type="text" name="start_time" data-date-time />';
 });
