<?php
/******************************************
*		Enjazy by Rashid AL Marri
******************************************/


// Language file (Error messages)
// =======================================


// GENERAL ERRORS:
// =======================================
// if the user presses edit button but does not change anything:
define("ERR_POST_EDIT","Error(2): There is nothing to edit");

// =======================================
// POSTS ERRORS:
// =======================================

// If the message or post does not exsist:
define("ERR_POST_EXSIST","Error(1): The post/message does not exsist");

// if the user forgets to write subject of post or message:
define("ERR_POST_ADD_SUB","Error(3): You did not write a subject");

// charters counter,
$char = 10;
define("ERR_POST_CHAR","Error(4): The content must have at least 10 chartars");

// this error can not be made by user, if the message/post does not have direction:
define("ERR_POST_DIR","Error(5): The post does not have direction please inform us if you have this problem");

// =======================================
// SECTIONS ERROR:
// =======================================

// if the user forgets to write sections name:
define("ERR_SEC_NAME","Error(6): Please write the section name");

// if the user wants to update or delete sections but it does not exsist:
define("ERR_SEC_EXSIST","Error(7): The section that you've chosen does not exsist");

// =======================================
// USERS ERROR:
// =======================================

// If the user doesn't write username or password:
define("ERR_USR_LOGIN","Error(8): You need to enter a username and password");

// If the user tries to login with incrrect username:
define("ERR_USR_EXSIST","Error(9): We can\'t find that username. have you registered?");

// If the password is incorrect:
define("ERR_USR_PWD","Error(10): That username/password combination is incorrect");

// If the user doesn't write the username or password:
define("ERR_USR_NODATA","Error(11): No data received!");

?>