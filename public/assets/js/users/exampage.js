<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>;

// Function to move to the next step
function nextStep(currentStepId, nextStepId) {
    $("#" + currentStepId).removeClass("active");
    $("#" + nextStepId).addClass("active");
}

// Function to move to the previous step
function prevStep(currentStepId, prevStepId) {
    $("#" + currentStepId).removeClass("active");
    $("#" + prevStepId).addClass("active");
}

// Function to add subject to the table
function addSubject() {
    var subject = $("#subject").val();
    var quantity = $("#quantity").val();
    var questionCategory = $("#questionCategory").val();
    var questionType = $("#questionType").val();

    if (subject && quantity && questionCategory && questionType) {
        var row = `
            <tr>
                <td>${subject}</td>
                <td>${quantity}</td>
                <td>${questionCategory}</td>
                <td>${questionType}</td>
                <td><button type="button" class="remove-btn" onclick="removeSubject(this)">Remove</button></td>
            </tr>
        `;
        $("#subjectTableBody").append(row);

        // Clear input fields after adding subject
        $("#subject").val("");
        $("#quantity").val("");
        $("#questionCategory").val("");
        $("#questionType").val("");
    }
}

// Function to remove subject from the table
function removeSubject(button) {
    $(button).closest("tr").remove();
}

// Function to display confirmation data
function displayConfirmationData() {
    var fullMarks = $("#fullMarks").val();
    var passMarks = $("#passMarks").val();
    var time = $("#time").val();
    var category = $("#category").val();
    var level = $("#level").val();
    var faculty = $("#faculty").val();
    var program = $("#program").val();

    var confirmationHTML = `
        <p>Full Marks: ${fullMarks}</p>
        <p>Pass Marks: ${passMarks}</p>
        <p>Time (minutes): ${time}</p>
        <p>Category: ${category}</p>
        <p>Level: ${level}</p>
        <p>Faculty: ${faculty}</p>
        <p>Program: ${program}</p>
        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Quantity</th>
                    <th>Question Category</th>
                    <th>Question Type</th>
                </tr>
            </thead>
            <tbody>
                ${$("#subjectTableBody").html()}
            </tbody>
        </table>
    `;
    $("#confirmationData").html(confirmationHTML);
}

// Submit handler for the form
$("#multi-step-form").submit(function (e) {
    e.preventDefault();
    displayConfirmationData();
    nextStep("step4", "step5"); // Redirect or next step logic
});

// AJAX example to populate options dynamically
$(document).ready(function () {
    // Example AJAX request to fetch categories
    $.ajax({
        url: "/get-categories", // Replace with your Laravel route
        type: "GET",
        success: function (response) {
            response.forEach(function (category) {
                $("#category").append(
                    '<option value="' +
                        category.id +
                        '">' +
                        category.name +
                        "</option>"
                );
            });
        },
    });

    // Example AJAX request to fetch levels based on category selection
    $("#category").change(function () {
        var categoryId = $(this).val();
        $.ajax({
            url: "/get-levels", // Replace with your Laravel route
            type: "GET",
            data: { category_id: categoryId },
            success: function (response) {
                $("#level")
                    .empty()
                    .append('<option value="">Select Level</option>');
                response.forEach(function (level) {
                    $("#level").append(
                        '<option value="' +
                            level.id +
                            '">' +
                            level.name +
                            "</option>"
                    );
                });
            },
        });
    });

    // Example AJAX request to fetch faculties based on level selection
    $("#level").change(function () {
        var levelId = $(this).val();
        $.ajax({
            url: "/get-faculties", // Replace with your Laravel route
            type: "GET",
            data: { level_id: levelId },
            success: function (response) {
                $("#faculty")
                    .empty()
                    .append('<option value="">Select Faculty</option>');
                response.forEach(function (faculty) {
                    $("#faculty").append(
                        '<option value="' +
                            faculty.id +
                            '">' +
                            faculty.name +
                            "</option>"
                    );
                });
            },
        });
    });

    // Example AJAX request to fetch programs based on faculty selection
    $("#faculty").change(function () {
        var facultyId = $(this).val();
        $.ajax({
            url: "/get-programs", // Replace with your Laravel route
            type: "GET",
            data: { faculty_id: facultyId },
            success: function (response) {
                $("#program")
                    .empty()
                    .append('<option value="">Select Program</option>');
                response.forEach(function (program) {
                    $("#program").append(
                        '<option value="' +
                            program.id +
                            '">' +
                            program.name +
                            "</option>"
                    );
                });
            },
        });
    });

    // Example AJAX request to fetch subjects based on program selection
    $("#program").change(function () {
        var programId = $(this).val();
        $.ajax({
            url: "/get-subjects", // Replace with your Laravel route
            type: "GET",
            data: { program_id: programId },
            success: function (response) {
                $("#subject")
                    .empty()
                    .append('<option value="">Select Subject</option>');
                response.forEach(function (subject) {
                    $("#subject").append(
                        '<option value="' +
                            subject.id +
                            '">' +
                            subject.name +
                            "</option>"
                    );
                });
            },
        });
    });
});
