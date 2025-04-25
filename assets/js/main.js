// DATE AND TIME

const date = document.getElementById('currentDate');
const time = document.getElementById('currentTime');

setInterval(() => {
    const updateDateTime = new Date();
    date.textContent = `${updateDateTime.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}`;
    time.textContent = `${updateDateTime.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' })}`;
})


// SETTINGS

const toggle = document.getElementById('settingsToggle');
const dropdown = document.getElementById('settingsDropdown');

    toggle.addEventListener('click', () => {
        dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';

    });

    window.addEventListener('click', (e) => {
        if (!toggle.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.style.display = 'none';
        }
    })
