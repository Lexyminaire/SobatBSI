import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
        colors: ({ colors }) => ({
            inherit: colors.inherit,
            current: colors.current,
            transparent: colors.transparent,
            primary: "#9333EA",
            secondary: "#ff7e33",
            info: "#0C63E7",
            black: colors.black,
            white: colors.white,
            slate: colors.slate,
            gray: {
              50: "#FAFAFC",
              100: "#E9E9EC",
              200: "#C6C8CD",
              300: "#ACAEB6",
              400: "#92959F",
              500: "#777C87",
              600: "#5D6370",
              700: "#434959",
              800: "#293041",
              900: "#0f172a",
            },
            zinc: colors.zinc,
            neutral: colors.neutral,
            stone: colors.stone,
            red: colors.red,
            orange: colors.orange,
            amber: colors.amber,
            yellow: colors.yellow,
            lime: colors.lime,
            green: colors.green,
            emerald: colors.emerald,
            teal: colors.teal,
            cyan: colors.cyan,
            sky: colors.sky,
            blue: colors.blue,
            indigo: colors.indigo,
            violet: colors.violet,
            purple: colors.purple,
            fuchsia: colors.fuchsia,
            pink: colors.pink,
            rose: colors.rose,
          })
    },

    plugins: [forms, require("flowbite/plugin")],
};
