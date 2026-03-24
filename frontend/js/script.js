document.addEventListener("DOMContentLoaded", function () {

    const studentList = document.getElementById("studentList");

    fetch("../../backend-php/api/getStudents.php")
        .then(response => response.json())
        .then(data => {

            studentList.innerHTML = '<option value="">Select Student</option>';

            data.forEach(student => {

                let option = document.createElement("option");

                option.value = student.reg_number;
                option.textContent = student.reg_number + " - " + student.fullname;

                studentList.appendChild(option);
            });

        })
        .catch(error => {
            console.error("Error fetching students:", error);
        });

});