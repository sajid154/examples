<template>
  <!--begin::Dashboard-->
  <div class="row gy-5 g-xl-8">
    <div class="col-xxl-4">
      <MixedWidget1></MixedWidget1>
    </div>
    <div class="col-xxl-4">
      <ListWidget5
        widget-classes="card-xxl-stretch mb-5 mb-xl-10"
      ></ListWidget5>
    </div>
    <div class="col-xxl-4">
      <StatsWidget7></StatsWidget7>
      <StatsWidget12></StatsWidget12>
    </div>
  </div>

  <div class="row gy-5 gx-xl-8">
    <div class="col-xxl-4">
      <ListWidget3 widget-classes="card-xxl-stretch mb-xl-3"></ListWidget3>
    </div>
    <div class="col-xxl-8">
      <TableWidget9
        widget-classes="card-xxl-stretch mb-5 mb-xl-8"
      ></TableWidget9>
    </div>
  </div>

  <div class="row gy-5 g-xl-8">
    <div class="col-xxl-4">
      <ListWidget2 widget-classes="card-xl-stretch mb-xl-8"></ListWidget2>
    </div>
    <div class="col-xxl-4">
      <ListWidget6 widget-classes="card-xl-stretch mb-xl-8"></ListWidget6>
    </div>
    <div class="col-xxl-4">
      <ListWidget1 widget-classes="card-xxl-stretch mb-xl-3"></ListWidget1>
    </div>
  </div>

  <div class="row g-5 gx-xxl-8">
    <div class="col-xxl-4">
      <StatsWidget13></StatsWidget13>
    </div>
    <div class="col-xxl-8">
      <TableWidget3
        widget-classes="card-xxl-stretch mb-5 mb-xxl-8"
      ></TableWidget3>
    </div>
  </div>
  <!--end::Dashboard-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import TableWidget9 from "@/components/widgets/table/Widget9.vue";
import TableWidget3 from "@/components/widgets/table/Widget3.vue";
import MixedWidget1 from "@/components/widgets/mixed/Widget1.vue";
import ListWidget1 from "@/components/widgets/list/Widget1.vue";
import ListWidget2 from "@/components/widgets/list/Widget2.vue";
import ListWidget3 from "@/components/widgets/list/Widget3.vue";
import ListWidget5 from "@/components/widgets/list/Widget5.vue";
import ListWidget6 from "@/components/widgets/list/Widget6.vue";
import StatsWidget7 from "@/components/widgets/stats/Widget7.vue";
import StatsWidget12 from "@/components/widgets/stats/Widget12.vue";
import StatsWidget13 from "@/components/widgets/stats/Widget13.vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";

export default defineComponent({
  name: "dashboard",
  components: {
    TableWidget9,
    TableWidget3,
    MixedWidget1,
    ListWidget1,
    ListWidget2,
    ListWidget3,
    ListWidget5,
    ListWidget6,
    StatsWidget7,
    StatsWidget12,
    StatsWidget13
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Dashboard");
    });
  }
});
</script>
