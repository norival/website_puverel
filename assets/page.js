import './styles/page.scss';

/**
 * @param {Event} event
 * @returns {undefined}
 */
const onClickMenuToggle = (event) => {
    event.preventDefault();
    document.getElementById('responsive-menu').classList.toggle('active');
    document.getElementById('menu-toggle').classList.toggle('active');
}

document.addEventListener('DOMContentLoaded', () => {
    let lastScrollPosition = 0;
    let ticking = false;
    const header = document.querySelector('header');

    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                // if (lastScrollPosition > window.scrollY) {
                //     // going up
                //     header.style.transform = 'translateY(0)';
                // } else {
                //     // going down
                //     header.style.transform = 'translateY(-100%)';
                // }
                lastScrollPosition = window.scrollY;

                if (lastScrollPosition > 0) {
                    header.style.boxShadow = '0 0 8px white';
                } else {
                    header.style.boxShadow = '0 0 0 white';
                }

                ticking = false;
            });

            ticking = true;
        }
    });

    // Burger menu
    document.getElementById('menu-toggle').addEventListener('click', onClickMenuToggle);
});
