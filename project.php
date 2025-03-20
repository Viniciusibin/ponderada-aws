<?php include "../inc/dbinfo.inc"; ?>
<html>
<body>
<h1>Sample page</h1>
<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  /* Ensure that the EMPLOYEES table exists. */
  VerifyEmployeesTable($connection, DB_DATABASE);

  /* Ensure that the PROJECTS table exists. */
  VerifyProjectsTable($connection, DB_DATABASE);

  /* If input fields are populated, add a row to the EMPLOYEES table. */
  $employee_name = htmlentities($_POST['NAME']);
  $employee_address = htmlentities($_POST['ADDRESS']);

  if (strlen($employee_name) || strlen($employee_address)) {
    AddEmployee($connection, $employee_name, $employee_address);
  }

  /* If input fields are populated, add a row to the PROJECTS table. */
  $project_name = htmlentities($_POST['PROJECT_NAME']);
  $project_description = htmlentities($_POST['PROJECT_DESCRIPTION']);
  $project_start_date = htmlentities($_POST['PROJECT_START_DATE']);
  $project_end_date = htmlentities($_POST['PROJECT_END_DATE']);
  $project_status = htmlentities($_POST['PROJECT_STATUS']);

  if (strlen($project_name) || strlen($project_description) || strlen($project_start_date) || strlen($project_end_date) || strlen($project_status)) {
    AddProject($connection, $project_name, $project_description, $project_start_date, $project_end_date, $project_status);
  }
?>

<!-- Input form for EMPLOYEES -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>NAME</td>
      <td><input type="text" name="NAME" maxlength="45" size="30" /></td>
    </tr>
    <tr>
      <td>ADDRESS</td>
      <td><input type="text" name="ADDRESS" maxlength="90" size="60" /></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" value="Add Employee" /></td>
    </tr>
  </table>
</form>

<!-- Input form for PROJECTS -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>PROJECT_NAME</td>
      <td><input type="text" name="PROJECT_NAME" maxlength="45" size="30" /></td>
    </tr>
    <tr>
      <td>PROJECT_DESCRIPTION</td>
      <td><input type="text" name="PROJECT_DESCRIPTION" maxlength="255" size="60" /></td>
    </tr>
    <tr>
      <td>PROJECT_START_DATE</td>
      <td><input type="date" name="PROJECT_START_DATE" /></td>
    </tr>
    <tr>
      <td>PROJECT_END_DATE</td>
      <td><input type="date" name="PROJECT_END_DATE" /></td>
    </tr>
    <tr>
      <td>PROJECT_STATUS</td>
      <td>
        <select name="PROJECT_STATUS">
          <option value="Not Started">Not Started</option>
          <option value="In Progress">In Progress</option>
          <option value="Completed">Completed</option>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" value="Add Project" /></td>
    </tr>
  </table>
</form>

<?php

/* Function to verify the EMPLOYEES table exists, and if not, create it. */
function VerifyEmployeesTable($connection, $dbName) {
  if (!TableExists("EMPLOYEES", $connection, $dbName)) {
    $query = "CREATE TABLE EMPLOYEES (
        ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        NAME VARCHAR(45),
        ADDRESS VARCHAR(90)
      )";

    if (!mysqli_query($connection, $query)) echo("Error creating table: " . mysqli_error($connection));
  }
}

/* Function to verify the PROJECTS table exists, and if not, create it. */
function VerifyProjectsTable($connection, $dbName) {
  if (!TableExists("PROJECTS", $connection, $dbName)) {
    $query = "CREATE TABLE PROJECTS (
        ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        PROJECT_NAME VARCHAR(45),
        PROJECT_DESCRIPTION VARCHAR(255),
        PROJECT_START_DATE DATE,
        PROJECT_END_DATE DATE,
        PROJECT_STATUS VARCHAR(20)
      )";

    if (!mysqli_query($connection, $query)) echo("Error creating table: " . mysqli_error($connection));
  }
}

/* Function to check if a table exists. */
function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);

  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

  if(mysqli_num_rows($checktable) > 0) return true;

  return false;
}

/* Function to add an employee to the EMPLOYEES table. */
function AddEmployee($connection, $name, $address) {
  $n = mysqli_real_escape_string($connection, $name);
  $a = mysqli_real_escape_string($connection, $address);

  $query = "INSERT INTO EMPLOYEES (NAME, ADDRESS) VALUES ('$n', '$a');";

  if(!mysqli_query($connection, $query)) echo("Error adding employee: " . mysqli_error($connection));
}

/* Function to add a project to the PROJECTS table. */
function AddProject($connection, $name, $description, $start_date, $end_date, $status) {
  $n = mysqli_real_escape_string($connection, $name);
  $d = mysqli_real_escape_string($connection, $description);
  $sd = mysqli_real_escape_string($connection, $start_date);
  $ed = mysqli_real_escape_string($connection, $end_date);
  $s = mysqli_real_escape_string($connection, $status);

  $query = "INSERT INTO PROJECTS (PROJECT_NAME, PROJECT_DESCRIPTION, PROJECT_START_DATE, PROJECT_END_DATE, PROJECT_STATUS) VALUES ('$n', '$d', '$sd', '$ed', '$s');";

  if(!mysqli_query($connection, $query)) echo("Error adding project: " . mysqli_error($connection));
}

/* List all employees */
$result = mysqli_query($connection, "SELECT * FROM EMPLOYEES");

echo "<h2>Employees</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Name</th><th>Address</th></tr>";

while($row = mysqli_fetch_assoc($result)) {
  echo "<tr><td>" . $row['ID'] . "</td><td>" . $row['NAME'] . "</td><td>" . $row['ADDRESS'] . "</td></tr>";
}
echo "</table>";

/* List all projects */
$result = mysqli_query($connection, "SELECT * FROM PROJECTS");

echo "<h2>Projects</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Project Name</th><th>Description</th><th>Start Date</th><th>End Date</th><th>Status</th></tr>";

while($row = mysqli_fetch_assoc($result)) {
  echo "<tr><td>" . $row['ID'] . "</td><td>" . $row['PROJECT_NAME'] . "</td><td>" . $row['PROJECT_DESCRIPTION'] . "</td><td>" . $row['PROJECT_START_DATE'] . "</td><td>" . $row['PROJECT_END_DATE'] . "</td><td>" . $row['PROJECT_STATUS'] . "</td></tr>";
}
echo "</table>";

mysqli_close($connection);
?>
</body>
</html>