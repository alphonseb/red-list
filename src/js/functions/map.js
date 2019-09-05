function map () {
    
    const $mapSvg = document.querySelector('.map-container .js-world-svg');
    const $mapSvgGroup = document.querySelector('.map-container .js-world-svg .js-world-move');
    
    const windowSizes = {
        width: window.innerWidth,
        height: window.innerHeight
    }
    
    window.addEventListener('resize', () => {
        windowSizes.width = window.innerWidth
        windowSizes.height = window.innerHeight
    })
    
    if ($mapSvg) {
        $mapSvg.setAttribute('viewBox', `0 0 ${ windowSizes.width / 4 } ${ windowSizes.height / 4 }`)
        const svgGroupBbox = $mapSvgGroup.getBBox();

        window.addEventListener('resize', () => {
            $mapSvg.setAttribute('viewBox', `0 0 ${ windowSizes.width / 4 } ${ windowSizes.height / 4 }`)
        })


        const limits = {
            top: 10,
            left: 10,
            bottom: windowSizes.height / 4 - svgGroupBbox.height,
            right: windowSizes.width / 4 - svgGroupBbox.width
        }

        const mouseCurrent = {
            x: 0,
            y: 0
        }

        const mouseDown = {
            x: 0,
            y: 0
        }
    
        const mouseCursor = {
            x: 0,
            y: 0
        }

        const total = {
            x: -300 / 1000,
            y: -250 / 1000
        }

        TweenMax.set($mapSvgGroup, {
            x: total.x * 1000,
            y: total.y * 1000
        })
    
        const $description = document.querySelector('.map-container .country-description')
    
        let isDown = false
    
        window.addEventListener('mousedown', (_event) => {
            isDown = true
            mouseDown.x = _event.clientX / windowSizes.width - 0.5
            mouseDown.y = _event.clientY / windowSizes.height - 0.5
        })
        window.addEventListener('touchstart', (_event) => {
            isDown = true
            mouseDown.x = _event.touches[0].clientX / windowSizes.width - 0.5
            mouseDown.y = _event.touches[0].clientY / windowSizes.height - 0.5
            mouseCursor.x = _event.touches[0].clientX / windowSizes.width - 0.5
            mouseCursor.y = _event.touches[0].clientY / windowSizes.height - 0.5

            console.log(mouseDown, mouseCursor);
            
        })
    
        window.addEventListener('mouseup', (_event) => {
            isDown = false
            // mouseCurrent.x = _event.clientX / windowSizes.width - 0.5
            // mouseCurrent.y = _event.clientY / windowSizes.width - 0.5
            const movedX = mouseCursor.x - mouseDown.x
            const movedY = mouseCursor.y - mouseDown.y
            total.x += movedX
            total.y += movedY
            
            let slideX = (total.x + movedX * 0.1) * 1000
            if (slideX > limits.left) {
                slideX = limits.left
            } else if (slideX < limits.right) {
                slideX = limits.right
            }

            let slideY = (total.y + movedY * 0.1) * 1000
            if (slideY > limits.top) {
                slideY = limits.top
            } else if (slideY < limits.bottom) {
                slideY = limits.bottom
            }
            

            TweenMax.to($mapSvgGroup, 1.5, {
                x: slideX,
                y: slideY,
                ease: Power2.easeOut
            })
        })
        window.addEventListener('touchend', (_event) => {
            isDown = false
            console.log(_event);
            const movedX = mouseCursor.x - mouseDown.x
            const movedY = mouseCursor.y - mouseDown.y
            total.x += movedX
            total.y += movedY


            TweenMax.to($mapSvgGroup, 0.5, {
                x: (total.x + movedX * 0.1) * 1000,
                y: (total.y + movedY * 0.1) * 1000
            })
        })
    
        window.addEventListener('mousemove', (_event) => {
            mouseCursor.x = _event.clientX / windowSizes.width - 0.5
            mouseCursor.y = _event.clientY / windowSizes.height - 0.5

            $description.style.left = `${_event.clientX + 5}px`
            $description.style.top = `${_event.clientY + 5}px`
        })
        window.addEventListener('touchmove', (_event) => {
            mouseCursor.x = _event.touches[0].clientX / windowSizes.width - 0.5
            mouseCursor.y = _event.touches[0].clientY / windowSizes.height - 0.5

            $description.style.left = `${_event.touches[0].clientX + 5}px`
            $description.style.top = `${_event.touches[0].clientY + 5}px`
        })
    
        const $paths = $mapSvg.querySelectorAll('path');
    
        for (const _$path of $paths) {
            const countryCode = _$path.getAttribute('id')
            const countryName = Object.keys(countryNames).find(key => countryNames[key] === countryCode);
            let sanitizedCountryName
            if (countryName) {
                sanitizedCountryName = countryName.toLowerCase().split(' ').join('_')
            }
            
            _$path.addEventListener('mouseenter', () => {
                $description.innerHTML = `<strong>${countryName}</strong><br>${countryCodes[countryCode]} endangered species`
                $description.style.opacity = '1'
            })
            _$path.addEventListener('mouseleave', () => {
                $description.style.opacity = '0'
            })
    
    
            let fill = ''
            if (countryCodes[countryCode] > 7000) {
                fill = '#CA0813'
            }
            else if (countryCodes[countryCode] > 5000) {
                fill = '#FC361C'
            }
            else if (countryCodes[countryCode] > 3000) {
                fill = '#FC6620'
            }
            else if (countryCodes[countryCode] > 2000) {
                fill = '#FD9827'
            }
            else if (countryCodes[countryCode] > 1500) {
                fill = '#FECB2E'
            }
            else if (countryCodes[countryCode] > 1000) {
                fill = '#FFFD71'
            }
            else if (countryCodes[countryCode] > 500) {
                fill = '#3CCA3E'
            }
            else {
                fill = '#A7E7A8'
            }
    
            const $link = document.createElementNS("http://www.w3.org/2000/svg", 'a')
            $link.setAttribute('href', `${ URL }${ sanitizedCountryName }`)
    
            // const newPath = _$path.cloneNode();
    
            $link.appendChild(_$path)
            $mapSvgGroup.appendChild($link)
            _$path.style.fill = fill;
        }

        const animate = () => {
            window.requestAnimationFrame(animate)

            // TweenMax.set($mapSvgGroup, {
            //     x: -1008,
            //     y: -650
            // })

            if (isDown) {
                let setX = (total.x + (mouseCursor.x - mouseDown.x)) * 1000;

                if (setX > limits.left) {
                    setX = limits.left
                } else if (setX < limits.right) {
                    setX = limits.right
                }
                
                let setY = (total.y + (mouseCursor.y - mouseDown.y)) * 1000;
                if (setY > limits.top) {
                    setY = limits.top
                } else if (setY < limits.bottom) {
                    setY = limits.bottom
                }


                TweenMax.set($mapSvgGroup, {
                    x: setX,
                    y: setY
                })
            }

        }

        animate()
    }
}



