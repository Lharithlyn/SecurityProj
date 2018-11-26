//display error message for failed login where username is not found
function displayLoginFail(){
    //console.log("displaying login fail");
    var userName = document.getElementById("username").value;
    $("#gradeDisplay").html("");
    $("#gradeDisplay").append("<p> No login found for user: " + userName + ". Make sure your login information is correct. </p>");
}

//display login fail for incorrect password
function displayLoginFailPassword(){
    //console.log("displaying login fail");
    var userName = document.getElementById("username").value;
    $("#gradeDisplay").html("");
    $("#gradeDisplay").append("<p> Password incorrect for user: " + userName + ". </p>");
}

//check login
function checkLogin() {
    var studentsList = [];
    var studentLogin;
    var userName = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var foundUser = false;
    var passwordCorrect = false;
    var grade = 0;
    $.getJSON('students.json', function(data) {
        $.each(data.students, function(key, student) {
            studentsList.push(student);
        });
        $.each(studentsList, function(key, student){
            if(userName == student.username){
                foundUser = true; 
                if(password == student.password){
                    passwordCorrect = true;
                    //console.log("correct password");
                    grade = student.grade;
                    studentLogin = student;
                }
            }
        });
        if(foundUser == true && passwordCorrect == true){
            //console.log("login successful");
            displayGrade(studentLogin);

        } else if (foundUser == true && passwordCorrect == false){
            displayLoginFailPassword();
        }
         else {
            displayLoginFail();
            //console.log("login unsuccessful");
        }
    });                  
}

//display grade for currently entered login
function displayGrade(student) {
    $("#gradeDisplay").html("");
    $("#gradeDisplay").append("<p> Grades for " + student.firstname + " " + student.lastname + "</p>");
    $("#gradeDisplay").append("<p> Student ID Number: " + student.ID + "</p>");
    $("#gradeDisplay").append("<p> Quiz1: " + student.quiz1 + "% </p>");
    $("#gradeDisplay").append("<p> Quiz2: " + student.quiz2 + "% </p>");
    $("#gradeDisplay").append("<p> Midterm: " + student.midterm + "% </p>");
    $("#gradeDisplay").append("<p> Quiz3: " + student.quiz3 + "% </p>");
    $("#gradeDisplay").append("<p> Quiz4: " + student.quiz4 + "% </p>");
    $("#gradeDisplay").append("<p> Final: " + student.final + "% </p>");
    $("#gradeDisplay").append("<p> Total Grade: " + student.quiz1 + "% </p>");
}