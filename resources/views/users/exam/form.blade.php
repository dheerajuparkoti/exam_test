@extends('layouts.master')
{{-- link css file for this form --}}
<link rel="stylesheet" href="{{ asset('assets/css/users') }}/exampage.css" />

@section('content')
    <section>
        @foreach ($exams as $exam)
            <p>{{ $exam->name }}</p>
            <p>{{ $exam->id }}</p>
        @endforeach
        {{-- multi step form  --}}
        <form id="multi-step-form">
            <!-- Step 1: Enter Marks and Time -->
            <div class="step active" id="step1">
                <h2>Step 1: Enter Marks and Time</h2>
                <div>
                    <label for="fullMarks">Full Marks:</label>
                    <input type="number" id="fullMarks" name="fullMarks" required />
                </div>
                <div>
                    <label for="passMarks">Pass Marks:</label>
                    <input type="number" id="passMarks" name="passMarks" required />
                </div>
                <div>
                    <label for="time">Time (minutes):</label>
                    <input type="number" id="time" name="time" required />
                </div>
                <button type="button" class="next-btn" onclick="nextStep('step1', 'step2')">
                    Next
                </button>
            </div>

            <!-- Step 2: Choose Category, Levels, Faculty, Programs -->
            <div class="step" id="step2">
                <h2>Step 2: Choose Category, Levels, Faculty, Programs</h2>
                <div>
                    <label for="category">Category:</label>
                    <select id="category" name="category" required>
                        <option value="">Select Category</option>
                        <!-- Options populated dynamically -->
                    </select>
                </div>
                <div>
                    <label for="level">Levels:</label>
                    <select id="level" name="level" required>
                        <option value="">Select Level</option>
                        <!-- Options populated dynamically -->
                    </select>
                </div>
                <div>
                    <label for="faculty">Faculty:</label>
                    <select id="faculty" name="faculty" required>
                        <option value="">Select Faculty</option>
                        <!-- Options populated dynamically -->
                    </select>
                </div>
                <div>
                    <label for="program">Programs:</label>
                    <select id="program" name="program" required>
                        <option value="">Select Program</option>
                        <!-- Options populated dynamically -->
                    </select>
                </div>
                <button type="button" class="prev-btn" onclick="prevStep('step2', 'step1')">
                    Previous
                </button>
                <button type="button" class="next-btn" onclick="nextStep('step2', 'step3')">
                    Next
                </button>
            </div>

            <!-- Step 3: Choose Subjects and Details -->
            <div class="step" id="step3">
                <h2>Step 3: Choose Subjects and Details</h2>
                <div>
                    <label for="subject">Subject:</label>
                    <select id="subject" name="subject" required>
                        <option value="">Select Subject</option>
                        <!-- Options populated dynamically -->
                    </select>
                </div>
                <div>
                    <label for="quantity">Question Quantity:</label>
                    <input type="number" id="quantity" name="quantity" required />
                </div>
                <div>
                    <label for="questionCategory">Question Category:</label>
                    <select id="questionCategory" name="questionCategory" required>
                        <option value="">Select Question Category</option>
                        <option value="General">General</option>
                        <option value="Specific">Specific</option>
                    </select>
                </div>
                <div>
                    <label for="questionType">Question Type:</label>
                    <select id="questionType" name="questionType" required>
                        <option value="">Select Question Type</option>
                        <option value="Long">Long</option>
                        <option value="Very Long">Very Long</option>
                        <option value="Short">Short</option>
                        <option value="Very Short">Very Short</option>
                    </select>
                </div>
                <button type="button" class="add-btn" onclick="addSubject()">
                    Add Subject
                </button>
                <br /><br />
                <table id="subjectTable" class="subject-table">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Quantity</th>
                            <th>Question Category</th>
                            <th>Question Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="subjectTableBody">
                        <!-- Selected subjects will be listed here -->
                    </tbody>
                </table>
                <button type="button" class="prev-btn" onclick="prevStep('step3', 'step2')">
                    Previous
                </button>
                <button type="button" class="next-btn" onclick="nextStep('step3', 'step4')">
                    Next
                </button>
            </div>

            <!-- Step 4: Confirmation and Redirect -->
            <div class="step" id="step4">
                <h2>Step 4: Confirmation and Redirect</h2>
                <p>Please review your selections:</p>
                <div id="confirmationData">
                    <!-- Confirmation data will be displayed here -->
                </div>
                <button type="button" class="prev-btn" onclick="prevStep('step4', 'step3')">
                    Previous
                </button>
                <button type="submit" class="submit-btn">
                    Confirm and Submit
                </button>
            </div>
        </form>
    </section>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
        $("#multi-step-form").submit(function(e) {
            e.preventDefault();
            displayConfirmationData();
            nextStep("step4", "step5"); // Redirect or next step logic
        });

        // AJAX example to populate options dynamically
        $(document).ready(function() {
            // Example AJAX request to fetch categories
            $.ajax({
                url: "/get-categories", // Replace with your Laravel route
                type: "GET",
                success: function(response) {
                    response.forEach(function(category) {
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
            $("#category").change(function() {
                var categoryId = $(this).val();
                $.ajax({
                    url: "/get-levels", // Replace with your Laravel route
                    type: "GET",
                    data: {
                        category_id: categoryId
                    },
                    success: function(response) {
                        $("#level")
                            .empty()
                            .append(
                                '<option value="">Select Level</option>'
                            );
                        response.forEach(function(level) {
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
            $("#level").change(function() {
                var levelId = $(this).val();
                $.ajax({
                    url: "/get-faculties", // Replace with your Laravel route
                    type: "GET",
                    data: {
                        level_id: levelId
                    },
                    success: function(response) {
                        $("#faculty")
                            .empty()
                            .append(
                                '<option value="">Select Faculty</option>'
                            );
                        response.forEach(function(faculty) {
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
            $("#faculty").change(function() {
                var facultyId = $(this).val();
                $.ajax({
                    url: "/get-programs", // Replace with your Laravel route
                    type: "GET",
                    data: {
                        faculty_id: facultyId
                    },
                    success: function(response) {
                        $("#program")
                            .empty()
                            .append(
                                '<option value="">Select Program</option>'
                            );
                        response.forEach(function(program) {
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
            $("#program").change(function() {
                var programId = $(this).val();
                $.ajax({
                    url: "/get-subjects", // Replace with your Laravel route
                    type: "GET",
                    data: {
                        program_id: programId
                    },
                    success: function(response) {
                        $("#subject")
                            .empty()
                            .append(
                                '<option value="">Select Subject</option>'
                            );
                        response.forEach(function(subject) {
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
    </script>
@endsection
