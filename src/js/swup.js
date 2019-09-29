import Swup from 'swup'
import SwupPreloadPlugin from '@swup/preload-plugin';

export default (fn) => {
    const swup = new Swup({
        plugins: [new SwupPreloadPlugin()],
        containers: ['#app']
    })

    swup.on('contentReplaced', fn)
}
