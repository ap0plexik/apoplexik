const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        fontSize: {
            xs: ["0.75rem", { lineHeight: "1rem" }],
            sm: ["0.875rem", { lineHeight: "1.5rem" }],
            base: ["1rem", { lineHeight: "2rem" }],
            lg: ["1.125rem", { lineHeight: "1.75rem" }],
            xl: ["1.25rem", { lineHeight: "2rem" }],
            "2xl": ["1.5rem", { lineHeight: "2.5rem" }],
            "3xl": ["2rem", { lineHeight: "2.5rem" }],
            "4xl": ["2.5rem", { lineHeight: "3rem" }],
            "5xl": ["3rem", { lineHeight: "3.5rem" }],
            "6xl": ["3.75rem", { lineHeight: "1" }],
            "7xl": ["4.5rem", { lineHeight: "1" }],
            "8xl": ["6rem", { lineHeight: "1" }],
            "9xl": ["8rem", { lineHeight: "1" }],
        },
        extend: {
            backgroundImage: {
                search: "url('/img/search-icon.svg')",
            },
            backgroundPosition: {
                searchPos: "8px center",
            },
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
