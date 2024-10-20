<header>
    <h1><span style="color:#FF0000">MCQ</span> For Engineers</h1>
    <!-- Navigation bar -->
    <nav>
        <button class="menu-toggle" aria-label="Toggle navigation">&#9776;</button>
        <ul class="nav-menu">
            <div class="left-menu">
                <li class="menu-item"><a href="{{ route('dashboard.index') }}" class="menu-link">DASHBOARD</a></li>
                <li class="menu-item"><a href="{{ route('exam.index') }}" class="menu-link">EXAM</a></li>
                <li class="menu-item"><a href="{{ route('oldsets.index') }}" class="menu-link">LIBRARY</a></li>
                <li class="menu-item"><a href="{{ route('history.index') }}" class="menu-link">MY REPORT</a></li>
            </div>
            <div class="right-menu">
                <li class="menu-item">
                    <a>MY ACCOUNT</a>
                    <!-- Dropdown menu for My Account -->
                    <ul id="myAccountDropdown" class="dropdown-menu">
                        <li><a href="#" class="dropdown-item"><span id="username">{{ $username }}</span></a></li>
                        <li><a href="#" class="dropdown-item email-item"><span id="email">{{ $email }}</span></a></li>

                        <li>
                            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item logout-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </div>
        </ul>
    </nav>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myAccountButton = document.querySelector('.right-menu .menu-item > a');
        var myAccountDropdown = document.getElementById('myAccountDropdown');
    
        myAccountButton.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            var isVisible = myAccountDropdown.style.display === 'block';
            // Hide all other dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
                menu.style.display = 'none';
            });
            // Toggle visibility of the clicked dropdown
            myAccountDropdown.style.display = isVisible ? 'none' : 'block';
        });
    
        window.addEventListener('click', function(event) {
            if (!myAccountDropdown.contains(event.target) && !myAccountButton.contains(event.target)) {
                myAccountDropdown.style.display = 'none';
            }
        });
    });


    // logout function 


    document.addEventListener('DOMContentLoaded', () => {
    const logoutButton = document.querySelector('.logout-item');
    if (logoutButton) {
        logoutButton.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent the default form submission
            document.getElementById('logoutForm').submit(); // Submit the form
        });
    }
});

    </script>
    