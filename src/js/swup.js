import Swup from 'swup'
import SwupPreloadPlugin from '@swup/preload-plugin'

export default (fn) => {
    const swup = new Swup({
        linkSelector: `a[href^="${window.location.origin}"]:not([data-no-swup]), a[href^="/"]:not([data-no-swup])`,
        plugins: [new SwupPreloadPlugin()],
        containers: ['#app']
    })

    swup.on('contentReplaced', fn)
}
