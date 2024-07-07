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
                <p>Timer</p>
            </div>
            <div class = "header-display">
                <div class="left-quiz-info">
                    <p>Level: Bachelore</p>
                    <p>Faculty: Science & Technology</p>
                    <p>Program: Computer Engineering</p>
                </div>
                <div class="right-quiz-info">
                    <p>Full Marks: 100</p>
                    <p>Pass Marks: 40</p>
                    <p>Time: 30 minutes</p>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class=left-aside>
            <div class="la-content">
                <h3>Sidebar</h3>
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

</body>

</html>
