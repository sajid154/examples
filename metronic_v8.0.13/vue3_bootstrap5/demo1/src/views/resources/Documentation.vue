<template>
  <router-view />
</template>

<script lang="ts">
import { defineComponent, onMounted, onUnmounted, onUpdated } from "vue";
import { useStore } from "vuex";
import { DrawerComponent } from "@/assets/ts/components/_DrawerOptions";

export default defineComponent({
  name: "documentation",
  components: {},
  setup() {
    const store = useStore();

    let minimized = false;

    onMounted(() => {
      DrawerComponent.reinitialization();
      if (store.getters.layoutConfig("toolbar.display")) {
        document.body.classList.remove("toolbar-enabled");
        document.body.classList.remove("toolbar-fixed");
        document.body.classList.remove("toolbar-tablet-and-mobile-fixed");
        if (document.body.getAttribute("data-kt-aside-minimize") === "on") {
          minimized = true;
          document.body.removeAttribute("data-kt-aside-minimize");
        }
      }
    });

    onUpdated(() => {
      DrawerComponent.reinitialization();
    });

    onUnmounted(() => {
      if (store.getters.layoutConfig("toolbar.display")) {
        document.body.classList.add("toolbar-enabled");
        document.body.classList.add("toolbar-fixed");
        document.body.classList.add("toolbar-tablet-and-mobile-fixed");
        if (minimized) {
          document.body.setAttribute("data-kt-aside-minimize", "on");
        }
      }
    });
  }
});
</script>
