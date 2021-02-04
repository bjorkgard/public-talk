const path = require('path')

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
            '@Shared': path.resolve('resources/js/Shared')
        }
    },
    output: {
        chunkFilename: 'js/[name].js?id=[chunkhash]'
    }
}
