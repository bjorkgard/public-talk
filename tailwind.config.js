const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue'
    ],

    theme: {
        extend: {
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                white: '#fff',
                black: '#000',
                gray: colors.coolGray,
                red: colors.red,
                teal: colors.teal
            },
            fontFamily: {
                //sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                sans: ['Inter var', ...defaultTheme.fontFamily.sans]
            }
        }
    },

    variants: {
        extend: {
            opacity: ['disabled']
        }
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('tailwindcss-debug-screens')
    ]
}
