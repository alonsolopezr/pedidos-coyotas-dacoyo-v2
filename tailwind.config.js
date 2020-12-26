const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        borderColor: theme => ({
            ...theme('colors'),
            DEFAULT: theme('colors.gray.300', 'currentColor'),
            'coyos-lightbrown': '#C0B5B3',
            'coyos-midbrown': '#A7917B',
            'coyos-darkbrown': '#756B5B',
            'coyos-lightblue': '#B8DDF5',
            'coyos-darkblue': '#4E74B4',
            'coyos-lightpink': '#FF12848D',
            'coyos-darkpink': '#FF1CF19D',
            'coyos-lightyellow': '#FFEF0F',
            'coyos-darkyellow': '##FFE001'
        }),
        extend: {
            colors: {
                'coyos-lightbrown': '#C0B5B3',
                'coyos-midbrown': '#A7917B',
                'coyos-darkbrown': '#756B5B',
                'coyos-lightblue': '#B8DDF5',
                'coyos-darkblue': '#4E74B4',
                'coyos-lightpink': '#FF12848D',
                'coyos-darkpink': '#FF1CF19D',
                'coyos-lightyellow': '#FFEF0F',
                'coyos-darkyellow': '##FFE001'
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },

    },
    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    plugins: [require('@tailwindcss/ui')],
};