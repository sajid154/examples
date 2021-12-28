<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#skeleton"></a>
      Skeleton
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      When loading data, and you need a rich experience for visual and
      interactions for your end users, you can choose <code>skeleton</code>.
    </div>
    <!--end::Block-->
  </div>
  <EUIBasicUsage></EUIBasicUsage>
  <EUIConfigurableRows></EUIConfigurableRows>
  <EUIAnimation></EUIAnimation>
  <EUICustomizedTemplate></EUICustomizedTemplate>
  <EUILoadingState></EUILoadingState>
  <EUIRenderingAListOfData></EUIRenderingAListOfData>
  <EUIAvoidingRenderingBouncing></EUIAvoidingRenderingBouncing>
</template>

<script>
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import EUIBasicUsage from "@/views/resources/documentation/element-ui/data/skeleton/BasicUsage.vue";
import EUIConfigurableRows from "@/views/resources/documentation/element-ui/data/skeleton/ConfigurableRows.vue";
import EUIAnimation from "@/views/resources/documentation/element-ui/data/skeleton/Animation.vue";
import EUICustomizedTemplate from "@/views/resources/documentation/element-ui/data/skeleton/CustomizedTemplate.vue";
import EUILoadingState from "@/views/resources/documentation/element-ui/data/skeleton/LoadingState.vue";
import EUIRenderingAListOfData from "@/views/resources/documentation/element-ui/data/skeleton/RenderingAListOfData.vue";
import EUIAvoidingRenderingBouncing from "@/views/resources/documentation/element-ui/data/skeleton/AvoidingRenderingBouncing.vue";

export default defineComponent({
  name: "skeleton",
  components: {
    EUIBasicUsage,
    EUIConfigurableRows,
    EUIAnimation,
    EUICustomizedTemplate,
    EUILoadingState,
    EUIRenderingAListOfData,
    EUIAvoidingRenderingBouncing
  },
  setup() {
    setCurrentPageTitle("Skeleton");
  }
});
</script>
