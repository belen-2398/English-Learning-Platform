import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tail
 * windcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx}",
        "node_modules/flowbite/**/*.{js,jsx,ts,tsx}",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                mainColor: "#81d8be",
                accentColor: "#ee9292",
                bgColor: "#f9f6f6",
                lighterColor: "#d0ece3",
                lightColor: "#dbdbd8",
                darkColor: "#585858",
                darkerColor: "#599b87",
                darkestColor: "#051014",
            },
        },
    },

    plugins: [forms, typography, require("flowbite/plugin")],
};
