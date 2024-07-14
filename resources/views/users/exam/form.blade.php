<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Interface</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/users/examform.css') }}">
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
                    <h6>Level: <span>Bachelore</span></h6>
                    <h6>Faculty: <span>Science & Technology</span></h6>
                    <h6>Program:<span> Computer Engineering</span></h6>
                </div>
                <div class="right-quiz-info">
                    <h6>Full Marks: <span>100</span></h6>
                    <h6>Pass Marks: <span>40</span></h6>
                    <h6>Time:<span> 30 min.</span></h6>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class=left-aside>
            <div class="la-content">
                <div class="model-information">
                    <h5>Model Information</h5>
                    <h6>Published on <br> <span>2024-04-21,09:15 AM</span></h6>
                    <h6>Total Participants <br> <span>96</span></h6>
                    <h6>Pass Percentage <br> <span>65 %</span></h6>
                </div>
                <div class="active-participants">
                    <hr>
                    <h6>
                        Active Participants
                    </h6>
                    <h3 id="participant_no">17</h3>
                    <hr>
                </div>
                <div class="live-score">
                    <h5>
                        Live Score
                    </h5>
                    <div class="load-scorer">
                        @for ($i = 1; $i <= 3; $i++)
                            <h6>Name: <span>Reverse Minded</span></h6>
                            <h6>Score: <span>87</span></h6>
                            <h6>Time: <span>26:42 min</span></h6>
                            <hr>
                        @endfor
                    </div>

                </div>
            </div>
        </div>


        <div class="content">
            <section class="main-content">

                <!-- The Modal -->
                <div id="confirmationModal" class="confirmation-modal">
                    <div class="modal-content">
                        <div class="container">
                            <h1>Confirm Action</h1>
                            <p id="modalMessage">Are you sure you want to proceed ?</p>
                            <div class="clearfix">
                                <button type="button" onclick="closeModal()" class="cancelbtn">Cancel</button>
                                <button type="button" onclick="confirmAction()" class="confirmbtn">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- confirmation model ends --}}

                <div class="question-section">
                    <h5> <span>1.</span> The study of scientic principles to design and build machines,structure is
                        known as
                    </h5>
                </div>
                <div class = "options-section">
                    <button class ="options-button"><span class= "option-1">A</span> Engineering The study of scientic
                        principles to design and
                        build machines,structure</button>
                    <button class ="options-button"><span class= "option-2">B</span> Chemistry</button>
                    <button class ="options-button"><span class= "option-3">C</span> Architecture</button>
                    <button class ="options-button"><span class= "option-4">D</span> Astronomy</button>
                </div>
                <hr>
                <div class ="navigation-button-section">
                    <button class ="prev-btn"> <span>
                            << PREVIOUS</span></button>
                    <button class ="skip-btn"><span>SKIP</span></button>
                    <button class ="next-btn"><span>NEXT >></span></button>
                </div>
                <hr>
                <section class ="answer-description-section">
                    <div class="tab">
                        <button class="tablinks" onclick="openTab(event, 'London')">See description</button>
                        <button class="tablinks" onclick="openTab(event, 'Paris')">Report this question</button>

                    </div>

                    <div id="London" class="tabcontent">
                        <p>London is the capital city of England.</p>
                    </div>

                    <div id="Paris" class="tabcontent">
                        <form action="/user_report_action_page.php">
                            <textarea id="report" name="report" placeholder="Write your suggestions here !! upto 275 characters" maxlength="275"
                                required></textarea>
                            <br>
                            <input type="submit" value="Report Now">
                        </form>
                    </div>
                </section>
            </section>
            <section class  = "submit-content">
                <button id="info-btn"> <span>i</span></button>
                <button class="submit-btn"
                    onclick="openModal('Are you sure you want to submit ?', '/submit-route')"><span>Submit</span></button>
                <button class="cancel-btn"
                    onclick="openModal('Are you sure you want to cancel ?', '/cancel-route')"><span>Cancel</span></button>
            </section>
        </div>
        <div class="right-aside">
            <div class="ra-content">
                <div class="answer-status">
                    <h5>Answer Status</h5>
                    <div class= "mark-buttons">
                        {{-- @for ($i = 1; $i <= $totalQuestions; $i++) --}}
                        @for ($i = 1; $i <= 100; $i++)
                            <button class="button button1">{{ $i }}</button>
                        @endfor
                    </div>
                </div>
                <div class="question-indexes">
                    <hr>
                    <h6><span class= "round-dot1"></span> Total Questions : <span>100</span></h6>

                    <h6><span class= "round-dot2"></span> Answered Questions : <span>9</span></h6>

                    <h6><span class= "round-dot3"></span> Skipped Questions : <span>6</span></h6>

                    <h6><span class= "round-dot4"></span> Current Question : <span>16</span></h6>
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
    <script>
        function startTimer(duration, display) {
            var timer = duration,
                minutes, seconds;
            setInterval(function() {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = 0;
                }
            }, 1000);
        }

        window.onload = function() {
            var thirtyMinutes = 60 * 30,
                display = document.querySelector('#timer');
            startTimer(thirtyMinutes, display);
        };

        // for tablink in answer description and report

        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }


        // confirmation model

        var modal = document.getElementById('confirmationModal');
        var modalMessage = document.getElementById('modalMessage');
        var actionUrl = '';

        function openModal(message, url) {
            modalMessage.textContent = message;
            actionUrl = url;
            modal.style.display = 'block';
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        function confirmAction() {
            window.location.href = actionUrl;
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>

</body>

</html>
