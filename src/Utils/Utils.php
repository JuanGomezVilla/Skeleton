<?php

/**
 * Class containing useful methods
 * @author JuanGV
 * @version 1.0.0
 * @method bool in_GET()
 * @method bool in_POST()
 * @method bool in_SESSION()
 * @method bool in_COOKIE()
 * @method mixed get_from_GET()
 * @method mixed get_from_POST()
 * @method mixed get_from_SESSION()
 * @method mixed get_from_COOKIE()
 * @method mixed get_json_from_POST()
 * @method mixed get_value_from_array_by_key()
 * @method mixed generate_unique_id()
 * @method void print_json()
 * @method void redirect()
 * @method void set_json_header()
 * @method string return_date_with_format()
 * @method string remove_accents()
 * @method bool is_valid_date_format()
 * @method string clear_text()
 * @method bool is_html()
 * @method bool is_valid_url()
 * @method bool is_valid_email()
 * @method bool contains_spaces()
 * @method bool key_exists_in_array()
 * @method bool is_lowercase()
 * @method bool is_integer_value()
 * @method bool is_valid_textarea()
 * @method bool is_only_numbers_and_letters()
 * @method bool is_only_numbers_letters_spaces()
 */
class Utils {
    /**
     * Method to check if a value with a key exists in the GET
     * @param $key Key in GET
     * @return bool Returns true if exists
     */
    public static function in_GET($key){
        //Returns true if the key is found in the GET
        return isset($_GET[$key]);
    }

    /**
     * Method to check if a value with a key exists in the POST
     * @param $key Key in POST
     * @return bool Returns true if exists
     */
    public static function in_POST($key){
        //Returns true if the key is found in the POST
        return isset($_POST[$key]);
    }

    /**
     * Method to check if a value with a key exists in the SESSION
     * @param $key Key in SESSION
     * @return bool Returns true if exists
     */
    public static function in_SESSION($key){
        //Returns true if the key is found in the SESSION
        return isset($_SESSION[$key]);
    }

    /**
     * Method to check if a value with a key exists in the COOKIE
     * @param $key Key in COOKIE
     * @return bool Returns true if exists
     */
    public static function in_COOKIE($key){
        //Returns true if the key is found in the COOKIE
        return isset($_COOKIE[$key]);
    }

    /**
     * Method that returns an object, if it does not exist in the GET, default value is returned
     * @param $key Key in GET
     * @param $default Default value to return if not exist
     * @return mixed Value associated with the key in GET
     */
    public static function get_from_GET($key, $default = null){
        //Checks if it exists and returns it, otherwise returns a default value
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }

    /**
     * Method that returns an object, if it does not exist in the POST, default value is returned
     * @param $key Key in POST
     * @param $default Default value to return if not exist
     * @return mixed Value associated with the key in POST
     */
    public static function get_from_POST($key, $default = null){
        //Checks if it exists and returns it, otherwise returns a default value
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }

    /**
     * Method that returns an object, if it does not exist in the SESSION, default value is returned
     * @param $key Key in SESSION
     * @param $default Default value to return if not exist
     * @return mixed Value associated with the key in SESSION
     */
    public static function get_from_SESSION($key, $default = null){
        //Checks if it exists and returns it, otherwise returns a default value
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    /**
     * Method that returns an object, if it does not exist in the COOKIE, default value is returned
     * @param $key Key in COOKIE
     * @param $default Default value to return if not exist
     * @return mixed Value associated with the key in COOKIE
     */
    public static function get_from_COOKIE($key, $default = null){
        //Checks if it exists and returns it, otherwise returns a default value
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : $default;
    }

    /**
     * Method that captures the JSON content passed by the POST
     * @return mixed Array as the JSON content
     */
    public static function get_json_from_POST(){
        //Translates the JSON code from the POST to an array and returns it
        return json_decode(file_get_contents("php://input"), true);
    }

    /**
     * Method to return a value if it exists in an array, null otherwise
     * @param $key Key in array
     * @param $data Array to search key
     * @return mixed Returns a value, null otherwise
     */
    public static function get_value_from_array_by_key($key, $data){
        //If the key exists in the array, return the value, else null
        return array_key_exists($key, $data) ? $data[$key] : null;
    }

    /**
     * Method to generate a random id
     * @return mixed Returns a unique id
     */
    public static function generate_unique_id(){
        //Return a generated value
        return vsprintf("%s%s%s%s%s%s%s%s", str_split(bin2hex(random_bytes(16)), 4));
    }

    /**
     * Method that prints a list or an object in JSON format
     * @param $content Object or array
     * @param $pretty_print Allows you to format the text to be written, default false
     */
    public static function print_json($content, $pretty_print = false){
        //Switch to format the JSON code to be printed
        if($pretty_print) echo json_encode($content, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        else echo json_encode($content, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Redirect to a page directly
     * @param $location Landing page
     * @param $replace Replace a previous similar header, or add a second header of the same type
     * @param $response_code The response code, default 0
     */
    public static function redirect($location, $replace = true, $response_code = 0){
        //Set the header and prevent further code from appearing (true, 302)
        header("Location: $location", $replace, $response_code);
        exit();
    }

    /**
     * Set a JSON content header to display it, in UTF8
     */
    public static function set_json_header(){
        //Set the header, and charset UTF8
        header("Content-type: application/json; charset=utf-8;");
    }

    /**
     * Method to return a date in string with a certain format
     * @param $date Date to format
     * @param $format Format to apply on the date
     * @return string Formatted date, will return false on error
     */
    public static function return_date_with_format($date, $format){
        //Create a date from the string, set the format, and return the formatted value
        return date_format(date_create($date), $format);
    }
    
    /**
     * Method to remove accents from a string
     * @param string $value Value to remove accents
     * @return string Value without accents 
     */
    public static function remove_accents($value){
        //Returns the rendered content without accents
        return strtr($value,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
        //return iconv("UTF-8", "ASCII//TRANSLIT//IGNORE", $value);
    }

    /**
     * Function to check if a date complies with a format passed by parameter
     * @param $date Date to check, of type string
     * @param $format Date format to apply, default "Y-m-d"
     * @return bool True if it conforms to the format, false otherwise
     */
    public static function is_valid_date_format(string $date, string $format = "Y-m-d"){
        //Create an object with the date and the format passed by parameter
        $dateObject = DateTime::createFromFormat($format, $date);
        //Check that the data is correct and complies with the format
        return $dateObject && $dateObject->format($format) == $date;
    }

    /**
     * Cleans a text passed by parameter, removing special characters, etc.
     * @param string $text Text content
     * @return string Cleaned up text
     */
    public static function clear_text($text){
        //Remove spaces, escape HTML tags, remove slashes from a string with escaped quotes
        return htmlspecialchars(stripslashes(trim($text)));
    }

    /**
     * Method that returns true if a text contains HTML tags
     * @param string $text Text content
     * @return bool True if contains HTML tags
     */
    public static function is_html($text){
        //Use (bool) on preg_match, return true if is html
        return (bool) preg_match("/<\s?[^\>]*\/?\s?>/i", $text);
    }

    /**
     * Function to check if a url complies with the valid format
     * @param string $url Value to check
     * @return bool True if is valid
     */
    public static function is_valid_url($url){
        //Use a filter function and a regular expression
        return (bool) filter_var($url, FILTER_VALIDATE_URL) && preg_match("/^(https?|http):\/\/([A-Z0-9-]+\.)+[A-Z]{2,6}\/?/i", $url);
    }

    /**
     * Method that returns true if a text is a valid email
     * @param string $email Email text
     * @return bool True if is a valid email
     */
    public static function is_valid_email($email){
        //If the returned text is different from null, it is because the email is valid
        return (bool) filter_var($email, FILTER_VALIDATE_EMAIL) != null;
    }

    /**
     * Method that returns true if a text contains spaces
     * @param string $text Text content
     * @return bool True if contains spaces
     */
    public static function contains_spaces($text){
        //Method to check if a string contains spaces
        return str_contains($text, " ");
    }

    /**
     * Method to check if a key exists in an array, improved version
     * @param $key Key in array
     * @param $data Array to search key
     * @return bool Returns true if exists in array
     */
    public static function key_exists_in_array($key, $data){
        //If the data passed by parameter is null, check it against a null array to avoid errors
        return array_key_exists($key, $data == null ? array() : $data);
    }

    /**
     * Method that returns true if a text is in lowercase
     * @param string $text Text content
     * @return bool True if is in lowercase
     */
    public static function is_lowercase($text){
        //The text is converted to lowercase and compared to the original
        return strtolower($text) == $text;
    }

    /**
     * Method to check if a value passed by parameter is a number and without decimals
     * @param mixed $value Value to check
     * @return bool True if is integer
     */
    public static function is_integer_value($value){
        //Returns the result of the three checks
        return is_numeric($value) && floor($value) == $value;
    }

    /**
     * Método para comprobar por expresión regular si un contenido es una expresión regular
     * @param string $content Contenido a verificar
     * @return bool Verdadero si es contenido es el válido para un textarea
     */
    public static function is_valid_textarea($content){
        //Realiza la comprobación con una expresión regular
        return (bool) preg_match("/^[A-Za-záéíóúÁÉÍÓÚ0-9,.\s\n]+$/", $content);
    }
    
    /**
     * Method that returns true if a text contains only letters and numbers
     * @param $text Text content
     * @return bool True if have only numbers and letters
     */
    public static function is_only_numbers_and_letters($text){
        //Regular expression to check if a text contains only numbers and letters
        return (bool) preg_match("/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/", $text);
    }

    /**
     * Method that returns true if a text contains only letters, numbers and spaces
     * @param $text Text content
     * @return bool True if have only numbers, letters and spaces
     */
    public static function is_only_numbers_letters_spaces($text){
        //Regular expression to check if a text contains only numbers, letters and spaces
        return (bool) preg_match("/^[a-zA-Z0-9 ]*$/", $text);
    }
}

?>