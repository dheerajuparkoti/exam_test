{{-- <!DOCTYPE html>
<html lang="en">

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
            <span>Powered By: <strong>SoftMine Tech Pvt. Ltd.</strong></span>
        </div>
        <div class="bottom-header">
            <span>Timer <strong>SoftMine Tech Pvt. Ltd.</strong></span>
        </div>
    </header>

    <main>
        <aside>
            <div class="left-aside">
                <!-- Left sidebar content -->
            </div>
        </aside>

        <section>
            <!-- Main content -->
        </section>



    </main>

    <footer class="text-center py-2">&copy; 2024 MCQ for Engineers. All rights reserved.</footer>
</body>

</html> --}}

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
                    <h5>
                        Active Participants
                    </h5>
                    <h1 id="participant_no">17</h1>
                    <hr>
                </div>
                <div class="live-score">
                    <h5>
                        Live Score
                    </h5>
                    <div class="load-scorer">
                        <h6>Name: <span>Reverse Minded</span></h6>
                        <h6>Score: <span>87</span></h6>
                        <h6>Time: <span>26:42 min</span></h6>
                        <hr>
                    </div>

                </div>
            </div>
        </div>


        <div class="content">
            <section class="main-content">

            </section>

            <section class  = "submit-content">
            </section>
        </div>

        <div class="right-aside">
            <div class="ra-content">
                <h3>Sidebar</h3>
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
    </script>

</body>

</html>
