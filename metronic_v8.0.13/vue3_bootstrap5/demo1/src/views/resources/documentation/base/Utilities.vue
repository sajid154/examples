<template>
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card Body-->
    <div class="card-body p-10 p-lg-15">
      <Overview></Overview>

      <ThemeColor></ThemeColor>

      <Spacing></Spacing>

      <FontSize></FontSize>

      <LineHeight></LineHeight>

      <Opacity></Opacity>

      <WidthAndHeight></WidthAndHeight>

      <ZIndex></ZIndex>
    </div>
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import Overview from "@/views/resources/documentation/base/utilities/Overview.vue";
import ThemeColor from "@/views/resources/documentation/base/utilities/ThemeColor.vue";
import Spacing from "@/views/resources/documentation/base/utilities/Spacing.vue";
import FontSize from "@/views/resources/documentation/base/utilities/FontSize.vue";
import LineHeight from "@/views/resources/documentation/base/utilities/LineHeight.vue";
import Opacity from "@/views/resources/documentation/base/utilities/Opacity.vue";
import WidthAndHeight from "@/views/resources/documentation/base/utilities/WidthAndHeight.vue";
import ZIndex from "@/views/resources/documentation/base/utilities/ZIndex.vue";

export default defineComponent({
  name: "utilities",
  components: {
    Overview,
    ThemeColor,
    Spacing,
    FontSize,
    LineHeight,
    Opacity,
    WidthAndHeight,
    ZIndex
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Utilities");
    });
  }
});
</script>
