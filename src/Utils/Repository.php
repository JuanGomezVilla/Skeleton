<?php

/**
 * Represents the structure of a repository
 * @author Skeleton
 * @version 1.0.0
 * @method bool is_database_connection()
 * @method bool finish() 
 * @method object get_connection()
 * @method object create_and_run_query()
 * @method object fecth_all()
 * @method object fetch_one()
 */
class Repository {
    
    /**
     * @var connection Store the connection with the database
     */
    private $connection;

    /**
     * Creates a new instance of the class and establish the connection to the database
     */
    public function __construct($databaseName){
        //Directly access the configuration and obtain the name of the database
        global $config;
        $database = $config["databases"][$databaseName];

        //Try to create a connection, handling possible exceptions
        try {
            //Start the connection with the data passed by parameter
            $this->connection = new PDO($database["host"], $database["user"], $database["password"]);
            
            //Set the error mode and prevents values ​​from not being converted correctly
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch(PDOException $error){
            //The connection will receive a null value
            $this->connection = null;
        }        
    }

    /**
     * Returns a boolean indicating whether there is a connection to the database
     * @return bool Mention if there is a connection to the database
     */
    public function is_database_connection(): bool {
        //Returns if different from null
        return $this->connection != null;
    }

    /**
     * End the connection
     */
    public function finish(){
        //Sets the value to null, that is, it empties the variable
        $this->connection = null;
    }

    /**
     * Get the connection with the database
     * @return object Returns the connection
     */
    public function get_connection(){
        //Returns the connection
        return $this->connection;
    }

    private function create_and_run_query($query, $arguments, $type_fetch, $action_type, $show_error=false): mixed {
        //If there is a connection to the database
        if($this->connection != null){
            //Try to run the query
            try {
                //Create the query with the passed text, then executes the query with possible arguments
                $preparedQuery = $this->connection->prepare($query);
                $preparedQuery->execute($arguments);

                //Returns the data according to the fetch type
                return ($action_type == "fetch_all" ? $preparedQuery->fetchAll($type_fetch) : $preparedQuery->fetch($type_fetch));
            } catch(Exception $error){
                //Show error message
                if($show_error) echo $error->getMessage();
                
                //Returns null on error
                return null;
            }
        }
        //Returns null by default
        return null;
    }

    /**
     * Retrieves all data from a query
     * @param $query The SQL query to execute
     * @param $arguments The arguments to apply to the query
     * @param $type_fetch The format in which to return the data
     * @param $show_error Whether to display an error message
     * @return object The results of the query
     */
    function fetch_all($query, $arguments=null, $type_fetch=PDO::FETCH_ASSOC, $show_error=false){
        //Calls the prepared method to perform these operations and fetches the entire result set
        return $this->create_and_run_query($query, $arguments, $type_fetch, "fetch_all", $show_error);
    }

    /**
     * Retrieves a single value from one column
     * @param $query The SQL query to execute
     * @param $arguments The arguments to apply to the query
     * @param $type_fetch The format in which to return the data
     * @param $show_error Whether to display an error message
     * @return object The result of the query
     */
    function fetch_one($query, $arguments=null, $type_fetch=PDO::FETCH_ASSOC, $show_error=false){
        //Calls the prepared method to perform these operations and fetches a single result
        return $this->create_and_run_query($query, $arguments, $type_fetch, "fetch", $show_error);
    }

    /**
     * Run a query to insert, modify or delete. The value to be returned is a boolean.
     * True if it has been processed, false otherwise
     * @param string $query Query content
     * @param array $arguments Arguments Dictionary with query arguments, default null
     * @return bool True if successful, false otherwise
     */
    public function commit($query, $arguments=null, $show_error=false): bool {
        //If there is a connection to the database, try to run the query
        if($this->connection != null){
            try {
                //Create the query with the passed text and executes the query with arguments
                $preparedQuery = $this->connection->prepare($query);
                return $preparedQuery->execute($arguments);
            } catch(Exception $error){
                //Show error message if trigger is activated and return false
                if($show_error) echo $error->getMessage();
                return false;
            }
        }
        //Returns false by default
        return false;
    }
}

?>