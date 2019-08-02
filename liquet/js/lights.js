;((window) => {
    const key = 'nicco.io:blog:lights'
    const CSS = 'body, .wp-block-image img, .thumbnail img {filter: invert(1);} '
    const style = window.document.createElement('style')
    document.head.appendChild(style)

    const on = () => {
        style.sheet.deleteRule(parseInt(window.localStorage.getItem(key)))
        window.localStorage.removeItem(key)
    }

    const off = () => {
        const i = style.sheet.insertRule(CSS)
        window.localStorage.setItem(key, i)
    }

    const isDark = () => window.localStorage.getItem(key) !== null

    if (isDark()) off()

    window.toggleLights = () => isDark() ? on() : off()
})(window)