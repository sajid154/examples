<template>
  <EUICustomizable></EUICustomizable>
  <EUIPropAliases></EUIPropAliases>
</template>

<script>
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import EUICustomizable from "@/views/resources/documentation/element-ui/form/transfer/Customizable.vue";
import EUIPropAliases from "@/views/resources/documentation/element-ui/form/transfer/PropAliases.vue";

export default defineComponent({
  name: "transfer",
  components: {
    EUICustomizable,
    EUIPropAliases
  },
  setup() {
    setCurrentPageTitle("Transfer");
  }
});
</script>
