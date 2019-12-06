if (typeof(Storage) !== "undefined") {
    var current = localStorage.recent;
    if (current) {
        // Hide content
        var tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        } // Remove Active Class 
        var tablink = document.getElementsByClassName("tablink");
        for (i = 0; i < tablink.length; i++) {
            tablink[i].classList.remove("active");
        } // Show Appropriate Content + Add Active Class to appropriate tab
        if (current == "link1")
            document.getElementById("signin").style.display = "block";
        else
            document.getElementById("signup").style.display = "block";
        document.getElementById(current).classList.add("active");
    }
}

function openTab(evt, choice) {
    // Hide All Content
    var tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    } // Remove Active Class
    var tablink = document.getElementsByClassName("tablink");
    for (i = 0; i < tablink.length; i++) {
        tablink[i].classList.remove("active");
    } // Show Appropriate Content + Add Active Class to appropriate tab
    document.getElementById(choice).style.display = "block";
    evt.currentTarget.classList.add("active");
    // Save
    if (typeof(Storage) !== "undefined") {
        localStorage.recent = evt.currentTarget.getAttribute('id');
    }
}

function validateLogin() {
    clearRequiredFields();
    var required = document.getElementsByClassName("required");
    var userid = document.getElementById("loginuserid").value;
    var userpass = document.getElementById("loginuserpass").value;
    var result = true;
    if (userid == "") {
        required[0].innerHTML = "Bu bölüm boş bırakılamaz.";
        result = false;
    }
    if (userpass == "") {
        required[1].innerHTML = "Bu bölüm boş bırakılamaz.";
        result = false;
    }
    return result;
}

function validateRegister() {
    clearRequiredFields();
    var required = document.getElementsByClassName("required");
    var username = document.getElementById("regusername").value;
    var userpass = document.getElementById("reguserpass").value;
    var userpassconfirm = document.getElementById("reguserpassconfirm").value;
    var userid = document.getElementById("loginuserid").value;
    var useremail = document.getElementById("userEmail");
    var result = true;
    if (username == "") {
        required[2].innerHTML = "Bu bölüm boş bırakılamaz.";
        result = false;
    }

    if (userpass == "") {
        required[5].innerHTML = "Bu bölüm boş bırakılamaz.";
        result = false;
    }
    if (userpassconfirm == "") {
        required[6].innerHTML = "Bu bölüm boş bırakılamaz.";
        result = false;
    }
    if (userpass != "" && userpassconfirm != "" && userpass != userpassconfirm) {
        required[5].innerHTML = "Passwords doesn't match.";
        required[6].innerHTML = "Passwords doesn't match.";
        result = false;
    }
    if (useremail == "") {
        required[7].innerHTML = "Bu bölüm boş bırakılamaz.";
        result = false;
    }
    return result;
}

function clearRequiredFields() {
    var required = document.getElementsByClassName("required");
    for (i = 0; i < required.length; i++) {
        required[i].innerHTML = "";
    }
}



/* Email Format
 -----------------> Start <-------------------------------
Matching the beginning of a regular expression --->      /^
 -------------------> Local Part <---------------------------
Doesn't Start with a Special Character --->      [^<>()[\]\\.,;:\s@\"]+
Start with any Character Else --->   (\.[^<>()[\]\\.,;:\s@\"]+)*
Or Anything between Quotes ---->     |(\"\S+\")
 -------------------> Domain <---------------------------
IP Address May be surrounded by squared brackets ---->   (\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])
Or Words and Hyphen included(provided it's not the first or last character) Followed by at least 1 dot then a word (Can be Repeated) Followed by the last word, it must contain 3 characters at most ([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,})
 -------------------> End <---------------------------
Matching the end of a regular expression ---> $/
*/

/* ---------------------------> RegExp Reference <-------------------------------
// All regular expressions start and end with forward slashes.
^ Matches the beginning of the string or line
$ Matches the end of the string or line
* Matches the previous character 0 or more times.
? Matches the previous character 0 or 1 time.
+ Matches the previous character 1 or more times.
\ Indicates that the next character is special and not to be interpreted literally.
[] Indicates range of characters
[^] Any character Not in between brackets.
\s whitespace character
n{x,y} Matches a string that contains a sequence of x to y n's
n{x,} Matches a string that contains a sequence of at least x n's
. Any single character
*/