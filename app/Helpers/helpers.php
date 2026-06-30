<?php

if (!function_exists('locale_field')) {
    function locale_field($model, $field) {
        $locale = app()->getLocale();
        // For English, use the "_en" variant if exists, otherwise fallback to Dari
        if ($locale === 'en') {
            $translatedField = $field . '_en';
            return $model->$translatedField ?? $model->$field;
        }
        // For Dari ('fa') or Pashto ('ps'), return the original field
        return $model->$field;
    }
}
