document.addEventListener('DOMContentLoaded', () => {
    // Toggle dropdown menu desktop
    const dropdownToggle = document.getElementById('dropdownToggle');
    const dropdownMenu = document.getElementById('dropdownMenu');

    if (dropdownToggle && dropdownMenu) {
        dropdownToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

        window.addEventListener('click', function (e) {
            if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    }

    // Toggle mobile menu
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Toggle dropdown in mobile menu
    const mobileDropdownToggle = document.getElementById('mobile-dropdown-toggle');
    const mobileDropdown = document.getElementById('mobile-dropdown');

    if (mobileDropdownToggle && mobileDropdown) {
        mobileDropdownToggle.addEventListener('click', (e) => {
            e.stopPropagation(); // opsional
            mobileDropdown.classList.toggle('hidden');
        });

        // Close mobile dropdown jika klik di luar
        window.addEventListener('click', function (e) {
            if (!mobileDropdownToggle.contains(e.target) && !mobileDropdown.contains(e.target)) {
                mobileDropdown.classList.add('hidden');
            }
        });
    }
});
