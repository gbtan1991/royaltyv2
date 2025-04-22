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

