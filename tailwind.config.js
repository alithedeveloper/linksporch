const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                blue: {
                    light: '#85d7ff',
                    DEFAULT: '#4EBAEB',
                    dark: '#009eeb',
                },
                pink: {
                    light: '#ff7ce5',
                    DEFAULT: '#ff49db',
                    dark: '#ff16d1',
                },
                gray: {
                    darkest: '#1f2d3d',
                    dark: '#3c4858',
                    DEFAULT: '#c0ccda',
                    light: '#e0e6ed',
                    lightest: '#f9fafc',
                },
                green: {
                    darkest: '#335500',
                    darker: '#5D7C01',
                    dark: '#8B9569',
                    DEFAULT: '#B4D260',
                    light: '#F8FBEF',
                    lightest: '#F8FFF8'
                }
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
