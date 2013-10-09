<?php

    // First we execute our common code to connection to the database and start the session
    require("common.php");
    
    // This if statement checks to determine whether the registration form has been submitted
    // If it has, then the registration code is run, otherwise the form is displayed
    if(!empty($_POST))
    {
        // Ensure that the user has entered a non-empty username
        if(empty($_POST['name']))
        {
            // Note that die() is generally a terrible way of handling user errors
            // like this.  It is much better to display the error with the form
            // and allow the user to correct their mistake.  However, that is an
            // exercise for you to implement yourself.
            die("Please enter your name.");
        }
        
        // Ensure that the user has entered a non-empty password
        	if(empty($_POST['teamname']))
        {
            	die("Please enter a teamname.");
        }
        	if(empty($_POST['teammate1']))
	{
		die("Please enter your first teammate's name.");
	}
	        if(empty($_POST['teammate2']))
        {
                die("Please enter your second teammate's name.");
        }
        	if(empty($_POST['teammate3']))
        {
                die("Please enter your third teammate's name.");
        }
	        if(empty($_POST['teammate4']))
        {
                die("Please enter your last teammate's name.");
        }

        // Make sure the user entered a valid E-Mail address
        // filter_var is a useful PHP function for validating form input, see:
        // http://us.php.net/manual/en/function.filter-var.php
        // http://us.php.net/manual/en/filter.filters.php
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            die("Invalid E-Mail Address");
        }
        
        // We will use this SQL query to see whether the username entered by the
        // user is already in use.  A SELECT query is used to retrieve data from the database.
        // :username is a special token, we will substitute a real value in its place when
        // we execute the query.
        $query = "
            SELECT
                1
            FROM teams
            WHERE
                teamname = :teamname
        ";
        
        // This contains the definitions for any special tokens that we place in
        // our SQL query.  In this case, we are defining a value for the token
        // :username.  It is possible to insert $_POST['username'] directly into
        // your $query string; however doing so is very insecure and opens your
        // code up to SQL injection exploits.  Using tokens prevents this.
        // For more information on SQL injections, see Wikipedia:
        // http://en.wikipedia.org/wiki/SQL_Injection
        $query_params = array(
            ':teamname' => $_POST['teamname']
        );
        
        try
        {
            // These two statements run the query against your database table.
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code. 
            die("Failed to run query: " . $ex->getMessage());
        }
        
        // The fetch() method returns an array representing the "next" row from
        // the selected results, or false if there are no more rows to fetch.
        $row = $stmt->fetch();
        
        // If a row was returned, then we know a matching username was found in
        // the database already and we should not allow the user to continue.
        if($row)
        {
            die("This teamname is already in use");
        }
        
        // Now we perform the same type of check for the email address, in order
        // to ensure that it is unique.
        $query = "
            SELECT
                1
            FROM teams
            WHERE
                email = :email
        ";
        
        $query_params = array(
            ':email' => $_POST['email']
        );
        
        try
        {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            die("Failed to run query: " . $ex->getMessage());
        }
        
        $row = $stmt->fetch();
        
        if($row)
        {
            die("This email address is already registered");
        }
        
        // An INSERT query is used to add new rows to a database table.
        // Again, we are using special tokens (technically called parameters) to
        // protect against SQL injection attacks.
        $query = "	
            INSERT INTO teams (
                name,
                teamname,
                teammate1,
		teammate2,
		teammate3,
		teammate4,
                email
            ) VALUES (
                :name,
                :teamname,
                :teammate1,
		:teammate2,
		:teammate3,
		:teammate4,
                :email
            )
        ";
        // Next we hash the hash value 65536 more times.  The purpose of this is to
        // protect against brute force attacks.  Now an attacker must compute the hash 65537
        // Here we prepare our tokens for insertion into the SQL query.  We do not
        // store the original password; only the hashed version of it.  We do store
        // the salt (in its plaintext form; this is not a security risk).
        $query_params = array(
            ':name' => $_POST['name'],
            ':teamname' => $teamname,
            ':teammate1' => $teammate1,
	    ':teammate2' => $teammate2,
	    ':teammate3' => $teammate3,
	    ':teammate4' => $teammate4,
            ':email' => $_POST['email']
        );
        
        try
        {
            // Execute the query to create the user
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code. 
            die("Failed to run query: " . $ex->getMessage());
        }
        
        // This redirects the user back to the login page after they register
        header("Location: complete.html");
        
        // Calling die or exit after performing a redirect using the header function
        // is critical.  The rest of your PHP script will continue to execute and
        // will be sent to the user if you do not die or exit.
        die("Redirecting to complete.html");
    }
    
?>
<h1>Register</h1>
<form action="counterstrike.php" method="post">
    Your name:<br>
    <input type="text" name="name" value=""/><br>
    Teamname:<br>
    <input type="text" name="teamname" value=""/><br>
    Teammate 1:<br>
    <input type="text" name="teammate1" value=""/><br>
    Teammate 2:<br>
    <input type="text" name="teammate2" value=""/><br>
    Teammate 3:<br>
    <input type="text" name="teammate3" value=""/><br>
    Teammate 4:<br>
    <input type="text" name="teammate4" value=""/><br>
    Email:<br>
    <input type="text" name="email" value=""/><br><br>
    <input type="submit" value="Submit"/>
    <input type="reset" value="Reset"/>
</form>
