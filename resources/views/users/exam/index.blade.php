@extends('layouts.master')

{{-- Link CSS file for this form --}}
<link rel="stylesheet" href="{{ asset('assets/css/users/exam_index.css') }}" />

@section('content')
    <section>
        {{-- Multi-step form --}}
        <form id="multi-step-form" action="{{ route('exam.room') }}" method="GET">
            <!-- Step 1: Choose Category, Levels, Faculty, Programs -->
            <div class="step active" id="step1">
                <p class="inter-abc abc">Step 1: Choose Category, Levels, Faculty, Sub-Faculty</p>
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
                        {{-- @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                        @endforeach --}}
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
                    <label for="sub-faculty">Sub-Faculty:</label>
                    <select id="sub-faculty" name="sub-faculty" required>
                        <option value="">Select Sub-Faculty</option>
                        {{-- @foreach ($faculties as $sub_faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                        @endforeach --}}
                    </select>
                </div>
                <button type="button" class="next-btn" onclick="goToStep2()">
                    Next
                </button>
            </div>
            </div>
            </div>


            <!-- Step 2: Choose Model Details -->
            <div class="step" id="step2">
                <h2>Step 2: Choose Available Model </h2>
                <div>
                    <label for="model">Model:</label>
                    <select id="model" name="model" required>
                        <option value="">Select Model</option>
                        {{-- Subjects will be populated dynamically --}}
                    </select>
                </div>
                <div id="model-details">
                    <!-- Model details will be populated here -->
                </div>

                <table id="model-details-table" class="table">
                    <thead>
                        <tr>
                            <th>Question Category</th>
                            <th>Weightage</th>
                            <th>Subject</th>
                            <th>Calculated Weightage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table rows will be populated here -->
                    </tbody>
                </table>


                <br></br>
                <button type="button" class="prev-btn" onclick="prevStep('step2', 'step1')">
                    Previous
                </button>
                <button type="button" class="next-btn" onclick="nextStep('step2','step3')">
                    Next
                </button>
            </div>

            <!-- Step 3: Confirmation and Redirect -->
            <div class="step" id="step3">
                <h2>Step 3: Confirmation and Redirect to Exam Room</h2>
                <p>Please review your selections:</p>
                <div id="confirmationData">
                    <!-- Confirmation data will be displayed here -->
                </div>
                <br></br>
                <button type="button" class="prev-btn" onclick="prevStep('step3', 'step2')">
                    Previous
                </button>
                <button type="submit" onclick="showLoaderAndSubmit()" class="submit-btn">
                    Confirm and Submit
                    {{-- {{ route('users.exam.form') }} --}}
                </button>
                <br>
                <br>
            </div>
        </form>
    </section>
    <div class="full-page-loader" id="fullPageLoader">
        <div class="loader"></div>
        <div class="progress-container">
            <div class="progress-text">10</div> <!-- Countdown timer -->
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to move to the next step
        function nextStep(currentStepId, nextStepId) {
            $("#" + currentStepId).removeClass("active");
            $("#" + nextStepId).addClass("active");
            displayConfirmationData();
        }
        // Function to move to the previous step
        function prevStep(currentStepId, prevStepId) {
            $("#" + currentStepId).removeClass("active");
            $("#" + prevStepId).addClass("active");
        }

        //load available models while goto step2
        function goToStep2() {
            var categoryId = $("#category option:selected").val();
            var levelId = $("#level option:selected").val();
            var facultyId = $("#faculty option:selected").val();
            var subFacultyId = $("#sub-faculty option:selected").val();

            if (subFacultyId) {
                $.ajax({
                    url: '{{ route('question.models') }}',
                    type: 'GET',
                    data: {
                        category_id: categoryId,
                        level_id: levelId,
                        faculty_id: facultyId,
                        sub_faculty_id: subFacultyId
                    },
                    success: function(response) {
                        $("#model").empty().append(
                            '<option value="">Select Model</option>'); // Clear and add default option

                        // Loop through each model in the response
                        $.each(response, function(index, model) {
                            $("#model").append('<option value="' + model.id + '">' + model.name +
                                '</option>');
                        });

                        // Handle model selection
                        $("#model").change(function() {
                            var selectedModelId = $(this).val();
                            if (selectedModelId) {
                                // Find the selected model by its ID in the response
                                var selectedModel = response.find(function(model) {
                                    return model.id == selectedModelId;
                                });
                                if (selectedModel) {
                                    displayModelDetails(selectedModel);
                                } else {
                                    console.error("Selected model not found in response:",
                                        selectedModelId);
                                }
                            } else {
                                $("#model-details").empty(); // Clear details if no model is selected
                            }
                        });
                    },
                    error: function(xhr) {
                        console.error("AJAX Error:", xhr);
                    }
                });
            } else {
                $("#model").empty().append('<option value="">Select Model</option>'); // Clear and add default option
            }
            nextStep('step1', 'step2');
        }

        function displayModelDetails(model) {
            var detailsHtml = `
        <p><strong>Model ID:</strong> ${model.id}</p>
        <p><strong>Model Name:</strong> ${model.name}</p>
        <p><strong>Full Marks:</strong> ${model.full_mark}</p>
        <p><strong>Pass Marks:</strong> ${model.pass_mark}</p>
        <p><strong>Time Limit:</strong> ${model.time_limit}</p>
        <p><strong>Created At:</strong> ${model.created_at}</p>
        <p><strong>Updated At:</strong> ${model.updated_at}</p>
    `;

            var tableHtml = '';
            if (model.subjects && model.question_categories) {
                for (var i = 0; i < model.subjects.length; i++) {
                    tableHtml += `
                <tr>
                    <td>${model.question_categories[i].name}</td>
                    <td>${model.question_categories[i].weightage}</td>
                    <td>${model.subjects[i].name}</td>
                    <td>${model.question_categories[i].weightage * model.subjects[i].question_count}</td>
                </tr>
            `;
                }
            }

            $("#model-details").html(detailsHtml);
            $("#model-details-table tbody").html(tableHtml);
        }



        // Function to display confirmation data
        function displayConfirmationData() {
            var category = $("#category option:selected").text();
            var level = $("#level option:selected").text();
            var faculty = $("#faculty option:selected").text();
            var sub_faculty = $("#sub-faculty option:selected").text();

            var confirmationHTML = `
            <p>Category: ${category}</p>
            <p>Level: ${level}</p>
            <p>Faculty: ${faculty}</p>
            <p>Sub-Faculty: ${sub_faculty}</p>
        `;
            $("#confirmationData").html(confirmationHTML);
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

            // Load sub-faculties based on faculty selection
            $("#faculty").change(function() {
                var facultyId = $(this).val();
                if (facultyId) {
                    $.ajax({
                        url: '{{ route('faculties.subFaculties', ':faculty') }}'.replace(':faculty',
                            facultyId),
                        type: 'GET',
                        success: function(response) {
                            $("#sub-faculty").empty().append(
                                '<option value="">Select Sub-faculty</option>');
                            $.each(response, function(key, value) {
                                $("#sub-faculty").append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $("#sub-faculty").empty().append('<option value="">Select Sub-Faculty</option>');
                }
            });

        });
        //function loading progress bar
        function showLoaderAndSubmit() {
            document.querySelector('.submit-btn').disabled = true;
            document.getElementById('fullPageLoader').style.display = 'flex';
            let count = 10;
            const countdownElement = document.querySelector('.progress-text');
            const countdownInterval = setInterval(() => {
                countdownElement.textContent = count;
                count--;
                if (count < 0) {
                    clearInterval(countdownInterval);
                    document.querySelector('form').submit();
                }
            }, 1000);
        }
    </script>
@endsection
