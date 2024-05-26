




<!-- Your HTML code here -->


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inbox</title>
<link rel="icon" href="./logo.png" type="image/icon type">
<style>
/* Your CSS styles here */
</style>
</head>
<body>
<a href="compose.php">
    <button>Compose</button>
</a>
<a href="logout.php">
    <button>logout</button>
</a>
<header>
<!-- Your header content -->
</header>

<div class="container">

<table>
<thead>
<tr>
<th>From</th>
<th>Date</th>
<th>Title</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php

//}
//
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

// Check if the user is not logged in, redirect to login page///
//if (!isset($_SESSION['email'])) {
    //  header("Location: login.php");
    // exit();
    //}
    
    // Your inbox content HTML and PHP code goes here
    
    
    
    $server = '{imap.gmail.com:993/imap/ssl}INBOX'; // Corrected IMAP server and mailbox
    $username = 'abhimali656@gmail.com'; // Replace with your email username
    $password = 'artu qhry dwgw vqxx'; // Replace with your email password
    // Attempt to connect to Gmail IMAP server
    $mailbox = imap_open($server, $username, $password);
    if (!$mailbox) {
        die('Cannot connect to Gmail mailbox: ' . imap_last_error());
    }
    // Search for unread emails
    $mail_ids = imap_search($mailbox, 'UNSEEN');
    if ($mail_ids) {
        sort($mail_ids);
        
        foreach ($mail_ids as $mail_id) {
            $header = imap_headerinfo($mailbox, $mail_id);
            $from = $header->from[0]->mailbox . "@" . $header->from[0]->host;
            $date = date("Y-m-d H:i:s", strtotime($header->date));
            $subject = isset($header->subject) ? $header->subject : "<No Subject>";
            echo "<tr>";
            echo "<td>$from</td>";
            echo "<td>$date</td>";
            echo "<td><a href='view_email.php?id=$mail_id'>$subject</a></td>";
            echo "<td><form method='post' action='delete_email.php'><input type='hidden' name='mail_id' value='$mail_id'><button type='submit' class='delete-btn'>Delete</button></form></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4' class='no-emails'>No new emails found.</td></tr>";
    }
    // Close the mailbox connection
    imap_close($mailbox);
    ?>
    
    </tbody>
    
    
    
    </table>
    </div>
    </body>
    </html>
    