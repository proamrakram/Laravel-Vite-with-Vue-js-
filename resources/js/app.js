import "./bootstrap";

import { createApp } from "vue";
import ProductManagement from "../views/src/product-management.vue";

const app = createApp(ProductManagement);

app.mount("#app");
