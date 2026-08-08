<!DOCTYPE html>
<html lang="en">


<head>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleSwitch = document.getElementById('themeToggle');
            
            // 1. Check local storage for saved theme
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.body.classList.add('dark-mode');
                if(toggleSwitch) toggleSwitch.checked = true;
            }

            // 2. Handle toggle change event
            if (toggleSwitch) {
                toggleSwitch.addEventListener('change', function() {
                    if(this.checked) {
                        document.body.classList.add('dark-mode');
                        localStorage.setItem('theme', 'dark');
                    } else {
                        document.body.classList.remove('dark-mode');
                        localStorage.setItem('theme', 'light');
                    }
                });
            }
        });
    </script>
</head>

<body>