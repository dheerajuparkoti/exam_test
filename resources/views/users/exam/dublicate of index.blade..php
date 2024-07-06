   @extends('layouts.master')
   <link rel='stylesheet' type='text/css' media='screen' href="{{ asset('assets/css/users') }}/exampage.css">
   @section('content')
       <section>
           <div class="container">
               <!-- Timer and navigation section -->
               <div class="nav-timer">
                   <div class="timer">
                       <span class="clock">00:27:35</span>
                   </div>
                   <div class="nav-buttons">
                       <button class="prev">Prev</button>
                       <button class="next">Next</button>
                   </div>
               </div>

               <!-- Main content section -->
               <main class="main-content">
                   <div class="question">
                       <h2>25. Juristic opinion, writing falls under:</h2>
                       <div class="options">
                           <div class="option"><input type="radio" name="q25" id="a"><label for="a">A.
                                   Historical source of law</label></div>
                           <div class="option"><input type="radio" name="q25" id="b"><label for="b">B.
                                   Legal source of law</label></div>
                           <div class="option"><input type="radio" name="q25" id="c"><label for="c">C.
                                   Secondary source of law</label></div>
                           <div class="option"><input type="radio" name="q25" id="d"><label for="d">D.
                                   Both a and c</label></div>
                       </div>
                   </div>

                   <!-- Question navigation section -->
                   <aside class="question-nav">
                       <div class="question-status">
                           <span>Answered: 23</span>
                           <span>Marked: 0</span>
                           <span>Skipped: 1</span>
                       </div>
                       <div class="question-grid">
                           <button>1</button>
                           <button>2</button>
                           <button>3</button>
                           <!-- Add buttons up to the number of questions -->
                           <button>25</button>
                       </div>
                   </aside>
               </main>

               <!-- Footer section -->
               <footer class="footer">
                   <button class="cancel">CANCEL</button>
                   <button class="submit">SUBMIT</button>
               </footer>
           </div>
       </section>
   @endsection
