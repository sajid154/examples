<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#color-picker"></a>
      ColorPicker
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      ColorPicker is a color selector supporting multiple color formats.
    </div>
    <!--end::Block-->
  </div>
  <EUIBasicUsage></EUIBasicUsage>
  <EUIAlpha></EUIAlpha>
  <EUIPredefinedColors></EUIPredefinedColors>
  <EUISizes></EUISizes>
</template>

<script>
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import EUIBasicUsage from "@/views/resources/documentation/element-ui/form/color-picker/BasicUsage.vue";
import EUIAlpha from "@/views/resources/documentation/element-ui/form/color-picker/Alpha.vue";
import EUIPredefinedColors from "@/views/resources/documentation/element-ui/form/color-picker/PredefinedColors.vue";
import EUISizes from "@/views/resources/documentation/element-ui/form/color-picker/Sizes.vue";

export default defineComponent({
  name: "color-picker",
  components: {
    EUIBasicUsage,
    EUIAlpha,
    EUIPredefinedColors,
    EUISizes
  },
  setup() {
    setCurrentPageTitle("ColorPicker");
  }
});
</script>
