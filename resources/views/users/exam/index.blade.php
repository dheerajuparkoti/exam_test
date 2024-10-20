@extends('layouts.master')

{{-- Link CSS file for this form --}}
<link rel="stylesheet" href="{{ asset('assets/css/users/exam_index.css') }}" />

@section('content')
    <section>
        {{-- Multi-step form --}}
        <form id="multi-step-form" action="{{ route('exam.room') }}" method="POST">
            @csrf

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
                            <th>Subject</th>
                            <th>Question Category</th>
                            <th>No. of Questions</th>
                            <th>Weightage</th>
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
                    {{-- {{ route('exam.room') }} --}}
                </button>
                <br>
                <br>
            </div>
             <!-- Hidden inputs to store the model details -->
             <input type="hidden" id="full_mark" name="full_mark">
             <input type="hidden" id="pass_mark" name="pass_mark">          
             <input type="hidden" id="time_limit" name="time_limit">
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
                    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
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

                        $.each(response.models, function(index, model) {
                            $("#model").append('<option value="' + model.id + '">' + model.name +
                                '</option>');
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
        $("#model").change(function() {
            var selectedModelId = $(this).val();
            if (selectedModelId) {
                $.ajax({
                    url: '{{ route('question.models.distribution') }}',
                    type: 'GET',
          
                    data: {
                        model_id: selectedModelId,
                    },
                    success: function(response) {
                        console.log(response);
                        displayModelDetails(response);
                    },
                    error: function(xhr) {
                        console.error("AJAX Error:", xhr);
                    }
                });
            } else {
                $("#model-details").empty();
                $("#model-details-table tbody").empty();
            }

        });

        function displayModelDetails(response) {
            var detailsHtml = `
                <p><strong>Model Name:</strong> ${response.model.name}</p>
                <p><strong>Full Marks:</strong> ${response.model.full_mark}</p>
                <p><strong>Pass Marks:</strong> ${response.model.pass_mark}</p>
                <p><strong>Time Limit:</strong> ${response.model.time_limit}</p>
            `;
            var tableHtml = '';
            if (response.data) {
                $.each(response.data, function(sKey, subject) {
                    $.each(subject, function(cKey, category) {
                        tableHtml += `
                            <tr>
                                <td>${sKey}</td>
                                <td>${cKey}</td>
                                <td>${category.weightage}</td>
                                <td>${category.count}</td>
                                <td>${category.weightage*category.count}</td>
                             </tr>
                        `;
                    });
                });
            }

            $("#model-details").html(detailsHtml);
            $("#model-details-table tbody").html(tableHtml);
              // Set hidden inputs with the model details
              $("#full_mark").val(response.model.full_mark);
            $("#pass_mark").val(response.model.pass_mark);
            $("#time_limit").val(response.model.time_limit);
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
        function showLoaderAndSubmit() {
            // Disable the submit button to prevent multiple submissions
            document.querySelector('.submit-btn').disabled = true;

            // Show the loader
            document.getElementById('fullPageLoader').style.display = 'flex';

            let count = 10;
            const countdownElement = document.querySelector('.progress-text');
            const countdownInterval = setInterval(() => {
                countdownElement.textContent = count;
                count--;

                if (count < 0) {
                    clearInterval(countdownInterval);  // Stop countdown
                    document.getElementById('multi-step-form').submit();  // Submit form after countdown
                }
            }, 1000);  // Countdown every second
        }

        // Form submission event
        $("#multi-step-form").submit(function (e) {
            e.preventDefault();  // Prevent default form submission (you can remove this if you want default behavior)

            // Optional: Add any additional validation or actions before submission
            alert('Form submitted successfully!');

            // Call the countdown and loader function to show the loader and submit the form
            showLoaderAndSubmit();
        });
    </script>
@endsection
