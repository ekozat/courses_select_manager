# MySQL

## Sara Adi
**Useful Commands**
Basic SQL Commands:
* SELECT: Used to retrieve data from one or more tables.
* INSERT INTO: Used to insert new records into a table.
* UPDATE: Used to modify existing records in a table.
* DELETE FROM: Used to delete records from a table.


**Table Operations:**
* CREATE TABLE: Used to create a new table with specified columns and data types.
* ALTER TABLE: Used to modify an existing table, such as adding or dropping columns.
* DROP TABLE: Used to delete an existing table and its data.

**Data Retrieval:**
* DISTINCT: Used to retrieve unique values from a column.
* WHERE: Used to filter rows based on specified conditions.
* ORDER BY: Used to sort the result set.
* LIMIT: Used to limit the number of rows returned.

**Joins:**
* INNER JOIN: Combines rows from two or more tables based on a related column.
* LEFT JOIN (or LEFT OUTER JOIN): Retrieves all rows from the left table and matched rows from the right table.
* RIGHT JOIN (or RIGHT OUTER JOIN): Retrieves all rows from the right table and matched rows from the left table.
* FULL JOIN (or FULL OUTER JOIN): Retrieves all rows when there is a match in either the left or right table.

## Maneesh Wijewardhana
-   Our VM uses an open source fork of MySQL called MariaDB
-   To enter the interactive shell, type `sudo mysql` or `sudo mariadb`
-   You can run a command like `SELECT NOW();` to view the output table
    -   Any valid SQL will run in this shell, refer to SQL documentation
-   You can also create .sql files, enter the interactive MySQL shell, and type in `source {path to sql file}` to execute them
-   Exiting the Shell
    -   EXIT; or \q: Exit the MariaDB shell
-   Help and Documentation
    -   HELP; (Display a list of available MariaDB shell commands)
    -   HELP <command>; (Get help and syntax information for a specific command)
