jQuery(($) => {
    const bottomOffset = 300
    const app = document.getElementById('app')
    let loading = false

    function load() {

        const pixelToBottom = this.scrollHeight - (this.scrollTop + this.clientHeight)

        if (!loading && pixelToBottom < bottomOffset) {
            console.log('Loading...')
            loading = true
            $.ajax({
                url: lazy_load_params.ajaxurl,
                data: {
                    'action': 'lazy_load',
                    'query': lazy_load_params.posts,
                    'page': lazy_load_params.current_page
                },
                type: 'POST',
                success: function (data) {
                    if (data) {
                        $('#list').find('hr:last-of-type').after(data) // where to insert posts
                        lazy_load_params.current_page++
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
})