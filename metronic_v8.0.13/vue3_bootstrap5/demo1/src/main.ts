import { createApp } from "vue";
import App from "./App.vue";

/*
TIP: To get started with clean router change path to @/router/clean.ts.
 */
import router from "./router";
import store from "./store";
import ElementPlus from "element-plus";

//imports for app initialization
import MockAdapter from "@/core/mock/MockService.ts";
import ApiService from "@/core/services/ApiService.ts";
import { initApexCharts } from "@/core/plugins/apexcharts";
import { initInlineSvg } from "@/core/plugins/inline-svg";
import { initVeeValidate } from "@/core/plugins/vee-validate.ts";

import "@/core/plugins/keenthemes.ts";
import "@/core/plugins/prismjs.ts";
import "bootstrap";

const app = createApp(App);

app.use(store);
app.use(router);
app.use(ElementPlus);

ApiService.init(app);
MockAdapter.init(app);
initApexCharts(app);
initInlineSvg(app);
initVeeValidate();

app.mount("#app");
