<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#space"></a>
      Space
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Even though we have Divider, but sometimes we need more than one Divider
      to split the elements apart, so we stack each elements upon Divider, but
      doing so not only makes our code ugly but also makes it difficult to
      maintain. Space is this kind of component provides us both productivity
      and elegance.
    </div>
    <!--end::Block-->
  </div>
  <EUIBasicUsage></EUIBasicUsage>
  <EUIVerticalLayout></EUIVerticalLayout>
  <EUIControlTheSizeOfTheSpace></EUIControlTheSizeOfTheSpace>
  <EUICustomizedSize></EUICustomizedSize>
  <EUIAutoWrapping></EUIAutoWrapping>
  <EUISpacer></EUISpacer>
  <EUIAlignment></EUIAlignment>
</template>

<script>
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import EUIBasicUsage from "@/views/resources/documentation/element-ui/basic/space/BasicUsage.vue";
import EUIVerticalLayout from "@/views/resources/documentation/element-ui/basic/space/VerticalLayout.vue";
import EUIControlTheSizeOfTheSpace from "@/views/resources/documentation/element-ui/basic/space/ControlTheSizeOfTheSpace.vue";
import EUICustomizedSize from "@/views/resources/documentation/element-ui/basic/space/CustomizedSize.vue";
import EUIAutoWrapping from "@/views/resources/documentation/element-ui/basic/space/AutoWrapping.vue";
import EUISpacer from "@/views/resources/documentation/element-ui/basic/space/Spacer.vue";
import EUIAlignment from "@/views/resources/documentation/element-ui/basic/space/Alignment.vue";

export default defineComponent({
  name: "space",
  components: {
    EUIBasicUsage,
    EUIVerticalLayout,
    EUIControlTheSizeOfTheSpace,
    EUICustomizedSize,
    EUIAutoWrapping,
    EUISpacer,
    EUIAlignment
  },
  setup() {
    setCurrentPageTitle("Space");
  }
});
</script>
