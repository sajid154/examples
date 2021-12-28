<template>
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card Body-->
    <div class="card-body p-10 p-lg-15">
      <Overview></Overview>

      <BasicExample></BasicExample>

      <ContentBlocking></ContentBlocking>

      <CardBlocking></CardBlocking>

      <ModalBlocking></ModalBlocking>
    </div>
    <!--end::Card Body-->
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import Overview from "@/views/resources/documentation/base/overlay/Overview.vue";
import BasicExample from "@/views/resources/documentation/base/overlay/BasicExample.vue";
import ContentBlocking from "@/views/resources/documentation/base/overlay/ContentBlocking.vue";
import CardBlocking from "@/views/resources/documentation/base/overlay/CardBlocking.vue";
import ModalBlocking from "@/views/resources/documentation/base/overlay/ModalBlocking.vue";

export default defineComponent({
  name: "overlay",
  components: {
    Overview,
    BasicExample,
    ContentBlocking,
    CardBlocking,
    ModalBlocking
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Overlay");
    });
  }
});
</script>
