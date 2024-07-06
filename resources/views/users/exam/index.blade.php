@extends('layouts.master')

{{-- Link CSS file for this form --}}
<link rel="stylesheet" href="{{ asset('assets/css/users/exampage.css') }}" />

@section('content')
    <section>
        {{-- Multi-step form --}}
        <form id="multi-step-form">
            <!-- Step 1: Choose Category, Levels, Faculty, Programs -->
            <div class="step active" id="step1">
                <h2>Step 1: Choose Category, Levels, Faculty, Programs</h2>
                <div>
                    <label for="category">Category:</label>
                    <select id="category" name="category" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="level">Levels:</label>
                    <select id="level" name="level" required>
                        <option value="">Select Level</option>
                        @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="faculty">Faculty:</label>
                    <select id="faculty" name="faculty" required>
                        <option value="">Select Faculty</option>
                        {{-- @foreach ($faculties as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                        @endforeach --}}
                    </select>
                </div>
                <div>
                    <label for="program">Programs:</label>
                    <select id="program" name="program" required>
                        <option value="">Select Program</option>
                        {{-- Programs will be populated dynamically --}}
                    </select>
                </div>
                <button type="button" class="next-btn" onclick="nextStep('step1', 'step2')">
                    Next
                </button>
            </div>

            <!-- Step 2: Choose Subjects and Details -->
            <div class="step" id="step2">
                <h2>Step 2: Choose Subjects and Details</h2>
                <div>
                    <label for="subject">Subject:</label>
                    <select id="subject" name="subject" required>
                        <option value="">Select Subject</option>
                        {{-- Subjects will be populated dynamically --}}
                    </select>
                </div>
                <div>

                    <label for="questionCategory">Question Category:</label>
                    <select id="questionCategory" name="questionCategory" required>
                        <option value="">Select Question Category</option>
                        {{-- <option value="General">General</option>
                        <option value="Specific">Specific</option> --}}
                    </select>
                </div>
                <div>
                    <label for="questionType">Question Type:</label>
                    <select id="questionType" name="questionType" required>
                        {{-- <option value="">Select Question Type</option>
                        <option value="Long">Long</option>
                        <option value="Very Long">Very Long</option>
                        <option value="Short">Short</option>
                        <option value="Very Short">Very Short</option> --}}
                    </select>
                </div>
                <div>
                    <label for="quantity">Question Quantity:</label>
                    <input type="number" id="quantity" name="quantity" required />
                </div>
                <button type="button" class="add-btn" onclick="addSubject()">
                    Add Subject
                </button>
                <br /><br />



                <label id="calcFullMarks"></label>

                <br />
                <table id="subjectTable" class="subject-table">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Question Category</th>
                            <th>Question Type</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="subjectTableBody">
                        <!-- Selected subjects will be listed here -->
                    </tbody>
                </table>
                <br></br>
                <button type="button" class="prev-btn" onclick="prevStep('step2', 'step1')">
                    Previous
                </button>
                <button type="button" class="next-btn" onclick="goToStep3()">
                    Next
                </button>
            </div>

            <!-- Step 3: Confirmation and Redirect -->
            <div class="step" id="step3">
                <h2>Step 3: Confirmation and Redirect</h2>
                <p>Please review your selections:</p>
                <div id="confirmationData">
                    <!-- Confirmation data will be displayed here -->
                </div>
                <br></br>
                <button type="button" class="prev-btn" onclick="prevStep('step3', 'step2')">
                    Previous
                </button>
                <button type="submit" class="submit-btn">
                    Confirm and Submit
                    {{-- {{ route('users.exam.form') }} --}}
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

        // Function to calculate total weightage from the table and update the label
        function calculateTotalWeightage() {
            var totalWeightage = 0;
            $("#subjectTableBody tr").each(function() {
                var currentQuantity = parseInt($(this).find("td:eq(3)").text());
                var currentWeightage = parseInt($(this).find("td:eq(2)").text().split(' - ')[1].split(' ')[0]);
                totalWeightage += currentQuantity * currentWeightage;
            });
            $("#calcFullMarks").text("Calculated Full Marks: " + totalWeightage);
            return totalWeightage;
        }

        // Function to add subject to the table
        function addSubject() {
            var subject = $("#subject").val();
            var subjectName = $("#subject option:selected").text(); // retrieve subject name

            var questionCategory = $("#questionCategory").val();
            var questionCategoryName = $("#questionCategory option:selected").text();

            var questionType = $("#questionType").val();
            var questionTypeName = $("#questionType option:selected").text();

            var quantity = $("#quantity").val();
            var weightage = parseInt($("#questionType option:selected").text().split(' - ')[1].split(' ')[
                0]); // retrieve weightage

            // Check if total weightage exceeds 100
            var totalWeightage = calculateTotalWeightage();
            var newWeightage = parseInt(quantity) * weightage;

            if (totalWeightage + newWeightage > 100) {
                alert("You can't add more because full marks exceed 100.");
                return; // Exit the function if total weightage exceeds 100
            }

            if (subject && quantity && questionCategory && questionType) {
                var row = `
                <tr>
                    <td>${subjectName}</td>
                    <td>${questionCategoryName}</td>
                    <td>${questionTypeName}</td>
                    <td>${quantity}</td>
                    <td><button type="button" class="remove-btn" onclick="removeSubject(this)">Remove</button></td>
                </tr>
            `;
                $("#subjectTableBody").append(row);

                // Clear input fields after adding subject
                $("#subject").val("");
                $("#questionCategory").val("");
                $("#questionType").val("");
                $("#quantity").val("");

                // Update the total weightage after adding a subject
                calculateTotalWeightage();
            }
        }

        // Function to remove subject from the table
        function removeSubject(button) {
            $(button).closest("tr").remove();
            // Update the total weightage after removing a subject
            calculateTotalWeightage();
        }

        // Function to display confirmation data
        function displayConfirmationData() {
            var category = $("#category option:selected").text();
            var level = $("#level option:selected").text();
            var faculty = $("#faculty option:selected").text();
            var program = $("#program option:selected").text();
            var calcFullMarks = $("#calcFullMarks").text();

            var subjectsHTML = "";
            $("#subjectTableBody tr").each(function(index) {
                var subject = $(this).find("td:eq(0)").text();
                var questionCategory = $(this).find("td:eq(1)").text();
                var questionType = $(this).find("td:eq(2)").text().split(' - ')[
                    0]; // Remove the marks from the displayed confirmation
                var quantity = $(this).find("td:eq(3)").text();

                subjectsHTML += `
                <tr>
                    <td>${subject}</td>
                    <td>${questionCategory}</td>
                    <td>${questionType}</td>
                    <td>${quantity}</td>
                </tr>
            `;
            });

            var confirmationHTML = `
            <p>Category: ${category}</p>
            <p>Level: ${level}</p>
            <p>Faculty: ${faculty}</p>
            <p>Program: ${program}</p>
            <p> ${calcFullMarks}</p>
            <table>
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Question Category</th>
                        <th>Question Type</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    ${subjectsHTML}
                </tbody>
            </table>
        `;
            $("#confirmationData").html(confirmationHTML);
        }

        // Function to go to Step 3 and display confirmation data
        function goToStep3() {
            // Check if total weightage is at least 100 marks
            var totalWeightage = calculateTotalWeightage();
            if (totalWeightage < 100) {
                alert("Total weightage should be at least 100 marks.");
                return;
            }
            displayConfirmationData();
            nextStep('step2', 'step3');
        }

        // Submit handler for the form
        $("#multi-step-form").submit(function(e) {
            e.preventDefault();
            // Add your form submission logic here
            alert('Form submitted successfully!');
        });

        // AJAX requests to populate options dynamically
        $(document).ready(function() {
            // Load levels based on category selection
            $("#category").change(function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: '{{ route('categories.levels', ':category') }}'.replace(':category',
                            categoryId),
                        type: 'GET',
                        success: function(response) {
                            $("#level").empty().append(
                                '<option value="">Select Level</option>');
                            $.each(response, function(key, value) {
                                $("#level").append('<option value="' + value.id + '">' +
                                    value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $("#level").empty().append('<option value="">Select Level</option>');
                }
            });

            // Load faculties based on category selection
            $("#category").change(function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: '{{ route('categories.faculties', ':category') }}'.replace(':category',
                            categoryId),
                        type: 'GET',
                        success: function(response) {
                            $("#faculty").empty().append(
                                '<option value="">Select Faculty</option>');
                            $.each(response, function(key, value) {
                                $("#faculty").append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $("#faculty").empty().append('<option value="">Select Faculty</option>');
                }
            });

            // Load programs based on faculty selection
            $("#faculty").change(function() {
                var facultyId = $(this).val();
                if (facultyId) {
                    $.ajax({
                        url: '{{ route('faculties.programs', ':faculty') }}'.replace(':faculty',
                            facultyId),
                        type: 'GET',
                        success: function(response) {
                            $("#program").empty().append(
                                '<option value="">Select Program</option>');
                            $.each(response, function(key, value) {
                                $("#program").append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $("#program").empty().append('<option value="">Select Program</option>');
                }
            });

            // Load subjects based on program selection
            $("#program").change(function() {
                var programId = $(this).val();
                if (programId) {
                    $.ajax({
                        url: '{{ route('programs.subjects', ':program') }}'.replace(':program',
                            programId),
                        type: 'GET',
                        success: function(response) {
                            $("#subject").empty().append(
                                '<option value="">Select Subject</option>');
                            $.each(response, function(key, value) {
                                $("#subject").append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $("#subject").empty().append('<option value="">Select Subject</option>');
                }
            });

            // Load Question Category Available based on Subject selection From Questions Database
            $("#subject").change(function() {
                var subjectId = $(this).val();
                if (subjectId) {
                    $.ajax({
                        url: '{{ route('subjects.QsnCategory', ':subject') }}'.replace(
                            ':subject', subjectId),
                        type: 'GET',
                        success: function(response) {
                            $("#questionCategory").empty().append(
                                '<option value="">Select Category</option>');
                            $.each(response, function(key, value) {
                                $("#questionCategory").append('<option value="' + value
                                    .id + '">' + value.type + '</option>');
                            });

                            $("#questionType").empty().append(
                                '<option value="">Select Type</option>');
                            $.each(response, function(key, value) {
                                $("#questionType").append('<option value="' + value.id +
                                    '">' + value.name + ' - ' + value.weightage +
                                    ' marks' + '</option>');
                            });
                        }
                    });
                } else {
                    $("#questionCategory").empty().append(
                        '<option value="">Select Question Category Type</option>');
                    $("#questionType").empty().append('<option value="">Select Question Type</option>');
                }
            });
        });
    </script>
@endsection
