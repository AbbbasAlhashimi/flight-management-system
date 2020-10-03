The Project is a Flight Booking System. It consists of the following:<br>
1- <b>Index page</b> consisting of a Bootstrap form with 6 Columns, a Booking button, adding and removing current reservations.<br>
2- <b>PHP service</b> to perform a simple call select statement and return data if existed.<br>
3- <b>SQL database</b> where records are saved.<br><br>

When the agent press on <i>Make A New Reservation</i> Button, a popup form appears to let the agent fill the flight information.<br>
The user can submit the request by pressing on the <i>Create</i> Button or Cancel by pressing on the <i>Close</i> Button.
Alternatively, the agent could press anywhere outside the form; and the form will be closed automatically. <br>
The Front-end of the project was built using JQuery. When a new reservation is made, an AJAX request passed with request parameters.<br>
<ul>Each Request passes
  <ol><i>URL</i>Of the redirection request like action.php.</ol>
  <ol><i><i>Method Type</i> Whether it's a <b>POST</b> request or a <b>GET</b>request.</i></ol>
    <ol><i>Identifiers</i> Organized by the index Value which is in this case <b>id</b>.</i></ol>
    <ol><i>DataType</i>Where data are stored. it Could be a a Excel data type, JSON, TXT, etc.</i></ol>
    <ol><i>Transaction Status</i>Where only Successful request queries are passed out.</i></ol>
</ul

<br>
Text Editor: Sublime Text<br>
Server: IIS / Xampp<br>
PHP Version 7.0<br>
