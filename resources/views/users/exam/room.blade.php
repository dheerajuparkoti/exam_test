<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <title>Quiz Interface</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/users/exam_room.css') }}">
</head>


<body>
    <header>
        <div class="top-header">
            <span>Powered By: <strong>E-MCQ</strong></span>
        </div>
        <div class="bottom-header">
            <div class = "timer-display">
                <h5>Timer</h5>
                <h1 id="timer">30:00</h1>
            </div>
            <div class = "header-display">
                <div class="left-quiz-info">
                    <h6>Level: <span>{{$level}}</span></h6>
                    <h6>Faculty: <span>{{$faculty}}</span></h6>
                    <h6>Program: <span>{{$subFaculty}}</span></h6>
                </div>
                <div class="right-quiz-info">
                    <h6>Full Marks: <span>{{$fullMark}}</span></h6>
                    <h6>Pass Marks: <span>{{$passMark}}</span></h6>
                    @php
                    $totalMinutes = $timeLimit;
                    $hours = floor($totalMinutes / 60);
                    $minutes = $totalMinutes % 60;
                @endphp
                   <h6>Time: <span>{{ $hours }} hrs. {{ $minutes }} min.</span></h6>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class=left-aside>
            <div class="la-content">
                <div class="model-information">
                    <h5>Model Information</h5>
                    <h6>Published on <br> <span>{{$publishedDate}}</span></h6>
                    <h6>Total Participants <br> <span>{{$participantCount}}</span></h6>
                    <h6>Pass Percentage <br> <span>{{$passPercentage}}</span></h6>
                </div>
                <div class="active-participants">
                    <hr>
                    <h6>
                        Active Participants
                    </h6>
                    <h3 id="participant_no">1</h3>
                    <hr>
                </div>
                <div class="live-score">
                    <h5>
                        Student Name
                    </h5>
                    <div class="load-scorer">
                        @for ($i = 1; $i <= 1; $i++)
                            <h6><span>{{$username}}</span></h6>
                            {{-- <h6>Score: <span>87</span></h6> --}}
                            {{-- <h6>Time: <span>26:42 min</span></h6> --}}
                            <hr>
                        @endfor
                    </div>

                </div>
            </div>
        </div>


        <div class="content">
            <section class="main-content">

                                <!-- The Modal -->
                                <!-- Result Modal -->
<div id="resultModal" class="result-modal" style="display: none;">
    <div class="modal-content">
        <div class="container">
            <h1>Result</h1>
            <p id="resultMessage"></p>
            <div class="clearfix">
                <button type="button" onclick="closeResultModal()" class="closebtn">Close</button>
            </div>
        </div>
    </div>
</div>

             <!-- Confirmation Modal -->
<div id="confirmationModal" class="confirmation-modal" style="display: none;">
    <div class="modal-content">
        <div class="container">
            <h1>Confirm Action</h1>
            <p id="modalMessage">Are you sure you want to submit?</p>
            <div class="clearfix">
                <button type="button" onclick="closeModal()" class="cancelbtn">Cancel</button>
                <button type="button" onclick="confirmAction()" class="confirmbtn">Confirm</button>
            </div>
        </div>
    </div>
</div>

<form id="confirmationForm" action="{{ route('submit.quiz') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="totalQuestion" value=""> <!-- Will be updated dynamically -->
    <input type="hidden" name="totalSkippedQsn" value=""> <!-- Will be updated dynamically -->
    <input type="hidden" name="totalAnsweredQsn" value=""> <!-- Will be updated dynamically -->
    <input type="hidden" name="totalObtainedMarks" value=""> <!-- Will be updated dynamically -->
    <input type="hidden" name="totalCorrectCount" value=""> <!-- Will be updated dynamically -->
    <input type="hidden" name="user_id" value="{{$user_id}}"> <!-- Will be updated dynamically -->
    <input type="hidden" name="qsn_model_id" value="{{$qsn_model_id}}"> <!-- Will be updated dynamically -->
     <!-- URL Parameters as Hidden Fields -->
     <input type="hidden" name="category" value="{{ $category }}">
     <input type="hidden" name="level" value="{{ $level }}">
     <input type="hidden" name="faculty" value="{{ $faculty }}">
     <input type="hidden" name="sub_faculty" value="{{ $subFaculty }}">


    
   
</form>




                {{-- confirmation model ends --}}

                <div class="question-section">
                    <h5> <span id="current_qsn_no"></span> <span id="question_title"></span>
                    </h5>
                </div>
                <div class = "options-section">
                    <button class ="options-button"><span class= "option-alphabet">A</span> <span
                            id="option-1"></span></button>
                    <button class ="options-button"><span class= "option-alphabet">B</span> <span
                            id="option-2"></span></button>
                    <button class ="options-button"><span class= "option-alphabet">C</span> <span
                            id="option-3"></span></button>
                    <button class ="options-button"><span class= "option-alphabet">D</span> <span
                            id="option-4"></span></button>
                </div>
                <hr>
                <div class ="navigation-button-section">
                    <button class ="prev-btn" onclick="prevQuestion()"> <span>
                            << PREVIOUS</span></button>
                    {{-- <button class ="skip-btn" onclick="skippedQuestion()"><span>SKIP</span></button> --}}
                    <button class ="next-btn" onclick="nextQuestion()"><span>NEXT >></span></button>
                </div>
                <hr>
                <section class ="answer-description-section">
                    <div class="tab">
                        <button class="tablinks" onclick="openTab(event, 'Description')">See description</button>
                        <button class="tablinks" onclick="openTab(event, 'Report')">Report this question</button>

                    </div>

                    <div id="Description" class="tabcontent">
                        <p id="description-text">Click on a question to see its description.</p>
                    </div>

                    <div id="Report" class="tabcontent">
                        <form action="/user_report_faction_page.php">
                            <textarea id="report" name="report" placeholder="Write your suggestions here !! upto 275 characters" maxlength="275"
                                required></textarea>
                            <br>
                            <input type="submit" value="Report Now">
                        </form>
                    </div>
                </section>
            </section>
               <!-- Submit Button -->
<section class="submit-content">
    <button class="submit-btn" onclick="openModal()"><span>Submit</span></button>
    <button class="cancel-btn"
    onclick="openModal('Are you sure you want to cancel ?', '/cancel-route')"><span>Cancel</span></button>
</section>


        </div>
        <div class="right-aside">
            <div class="ra-content">
                <div class="answer-status">
                    <h5>Answer Status</h5>
                    <div class= "mark-buttons" id="mark-buttons">
                        {{-- @for ($i = 1; $i <= $totalQuestions; $i++) --}}
                        {{-- @for ($i = 1; $i <= count - total - qsn; $i++) --}}
                        {{-- <button id="q{{ $i }}"class="button button1">{{ $i }}</button> --}}
                        {{-- @dump("Button ID: q{$i}") --}}
                        {{-- @endfor --}}
                    </div>
                </div>
                <div class="question-indexes">
                    <hr>
                    <h6><span class= "round-dot1"></span> Total Questions : <span id="count-total-qsn"></span></h6>

                    <h6><span class= "round-dot2"></span> Answered Questions : <span id="count-answered-qsn"></span>
                    </h6>

                    <h6><span class= "round-dot3"></span> Skipped Questions : <span id="count-skipped-qsn"></span></h6>

                    <h6><span class= "round-dot4"></span> Current Question : <span id= "track-current-qsn"></span>
                    </h6>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class = "left-footer">
        </div>
        <div class = "right-footer">
            <p>&copy; 2024 MCQ for Engineers. All rights reserved.</p>
        </div>
    </footer>

    {{-- javascripts --}}

    {{-- for count down timer --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // Variables to hold questions and track the current state
        var currentQsnModelId = 2;
        var qsnSN = 0; // Initial question number
        var questions = []; // Array to store all questions
        var userSelections = []; // Array to store user's selected options
        var correctOptions = []; // Array to store correct options for all questions
        var questionWeightages = []; // Array to store weightages of each question
        var countAnsweredQsn = 0;
        var countSkippedQsn = 0;
        var totalQuestions;

        // Load all questions when the page loads
        $(document).ready(function() {
            fetchAllQuestions(); // Fetch all questions once
            bindAnswerStatusButtons(); // Bind click events to status buttons
        });

        // Fetch all questions at once
        function fetchAllQuestions() {
            $.ajax({
                url: '{{ route('load.questions', ':qsn_model_id') }}'.replace(':qsn_model_id', currentQsnModelId),
                method: 'GET',
                success: function(response) {
                    if (response.status === 'success' && response.data.length > 0) {
                        questions = response.data; // Store all questions
                        totalQuestions = response.totalQuestions; // Get total questions count

                        // Populate buttons based on the total questions count
                        var buttonsHtml = '';
                        for (var i = 1; i <= totalQuestions; i++) {
                            buttonsHtml += '<button id="q' + i + '" class="button button1">' + i + '</button>';
                        }
                        $('#mark-buttons').html(buttonsHtml);


                        $('#count-total-qsn').text(totalQuestions); // Display total count
                        displayQuestion(qsnSN); // Display the first question
                        // Save correct options and weightages for all questions
                        questions.forEach((question, index) => {
                            correctOptions[index] = question.correct_option;
                            questionWeightages[index] = parseFloat(question.weightage);
                        });
                        console.log(correctOptions);

                    } else {
                        console.error('No questions available or response status not success.');
                        alert('No questions available. Please try again later.');
                    }
                },
                error: handleError
            });
        }

        // Define the handleError function to manage errors from AJAX requests
        function handleError(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);
            alert('An error occurred while loading the questions. Please try again.');
        }


        // Function to bind click events to the Answer Status buttons
        function bindAnswerStatusButtons() {
            $('#mark-buttons').on('click', 'button', function() {
                var btnId = $(this).attr('id'); // Get the button ID
                var questionNumber = parseInt(btnId.replace('q', '')); // Extract the question number from ID
                jumpToQuestion(questionNumber - 1); // Jump to the question (zero-indexed)
            });
        }

        // Function to jump to a specific question based on button click
        function jumpToQuestion(index) {
            if (index >= 0 && index < questions.length) {
                qsnSN = index; // Update the current question number
                displayQuestion(qsnSN); // Display the selected question
            } else {
                alert('Invalid question number.'); // Error handling in case of an invalid question number
            }
        }
        // Display the question based on the current question number
        function displayQuestion(index) {
            if (index >= 0 && index < questions.length) {
                updateQuestionDisplay(questions[index]);
            }
        }

        // Load the next question from the array
        function loadNextQuestion() {
            if (qsnSN < questions.length - 1) {
                qsnSN++;
                displayQuestion(qsnSN);
            } else {
                alert('This is the last question.');
            }
        }

        // Load the previous question from the array
        function loadPreviousQuestion() {
            if (qsnSN > 0) {
                qsnSN--;
                displayQuestion(qsnSN);

            } else {
                alert('This is the first question.');
            }
        }

        // Update the question display
        function updateQuestionDisplay(question) {
            $('#current_qsn_no').text(qsnSN + 1 + '.');
            $('#question_title').text(question.title);

            // Set options text and bind click events to selectOption with the option text
            $('#option-1').text(question.options[0] || '').off('click').on('click', function() {
                selectOption(0, question.options[0] || '');
            });
            $('#option-2').text(question.options[1] || '').off('click').on('click', function() {
                selectOption(1, question.options[1] || '');
            });
            $('#option-3').text(question.options[2] || '').off('click').on('click', function() {
                selectOption(2, question.options[2] || '');
            });
            $('#option-4').text(question.options[3] || '').off('click').on('click', function() {
                selectOption(3, question.options[3] || '');
            });
            currentQuestion();

            applySelectedOption(qsnSN);
            // Update the description text
            $('#description-text').text(question.description || 'No description available.');
 
        }

        // Function to apply selected option styles
        function applySelectedOption(questionIndex) {
            const selectedOption = userSelections[questionIndex];

            // Remove the 'selected' class from all options
            $('.options-button').removeClass('selected');

            // Add 'selected' class to the previously selected option
            if (selectedOption) {
                const options = questions[questionIndex].options;
                const optionIndex = options.indexOf(selectedOption);
                if (optionIndex !== -1) {
                    $('#option-' + (optionIndex + 1)).closest('button').addClass('selected');
                }
            }
        }

        // Function to handle user selection
        function selectOption(index, optionText) {
            userSelections[qsnSN] = optionText.trim();

            // Update selected button styles
            $('.options-button').removeClass('selected');
            $('#option-' + (index + 1)).closest('button').addClass('selected');

            console.log('User selected option:', optionText, 'for qsnNo:', qsnSN + 1);
        }

        // Update the current question's button color
        function currentQuestion() {
            var btnId = 'q' + (qsnSN + 1);
            $('#' + btnId).css('background-color', '#FEE14B');
            $('#track-current-qsn').text(qsnSN + 1);
        }


        // Navigate to the previous question
        function prevQuestion() {
            loadPreviousQuestion();
            hideAllTabs();
        }
        // Navigate to the next question and update its button color
        function nextQuestion() {
            // Check if the current question has been answered
            if (!userSelections[qsnSN] || userSelections[qsnSN].trim() === "") {
                // If no selection, treat it as skipped
                skippedQuestion();

            } else {
                // If an option is selected, treat it as answered
                countAnsweredQsn++;

                $('#count-answered-qsn').text(countAnsweredQsn);

                // Update the current question's button color to indicate it has been answered
                var btnId = 'q' + (qsnSN + 1);
                $('#' + btnId).css('background-color', '#A1FF9F');
            }

            // Move to the next question
            loadNextQuestion();
            hideAllTabs();
        }


        // Handle skipped question scenario
        function skippedQuestion() {

            // Calculate the maximum allowed skipped questions
            var maxSkippedAllowed = totalQuestions - countAnsweredQsn;

            // Check if skipped questions count can be incremented
            if (countSkippedQsn < maxSkippedAllowed) {
                countSkippedQsn++;
                $('#count-skipped-qsn').text(countSkippedQsn);

                // Mark the current question as skipped
                var btnId = 'q' + (qsnSN + 1);
                $('#' + btnId).css('background-color', '#DE8C8C');

                // Call the function to check answers (optional, depending on your application)
                // checkAnswers();
            } else {
                // Optionally, you can show a message to the user if they attempt to skip more questions than allowed
                alert('Cannot skip more questions. You have reached the limit of skipped questions.');
            }
            hideAllTabs();

        }



        function checkAnswers() {
            console.log("Starting comparison...");
            console.log("User Selections Array:", userSelections);
            console.log("Correct Options Array:", correctOptions);
            console.log("Question Weightages Array:", questionWeightages);

            const arrayLengths = {
                correctOptions: correctOptions.length,
                userSelections: userSelections.length,
                questionWeightages: questionWeightages.length
            };
            console.log("Array Lengths:", arrayLengths);

            let totalObtainedMarks = 0;
            let totalCorrectCount = 0;

            // Iterate through correctOptions to ensure proper comparison
            for (let i = 0; i < correctOptions.length; i++) {
                const userSelection = userSelections[i];
                const correctOption = correctOptions[i];
                const weightage = questionWeightages[i] || 0;

                console.log(
                    `\nIndex: ${i}, User Selected Option: "${userSelection}", Correct Option: "${correctOption}", Weightage: ${weightage}`
                );

                // Check if user selection is empty, undefined, or null
                if (userSelection === undefined || userSelection === null || userSelection.trim() === "") {
                    console.log(`User did not select an option for Question ${i} or selected an empty value.`);
                    // If user selection is empty, check if the correct option is also empty
                    if (correctOption.trim() === "") {
                        console.log(`Empty match found for Question ${i}`);
                        totalObtainedMarks += parseFloat(weightage);
                        totalCorrectCount += 1;
                    } else {
                        console.log(
                            `No match for Question ${i}. Expected: "${correctOption}", but got: "${userSelection}"`);
                    }
                    continue; // Skip further processing for empty cases
                }

                // Compare non-empty user-selected option with the correct option
                if (userSelection.trim() === correctOption.trim()) {
                    console.log(`Match found for Question ${i}`);
                    totalObtainedMarks += parseFloat(weightage);
                    totalCorrectCount += 1;
                } else {
                    console.log(`No match for Question ${i}. Expected: "${correctOption}", but got: "${userSelection}"`);
                }

                console.log(
                    `After comparison - Total Weightage: ${totalObtainedMarks}, Total Correct Count: ${totalCorrectCount}`
                );
            }

            console.log("Final Total Weightage:", totalObtainedMarks);
            console.log("Final Total Correct Count:", totalCorrectCount);

            return {
                totalObtainedMark: totalObtainedMarks,
                totalCorrectCount: totalCorrectCount
            };

        }

// Open the confirmation modal
function openModal() {
    document.getElementById('confirmationModal').style.display = 'block';
}

// Close the confirmation modal
function closeModal() {
    document.getElementById('confirmationModal').style.display = 'none';
}

// Open the result modal
function openResultModal(result) {
    const resultMessage = `
      <p><strong>Total Questions: <span style="font-size: 20px; color: blue;">${ result.totalQuestion}</span></strong></p>
        <p><strong>Total Answered Questions:  <span style="font-size: 20px; color: blue;">${ result.totalAnsweredQsn}</span></strong></p>
        <p><strong>Total Skipped Questions: <span style="font-size: 20px; color: blue;">${ result.totalSkippedQsn}</span></strong></p>
        <p><strong>Total Correct Answers:  <span style="font-size: 20px; color: blue;">${ result.totalCorrectCount}</span></strong></p>
        <p><strong>Total Obtained Marks:  <span style="font-size: 20px; color: blue;">${ result.totalObtainedMarks}</span></strong></p>
    `;
    document.getElementById('resultMessage').innerHTML = resultMessage;
    document.getElementById('resultModal').style.display = 'block';
}

// Close the result modal
function closeResultModal() {
    // Hide the result modal
    document.getElementById('resultModal').style.display = 'none'; 
    // Redirect to the exam-form page
    window.location.href = "{{ route('exam.index') }}"; // Replace with your route URL if needed
}


// Confirm action and submit the form
function confirmAction() {
    // Get the results from checkAnswers()
    const results = checkAnswers();
    const totalObtainedMarks = results.totalObtainedMark;
    const totalCorrectCount = results.totalCorrectCount;

    // Set the values in the hidden form fields
    $('#confirmationForm input[name="totalQuestion"]').val(totalQuestions);
    $('#confirmationForm input[name="totalAnsweredQsn"]').val(countAnsweredQsn);
    $('#confirmationForm input[name="totalSkippedQsn"]').val(countSkippedQsn);
    $('#confirmationForm input[name="totalObtainedMarks"]').val(totalObtainedMarks);
    $('#confirmationForm input[name="totalCorrectCount"]').val(totalCorrectCount);


    // Use AJAX to submit the form data
    $.ajax({
        url: $('#confirmationForm').attr('action'),
        method: $('#confirmationForm').attr('method'),
        data: $('#confirmationForm').serialize(),
        success: function(response) {
            closeModal();
            if (response.status === 'success') {
                // Show the result modal with the response data
                openResultModal(response);
            } else {
                console.error('Submission failed:', response.message);
                // Handle error case if needed
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error:', textStatus, errorThrown);
            // Handle network or other errors
        }
    });
}

function startTimer(duration, display) {
        var timer = duration,
            minutes, seconds;
        var interval = setInterval(function() {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                timer = 0;
                clearInterval(interval); // Stop the timer
                confirmAction(); // Trigger the confirmAction function
            }
        }, 1000);
    }

    window.onload = function() {
        var timeLimitMinutes = {{ $timeLimit }}; // Pass the time limit from your Blade variable
        var timeLimitSeconds = 60 * timeLimitMinutes;
        var display = document.querySelector('#timer');
        startTimer(timeLimitSeconds, display);
    };


//         // confirmation model ends
//         function startTimer(duration, display) {
//     var timer = duration,
//         minutes, seconds;
//     var interval = setInterval(function() {
//         minutes = parseInt(timer / 60, 10);
//         seconds = parseInt(timer % 60, 10);

//         minutes = minutes < 10 ? "0" + minutes : minutes;
//         seconds = seconds < 10 ? "0" + seconds : seconds;

//         display.textContent = minutes + ":" + seconds;

//         if (--timer < 0) {
//             timer = 0;
//             clearInterval(interval); // Stop the timer
//             confirmAction(); // Trigger the confirmAction function
//         }
//     }, 1000);
// }

// window.onload = function() {
//     var thirtyMinutes = 60 * 0.5,
//         display = document.querySelector('#timer');
//     startTimer(thirtyMinutes, display);
// };



        // for tablink in answer description and report
        function openTab(evt, tabName) {
    hideAllTabs(); // Hide all tab content first
    var tab = document.getElementById(tabName);
    if (tab) {
        tab.style.display = "block"; // Show the selected tab content
    } else {
        console.error("No element found with id: " + tabName);
    }
    var tablinks = document.getElementsByClassName("tablinks");
    for (var i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", ""); // Remove active class from all tabs
    }
    evt.currentTarget.className += " active"; // Add active class to the clicked tab
}


function hideAllTabs() {
    var i, tabcontent;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none"; // Hide all tab content
    }
}

    </script>

</body>

</html>
