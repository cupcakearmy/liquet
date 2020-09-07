import lights from './lights'
import lazy from './lazy'
import swup from './swup'

document.addEventListener('DOMContentLoaded', () => {
  lights()
  lazy()
  swup(() => {
    lazy()
  })
})
