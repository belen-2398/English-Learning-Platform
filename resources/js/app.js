import "./bootstrap";
import "../css/app.css";
import "flowbite";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
// import { faClipboard } from "@fortawesome/free-regular-svg-icons";
// import { faClipboardCheck } from "@fortawesome/free-solid-svg-icons";

// library.add(faClipboard, faClipboardCheck);

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText ||
    "Learn English";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .component("Head", Head)
            .component("font-awesome-icon", FontAwesomeIcon)
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: "#E38B29",
        showSpinner: false,
    },
});
