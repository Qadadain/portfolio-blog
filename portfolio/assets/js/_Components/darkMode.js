// On page load or when changing themes, best to add inline in `head` to avoid FOUC
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark')
    document.getElementById('logo').classList.add('dark')

} else {
    document.documentElement.classList.remove('dark')
    document.getElementById('logo').classList.remove('dark')
}


const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
        themeToggleLightIcon.classList.remove('hidden');
    } else {
        themeToggleDarkIcon.classList.remove('hidden');
    }

const themeToggleBtn = document.getElementById('theme-toggle');
themeToggleBtn.addEventListener('click', function () {
    themeToggleDarkIcon.classList.toggle('hidden');
    themeToggleLightIcon.classList.toggle('hidden');
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.add('dark');
        }
});
