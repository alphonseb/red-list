function form_category () {
    
    /**
    *   Variables 
    */
    const categoryForm = document.querySelector('.categoryForm')
    const $tilesContainer = document.querySelector('.region__scroll-content__tiles')

    const $countryLoadMore = document.querySelector('.js-load-more')
    const $loader = document.querySelector('.region__scroll-content__tiles .loader-container')

    const $emptyPrompt = document.querySelector('.empty-cat')
    
    
    
    if (categoryForm) {
        const categoryInputs = categoryForm.querySelectorAll('.category input')
        for (const _input of categoryInputs) {
            // On click
            _input.addEventListener('change', (e) => {
                const currentTiles = [...$tilesContainer.querySelectorAll('a')];
                for (const _tile of currentTiles) {
                    _tile.remove()
                }
                $loader.style.display = 'block'
                const body = new FormData()
                body.append('cat', e.target.value)
                body.append('current_array', JSON.stringify(count))

                window.fetch('#', {
                    method: 'post',
                    body
                })
                    .then(res => res.text())
                    .then(data => {
                        selectedSpecies = JSON.parse(data.split('===SEPARATOR===')[1])
                        const toRender = data.split('===SEPARATOR===')[0]

                        if (selectedSpecies.newArray.length === 0) {
                            $emptyPrompt.classList.remove('hidden');
                        } else {
                            $emptyPrompt.classList.add('hidden');
                            $tilesContainer.insertAdjacentHTML('afterbegin', toRender)
                        }

                        $loader.style.display = 'none'
                        if (selectedSpecies.oldArray.count === 0) {
                            $countryLoadMore.style.display = 'none'
                        } else {
                            $countryLoadMore.style.display = 'block'
                        }
                    })
                
            })
        }
    }
}