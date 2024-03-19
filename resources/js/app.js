require('./bootstrap');

window.Vue = require("vue");
import BootstrapVue from "bootstrap-vue";

Vue.use(BootstrapVue);


Vue.component("person-list", require("./components/PersonList.vue").default);
Vue.component("layout-div", require("./components/LayoutDiv.vue").default)
Vue.component("person-edit", require("./components/PersonEdit.vue").default)
Vue.component("person-create", require("./components/PersonCreate.vue").default)

const app = new Vue({
    el: "#app"
});


