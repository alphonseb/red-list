function loading () {
    const $loader = document.querySelector('.loader-package')

    window.addEventListener('load', () => {
        $loader.style.display = 'none'
    })

    if (!Element.prototype.matches) {
        Element.prototype.matches = Element.prototype.msMatchesSelector || 
                                    Element.prototype.webkitMatchesSelector;
    }

    if (!Element.prototype.closest) {
        Element.prototype.closest = function(s) {
            var el = this;
            if (!document.documentElement.contains(el)) return null;
            do {
                if (el.matches(s)) return el;
                el = el.parentElement || el.parentNode;
            } while (el !== null && el.nodeType == 1); 
            return null;
        };
    }

    document.addEventListener('click', (e) => {
        if (e.target.closest('a:not(.async)')) {
            $loader.style.display = 'flex'
        }
    })
}