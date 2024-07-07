<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Interface</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/users/examform.css') }}">
</head>

<body>
    <div class="container-fluid p-0">
        <div class="row no-gutters header">
            <div class="col-12 text-center py-2">
                <span>Powered By: <strong>SoftMine Tech Pvt. Ltd.</strong></span>
            </div>
        </div>
        <div class="row no-gutters main-content">
            <div class="col-md-2 col-sm-3 sidebar-left">
                <div class="timer text-center my-3">00:29:30</div>
                <div class="model-info my-3">
                    <h5>Model Information</h5>
                    <p>Published on: 2024-04-21, 09:15 AM</p>
                    <p>Total Participants: 96</p>
                    <p>Pass Percentage: 65%</p>
                </div>
                <div class="live-score my-3">
                    <h5>Live Score</h5>
                    <p>Name: Reverse Minded<br>Score: 85<br>Time: 25:45 min</p>
                    <p>Name: Dheeraj Uparkoti<br>Score: 56<br>Time: 20:34 min</p>
                    <p>Name: Ram Prasad<br>Score: 60<br>Time: 30:00 min</p>
                </div>
            </div>
            <div class="col-md-8 col-sm-9 quiz-content">
                <div class="row quiz-header py-2">
                    <div class="col-6 quiz-info">
                        <p>Level: Bachelore</p>
                        <p>Faculty: Science & Technology</p>
                        <p>Program: Computer Engineering</p>
                    </div>
                    <div class="col-6 text-right quiz-marks">
                        <p>Full Marks: 100</p>
                        <p>Pass Marks: 40</p>
                        <p>Time: 30 minutes</p>
                    </div>
                </div>
                <div class="question-section my-4">
                    <h2>1. The quote "Day is yours, Night is Mine" is said by</h2>
                    <ul class="options list-unstyled">
                        <li><input type="radio" name="answer" id="option1"><label for="option1"><span
                                    class="option-circle">A</span> Reverse Minded</label></li>
                        <li><input type="radio" name="answer" id="option2"><label for="option2"><span
                                    class="option-circle">B</span> Sir Issac Newton</label></li>
                        <li><input type="radio" name="answer" id="option3"><label for="option3"><span
                                    class="option-circle">C</span> Lok Bdr. Uparkoti</label></li>
                        <li><input type="radio" name="answer" id="option4"><label for="option4"><span
                                    class="option-circle">D</span> Albert Einstein</label></li>
                    </ul>
                </div>
                <div class="navigation-buttons d-flex justify-content-between">
                    <button class="btn btn-warning">Previous</button>
                    <button class="btn btn-danger">Skip</button>
                    <button class="btn btn-warning">Next</button>
                </div>
                <div class="submit-buttons d-flex justify-content-between mt-3">
                    <button class="btn btn-success">Submit</button>
                    <button class="btn btn-danger">Cancel</button>
                </div>
                <div class="note text-center mt-3">Note: Answer will be automatically submitted if you do not complete
                    within time.</div>
            </div>
            <div class="col-md-2 col-sm-3 sidebar-right">
                <div class="answer-status my-3">
                    <h5>Answer Status</h5>
                    <ul class="status list-unstyled d-flex flex-wrap">
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                        <li>4</li>
                        <li>5</li>
                        <li>6</li>
                        <li>7</li>
                        <li>8</li>
                        <li>9</li>
                        <li>10</li>
                        <li class="answered">11</li>
                        <li class="answered">12</li>
                        <li class="answered">13</li>
                        <li class="answered">14</li>
                        <li class="answered">15</li>
                        <li class="current">16</li>
                        <li>17</li>
                        <li>18</li>
                        <li>19</li>
                        <li>20</li>
                    </ul>
                    <div class="summary">
                        <p>Total Questions: 100</p>
                        <p>Answered Questions: 9</p>
                        <p>Skipped Questions: 6</p>
                        <p>Current Question: 16</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-center py-2">&copy; 2024 MCQ for Engineers. All rights reserved.</footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
