import Vue from 'vue'

import userHelpers from './user-helpers'

export default {
    install: () => {
        Vue.prototype.userHelpers = userHelpers
        Vue.userHelpers = userHelpers
    }
}
