import Isotope from 'isotope-layout';

export default function() {

    const grid = document.querySelector('.tabs .grid-x');

    if (!grid) return;

    const regexResult = /tab=([^&]+)/.exec(window.location.hash),
        tabSelected = regexResult && regexResult[1],
        toggles = Array.from(document.querySelectorAll('.tabs-toggles > ul > li')),
        isotope = new Isotope(grid, {
            itemSelector: '.cell',
            masonry: {
                columnWidth: '.sizer'
            },
            percentPosition: true,
            transitionDuration: 1200,
            stagger: 100,
            hiddenStyle: {
                transform: 'scale(0.8)',
                opacity: 0
            },
            visibleStyle: {
                transform: 'scale(1)',
                opacity: 1
            }
        });

    let oldActiveToggle;

    if (tabSelected) {
        const toggleSelected = toggles.filter(el => el.dataset.tab === tabSelected)[0];
        if (toggleSelected) {
            setActiveTab(toggleSelected);
        } else {
            history.replaceState("", document.title, window.location.pathname);
            setActiveTab(toggles[0]);
        }
    } else {
        setActiveTab(toggles[0]);
    }

    toggles.forEach(el => el.addEventListener('click', () => setActiveTab(el)));

    function setActiveTab(toggle) {
        if (oldActiveToggle) {
            oldActiveToggle.classList.remove('active');
        }
        oldActiveToggle = toggle;
        toggle.classList.add('active');
        isotope.arrange({
            filter: (i, el) => {
                if (!toggle.dataset.tab) return true;
                return el.dataset.tabs && el.dataset.tabs.split(',').includes(toggle.dataset.tab);
            }
        });
        const hash = toggle.dataset.tab ? `#tab=${toggle.dataset.tab}` : '';
        history.replaceState('', document.title, window.location.pathname + hash);
    }

}