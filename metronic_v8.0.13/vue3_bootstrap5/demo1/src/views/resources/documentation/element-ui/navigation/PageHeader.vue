<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#page-header"></a>
      PageHeader
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      If path of the page is simple, it is recommended to use PageHeader instead
      of the Breadcrumb.
    </div>
    <!--end::Block-->
  </div>
  <EUIBasic></EUIBasic>
</template>

<script>
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import EUIBasic from "@/views/resources/documentation/element-ui/navigation/page-header/Basic.vue";

export default defineComponent({
  name: "page-header",
  components: {
    EUIBasic
  },
  setup() {
    setCurrentPageTitle("PageHeader");
  }
});
</script>
