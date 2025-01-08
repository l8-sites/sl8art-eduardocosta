/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    important: true,
    theme: {
        colors: {
            'primary': {
                light: 'var(--primary-light)',
                DEFAULT: 'rgb(var(--primary) / <alpha-value>)',
                dark: 'var(--primary-dark)',
                bw: 'var(--primary-bw)',
            },
            'secondary': {
                light: 'var(--secondary-light)',
                DEFAULT: 'rgb(var(--secondary) / <alpha-value>)',
                dark: 'var(--secondary-dark)',
                bw: 'var(--secondary-bw)',
            },
            'tertiary': {
                light: 'var(--tertiary-light)',
                DEFAULT:'rgb(var(--tertiary) / <alpha-value>)',
                dark: 'var(--tertiary-dark)',
                bw: 'var(--tertiary-bw)',
            },
            'fourth': {
                light: 'var(--fourth-light)',
                DEFAULT:'rgb(var(--fourth) / <alpha-value>)',
                dark: 'var(--fourth-dark)',
                bw: 'var(--fourth-bw)',
            },
            'colorprimary': 'rgb(var(--txt-primary) / <alpha-value>)',
            'colorsecondary': 'rgb(var(--txt-secondary) / <alpha-value>)',
            'colortertiary': 'rgb(var(--txt-tertiary) / <alpha-value>)',
            'colorfourth': 'rgb(var(--txt-fourth) / <alpha-value>)',
            success: {
                light: '#69ff91',
                DEFAULT: '#1ED561',
                dark: '#00a233',
            },
            'white': {
                light: '#f5f5f5',
                DEFAULT: '#ffffff',
                dark: '#9b9b9b',
            },
            'black': {
                light: '#2c2c2c',
                DEFAULT: '#000000',
                dark: '#181818',
            },
            'gray': {
                light: '#808080',
                DEFAULT:  '#545454',
                dark: '#2b2b2b',
            },
            'orange': {
                light: '#ffb346',
                DEFAULT:  '#fe8206',
                dark: '#c45300',
            },
            'red': {
                light: '#ff6b70',
                DEFAULT:  '#dc3545',
                dark: '#a3001e',
            },
            'blue': {
                light: '#6793ff',
                DEFAULT:  '#0f66e9',
                dark: '#003db6',
            },
            'yellow': {
                light: '#ffee4d',
                DEFAULT:  '#F9BC00',
                dark: '#c18c00',
            },
            'green': {
                light: '#69ff91',
                DEFAULT:  '#1ED561',
                dark: '#00a233',
                100: '#F2FDFC',
            },
            transparent: 'transparent',
            current: 'currentColor',
        },
        container: {
            center: true,
            padding: {
                DEFAULT: '1.5rem',
                md: '1rem',
                sm: '.8rem',
            },
        },
        extend: {
            fontFamily: {
                sans: ['Montserrat', ...defaultTheme.fontFamily.sans],
                'secondary': ['Montserrat'],
                'tertiary': ['BigNoodleTitling']
            },
        },
        aspectRatio: {
            auto: 'auto',
            square: '1 / 1',
            video: '16 / 9',
            1: '1',
            2: '2',
            3: '3',
            4: '4',
            5: '5',
            6: '6',
            7: '7',
            8: '8',
            9: '9',
            10: '10',
            11: '11',
            12: '12',
            13: '13',
            14: '14',
            15: '15',
            16: '16',
        },

    },
    plugins: [
        require('@tailwindcss/forms')({
            strategy: 'base',
            strategy: 'outline-input',
        }),
        require('@tailwindcss/aspect-ratio'),

        function ({ addComponents }) {
            addComponents({
                '.container': {
                    maxWidth: '100%',
                    '@screen sm': {
                        maxWidth: '640px',
                    },
                    '@screen md': {
                        maxWidth: '768px',
                    },
                    '@screen lg': {
                        maxWidth: '1024px',
                    },
                    '@screen xl': {
                        maxWidth: '1280px',
                    },
                }
            })
        }
    ],
}
