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
    $.getJSON('Students.json', function(data) {
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

function calculateFinalGrade(student){
    var totalGrade;
    var quiz1 = student.quiz1 / 10;
    var quiz2 = student.quiz2 / 10;
    var midterm = student.midterm / 50;
    var quiz3 = student.quiz3 / 10;
    var quiz4 = student.quiz4 / 10;
    var final = student.final / 100;
    totalGrade = quiz1 * .1 + quiz2 * .1 + midterm * .25 + quiz3 * .1 + quiz4 * .1 + final * .35;
    return totalGrade;
}

//display grade for currently entered login
function displayGrade(student) {
    var totalGrade = calculateFinalGrade(student) * 100;
    $("#gradeDisplay").html("");
    $("#gradeDisplay").append("<p> Grades for " + student.firstname + " " + student.lastname + "</p>");
    $("#gradeDisplay").append("<p> Quiz1: " + student.quiz1 + "/10 </p>");
    $("#gradeDisplay").append("<p> Quiz2: " + student.quiz2 + "/10 </p>");
    $("#gradeDisplay").append("<p> Midterm: " + student.midterm + "/50 </p>");
    $("#gradeDisplay").append("<p> Quiz3: " + student.quiz3 + "/10 </p>");
    $("#gradeDisplay").append("<p> Quiz4: " + student.quiz4 + "/10 </p>");
    $("#gradeDisplay").append("<p> Final: " + student.final + "50 </p>");
    $("#gradeDisplay").append("<p> Total Grade: " + Math.round(totalGrade) + "% </p>");
}