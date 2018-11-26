//display error message for failed login where username is not found
function displayLoginFail(){
    document.getElementById('display').innerHTML = "No login found for user: "+ document.getElementById("username").value + ". Make sure your login information is correct.";
}

//display login fail for incorrect password
function displayLoginFailPassword(){
    //console.log("displaying login fail");
    document.getElementById('display').innerHTML = "Password incorrect for user: "+ document.getElementById("username").value + ". ";
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
                    grade = student.grade;
                    studentLogin = student;
                }
            }
        });
        if(foundUser == true && passwordCorrect == true){
            displayGrade(studentLogin);

        } else if (foundUser == true && passwordCorrect == false){
            displayLoginFailPassword();
        }
         else {
            displayLoginFail();
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
    document.getElementById('grades').innerHTML = "Grades for " + student.firstname + " " + student.lastname;
    document.getElementById('quiz1').innerHTML = "Quiz1: " + student.quiz1 + "/10";
    document.getElementById('quiz2').innerHTML = "Quiz2: " + student.quiz2 + "/10";
    document.getElementById('midterm').innerHTML = "Midterm: " + student.midterm + "/50";
    document.getElementById('quiz3').innerHTML = "Quiz3: " + student.quiz3 + "/10";
    document.getElementById('quiz4').innerHTML = "Quiz4: " + student.quiz4 + "/10";
    document.getElementById('final').innerHTML = "Final: " + student.final + "/100";
    document.getElementById('total').innerHTML = "Total Grade: " + Math.round(totalGrade) + "%";
}