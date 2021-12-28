<template>
  <!--begin::Aside-->
  <div
    id="kt_aside"
    class="aside aside-hoverable"
    :class="[
      (asideTheme === 'light' || isDocPage) && 'aside-light',
      asideTheme === 'dark' && !isDocPage && 'aside-dark'
    ]"
    data-kt-drawer="true"
    data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}"
    data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}"
    data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle"
  >
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
      <!--begin::Logo-->
      <a href="#" v-if="asideTheme === 'dark' && !isDocPage">
        <img alt="Logo" :src="darkLogo" class="h-15px logo" />
      </a>
      <a href="#" v-if="asideTheme === 'light' || isDocPage">
        <img alt="Logo" :src="lightLogo" class="h-15px logo" />
      </a>
      <!--end::Logo-->

      <!--begin::Aside toggler-->
      <div
        id="kt_aside_toggle"
        class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
        data-kt-toggle="true"
        data-kt-toggle-state="active"
        data-kt-toggle-target="body"
        data-kt-toggle-name="aside-minimize"
        v-if="!isDocPage"
      >
        <span class="svg-icon svg-icon-1 rotate-180">
          <inline-svg
            src="media/icons/duotone/Navigation/Angle-double-left.svg"
          />
        </span>
      </div>
      <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->

    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
      <KTMenu></KTMenu>
    </div>
    <!--end::Aside menu-->

    <!--begin::Footer-->
    <div
      class="aside-footer flex-column-auto pt-5 pb-7 px-5"
      id="kt_aside_footer"
    >
      <router-link
        v-if="isDocPage"
        to="/dashboard"
        class="btn btn-primary w-100"
        >Preview Metronic</router-link
      >
      <router-link
        v-else
        to="/documentation/doc-overview"
        class="btn btn-custom btn-primary w-100"
        data-bs-toggle="tooltip"
        data-bs-trigger="hover"
        data-bs-delay-show="8000"
        title="Check out the complete documentation with over 100 components"
      >
        <span class="btn-label">
          Docs & Components
        </span>
        <span class="svg-icon btn-icon svg-icon-2">
          <inline-svg src="media/icons/duotone/General/Clipboard.svg" />
        </span>
      </router-link>
    </div>
    <!--end::Footer-->
  </div>
  <!--end::Aside-->
</template>

<script lang="ts">
import { defineComponent, onMounted, onUpdated } from "vue";
import { DrawerComponent } from "@/assets/ts/components/_DrawerOptions.ts";
import { ToggleComponent } from "@/assets/ts/components/_ToggleComponent.ts";
import KTMenu from "@/layout/aside/Menu.vue";
import { isDocPage } from "@/core/helpers/documentation";
import { asideTheme } from "@/core/helpers/config.ts";

export default defineComponent({
  name: "KTAside",
  components: {
    KTMenu
  },
  props: {
    lightLogo: String,
    darkLogo: String
  },
  setup() {
    onMounted(() => {
      DrawerComponent.reinitialization();
      ToggleComponent.reinitialization();
    });

    onUpdated(() => {
      ToggleComponent.bootstrap();
    });

    return {
      isDocPage,
      asideTheme
    };
  }
});
</script>
