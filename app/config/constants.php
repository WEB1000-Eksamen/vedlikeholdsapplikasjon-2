<?php
/**
 * Class containing configurations/constants for this project.
 */
final class Config {
    // Database login info
    public static $DB_HOST_NAME = "localhost";
    public static $DB_USER_NAME = "root"; // studentnummer
    public static $DB_USER_PASSWORD = ""; // db passord (samme som phpmyadmin)
    public static $DB_DB_NAME = "web-is-gr11w"; // studentnummer

    // Image upload constants
    public static $UPLOAD_IMAGE_PREFIX = "884604"; // studentnummer
    public static $UPLOAD_PATH = "D:\\Sites\\home.hbv.no\\phptemp\\";
    public static $UPLOAD_MAX_FILESIZE_BYTES = 10000000; // 10mb
    public static $UPLOAD_MAX_DESCRIPTION_LENGTH = 200; // character length
    public static $UPLOAD_VALID_MIME_TYPES = array( "image/gif", "image/jpg", "image/png", "image/jpeg" );

    // Login/register messages
    public static $USER_LOGIN_ERROR = "Feil brukernavn eller passord.";
    public static $USER_COOKIE_VALUE = true;
    public static $UNKNOWN_ERROR = "En uventet feil skjedde.";
    public static $PASSWORD_NOT_MATCHING = "Passordene du skrev inn stemmer ikke overens.";
    public static $REGISTER_USER_DUPLICATE = "Denne brukeren finnes allerede.";
    public static function REGISTER_SUCCESS ($username) {
        return "Brukeren {$username} ble opprettet.";
    }
    public static $USER_NOT_EXIST = "Brukeren finnes ikke.";
    public static function CHANGE_PASSWORD_SUCCESS ($username) {
        return "Passordet til {$username} ble endret.";
    }
}