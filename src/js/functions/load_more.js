function load_more () {
    
    const $countryLoadMore = document.querySelector('.js-load-more')
    
    if ($countryLoadMore) {
        const $loader = document.querySelector('.region__scroll-content__tiles .loader-container')
        const $fullLoader = document.querySelector('.region__scroll-content__tiles .full-loader')
        $countryLoadMore.addEventListener('click', () => {
            $loader.style.display = 'block'
            $countryLoadMore.style.display = 'none';
            //load more here
            const requestBody = new FormData()

            requestBody.append('speciesLeft', JSON.stringify(selectedSpecies.oldArray));

            window.fetch('#', {
                method: 'post',
                body: requestBody
            })
                .then(res =>res.text())
                .then(data => {
                    selectedSpecies = JSON.parse(data.split('===SEPARATOR===')[1])
                    const toRender = data.split('===SEPARATOR===')[0]
                    $fullLoader.insertAdjacentHTML('beforebegin', toRender)
                    $loader.style.display = 'none';
                    if (selectedSpecies.oldArray.count > 0) {
                        $countryLoadMore.style.display = 'block';
                    }
                })
        })
    }
    
}