function show_backlink () {
    const $backLink = document.querySelector('.js-go-back')

    if ($backLink) {
        if (window.history.length < 2) {
            $backLink.style.display = 'none'
        }
    }
}