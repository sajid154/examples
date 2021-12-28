<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#pagination"></a>
      Pagination
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      If you have too much data to display in one page, use pagination.
    </div>
    <!--end::Block-->
  </div>
  <EUIBasicUsage></EUIBasicUsage>
  <EUINumberOfPagers></EUINumberOfPagers>
  <EUIButtonsWithBackgroudColor></EUIButtonsWithBackgroudColor>
  <EUISmallPagination></EUISmallPagination>
  <EUIMoreElements></EUIMoreElements>
  <EUIHidePaginWhenThereIsOnePg></EUIHidePaginWhenThereIsOnePg>
</template>

<script>
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import EUIBasicUsage from "@/views/resources/documentation/element-ui/data/pagination/BasicUsage.vue";
import EUINumberOfPagers from "@/views/resources/documentation/element-ui/data/pagination/NumberOfPagers.vue";
import EUIButtonsWithBackgroudColor from "@/views/resources/documentation/element-ui/data/pagination/ButtonsWithBackgroudColor.vue";
import EUISmallPagination from "@/views/resources/documentation/element-ui/data/pagination/SmallPagination.vue";
import EUIMoreElements from "@/views/resources/documentation/element-ui/data/pagination/MoreElements.vue";
import EUIHidePaginWhenThereIsOnePg from "@/views/resources/documentation/element-ui/data/pagination/HidePaginWhenThereIsOnePg.vue";

export default defineComponent({
  name: "pagination",
  components: {
    EUIBasicUsage,
    EUINumberOfPagers,
    EUIButtonsWithBackgroudColor,
    EUISmallPagination,
    EUIMoreElements,
    EUIHidePaginWhenThereIsOnePg
  },
  setup() {
    setCurrentPageTitle("Pagination");
  }
});
</script>
