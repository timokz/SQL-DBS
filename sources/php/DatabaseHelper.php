<?php

class DatabaseHelper
{
    // Since the connection details are constant, define them as const
    // We can refer to constants like e.g. DatabaseHelper::username
    const username = 'a11848158'; // use a + your matriculation number
    const password = 'dbs21'; // use your oracle db password
    const con_string = '//oracle-lab.cs.univie.ac.at:1521/lab';

    // Since we need only one connection object, it can be stored in a member variable.
    // $conn is set in the constructor.
    protected $conn;

    // Create connection in the constructor
    public function __construct()
    {
        try {
            // Create connection with the command oci_connect(String(username), String(password), String(connection_string))
            $this->conn = oci_connect(
                DatabaseHelper::username,
                DatabaseHelper::password,
                DatabaseHelper::con_string
            );

            //check if the connection object is != null
            if (!$this->conn) {
                // die(String(message)): stop PHP script and output message:
                die("DB error: Connection can't be established!");
            }

        } catch (Exception $e) {
            die("DB error: {$e->getMessage()}");
        }
    }

    public function __destruct()
    {
        // clean up
        oci_close($this->conn);
    }

    public function selectAllTheater($T_NAME, $ADDRESS, $T_CAPACITY, $PRIVATE_OR_PUBLIC)
    {
        $sql = "SELECT * FROM THEATRE
          WHERE t_Name LIKE '%{$T_NAME}%' 
          AND Address LIKE '%$ADDRESS%'
          AND t_Capacity LIKE '%{$T_CAPACITY}%'
          AND PRIVATE_OR_PUBLIC LIKE '%$PRIVATE_OR_PUBLIC%'";

        $statement = oci_parse($this->conn, $sql);

        // Executes the statement
        oci_execute($statement);

        // Fetches multiple rows from a query into a two-dimensional array
        // Parameters of oci_fetch_all:
        //   $statement: must be executed before
        //   $res: will hold the result after the execution of oci_fetch_all
        //   $skip: it's null because we don't need to skip rows
        //   $maxrows: it's null because we want to fetch all rows
        //   $flag: defines how the result is structured: 'by rows' or 'by columns'
        //      OCI_FETCHSTATEMENT_BY_ROW (The outer array will contain one sub-array per query row)
        //      OCI_FETCHSTATEMENT_BY_COLUMN (The outer array will contain one sub-array per query column. This is the default.)
        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        //clean up;
        oci_free_statement($statement);

        return $res;
    }

    // This function creates and executes a SQL insert statement and returns true or false
    public function insertIntoTheatre($t_name, $Address, $t_capacity, $private_or_public)
    {
        $sql = "INSERT INTO THEATRE (T_NAME, ADDRESS, T_CAPACITY, PRIVATE_OR_PUBLIC) VALUES ('{$t_name}', '{$Address}', '{$t_capacity}','{$private_or_public}')";

        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }

    // Using a Procedure
    // This function uses a SQL procedure to delete a person and returns an errorcode (&errorcode == 1 : OK)
    public function deleteTheatre($t_Name)
    {
        // but to be sure that the $errorcode differs after the execution of our procedure we do it anyway
        $errorcode = 0;

        $sql = 'BEGIN del_theatre(:t_Name, :errorcode); END;';
        $statement = oci_parse($this->conn, $sql);

        //  Bind the parameters
        oci_bind_by_name($statement, ':t_Name', $t_Name);
        oci_bind_by_name($statement, ':errorcode', $errorcode);

        // Execute Statement
        oci_execute($statement);

        //Note: Since we execute COMMIT in our procedure, we don't need to commit it here.
        //@oci_commit($statement); //not necessary

        //Clean Up
        oci_free_statement($statement);

        //$errorcode == 1 => success
        //$errorcode != 1 => Oracle SQL related errorcode;
        return $errorcode;
    }
    public function update_theatre($T_NAME, $ADDRESS, $T_CAPACITY, $PRIVATE_OR_PUBLIC)
    {
        $sql = "UPDATE Theatre SET Address ='$ADDRESS',
                    t_Capacity ='$T_CAPACITY', PRIVATE_OR_PUBLIC = '$PRIVATE_OR_PUBLIC'  WHERE t_Name='$T_NAME'";

        $statement = @oci_parse($this->conn,$sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }
    public function commit(){
        @oci_commit($this->conn);
    }

    //performance
    public function selectAllPerf($P_NAME, $T_NAME, $P_DATE, $DIRECTION,$LANGUAGES){
        $sql = "SELECT * FROM E_PERFORMANCE
        WHERE P_NAME LIKE '%{$P_NAME}%' 
          AND t_Name LIKE '%{$T_NAME}%' 
          AND P_DATE LIKE '%$P_DATE%'
          AND DIRECTION LIKE '%{$DIRECTION}%'
          AND LANGUAGES LIKE '%$LANGUAGES%'";

        $statement = oci_parse($this->conn, $sql);

        // Executes the statement
        oci_execute($statement);

        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        //clean up;
        oci_free_statement($statement);

        return $res;

    }
    public function insertIntoPerf($T_NAME, $P_NAME, $P_DATE, $DIRECTION,$LANGUAGES){
        $sql = "INSERT INTO E_PERFORMANCE (T_NAME, P_NAME, P_DATE, DIRECTION, LANGUAGES) VALUES ('{$T_NAME}', '{$P_NAME}', '{$P_DATE}','{$DIRECTION}','{$LANGUAGES}')";

        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }

    public function upcoming(){
        $sql = "SELECT P_NAME,EP.T_NAME,P_DATE,DIRECTION,LANGUAGES,ADDRESS 
                FROM THEATRE LEFT JOIN E_PERFORMANCE EP on
                    THEATRE.T_NAME = EP.T_NAME
                    WHERE P_DATE BETWEEN CURRENT_DATE AND CURRENT_DATE+14";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);

        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        oci_free_statement($statement);
        return $res;
    }
}
