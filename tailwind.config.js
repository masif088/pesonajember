import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

const {addDynamicIconSelectors} = require("@iconify/tailwind");
/** @type {import('tailwindcss').Config} */
export default {
    content: ['./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php', './vendor/laravel/jetstream/**/*.blade.php', './storage/framework/views/*.php', './resources/views/**/*.blade.php',],

    theme: {

        colors: {
            green: {
                100: '#E9F8F4',
                200: '#d5fff1',
                900: '#5DA38E',
            },
            blue: {
                200: "#EBF3FE", 300: "#539BFF", 400: "#4784d9", 500: "#ECF2FF", 600: "#5D87FF", 700: "#4f73d9",
            }, cyan: {
                400: "#E8F7FF", 500: "#49BEFF", 600: "#3ea2d9",
            }, teal: {
                400: "#E6FFFA", 500: "#9fffeb", 600: "#10bd9d",
            }, yellow: {
                900: "#FDD700",
                200: "#fdee84",
                100: "#FFF4B9",
            },
            red: {
                400: "#FDEDE8", 500: "#FA896B", 600: "#d5745b",
                100: '#FFF2F2',900:'#FD0000'

            },
            gray: {
                50:'#FCFCFC',
                100: "#ebf1f6", 200: "#f4f4f4", 400: "#e5eaef", 500: "#5A6A85", 600: "#2a3547", 700: "#929292",
            }, transparent: "transparent", white: "#fff", black: "#c1c1c1",
        },

        fontFamily: {
            sans: ["Plus Jakarta Sans", "sans-serif"],
        }, borderRadius: {
            none: "0px", md: "7px", full: "50%", "2xl": "15px", "3xl": "9999px",
        }, extend: {
            boxShadow: {
                md: "rgba(145,158,171,0.2) 0px 0px 2px 0px,rgba(145,158,171,0.12) 0px 12px 24px -4px",
                xl: "inset 0 1px 2px rgba(90,106,133,0.075)",
            }, fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        }, container: {
            center: true, padding: "20px",
        },
    },


    variants: {}, plugins: [
        forms, typography,
        require("@tailwindcss/forms")({
                strategy: "base",
            }
        ),
        addDynamicIconSelectors(),
        require("@tailwindcss/typography"),
        require("preline/plugin"),
    ],
};
