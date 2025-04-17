<?php
class DateValidator {
    public static function isValidDateRange($from, $until) {
        return strtotime($until) > strtotime($from);
    }
}