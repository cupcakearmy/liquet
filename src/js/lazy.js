import $ from 'jquery'

export default () => {
    const bottomOffset = 300
    const app = document.getElementById('app')
    let loading = false

    function load() {

        const pixelToBottom = this.scrollHeight - (this.scrollTop + this.clientHeight)

        if (!loading && pixelToBottom < bottomOffset) {
            loading = true
            $.ajax({
                url: WPParams.lazy.ajaxurl,
                data: {
                    'action': 'lazy_load',
                    'query': JSON.stringify(WPParams.lazy.posts),
                    'page': WPParams.lazy.current_page
                },
                type: 'POST',
                success: function (data) {
                    if (data) {
                        $('#list').find('hr:last-of-type').after(data) // where to insert posts
                        WPParams.lazy.current_page++
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