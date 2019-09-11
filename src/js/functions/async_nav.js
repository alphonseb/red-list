function async_nav() {
    const $asyncLoader = document.querySelector('.async-loader')
    document.addEventListener('click', (e) => {
        if (e.target.matches('.async')) {
            e.preventDefault()
            $asyncLoader.style.display = 'flex'

            const destination = e.target.getAttribute('href')
            
            window.fetch(destination)
            .then(res => res.text())
            .then((data) => {
                const temp = document.createElement('html')
                temp.innerHTML = data
                const $content = temp.querySelector('[class$="scroll-content"]')
                const title = temp.querySelector('title').textContent

                document.title = title
                document.querySelector('[class$="scroll-content').remove()
                document.querySelector('.js-async-container').appendChild($content)

                if (document.querySelector('.js-donut')) {
                    donut_chart()
                }

                if (document.querySelector('.categoryForm')) {
                    form_category()
                }

                if (document.querySelector('.js-load-more')) {
                    load_more()
                }

                window.history.pushState({async: true}, title, destination)
                
                window.scrollTo(0, 0)
                $asyncLoader.style.display = 'none'
            })
        }
    })

    window.addEventListener('popstate', () => {
        window.location.reload()
        
    })
}