import $ from 'jquery'

export default () => {
    const bottomOffset = 300
    const app = document.getElementById('app')
    let loading = false
    let page = WPParams.lazy.current_page

    function load() {

        const pixelToBottom = this.scrollHeight - (this.scrollTop + this.clientHeight)

        if (!loading && pixelToBottom < bottomOffset) {
            loading = true

            $.ajax({
                url: WPParams.lazy.ajaxurl,
                data: {
                    name: window.location.pathname
                        .replace(/(\/\d+){3}\//, '')
                        .replace(/\/$/, ''),
                    action: 'lazy_load',
                    page,
                },
                type: 'POST',
                success: (data) => {
                    if (data) {
                        $('#list').find('hr:last-of-type').after(data) // where to insert posts
                        page++
                        loading = false
                    }
                }
            })
        }
    }

    // Bind to the scroll event
    $('#app').scroll(load)

    // Check initial page if they need loading
    load.bind(app)()
}