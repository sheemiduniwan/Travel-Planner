// HOME link එක click කළ විට උඩටම smooth scroll වීම
const homeLink = document.querySelector('a[href="#hero"]');
if (homeLink) {
    homeLink.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// Check logged in user status and update navigation bar dynamically
document.addEventListener('DOMContentLoaded', function() {
    fetch('auth/check_auth.php')
        .then(response => response.json())
        .then(data => {
            if (data && data.logged_in) {
                const nav = document.getElementById('main-nav');
                if (nav) {
                    const links = nav.querySelectorAll('li a');
                    links.forEach(a => {
                        const href = a.getAttribute('href') || '';
                        if (href.includes('register.php') || href.includes('login.php')) {
                            a.parentElement.remove();
                        }
                    });

                    // Add greeting and logout options
                    const userLi = document.createElement('li');
                    const displayName = data.username ? data.username : 'User';
                    userLi.innerHTML = `<a href="javascript:void(0)"><span title="Hi, ${displayName}">Hi, ${displayName}</span></a>`;
                    nav.appendChild(userLi);

                    const logoutLi = document.createElement('li');
                    logoutLi.innerHTML = `<a href="auth/logout.php"><span title="LogOut">LogOut</span></a>`;
                    nav.appendChild(logoutLi);
                }
            }
        })
        .catch(err => {
            console.log('Auth check error:', err);
        });
});