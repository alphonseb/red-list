function donut_chart () {

    
    
    if (typeof count !== 'undefined') {
        const countArray = [];

        for (const key in count) {
            if (!key.includes('LR/')) {
                countArray.push({
                    name: key,
                    value: count[key]
                })
            }
        };

        countArray.sort((a, b) => {
            if (a.value.count < b.value.count) {
                return -1;
            }
            return 1;
        })

        const totalCount = countArray.reduce((accumulator, current) => accumulator + current.value.count, 0)

        const $donutContainer = document.querySelector('.js-donut')
        const $legendContainer = document.querySelector('.js-legend')

        const legends = {
            lc: "Least Concern",
            nt: "Not threatened",
            dd: "Data deficient",
            vu: "Vulnerable",
            ew: "Extinct in the Wild",
            ex: "Extinct",
            cr: "Critically endangered",
            en: "Endangered"
        }

        const offsets = []
        const perimeter = Math.PI * 2 * 20
        let offset = perimeter

        const $svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg')
        $svg.setAttribute('viewBox', '0 0 50 50')
        $svg.setAttribute('xmlns', 'http://www.w3.org/2000/svg')


        for (const _category of countArray) {
            const circle = document.createElementNS('http://www.w3.org/2000/svg','circle')
            circle.setAttribute('cx', '25')
            circle.setAttribute('cy', '25')
            circle.setAttribute('r', '20')
            circle.style.strokeDasharray = perimeter
            circle.style.strokeDashoffset = perimeter
            circle.classList.add(`circle-${ _category.name.toLowerCase() }`)
            _category.$el = circle
            $svg.appendChild(circle)
        }

        let delay = 0.5

        for (const _category of countArray.reverse()) {
            offset -= Math.floor(_category.value.count * 1000 / totalCount) / 1000 * perimeter

            TweenMax.to(_category.$el, 0.5, {
                strokeDashoffset: offset,
                delay
            })

            const $legend = document.createElement('p')
            $legend.classList.add(_category.name.toLowerCase())
            $legend.textContent = `${ Math.floor(_category.value.count * 1000 / totalCount) / 10 }% - ${ legends[_category.name.toLowerCase()] }`
            $legendContainer.appendChild($legend)

            delay += 0.1
            offsets.push(offset)
        }
        

        $donutContainer.insertAdjacentElement('afterbegin', $svg)
    }
}

