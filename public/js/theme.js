function setTheme(theme) {
    document.documentElement.setAttribute('data-bs-theme', theme);
}

function toggleTheme() {
    const currentTheme = localStorage.getItem('theme') || 'light';
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    localStorage.setItem('theme', newTheme);

    setTheme(newTheme);

    if (themeButton) {
        if (newTheme === 'dark') {
            themeButton.classList.add('ti-moon');
            themeButton.classList.remove('ti-sun-high');
        } else {
            themeButton.classList.add('ti-sun-high');
            themeButton.classList.remove('ti-moon');
        }
    }
}

function initializeTheme() {
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const savedTheme = localStorage.getItem('theme');

    if (themeButton) {
        if (savedTheme) {
            setTheme(savedTheme);
        } else {
            setTheme(prefersDark ? 'dark' : 'light');
        }
    }
}

const themeButton = document.getElementById('themeButton');

if (themeButton) {
    themeButton.addEventListener('click', toggleTheme);
    initializeTheme();
} else {
    Livewire.on('themeChanged', function () {
        location.reload();
    });
}

