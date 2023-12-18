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
import { faBell } from "@fortawesome/free-solid-svg-icons";
import { faUser } from "@fortawesome/free-solid-svg-icons";
import { faEye } from "@fortawesome/free-solid-svg-icons";
import { faEyeSlash } from "@fortawesome/free-solid-svg-icons";
import { faTrash } from "@fortawesome/free-solid-svg-icons";
import { faBars } from "@fortawesome/free-solid-svg-icons";
import NestedReply from "./Components/Modals/Comments/NestedReply.vue";

library.add(faBell, faUser, faEye, faEyeSlash, faTrash, faBars);

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
            .component("NestedReply", NestedReply)
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: "#E38B29",
        showSpinner: false,
    },
});
